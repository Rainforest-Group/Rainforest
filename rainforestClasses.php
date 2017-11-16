<?php
/*
  File: Rainforest Classes
  Author: Steven Hillerman
  Created: 11/13/17
  
  Contains all of the classes to be used by the server.
  Include this file in all files that require classes.

/*============================================================================*/

    class Item {
        public $itemType;
        public $itemDesc;
        public $itemPrice;
        
        function __construct($sentType = "", $sentDesc = "", $sentPrice = 0.0)
        {
            $this->$itemType = $sentType;
            $this->$itemDesc = $sentDesc;
            $this->$itemPrice = $sentPrice;
        }
    }

/*******************************************************************************/

    class Cart {
        public $username;
        public $item_list = array();
        public $quant_list = array();
        
        public function __construct($username, $i_list = null, $q_list = null) {
            $this->username = $username;
            if ($i_list == null xor $q_list == null) {
                throw new Exception('Must provide both $i_list and $q_list, or neither');
            }
            if ($i_list != null) {
                $this->item_list = $i_list;
                if ($q_list != null) {
                    $this->quant_list = $q_list;
                }
            }
        }
    }

/*============================================================================*/
    
    /*
      The Order class contains information about each individual order.
      
      Constructor: Order(int username, int order_id, array<Item> item_list);
                                                      ^optional final param
                                                        
      Methods:
      addItem($item) - adds an item to the order.
    */
    class Order 
    {        
        public $item_list = array();
        public $username;
        public $order_id;
        
        function __construct($username, $o_id, $i_list = null) {
            $this->username = $username;
            $this->order_id = $o_id;
            if ($i_list != null) {
                $this->item_list = $i_list;
            }
        }
        
        // This function adds the given Item to the list of items in the order.
        function addItem($item) {
            $this->item_list[] = $item;    
        }
    }
 
/*============================================================================*/
    
    /*
      The User class stores info that all users (admins and customers) have.
      
      Constructor: User(string username, string password, { string address,
                        string city, string state, int zip, string country,
                        Cart cart } );
                        
                        ^params that are surrounded by {} are optional)
                                                        
      Methods:
      getFullAddress() - returns the full address of the user in string format.
    */
    class User 
    {
        public $username;
        public $password;
        public $address;
        public $city;
        public $state;
        public $zip;
        public $country;
        
        function __construct($username, $password, $address = "", $city = "", 
                            $state = "", $zip = "", $country = "", $cart = NULL)
        {
            $this->username = $username;
            $this->password = $password;
            $this->address = $address;
            $this->city = $city;
            $this->state = $state;
            $this->zip = $zip;
            $this->country = $country;
            $this->cart = $cart;
        }
        
        // Returns a string with the full address of the User, properly formatted.
        function getFullAddress()
        {
            return "$this->address<br>$this->city, $this->state $this->zip<br>$this->country";
        }
    }
    
/*============================================================================*/
    
    /*
      >>>>>>>>>>>>>>>>>>>>>>>>>>>>> TALK ABOUT THIS <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
    */
    class Admin extends User
    {   
        // A pointer to the list of orders
        public $orders;
    }

/*============================================================================*/
   
    class Customer extends User
    {
        public $cart_id;
        public $past_order_ids;
        
        function chargeOrder($orderID)
        {
            $this->past_order_ids[] = $orderID;        
        }
    }

?>