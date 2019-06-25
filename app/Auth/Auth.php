<?php

namespace App\Auth;

use App\Models\User;

class Auth
{

 public function check()
 {

  return isset($_SESSION['user']);
 }

 public function user()
 {

  return User::find($_SESSION['user']);
 }

 public function attempt($email, $password)
 {

  $user = User::where("user_email", $email)->first();

//   var_dump($user);
  if (!$user) {
   return false;
  }

  if (password_verify($password, $user->user_password)) {

   $_SESSION['user'] = $user->user_id;
   return true;
  }

  var_dump($password.$email."\n".$user->user_password);
  return false;
 }

 public function logout()
 {

  unset($_SESSION['user']);
 }
}
