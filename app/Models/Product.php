<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model{

    protected $table="products";

    protected $fillable=[
            'product_name',
            'category_id',
            'tag_id',
            'price_cost',
            'price_sell'
    ];

    
}