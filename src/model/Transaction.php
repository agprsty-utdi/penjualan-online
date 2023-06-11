<?php

require_once "../utils.php";

class Transaction
{
    public $_id;
    public $consumer_id;
    public $consumer_name;
    public $products;
    public $total_price;
    public $created_at;
    public $updated_at;
    public $deleted_at;

    public function __construct(
      string $consumer_id = '', 
      string $consumer_name = '',
      array $products = [], 
      float $total_price = 0.0,
      int $created_at = 0,
      int $updated_at = 0,
      int $deleted_at = 0
    ) {
        $this->_id = generateObjectId();
        $this->consumer_id = $consumer_id;
        $this->consumer_name = $consumer_name;
        $this->products = $products;
        $this->total_price = $total_price;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->deleted_at = $deleted_at;
    }
}

class TransactionItem
{
    public $_id;
    public $name;
    public $quantity;
    public $price;

    public function __construct(
      string $_id = '', 
      string $name = '',
      int $quantity = 0, 
      int $price = 0,
    ) {
        $this->_id = $_id;
        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;
    }
}
