<?php

namespace App\Products;

use App\Models\Product;

class ProductTableHandler
{

 public function getProducts($user_id)
 {

  return Product::where('user_id', $user_id)->get();
 }

 public function getProduct($product_id)
 {
  return Product::find($product_id);
 }
}
