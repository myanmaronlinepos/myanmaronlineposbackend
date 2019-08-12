<?php

namespace App\Inventory;

use App\Models\Inventory;
use App\Models\User;

class InventoryTableHandler
{

 public function getAllProductInventory($user_id)
 {

   return Inventory::where('user_id',$user_id)->get();
 }

 public function getInventory($product_id) {
    return Inventory::where('product_id',$product_id)->first();
 }

 public function inventory($inventory_id) {
   return Inventory::find($inventory_id);
 }
}
