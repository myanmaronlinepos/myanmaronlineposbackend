<?php

namespace App\Sell;

use App\Models\SellHistory;
use App\Models\User;
use Carbon\Carbon;

class SellHistoryTableHandler
{


 public function getSellItem($user_id) {
     return SellHistory::where('user_id',$user_id)->get();
 }

public function getData($user_id,$startDate,$endDate) {
    $start = new Carbon($startDate);
    $end=new Carbon($endDate);
     return $result=SellHistory::where('user_id',$user_id)
                    ->whereDate("created_at",">=",$start)
                    ->whereDate("created_at","<",$end)
                    ->get();
 }

}
