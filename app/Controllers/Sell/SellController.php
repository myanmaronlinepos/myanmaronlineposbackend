<?php

namespace App\Controllers\Sell;

use App\Controllers\Controller;
use App\Models\SellHistory;
use App\Models\SoldOutProduct;
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

 public function storeSellHistory($request,$response) {
     $total=$request->getParam('total_price');
     $productList=$request->getParam('productList');
     $user_id=$_SESSION['user'];
     
     $sellhistory=SellHistory::create([
        'user_id'=>$user_id,
     ]);
   
     if($sellhistory) {
         $data=null;
         $sellhistory_id=$sellhistory->sellhistory_id;
         foreach($productList as $item) {
            if($item) {
               $element=array(
                   'sellhistory_id'=>$sellhistory_id,
                   'product_id'=>$item['product_id'],
                   'quantity'=>$item['quantity'],
                   'total_price'=>$total
               );

               $data[]=$element;
            }
         }
         $result=SoldOutProduct::insert($data);
         $response->getBody()->write(json_encode(true));
         return $response;
     }
     $response->getBody()->write(json_encode(false));
     return $response;

 }

}
