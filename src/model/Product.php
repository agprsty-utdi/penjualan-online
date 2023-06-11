<?php

require_once "../utils.php";

class Product
{
    public $_id;
    public $name;
    public $price;
    public $stock;
    public $created_at;
    public $updated_at;
    public $deleted_at;

    public function __construct(
      string $name = '', 
      float $price = 0.0, 
      int $stock = 0, 
      int $created_at = 0,
      int $updated_at = 0,
      int $deleted_at = 0
    ) {
        $this->_id = generateObjectId();
        $this->name = $name;
        $this->price = $price;
        $this->stock = $stock;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->deleted_at = $deleted_at;
    }
}
