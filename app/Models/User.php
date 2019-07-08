<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

 protected $table = "users";
 protected $primaryKey = 'user_id';

 protected $fillable = [
  'user_name',
  'user_email',
  'user_password',
  'user_phone',
  'address',
  'storename',
  'city_id',
  'user_role'
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

 public function city() {
    return $this->belongsTo('App\Models\City','city_id');
}
 
}
