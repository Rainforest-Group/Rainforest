<?php
/*
  File: Rainforest Classes
  Author: Steven Hillerman
  Created: 11/13/17
  
  Contains all of the classes to be used by the server, in alphabetical order.
  Include this file in all files that require classes.
*******************************************************************************/

    /*class Cart {
        private $user_id;
        private $item_list;
        private $quant_list;
        
        public function __construct() {
            
        }
    }*/

/*============================================================================*/
    
    /*
      The Order class contains information about each individual order.
      
      Constructor: Order(int user_id, int order_id, array<Item> item_list);
                                                      ^optional final param
                                                        
      Methods:
      addItem($item) - adds an item to the order.
    */
    class Order 
    {        
        public $item_list = array();
        public $user_id = -1;
        public $order_id = -1;
        
        function __construct($u_id, $o_id, $i_list = null) {
            $this->user_id = $u_id;
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