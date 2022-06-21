<?php 
// class representing a single product item in the cart
class CartItem
{
    // Properties
    public $id;
    public $name;
    public $price;
    public $quantity;
    public $description;
    public $imageUrl;
    public $size;

    function __construct($id, $name, $price, $quantity, $imageUrl, $size)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->imageUrl = $imageUrl;
        $this->size = $size;
    }
}
