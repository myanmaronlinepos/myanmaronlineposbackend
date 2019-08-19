<?php

namespace App\Models\DataModel;

class SellProduct {
    public $product_id;
    public $product_name;
    public $category_name;
    public $tag_name;
    public $quantity;
    public $sell_price;
    public $cost_price;

    /**
     * Class constructor.
     */
    public function __construct(
        $product_id,
        $product_name,
        $category_name,
        $tag_name,
        $quantity,
        $cost_price,
        $sell_price
        )
    {
        $this->product_id=$product_id;
        $this->product_name=$product_name;
        $this->category_name=$category_name;
        $this->tag_name=$tag_name;
        $this->quantity=$quantity;
        $this->cost_price=$cost_price;
        $this->sell_price=$sell_price;
    }
}