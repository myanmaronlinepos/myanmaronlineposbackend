<?php

namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Model\User;
use Respect\Validation\Validator as v;

class AuthController extends Controller
{

 public function postSignup($request, $response)
 {

  $validation = $this->validator->validate($request, [
   'user_name'     => v::notEmpty()->alpha(),
   'user_email'    => v::noWhitespace()->notEmpty()->email()->emailAvailable(),
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

    $response->getBody()->write("Something went wrong!");

   }

   return $response;
  }

  $user = User::create([
   'user_name'     => $request->getParam('user_name'),
   'user_email'    => $request->getParam('user_email'),
   'user_phone'    => $request->getParam('user_phone'),
   'address'       => $request->getParam('address'),
   'storename'     => $request->getParam('storename'),
   'city_id'       => $request->getParam('city_id'),
   'user_password' => password_hash($request->getParam('password'), PASSWORD_DEFAULT),
  ]);

  $auth = $this->auth->attempt(
   $request->getParam('email'),
   $request->getParam('password')
  );

  $response->getBody()->write(json_encode(array('signupStatus' => 'true')));
  return $response;
 }

 public function isLogged()
 {

  if ($this->auth->check()) {

   return json_encode(array('status' => true));
  } else {
   return json_encode(array('status' => false));
  }
 }

}
