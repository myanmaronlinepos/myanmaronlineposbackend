<?php

namespace App\Sell;

use App\Models\SoldOutProduct;
use App\Models\User;

class SoldOutItemTableHandler
{


    public function getAllSellItem($sellhistory_id) {
        return SoldOutProduct::where('sellhistory_id',$sellhistory_id)->get();
    }
}
