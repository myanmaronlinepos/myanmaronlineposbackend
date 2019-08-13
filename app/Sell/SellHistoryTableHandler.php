<?php

namespace App\Sell;

use App\Models\SellHistory;
use App\Models\User;

class SellHistoryTableHandler
{


 public function getSellItem($user_id) {
     return SellHistory::where('user_id',$user_id)->get();
 }
}
