<?php

namespace App\Tag;

use App\Models\Tag;
use App\Models\User;

class TagTableHandler
{


 public function getAllTag($user_id) {

    return Tag::select('tag_id','tag_name')->where('user_id',$user_id)->get();
 }

 public function getTag($tag_id) {
   return Tag::where('tag_id',$tag_id)->first();
}

public function tag($tag_id) {

   return Tag::find($tag_id);
 }
 
}
