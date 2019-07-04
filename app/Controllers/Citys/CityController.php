<?php

namespace App\Controllers\Citys;

use App\Controllers\Controller;
use App\Models\City;

class CityController extends Controller
{

// api for get city data and response back client
 public function getCity($request, $response)
 {
    if($this->auth->check()) {
        $user_id=$_SESSION['user'];
        $city=$this->city->getCity($user_id);
        $response->getBody()->write(json_encode($city));
        return $response;

    }else {

        $response->getBody()->write(json_encode(array("permissionDenied"=>true)));
        return $response;
    }

 }

 public function getAllCity($request,$response) {

    $cities=$this->city->getAllCity()->toJson();
    $response->getBody()->write($cities);
    return $response;
 }

}
