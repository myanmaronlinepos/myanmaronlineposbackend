<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellHistory extends Model{

    protected $table="sellhistory";
    protected $primaryKey = 'sellhistory_id';

    protected $fillable=[
            'sellhistory_id',
            'user_id',
            'created_at',
            'updated_at'
    ];

}