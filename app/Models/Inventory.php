<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model{

    protected $table="inventory";

    protected $fillable=[
            'inventory_id',
            'product_id',
            'quantity'
    ];
}