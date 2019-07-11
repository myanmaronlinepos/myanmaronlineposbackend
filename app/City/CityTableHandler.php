<?php

namespace App\City;

use App\Models\City;
use App\Models\User;

class CityTableHandler
{

 public function getCity($user_id)
 {
    $city=User::find($user_id)->city()->get();
    return $city;
    
 }

 public function getAllCity() {
     
    return City::all('city_id','city_name');
 }
}
