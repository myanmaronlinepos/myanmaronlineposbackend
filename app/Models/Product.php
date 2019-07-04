<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

 protected $table = "products";
 protected $primaryKey = 'product_id';

 protected $fillable = [
  'product_name',
  'user_id',
  'category_id',
  'tag_id',
  'price_cost',
  'price_sell',
 ];

//  public function user() {
//     return $this->belongsTo('App\Models\User');
//  }
}
