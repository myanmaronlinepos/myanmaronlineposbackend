<?php

namespace App\Sell;

use App\Models\SoldOutProduct;
use App\Models\User;

class SoldOutItemTableHandler
{


    public function getAllSellItem($sellhistory_id) {
        return SoldOutProduct::where('sellhistory_id',$sellhistory_id)->get();
    }

    public function getCost($searchDate) {
        
        return $cost=SoldOutProduct::whereDate("created_at","=",$searchDate)->sum('total_cost');
    }
   
    public function getSell($searchDate) {
        return $income=SoldOutProduct::whereDate("created_at","=",$searchDate)->sum('total_sell');

   }
   
   public function getProfit($searchDate) {

    return $profit=SoldOutProduct::whereDate("created_at","=",$searchDate)->sum('profit');

   }
}
