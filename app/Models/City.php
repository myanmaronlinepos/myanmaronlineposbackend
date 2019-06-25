<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model{

    protected $table="city";

    protected $fillable=[
            'city_id',
            'city_name'
    ];
}