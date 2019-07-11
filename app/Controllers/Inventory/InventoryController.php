<?php

namespace App\Controllers\Inventory;

use App\Controllers\Controller;
use App\Models\Inventory;

class CategoryController extends Controller
{

// api for get Categorys data and response back client
 public function getAllProductInventory($request, $response)
 {
    if($this->auth->check()) {

        // $user_name=$request->getParam('user_name');
        $user_id=$_SESSION['user'];
        $inventory=$this->inventory->getAllProductInventory($user_id);
        $response->getBody()->write(json_encode($inventory));
        return $response;

    }else {

        $response->getBody()->write(json_encode(false));
        return $response;
    }

 }

 public function addInventory($request,$response) {
    if($this->auth->check()) {
       $user_id=$_SESSION['user'];
       
       $validation = $this->validator->validate($request, [
           'user_id' => v::noWhitespace()->notEmpty(),
           'product_id'=> v::noWhitespace()->notEmpty(),
           'quantity'  => v::noWhitespace()->notEmpty(),
          ]);

          if ($validation->failed()) {

           if (isset($_SESSION['errors'])) {
        
            $error = $_SESSION['errors'];
            $response->write(json_encode($error));
        
           } else {
        
            $response->getBody()->write(json_encode(false));
        
           }
        
           return $response;
          }

          $inventory = Inventory::create([
           'user_id'   => $user_id,   
           'product_id'=> $request->getParam('product_id'),  
           'qunatity'  => $request->getParam('quantity'),
          ]);

          $response->getBody()->write(json_encode(true));
    }
}


}
