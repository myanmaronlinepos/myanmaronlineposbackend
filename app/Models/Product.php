<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

 protected $table = "products";
 protected $primaryKey = 'product_id';

 protected $fillable = [
  'product_id',
  'product_name',
  'user_id',
  'category_id',
  'tag_id',
  'price_cost',
  'price_sell',
  'imageUrl',
 ];

 public function setImage($imageUrl)
 {

  $this->update([

   'imageUrl' => $imageUrl,
  ]);
 }

 public function updateCategoryId($category_id) {
     $this->update([
        'category_id' => $category_id
     ]);
 }

}
