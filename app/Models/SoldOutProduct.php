<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoldOutProduct extends Model{

    protected $table="sellitem";
    protected $primaryKey = 'sellitem_id';
    public $timestamps = true;

    protected $fillable=[
            'sellitem_id',
            'sellhistory_id',
            'product_id',
            'quantity',
            'total_sell',
            'total_cost',
            'profit',
            'cost_price',
            'sell_price',
            'created_at',
            'updated_at'
    ];

}