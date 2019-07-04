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

  if (!$user) {
   return false;
  }

  if (password_verify($password, $user->user_password)) {

   $_SESSION['user'] = $user->user_id;
   return true;
  }

  return false;
 }

 public function logout()
 {

  unset($_SESSION['user']);
 }
}
