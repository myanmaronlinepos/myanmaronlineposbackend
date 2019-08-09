<?php

namespace App\Controllers\Tag;

use App\Controllers\Controller;
use App\Models\Tag;
use Respect\Validation\Validator as v;

class TagController extends Controller
{

// api for get Categorys data and response back client
 public function getAllTag($request, $response)
 {
    if($this->auth->check()) {

        // $user_name=$request->getParam('user_name');
        $user_id=$_SESSION['user'];
        $tag=$this->tag->getAllTag($user_id);
        $response->getBody()->write(json_encode($tag));
        return $response->withStatus(200);

    }else {

        $response->getBody()->write(json_encode(false));
        return $response->withStatus(400);
    }

 }

 public function addTag($request,$response) {
    if($this->auth->check()) {
       $user_id=$_SESSION['user'];
       
       $validation = $this->validator->validate($request, [
           'tag_name'  => v::notEmpty(),
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

          $tag = Tag::create([
           'user_id'   => $user_id,   
           'tag_name'=> $request->getParam('tag_name'), 
          ]);

          $response->getBody()->write(json_encode(true));
          return $response->withStatus(200);
    }
}


}
