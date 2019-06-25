<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOwner extends Model{

    protected $table="productowner";

    protected $fillable=[
            'user_id',
            'product_id'
    ];
}