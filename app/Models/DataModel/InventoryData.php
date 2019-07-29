<?php
namespace App\Models\DataModel;

class InventoryData {
    public $product_name;
    public $category_name;
    public $quantity;
    /**
     * Class constructor.
     */
    public function __construct($product_name,$category_name,$quantity)
    {
        $this->product_name=$product_name;
        $this->category_name=$category_name;
        $this->quantity=$quantity;
    }
}

