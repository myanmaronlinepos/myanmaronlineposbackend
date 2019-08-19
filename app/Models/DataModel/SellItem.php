<?php
namespace App\Models\DataModel;

class SellItem {
    public $sellitem_id;
    public $sellhistory_id;
    public $product_id;
    public $product_name;
    public $quantity;
    public $total_sell;
    public $total_cost;
    public $profit;
    public $cost_price;
    public $sell_price;
    public $created_at;
    /**
     * Class constructor.
     */
    public function __construct(
        $sellitem_id,
        $sellhistory_id,
        $product_id,
        $product_name,
        $quantity,
        $cost_price,
        $sell_price,
        $total_sell,
        $total_cost,
        $profit,
        $created_at
        )
    {
        $this->sellitem_id=$sellitem_id;
        $this->sellhistory_id=$sellhistory_id;
        $this->product_id=$product_id;
        $this->product_name=$product_name;
        $this->quantity=$quantity;
        $this->cost_price=$cost_price;
        $this->sell_price=$sell_price;
        $this->total_sell=$total_sell;
        $this->total_cost=$total_cost;
        $this->profit=$profit;
        $this->created_at=$created_at;

    }
}
