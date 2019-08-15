<?php
namespace App\Models\DataModel;

class ProductData {
    public $product_id;
    public $product_name;
    public $category_name;
    public $tag_name;
    public $imageurl;
    public $sell_price;
    public $cost_price;
    public $created_at;
    public $updated_at;
    /**
     * Class constructor.
     */
    public function __construct(
        $product_id,
        $product_name,
        $category_name,
        $tag_name,
        $imageurl,
        $sell_price,
        $cost_price
        )
    {
        $this->product_id=$product_id;
        $this->product_name=$product_name;
        $this->category_name=$category_name;
        $this->tag_name=$tag_name;
        $this->sell_price=$sell_price;
        $this->cost_price=$cost_price;
    }
}

