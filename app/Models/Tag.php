<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model{

    protected $table="tag";
    protected $primaryKey = 'tag_id';

    protected $fillable=[
            'tag_id',
            'user_id',
            'tag_name',
    ];

public function setTagName($tag_name)
  {
  $this->update([
   'tag_name' =>$tag_name
  ]);
 }
}