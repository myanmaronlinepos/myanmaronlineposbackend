<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\User;
use Respect\Validation\Validator as v;

class AuthController extends Controller
{

// api for singup data and store that data in database
 public function postSignup($request, $response)
 {

  // validate user post value
  $validation = $this->validator->validate($request, [
   'user_name'     => v::notEmpty()->alpha(),
   'user_email'    => v::noWhitespace()->notEmpty()->email()->emailAvailable(),
   'user_password' => v::notEmpty(),
   'user_phone'    => v::notEmpty()->noWhitespace(),
   'address'       => v::notEmpty(),
   'storename'     => v::notEmpty(),
   'city_id'       => v::notEmpty()->noWhitespace(),
   'user_role'     => v::notEmpty()->noWhitespace()

  ]);

  if ($validation->failed()) {

   if (isset($_SESSION['errors'])) {

    $error = $_SESSION['errors'];
    $response->write(json_encode($error));

   } else {

    $response->getBody()->write("Something went wrong Validation failed!");

   }

   return $response;
  }

  // store user data in database
  $user = User::create([
   'user_name'     => $request->getParam('user_name'),
   'user_email'    => $request->getParam('user_email'),
   'user_phone'    => $request->getParam('user_phone'),
   'address'       => $request->getParam('address'),
   'storename'     => $request->getParam('storename'),
   'city_id'       => $request->getParam('city_id'),
   'user_role'     => $request->getParam('user_role'),
   'user_password' => password_hash($request->getParam('user_password'), PASSWORD_DEFAULT),
  ]);

  $this->postSignin($request,$response);
  
 }

 // api for check user is logged
 public function isLogged($request, $response)
 {
  $loggedStatus;

  if ($this->auth->check()) {

   $loggedStatus = json_encode(true);

  } else {
      
   $loggedStatus = json_encode(false);
  }

  $response->getBody()->write($loggedStatus);
  return $response;
 }

 //api for login
 public function postSignin($request,$response) {

    //check if user is already signin
    if(!$this->auth->check()) {

        $auth = $this->auth->attempt(
            $request->getParam('user_email'),
            $request->getParam('user_password')
           );
         
           $authentication;
           
           if ($auth) {
         
            $authentication = json_encode(true);
         
           } else {
         
            $authentication = json_encode(false);
           }
           $response->getBody()->write($authentication);
           return $response;
    }else {
        //if user is already signed, redirect dashboard
        $response->getBody()->write(json_encode(true));
        return $response;
    }
 }

 public function postSignOut($request,$response) {
     $responseMsg="";
     if($this->auth->check()) {
         $this->auth->logout();
         $responseMsg=true;
     }else {
         $responseMsg=false;
     }
     $response->getBody()->write(json_encode($responseMsg));
 }

}
