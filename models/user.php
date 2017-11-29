<?php
    class User {
        public $id;
        public $username;
        public $password;
        public $city;
        public $state;
        public $address;
        public $zip;

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

    class Admin extends User {
        public $orders;
    }

    class Customer extends User {
        public $cart; // id of the cart
        public $past_orders;

        function chargeOrder($orderID)
        {
            // Append to $past_orders
        }
    }
?>
