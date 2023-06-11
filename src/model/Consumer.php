<?php

require_once "../utils.php";

class Consumer
{
    public $_id;
    public $name;
    public $email;
    public $address;
    public $phone_number;
    public $gender;
    public $created_at;
    public $updated_at;
    public $deleted_at;

    public function __construct(
      string $name = '', 
      string $email = '', 
      string $address = '', 
      string $phoneNumber = '', 
      int $gender = 0,
      int $created_at = 0,
      int $updated_at = 0,
      int $deleted_at = 0
    ) {
        $this->_id = generateObjectId();
        $this->name = $name;
        $this->email = $email;
        $this->address = $address;
        $this->phone_number = $phoneNumber;
        $this->gender = $gender;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
        $this->deleted_at = $deleted_at;
    }
}
