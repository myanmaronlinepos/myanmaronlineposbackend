<?php

namespace App\Controllers\Categorys;

use App\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{

// api for get Categorys data and response back client
 public function getAllCategory($request, $response)
 {
    if($this->auth->check()) {

        // $user_name=$request->getParam('user_name');
        $user_id=$_SESSION['user'];
        $categories=$this->category->getAllCategory($user_id);
        $response->getBody()->write(json_encode($categories));
        return $response;

    }else {

        $response->getBody()->write(json_encode(false));
        return $response;
    }

 }

 //get category by product id
 public function getCategory($request,$response) {
     if($this->auth->check()) {
        $product_id=$request->getParam('product_id');
     }

 }

 public function addCategory($request,$response) {
    if($this->auth->check()) {
       $user_id=$_SESSION['user'];
       
       $validation = $this->validator->validate($request, [
           'user_id'        => v::noWhitespace()->notEmpty(),
           'category_name'  => v::noWhitespace()->notEmpty(),
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

          $category = Category::create([
           'user_id'        => $user_id,
           'category_name'  => $request->getParam('category_name'),
          ]);

          $response->getBody()->write(json_encode(true));
    }
}


}
