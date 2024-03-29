<?php

namespace App\Controllers\Categorys;

use App\Controllers\Controller;
use App\Models\Category;
use Respect\Validation\Validator as v;

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
        //    'user_id'        => v::noWhitespace()->notEmpty(),
           'category_name'  => v::notEmpty(),
          ]);

          if ($validation->failed()) {

           if (isset($_SESSION['errors'])) {
        
            $error = $_SESSION['errors'];
            $response->write(json_encode($error));
           }
           return $response->withStatus(400);
          }

          $category = Category::create([
           'user_id'        => $user_id,
           'category_name'  => $request->getParam('category_name'),
          ]);

          $response->getBody()->write(json_encode(true));
          return $response->withStatus(200);
    }else {

        $response->getBody()->write(json_encode(false));
        return $response->withStatus(400);
    }
}

public function updateCategory($request,$response) {
    if($this->auth->check()) {
        $user_id=$_SESSION['user'];
        
        $validation = $this->validator->validate($request, [
            'category_id'=> v::noWhitespace()->notEmpty(),
            'category_name'  => v::notEmpty(),
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
 
           $category=$this->category->category($request->getParam("category_id"));
           $category->setCategoryName($request->getParam("category_name"));
 
           $response->getBody()->write(json_encode(true));
           return $response->withStatus(200);
     }else {

        $response->getBody()->write(json_encode(false));
        return $response->withStatus(400);
    }
 }

 public function deleteCategory($request,$response) {
    if($this->auth->check()) {
        $user_id=$_SESSION['user'];
        
        $validation = $this->validator->validate($request, [
            'category_id'=> v::noWhitespace()->notEmpty(),
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
 
           $category=$this->category->category($request->getParam("category_id"));
           $category->delete();
 
           $response->getBody()->write(json_encode(true));
           return $response->withStatus(200);

     }else {

        $response->getBody()->write(json_encode(false));
        return $response->withStatus(400);
    }

 }

 public function assignProduct($request,$response) {
     if($this->auth->check()) {
        $user_id=$_SESSION['user'];

        $validation = $this->validator->validate($request, [
            'assignProductList'  => v::notEmpty(),
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

        $productList=$request->getParam("assignProductList");

        foreach($productList as $assignProduct) {
                $product_id=$assignProduct['product_id'];
                $category_id=$assignProduct['category_id'];
                $product=$this->product->getProduct($product_id);
                $result=$product->updateCategoryId($category_id);
            }

        $response->getBody()->write(json_encode(true));
        return $response->withStatus(200);
     }

     $response->getBody()->write(json_encode(false));
     return $response->withStatus(400);
 }

}