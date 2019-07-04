<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model{

    protected $table='category';
    protected $primaryKey='admin_id';
    
    protected $fillable=[
            'category_id',
            'category_name'
    ];
}