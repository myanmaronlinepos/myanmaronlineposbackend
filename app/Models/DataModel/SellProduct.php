<?php

namespace App\Models\DataModel;

class SellProduct {
    public $product_name;
    public $category_name;
    public $tag_name;
    public $quantity;
    public $price_sell;
    public $price_cost;

    /**
     * Class constructor.
     */
    public function __construct(
        $product_name,
        $category_name,
        $tag_name,
        $quantity,
        $price_cost,
        $price_sell
        )
    {
        $this->product_name=$product_name;
        $this->category_name=$category_name;
        $this->tag_name=$tag_name;
        $this->quantity=$quantity;
        $this->price_cost=$price_cost;
        $this->price_sell=$price_sell;
    }
}