<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model{

    protected $table="city";
    protected $primaryKey = 'city_id';

    protected $fillable=[
            'city_id',
            'city_name'
    ];

    public function user() {
        return $this->hasMany('App\Models\User','city_id');
    }
}