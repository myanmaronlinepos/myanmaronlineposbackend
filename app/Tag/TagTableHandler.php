<?php

namespace App\Tag;

use App\Models\Tag;
use App\Models\User;

class TagTableHandler
{


 public function getAllTag($user_id) {
     
    return Tag::where('user_id',$user_id);
 }
}
