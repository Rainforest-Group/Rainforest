<?php

class User {
    public $id;
    public $username;
    public $password;
    public $city;
    public $state;
    public $address;
    public $zip;
    public $cart; // id of the cart

    function __construct($username, $password, $address, $city, $state, $zip, $cart)
    {
        $this->username = $username;
        $this->password = $password;
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->zip = $zip;
        $this->cart = $cart;
    }

    function displayAddress()
    {
        return "$this->address\n$this->city, $this->state $this->zip";
    }
}

?>
