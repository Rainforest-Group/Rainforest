<?php
require_once 'databaseOps.php';
/*
 * File: Rainforest Classes
 * Author: Steven Hillerman
 * Created: 11/13/17
 * 
 * Contains all of the classes to be used by the server.  Any changes made in
 * the classes using setters will automatically by uploaded to the database.
 * 
 * Include this file in all files that require classes.
 * 
 * IMPORTANT: whenever you call a constructor, put in in a try/catch statement.
 * The classes will throw exceptions if the constructor is not called properly.
 */

/*============================================================================*/
class Item 
{
    private $id;
    private $name;
    private $description;
    private $price;
    private $expired;
    private $quantity;
    
    /*
     * When calling the constructor for Item, either give it only the id, or
     * a negative ID and other params.  If you only give it the ID, the 
     * constructor will attempt to automatically fill in the rest of the 
     * information from the database. If you give it a negative ID, it 
     * will automatically create a new Item in the database, and will assign
     * itself a new ID.
     */
    public function __construct($id = -1, $name = "", $price = -1, $desc = "",
                         $expired = false, $quantity = 0)
    {
        // If the ID was provided, get info from the database.
        if ($id > 0) {
            $item_info = getItemInfo($id);
            if ($item_info) {
                $this->setVariables($item_info);
            } else {
                throw new Exception('The given ID does not correspond to '
                        . 'any Item in the database.');
            }
        // If ID is 0 or negative, set to parameter values.
        } else {
            $this->id = -1;
            $this->name = $name;
            $this->description = $desc;
            $this->price = $price;
            $this->expired = $expired;
            $this->quantity = $quantity;
            $this->id = addItem($this);
            $info = getItemInfo($this->id);
            $this->setVariables($info);
        }
    }
    
    public function getID() {
        return $this->id;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function setName($name) {
        $this->name = $name;
        
        modifyItem($this->id, "title", $name);
    }
    
    public function getDescription() {
        return $this->description;
    }
    
    public function setDescription($desc) {
        $this->description = $desc;
        
        modifyItem($this->id, "description", $desc);
    }

    public function getSummary() {
        if (strlen($this->description) <= 55) return $this->description;
        return substr($this->description, 0, 55) . "...";
    }
    
    public function getPrice() {
        return $this->price;
    }
    
    public function setPrice($price) {
        $this->price = $price;
        
        modifyItem($this->id, "price", $price);
    }
    
    public function isExpired() {
        return $this->expired;
    }
    
    public function setExpired($exp) {
        $this->expired = $exp;
        
        modifyItem($this->id, "expired", $exp);
    }
    
    public function getQuantity() {
        return $this->quantity;
    }
    
    public function setQuantity($quant) {
        $this->quantity = $quant;
        
        modifyItem($this->id, "quantity_in_stock", $quant);
    }
    
    private function setVariables($val_arr) {
        $this->id = $val_arr['item_id'];
        $this->name = $val_arr['title'];
        $this->description = $val_arr['description'];
        $this->price = $val_arr['price'];
        $this->expired = $val_arr['expired'];
        $this->quantity = $val_arr['quantity_in_stock'];
    }
}

/*============================================================================*/

class Inventory {
    // itemList will store items, indexed by item id
    private $item_list = array();
    
    /*
     * The inventory constructor will pull all item IDs from the database,
     * create new Items from all of them, and add them to the item_list.
     */
    public function __construct() {
        $ids = getAllItemIDs();
        for ($i = 0; $i < count($ids); $i++) {
            $new_item = new Item($ids[$i]);
            $this->item_list[$ids[$i]] = $new_item;
        }
    }
    
    // Attempts to add the item to the inventory.  Returns true if successful,
    // or false if the item was already in the inventory.
    public function addItem($item)
    {
        if (!key_exists($item->getID(), $this->item_list)) {
            $this->item_list[$item->getID()] = $item;
            return true;
        }
        return false;
    }
    
