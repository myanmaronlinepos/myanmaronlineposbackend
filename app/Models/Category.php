<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model{

    protected $table='category';
    protected $primaryKey='category_id';
    
    protected $fillable=[
            'category_id',
            'user_id',
            'category_name'
    ];

public function setCategoryName($category_name)
  {
  $this->update([
   'category_name' =>$category_name
  ]);
 }
}
