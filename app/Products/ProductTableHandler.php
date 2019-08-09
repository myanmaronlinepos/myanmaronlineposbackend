<?php

namespace App\Products;

use App\Models\Product;

class ProductTableHandler
{

 public function getProducts($user_id)
 {

  return Product::where('user_id', $user_id)->get();
 }

 public function product($product_id)
 {
  return Product::where('product_id',$product_id)->first();
 }

 public function getSellProduct($user_id) {
    return Product::where('user_id',$user_id)->get();
 }
}