    /*
     * Returns the number of items that can be removed after the operation has
     * taken place.  If you try to remove too many items, it will not remove 
     * any, and will return the number of items that you can remove.
     */
    public function modifyQuantity($item_id, $change_in_quant) {
        $curr_quant = $this->item_list[$item_id].getQuantity();
        $new_quant = $curr_quant + $change_in_quant;
        if ($new_quant >= 0) {
            $this->item_list[$item_id].setQuantity($new_quant);
            return $new_quant;
        } else {
            return $curr_quant;
        }
    }
    
    // Returns the Item object with the given ID.  Returns false if there is no
    // Item with the given ID.
    public function getItem($id) {
        if (array_key_exists($id, $this->item_list)) {
            return $this->item_list[$id];
        } else {
            return false;
        }
    }
    
    // Returns a list of all Item IDs in the inventory;
    public function getItemList() {
        return array_keys($this->item_list);
    }
}


/******************************************************************************/

/*
 * The Cart class represent each customer's cart.
 * 
 * Constructor: Cart(string username, { array<int> item_list,
 *                                      array<int> quant_list } )
 *                                         ^Final 2 params are optional;
 *                                          must put neither or both.
 * 
 * Methods:
 * addToCart(int item, int quantity) - inserts $quantity item ids into the cart
 * clearCart() - removes all items from the user's cart.
 * 
 * Getters and Setters:
 * getUsername - returns the username of the cart's owner
 */
/*class Cart {
    private $username;
    private $item_list = array(); // stores item ids
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

    // Adds the given item id and quantity to the cart.
    public function addToCart($item_ids, $quantity) {
        $this->item_list[] = $item_ids;
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
    
    // Turn cart into an order, then process that order
    public function checkOut() {
        
    }
}*/

/*============================================================================*/

/*
 * The Order class also functions as the cart.  Nothing is saved to the database
 * until the order is processed.  So all carts are temporary (not saved to the
 * database).
 */
class Order 
{      
    // item_list has the item_id as the key, and quantity as the value
    private $item_list = array();
    private $username; // username of the associated user.
    private $order_id;
    private $placed; // has the order been placed (cart checkout)
    private $filled; // has the order been fulfilled

    /*
     * When calling the constructor, giving it a positive order ID will make it
     * fill in the data from the database associated with that order id.  Giving
     * it a negative order ID will make it use the parameters given to it to
     * create a new order.  The order will not be added to the database, and
     * thus not given a new order ID, until processOrder has been called (when
     * the order is placed).
     */
    function __construct($o_id, $username = "", $i_list = null, 
            $order_placed = false, $order_filled = false) {
        if($o_id > 0) {
            // If they gave a positive ID, get info from the database
            $data = getOrderInfo($o_id);
            $this->order_id = $o_id;
            $this->username = $data['username'];
            $this->placed = true;
            $this->filled = $data['filled'];
            for ($i = 0; $i < count($data['item_list']); $i++) {
                $item_id = $data['item_list'][$i];
                $quant = $data['quant_list'][$i];
                $this->item_list[$item_id] = $quant;
            }
        } else {
            // If they gave a negative ID, set info from parameters
            $this->order_id = -1;
            $this->username = $username;
            $this->filled = $order_filled;
            $this->placed = $order_placed;
            if ($i_list != null) {
                $this->item_list = $i_list;
            }
        }
    }
    
    function getUsername() {
        return $this->username;
    }
    
    function isFilled() {
        return $this->filled;
    }
    
    function setFilled($filled) {
        $this->filled = $filled;
        
        modifyOrder($this->order_id, "filled", $this->filled);
    }
    
    function isPlaced() {
        return $this->placed;
    }
    
    function getOrderId() {
        return $this->order_id;
    }
    
    function getItemList() {
        return $this->item_list;
    }

    // This function adds the given Item to the list of items in the order.
    function addItem($item) {
        if (!placed) {
            $this->item_list[] = $item;
        }
    }
    
