<?php
namespace App\Models\DataModel;

class ProductData {
    public $product_name;
    public $category_name;
    public $tag_name;
    public $price;
    /**
     * Class constructor.
     */
    public function __construct($product_name,$category_name,$tag_name,$price)
    {
        $this->product_name=$product_name;
        $this->category_name=$category_name;
        $this->tag_name=$tag_name;
        $this->price=$price;
    }
}

