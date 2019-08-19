<?php
namespace App\Models\DataModel;

class InventoryData {
    public $inventory_id;
    public $product_name;
    public $category_name;
    public $quantity;
    /**
     * Class constructor.
     */
    public function __construct($inventory_id,$product_name,$category_name,$quantity)
    {
        $this->inventory_id=$inventory_id;
        $this->product_name=$product_name;
        $this->category_name=$category_name;
        $this->quantity=$quantity;
    }
}

