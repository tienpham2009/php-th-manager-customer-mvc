<?php
namespace App;

class Customers
{
    public string $name;
    public string $email;
    public string $address;
    public mixed $id;

    public function __construct($data)
    {
        $this->name = $data["name"];
        $this->email = $data["email"];
        $this->address = $data["address"];
    }


}