<?php

namespace App\Controllers\Inventory;

use App\Controllers\Controller;
use App\Models\Inventory;
use App\Models\DataModel\InventoryData;
use Respect\Validation\Validator as v;

class InventoryController extends Controller
{

// api for get Categorys data and response back client
 public function getAllProductInventory($request, $response)
 {
    if($this->auth->check()) {

        // $user_name=$request->getParam('user_name');
        $user_id=$_SESSION['user'];
        $response_inventory=[];
        $inventory=$this->inventory->getAllProductInventory($user_id);
        $category_name="assign";
        // var_dump($inventory);

        foreach($inventory as $element) {
            $product_id=$element->product_id;
            $product=$this->product->product($product_id);
            
            if(!$product) {
                break;
            } 
    
            $category=$this->category->getCategory($product->category_id);

            if($category) {
                $category_name=$category->category_name;
            }
            
            $inv=new InventoryData(
                $element->inventory_id,
                $product->product_name,
                $category_name,
                $element->quantity
           );
           $response_inventory[]=$inv;
        }
        $response->getBody()->write(json_encode($response_inventory));
        return $response->withStatus(200);

    }

    $response->getBody()->write(json_encode(false));
    return $response->withStatus(400);

 }

 public function addInventory($request,$response) {
    if($this->auth->check()) {
       $user_id=$_SESSION['user'];
       
       $validation = $this->validator->validate($request, [
           'product_id'=> v::noWhitespace()->notEmpty(),
           'quantity'  => v::noWhitespace(),
          ]);

          if ($validation->failed()) {

           if (isset($_SESSION['errors'])) {
        
            $error = $_SESSION['errors'];
            $response->write(json_encode($error));
        
           } else {
        
            $response->getBody()->write(json_encode(false));
        
           }
        
          return $response->withStatus(400);           
          }

          $inventory = Inventory::create([
           'user_id'   => $user_id,   
           'product_id'=> $request->getParam('product_id'),  
           'qunatity'  => $request->getParam('quantity'),
          ]);

          $response->getBody()->write(json_encode(true));
          return $response->withStatus(200);
          
    }else {

        $response->getBody()->write(json_encode(false));
        return $response->withStatus(400);
    }
}

public function updateInventory($request,$response) {

    if($this->auth->check()) {
        $user_id=$_SESSION['user'];
        
        $validation = $this->validator->validate($request, [
            'inventory_id'=> v::noWhitespace()->notEmpty(),
            'quantity'  => v::noWhitespace(),
           ]);
 
           if ($validation->failed()) {
 
            if (isset($_SESSION['errors'])) {
         
             $error = $_SESSION['errors'];
             $response->write(json_encode($error));
         
            } else {
         
             $response->getBody()->write(json_encode(false));
         
            }
         
           return $response->withStatus(400);           
           }
 
           $inventory=$this->inventory->inventory($request->getParam("inventory_id"));
           $inventory->setQuantity($request->getParam("quantity"));
 
           $response->getBody()->write(json_encode(true));
           return $response->withStatus(200);

     }else {

        $response->getBody()->write(json_encode(false));
        return $response->withStatus(400);
    }
}

}
