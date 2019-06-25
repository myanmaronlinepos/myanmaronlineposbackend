<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryOwner extends Model{

    protected $table="categoryowner";

    protected $fillable=[
            'user_id',
            'category_id'
    ];
}