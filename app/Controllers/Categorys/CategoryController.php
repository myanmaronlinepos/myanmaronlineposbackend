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
        $categorys=$this->category->getCategorys($user_id)->toJson();
        $response->getBody()->write($categorys);
        return $response;

    }else {

        $response->getBody()->write(json_encode(array("permissionDenied"=>true)));
        return $response;
    }

 }

}
