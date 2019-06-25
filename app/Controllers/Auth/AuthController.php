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
   'user_email'    => v::noWhitespace()->notEmpty(),
   'user_password' => v::noWhitespace()->notEmpty(),
   'user_phone'    => v::notEmpty()->noWhitespace(),
   'address'       => v::notEmpty()->noWhitespace(),
   'storename'     => v::notEmpty()->noWhitespace(),
   'city_id'       => v::notEmpty()->noWhitespace(),

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
   'user_password' => password_hash($request->getParam('user_password'), PASSWORD_DEFAULT),
  ]);

  $auth = $this->auth->attempt(
   $request->getParam('user_email'),
   $request->getParam('user_password')
  );

  $authentication;
  
  if ($auth) {

   $authentication = json_encode(array('authenticationSuccess' => true));

  } else {

   $authentication = json_encode(array('authenticationSuccess' => false));
  }
  $response->getBody()->write($authentication);
  return $response;
 }

 // api for check user is logged
 public function isLogged($request, $response)
 {
  $loggedStatus;

  if ($this->auth->check()) {

   $loggedStatus = json_encode(array('status' => true));

  } else {
      
   $loggedStatus = json_encode(array('status' => false));
  }

  $response->getBody()->write($loggedStatus);
  return $response;
 }

}
