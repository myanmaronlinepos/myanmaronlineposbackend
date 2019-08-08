<?php

namespace App\Categorys;

use App\Models\Category;

class CategoryTableHandler
{

public function category()
{

    return Category::find($_SESSION['user']);
}
   

 public function getAllCategory($user_id)
 {
  return Category::select('category_id','category_name')->where('user_id',$user_id)->get();
 }

 public function getCategory($category_id) {
     return Category::select('category_id','category_name')->where('category_id',$category_id)->first();
 }
}
