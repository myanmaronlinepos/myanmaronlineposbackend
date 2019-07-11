<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\User;
use Respect\Validation\Validator as v;

class PasswordController extends Controller{

    public function postPasswordChange($request,$response) {

        if(!$this->auth->check()) {

             
             return  $response;
        }

            $validation=$this->validator->validate($request,[

            'password_old' => v::noWhitespace()->notEmpty()->matchesPassword($this->auth->user()->password),
            'password' => v::notEmpty() 
            ]);

        if($validation->failed()) {

            $response->getBody()->write(json_encode($_SESSION['errors']));
            return $response;
         }
             
        $this->auth->user()->setPassword($request->getParam('password'));
        
        $response->getBody()->write(json_encode(true));


      return $response;
    }
    
}