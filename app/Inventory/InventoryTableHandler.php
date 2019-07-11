<?php

namespace App\Inventory;

use App\Models\Inventory;
use App\Models\User;

class CategoryTableHandler
{

 public function getAllProductInventory($user_id)
 {

   return Inventory::where('user_id',$user_id)->get();
 }
}
