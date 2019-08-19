<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

 protected $table = "users";
 protected $primaryKey = 'user_id';

 protected $fillable = [
  'user_id',
  'user_name',
  'user_email',
  'user_password',
  'user_phone',
  'address',
  'storename',
  'user_role',
  'city_id',
  'imageurl',
 ];

//  public function products() {

//     return $this->hasMany('App\Models\Product');
//  }

 public function setPassword($password)
 {

  $this->update([

   'password' => password_hash($password, $PASSWORD_DEFAULT),
  ]);
 }

 public function setImage($imageUrl)
 {

  $this->update([

   'imageurl' => $imageUrl,
  ]);
 }

 public function city() {
    return $this->belongsTo('App\Models\City','city_id');
}

public function updateUserData($user_name,$user_email,$user_phone,$address,$city_id) {
    $this->update([
        'user_name' => $user_name,
        'user_email'=> $user_email,
        'user_phone'=> $user_phone,
        'address'   => $address,
        'city_id'   => $city_id,
    ]);
}
 
}
