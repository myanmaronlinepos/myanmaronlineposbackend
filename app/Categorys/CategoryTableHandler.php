<?php

namespace App\Categorys;

use App\Models\Category;

class CategoryTableHandler
{

 public function getAllCategory($user_id)
 {

  return Category::where('user_id',$user_id)->get();
 }

 public function getCategory($product_id) {
     return Category::find($product_id)->get();
 }
}
