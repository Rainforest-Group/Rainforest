<?php
/*
 * File: Rainforest Classes
 * Author: Steven Hillerman
 * Created: 11/13/17
 * 
 * Contains all of the classes to be used by the server.  Any changes made in the
 * 
 * Include this file in all files that require classes.
 */

/*============================================================================*/
class Item {
    public $itemID;
    public $itemType;
    public $itemDesc;
    public $itemPrice;
    
    function __construct($sentID = 1234, $sentType = "", $sentDesc = "", $sentPrice = 0.0)
    {
        $this->$itemID = $sentID;
        $this->$itemType = $sentType;
        $this->$itemDesc = $sentDesc;
        $this->$itemPrice = $sentPrice;
    }
}

/*============================================================================*/
class Inventory {
    public $itemList = array();
    public $quantList = array();
    function __construct() {
        // Pull items from database, store in item/quant array.
    }
    function updateDatabase() {
        // Update database with new items and quantities.
    }
    function addNewItem($sentID = 1234, $sentType = "", $sentDesc = "", $sentPrice = 0.0, $sentQuant = 0)
    {
        // Ensure that the item doesn't already exist.
        // Check if itemID exists in an item in the itemList
        $newItem = new Item($sentID, $sentType, $sentDesc, $sentPrice);
        $itemFound = self.addExisitingItem($newItem, $sentQuant);
        if (!$itemFound) {
            // If it does not exist, create and add new item.
            $itemList[$newItem] = $sentQuant;
        }
    }
    
    function addExisitingItem($sentItem, $sentQuant)
    {
        $itemFound = false;
        foreach($itemList as $key => $value) {
            if ($key.itemID == $sentID) {
                $itemFound = true;
                self.incItem($sentID, $sentQuant);
                break;
            }
        }
        return $itemFound;
    }
    function deleteItem($sentID)
    {
        // Delete item and quantity of that item from inventory
        $itemFound = false;
        foreach($itemList as $key => $value) {
            if ($key.itemID == $sentID) {
                $itemFound = true;
                unset($itemList[$key]);
                break;
            }
        }
        return $itemFound;
    }
    function decItem($itemID, $quantRemoved)
    {
        // Reduce the quantity of an item.
        // Do not remove more than the inventory actually has.
        // Return an int with the amount actually removed; -1 (?) if item doesnt exist.
        // Delete item and quantity of that item from inventory
        $numRemoved = -1;
        foreach($itemList as $key => $value) {
            if ($key.itemID == $sentID) {
                if ($itemList[$key] < $quantRemoved) {
                    $numRemoved = $itemList[$key];
                    $itemList[$key] = 0;
                } else {
                    $numRemoved = $quantRemoved;
                    $itemList[$key] = $itemList[$key] - $quantRemoved;
                }
                break;
            }
        }
        return $numRemoved;
    }
    function incItem($itemID, $quantAdded)
    {
        // Increase the quantity of an item.
        // Return true if item added; false if item does not exist in inv.
        $successfulAdd = false;
        foreach($itemList as $key => $value) {
            if ($key.itemID == $sentID) {
                $itemList[$key] = $itemList[$key] + $quantAdded;
                $successfulAdd = true;
                break;
            }
        }
        return $successfulAdd;
    }
}


/******************************************************************************/

/*
 * The Cart class represent each customer's cart.
 * 
 * Constructor: Cart(string username, { array<Item> item_list,
 *                                      array<int> quant_list } )
 *                                         ^Final 2 params are optional;
 *                                          must put neither or both.
 * 
 * Methods:
 * addToCart(Item item, int quantity) - inserts $quantity items into the cart
 * clearCart() - removes all items from the user's cart.
 * 
 * Getters and Setters:
 * getUsername - returns the username of the cart's owner
 */
class Cart {
    private $username;
    private $item_list = array();
    private $quant_list = array();

    public function __construct($username, $i_list = null, $q_list = null) {
        $this->username = $username;
        if ($i_list == null xor $q_list == null) {
            throw new Exception('Must provide both $i_list and $q_list, '
                              . 'or neither one of them');
        }
        if ($i_list != null) {
            $this->item_list = $i_list;
            if ($q_list != null) {
                $this->quant_list = $q_list;
            }
        }
    }

    // Adds the given Item and Quantity to the cart.
    public function addToCart($item, $quantity) {
        $this->item_list[] = $item;
        $this->quant_list[] = $quantity;

        // TODO: update database
    }

    // Removes all items from the user's cart.
    public function clearCart() {
        $this->item_list = array();
        $this->quant_list = array();

        // TODO: update database
    }

    public function getUsername() {
        return $this->username;
    }
}

/*============================================================================*/

/*
* The Order class contains information about each individual order.
* 
* Constructor: Order(string username, int order_id, array<Item> item_list);
*                                                 ^optional final param
*                                                   
* Methods:
* addItem($item) - adds an item to the order.
*/
class Order 
{        
    private $item_list = array();
    private $username;
    private $order_id;

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

        // TODO: update database
    }
}

/*============================================================================*/

/*
* The User class stores info that all users (admins and customers) have.
*  
* Constructor: User(string username, string password, { string address,
*                   string city, string state, int zip, string country,
*                   Cart * cart } );
*                   
*                   ^params that are surrounded by {} are optional)
*                                                   
* Methods:
* getFullAddress() - returns the full address of the user in string format.
*/
class User 
{
    protected $username;
    protected $password;
    protected $address;
    protected $city;
    protected $state;
    protected $zip;
    protected $country;

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
    function getFullAddress() {
        return "$this->address<br>$this->city, "
             . "$this->state $this->zip<br>$this->country";
    }
    
    // Standard getters and setters:

    function getCart() {
        return $this->cart;
    }

    function setCart($cart) {
        $this->cart = $cart;

        // TODO: update database
    }

    function getCountry() {
        return $this->country;
    }

    function setCountry($country) {
        $this->country = $country;

        // TODO: update database
    }

    function getZip() {
        return $this->zip;
    }
    
    function setZip($zip) {
        $this->zip = $zip;
        
        // TODO: update database
    }

    function getState() {
        return $this->state;
    }
    
    function setState($state) {
        $this->state = $state;
        
        // TODO: update database
    }

    function getCity() {
        return $this->city;
    }
    
    function setCity($city) {
        $this->city = $city;
        
        // TODO: update database
    }

    function getStreetAddress() {
        return $this->address;
    }
    
    function setStreetAddress($address) {
        $this->address = $address;
        
        // TODO: update database
    }

    // >>>>>>>>>>>>>>>>>>>>>>>>>>> Do we want to allow this? <<<<<<<<<<<<<<<<<<<<
    function getPassword() {
        return $this->password;
    }
    
    function setPassword($password) {
        $this->password = $password;
        
        // TODO: update database
    }

    function getUsername() {
        return $this->username;
    }
    
    function setUsername($username) {
        $this->username = $username;
        
        // TODO: update database
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
    public $cart;
    public $past_order_ids;

    function chargeOrder($orderID)
    {
        $this->past_order_ids[] = $orderID;
        $this->cart->clearCart();
        // TODO: update database
    }
}

?>