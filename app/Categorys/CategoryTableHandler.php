<?php

namespace App\Categorys;

use App\Models\Category;

class CategoryTableHandler
{

 public function getCategorys($user_id)
 {

  return Category::select('category_name')->where('user_id',$user_id)->get();
 }
}
