<?php

namespace App\Controllers\Sell;

use App\Controllers\Controller;
use App\Models\SellHistory;
use App\Models\SoldOutProduct;
use App\Models\DataModel\SellItem;
use App\Models\DataModel\SellProduct;

class SellController extends Controller
{

 public function getAllSell($request, $response)
 {
    if($this->auth->check()) {

        // $user_name=$request->getParam('user_name');
        $user_id=$_SESSION['user'];
        $sellProduct=$this->product->getSellProduct($user_id);
        $response_product=[];
        foreach($sellProduct as $item) {

            $category_name="assign";
            $tag_name="assign";
            $category_id=$item->category_id;
            $tag_id=$item->tag_id;
            $category=$this->category->getCategory($category_id);

            if($category) {
                $category_name=$category->category_name;
            }

            $tag=$this->tag->getTag($tag_id);

            if($tag) {
                $tag_name=$tag->tag_name;
            }
            $inventory=$this->inventory->getInventory($item->product_id);
            
            if($category_name && $tag_name && $inventory) {
                $product=new SellProduct(
                    $item->product_id,
                    $item->product_name,
                    $category_name,
                    $tag_name,
                    $inventory->quantity,
                    $item->price_cost,
                    $item->price_sell
                );
                $response_product[]=$product;
            }
        }
        $response->getBody()->write(json_encode($response_product));
        return $response;

    }else {

        $response->getBody()->write(json_encode(false));
        return $response;
    }

 }

 public function getAllSellItem($request,$response) {
     if($this->auth->check()) {
        $user_id=$_SESSION['user'];
        $sell_historys=$this->sellhistory->getSellItem($user_id);
        $all_sell_items=[];

        foreach($sell_historys as $history) {

            if($history) {
               $sell_items=$this->soldoutitem->getAllSellItem($history->sellhistory_id);

               foreach($sell_items as $item) {
                   $product_name=$this->product->product($item->product_id)->product_name;
                   $sell=new SellItem(
                    $item->sellitem_id,
                    $history->sellhistory_id,
                    $item->product_id,
                    $product_name,
                    $item->quantity,
                    $item->cost_price,
                    $item->sell_price,
                    $item->total_sell,
                    $item->total_cost,
                    $item->profit,
                    $item->created_at
                   );
                   $all_sell_items[]=$sell;
               }
               
            }
        }
        $response->getBody()->write(json_encode($all_sell_items));
        return $response;
     }

     $response->getBody()->write(json_encode(false));
     return $response->withStatus(200);
 }

 public function storeSellHistory($request,$response) {
     if($this->auth->check()) {

     $user_id=$_SESSION['user'];
     $productList=$request->getParam('productList');
     
     if(!$productList){
        return $response->withStatus(200);
     }

     $sellhistory=SellHistory::create([
        'user_id'=>$user_id,
     ]);

   
     if($sellhistory) {
         $data=null;
         $sellhistory_id=$sellhistory->sellhistory_id;

         foreach($productList as $item) {
            if($item) {
               $quantity=$item['quantity'];
               $product_id=$item['product_id'];
               $total_sell=$item['total_sell'];
               $total_cost=$item['total_cost'];
               $profit=$item['profit'];
               $cost_price=$item['cost_price'];
               $sell_price=$item['sell_price'];

               $inventory=$this->inventory->getInventory($product_id);
               $inv_quantity=(int)$inventory->quantity - (int)$quantity;
               $inventory->setQuantity($inv_quantity);

               $result=SoldOutProduct::create([
                   'sellhistory_id'=>$sellhistory_id,
                   'product_id'=>$product_id,
                   'quantity'=>$quantity,
                   'cost_price' =>$cost_price,
                   'sell_price' =>$sell_price,
                   'total_sell'=>$total_sell,
                   'total_cost'=>$total_cost,
                   'profit' => $profit
               ]);
            }
         }
        
         $response->getBody()->write(json_encode(true));
         return $response->withStatus(200);
     }
    }

     $response->getBody()->write(json_encode(false));
     return $response->withStatus(200);

 }

}