    // Because the order is not saved to the database until it is placed, there
    // is never any need to delete items from the database.
    function deleteItem($item_id) {
        if (!placed) {
            unset($this->item_list[$item_id]);
        }
    }
    
    // Removes all items from the user's cart.
    public function clearOrder() {
        $this->item_list = array();
    }
    
    /*
     * Adds all order info to Orders and OrderItems tables in database, and
     * creates a new PastOrder object.  Once an order is processed, it cannot be
     * changed or deleted from the database.
     */
    function processOrder() {
        if (!placed) {
            $this->placed = true;
            $this->order_id = addOrder($this);
        }
    }
}

/*class PastOrder extends Order
{
    function processOrder() {
        return null;
    }
}*/

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
    protected $cart;
    protected $is_admin; // whether the user is an admin or customer
    protected $past_orders; // an array of PastOrder objects
    
    // Need to allow for just the ID.
    function __construct($username, $password, $email, $address = "", $city = "", 
                        $state = "", $zip = "", $country = "", $cart = NULL)
    {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->zip = $zip;
        $this->country = $country;
        $this->cart = $cart;
    }
    
    /*
     * In this constructor, providing only the username will make it
     * automatically fill in the rest of the info from the database.  Providing
     * anything else will automatically create a new user in the database
     * with the provided information.  It will return true if successful or
     * false if unsuccessful.
     */
    /*function __construct($username, $password = "", $address = "", $city = "", 
                        $state = "", $zip = "", $country = "", $cart = NULL,
                        $is_admin = false) {
        // pull user info from database
        
        // pull past order info from the database
            // create new PastOrder objects, and put them in $past_orders
    }

    /*
     * Fetches a user with the given username
     */
    public static function fetchUser($username) {
    // stub code
        $user_data = getUserInfo($username);
        if (!$user_data) return false;

        $user = new User($user_data['username'], $user_data['user_password'], $user_data['email'],
            $user_data['street'], $user_data['city'], $user_data['state'], $user_data['zip'], $user_data['country']);

        return $user;
    }

    // Saves the user in the database
    function save() {
        return addUser($this);
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

    function getPassword() {
        return $this->password;
    }
    
    function setPassword($password) {
        $this->password = $password;
        
        // TODO: update database
    }
    
    function getEmail() {
        return $this->email;
    }
    
    function setEmail() {
        $this->email = $email;
        
        // TODO: update database
    }

    function getUsername() {
        return $this->username;
    }
    
    function setUsername($username) {
        $this->username = $username;
        
        // TODO: update database
    }
    
    // Returns the order ids associated with the user.
    function getOrderIds() {
        // TODO: fill in
    }
    
    // Add a PastOrder to past_orders
    function addPastOrder($pastorder) {
        // TODO: fill in
    }
    
    //Returns true if the user is an admin, flase otherwise.
    function isAdmin() {
        return $this->is_admin;
    }
    
    function setAdmin($is_admin) {
        $this->is_admin = $is_admin;
        
        //TODO: update database
    }
}

/*============================================================================*/

/*
 >>>>>>>>>>>>>>>>>>>>>>>>>>>>> TALK ABOUT THIS <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
*/
/*class Admin extends User
{   
    // A pointer to the list of orders
    public $orders;
}

//==============================================================================

class Customer extends User
{
    public $past_order_ids;

    function chargeOrder($orderID)
    {
        $this->past_order_ids[] = $orderID;
        $this->cart->clearCart();
        // TODO: update database
    }
}*/




/*  This may or may not be used, but I didn't want to take it out completely.
    function addNewItem($sentID = -1, $sentType = "", $sentDesc = "", $sentPrice = 0.0, $sentQuant = 0)
    {
        // Ensure that the item doesn't already exist.
        // Check if itemID exists in an item in the itemList
        $newItem = new Item($sentID, $sentType, $sentDesc, $sentPrice);
        $itemFound = self.addExisitingItem($newItem, $sentQuant);
        if (!$itemFound) {
            // If it does not exist, create and add new item.
            $itemList[$newItem] = $sentQuant;
        }
    }*/

?>
