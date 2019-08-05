<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoldOutProduct extends Model{

    protected $table="sellitem";
    protected $primaryKey = 'sellitem_id';

    protected $fillable=[
            'sellitem_id',
            'sellhistory_id',
            'product_id',
            'quantity',
            'total_price',
            'cost_price',
            'sell_price',
            'created_at',
            'updated_at'
    ];

}