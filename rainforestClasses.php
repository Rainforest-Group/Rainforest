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

/*
 * Be sure to put the constructor for Item in a try/catch block when pulling
 * info from the database (by giving the constructor the item ID).  Be sure to
 * always add new Items to your Inventory, or call updateInventory().
 */
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
    
    // Returns the Item ID (int)
    public function getID() {
        return $this->id;
    }
    
    // Returns the name or title of the Item (string)
    public function getName() {
        return $this->name;
    }
    
    // Takes the new name (string) as a parameter
    public function setName($name) {
        $this->name = $name;
        
        modifyItem($this->id, "title", $name);
    }
    
    // Returns the item's full description (string)
    public function getDescription() {
        return $this->description;
    }
    
    // Takes the item description (string) as a parameter.
    public function setDescription($desc) {
        $this->description = $desc;
        
        modifyItem($this->id, "description", $desc);
    }

    // Returns a shortened version of the description (55 char string or less)
    public function getSummary() {
        if (strlen($this->description) <= 55) {
            return $this->description;
        } else {
            return substr($this->description, 0, 55) . "...";
        }
    }
    
    // Returns the item's price (float)
    public function getPrice() {
        return $this->price;
    }
    
    // Takes a the new price (float with 2 decimals) as a parameter.
    public function setPrice($price) {
        $this->price = $price;
        
        modifyItem($this->id, "price", $price);
    }
    
    // Returns a boolean stating if the item is expired (no longer being sold)
    public function isExpired() {
        return $this->expired;
    }
    
    // Takes a boolean indicating whether the item is expired.
    public function setExpired($exp) {
        $this->expired = $exp;
        
        modifyItem($this->id, "expired", $exp);
    }
    
    // Returns the amount of this Item that is in stock (int)
    public function getQuantity() {
        return $this->quantity;
    }
    
    // Takes the new quantity (int) as a parameter.
    // Easier to use Inventory's modifyQuantity() method.
    public function setQuantity($quant) {
        $this->quantity = $quant;
        
        modifyItem($this->id, "quantity_in_stock", $quant);
    }
    
    // Private helper function
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

/*
 * Use this class when interacting with Item objects.  This class should be the
 * only thing storing Item objects.
 */
class Inventory {
    // itemList will store items, indexed by item id
    private $item_list = array();
    
    /*
     * The inventory constructor will pull all item IDs from the database,
     * create new Item objects from all of them, and add them to the item_list.
     */
    public function __construct() {
        $ids = getAllItemIDs();
        for ($i = 0; $i < count($ids); $i++) {
            $new_item = new Item($ids[$i]);
            $this->item_list[$ids[$i]] = $new_item;
        }
    }
    
    // Updates the inventory by re-checking the database for any new Items.
    public function updateInventory() {
        $this->__construct();
    }
    
    /* Takes an Item object as a parameter.
     * 
     * Attempts to add the item to the inventory.  Returns true if successful,
     * or false if the item was already in the inventory
     * .  
     * May be better to use updateInventory();
     */
    public function addItem($item)
    {
        if (!key_exists($item->getID(), $this->item_list)) {
            $this->item_list[$item->getID()] = $item;
            return true;
        }
        return false;
    }
    
    /* 
     * Takes the item ID (int) and a change in quantity (int) as parameters.
     * Returns true after the operation has taken place.  If you try to
     * remove too many items, it will not remove any, and will return false.
     * Use a negative change in quantity to remove and a positive change in
     * quantity to add items.
     */
    public function modifyQuantity($item_id, $change_in_quant) {
        if (!key_exists($item_id, $this->item_list)) {
            return false;
        }
        $curr_quant = $this->item_list[$item_id]->getQuantity();
        $new_quant = $curr_quant + $change_in_quant;
        if ($new_quant >= 0) {
            $this->item_list[$item_id]->setQuantity($new_quant);
            return true;
        } else {
            return false;
        }
    }
    
    // Returns the Item object with the given ID.  Returns false if there is no
    // Item with the given ID (int).
    public function getItem($id) {
        if (array_key_exists($id, $this->item_list)) {
            return $this->item_list[$id];
        } else {
            return false;
        }
    }
    
    // Returns an array of all Item IDs in the inventory;
    public function getItemList() {
        return array_keys($this->item_list);
    }
}

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
    
    // Returns the username associated with the order.
    function getUsername() {
        return $this->username;
    }
    
    // Returns a boolean indicating whether or not the order has been fulfilled.
    function isFilled() {
        return $this->filled;
    }
    
    // Takes a boolean parameter indicating if the order has been fulfilled.
    function setFilled($filled) {
        $this->filled = $filled;
        
        modifyOrder($this->order_id, "filled", $this->filled);
    }
    
    // Returns a boolean indicating whether or not the order has been placed.
    function isPlaced() {
        return $this->placed;
    }
    
    // Returns an int - the order ID.
    function getOrderId() {
        return $this->order_id;
    }
    
    // Returns an array of item quantities, indexed by Item ID.
    function getItemList() {
        return $this->item_list;
    }

    // Takes an item id (int) and quantity (int) and adds them to the order.
    // This cannot happen once the order has been processed.
    function addItem($item_id, $quant) {
        if (!$this->placed) {
            $this->item_list[$item_id] = $quant;
        }
    }
    
    // Takes an item ID (int) and deletes that item from the order.  This cannot
    // happen once the order has been processed.
    function deleteItem($item_id) {
        if (!$this->placed) {
            unset($this->item_list[$item_id]);
        }
    }
    
    // Removes all items from the order.  This cannot take place once the order
    // has been processed.
    public function clearOrder() {
        if (!$this->placed) {
            $this->item_list = array();
        }
    }
    
    /*
     * Adds all order info to the Orders and OrderItems tables in database, and
     * marks the order as placed. Once an order is processed, it cannot be
     * changed or deleted from the database.
     */
    function processOrder() {
        if (!placed) {
            $this->placed = true;
            $this->order_id = addOrder($this);
        }
    }
}

/*============================================================================*/

/*
 * User class
 */
class User 
{
    protected $username;
    protected $password;
    protected $email;
    protected $address;
    protected $city;
    protected $state;
    protected $zip;
    protected $country;
    protected $cart;
    protected $is_admin; // whether the user is an admin or customer
    protected $past_orders; // a list of order IDs
    
    /*
     * If no password is given, the constructor will automatically fill in the
     * remaining info from the database, using the username provided.
     * If at least a username and password are given, a new user will be created
     * in the database using the given info.
     */
    function __construct($username, $password = "", $email = "", $address = "", $city = "", 
                        $state = "", $zip = "", $country = "", $is_admin = false)
    {
        if ($password == "") {
            $data = getUserInfo($username);
            $this->setVariables($data);
            $this->past_orders = getAllUserOrders($username);
        } else {
            $this->username = $username;
            $this->password = $password;
            $this->email = $email;
            $this->address = $address;
            $this->city = $city;
            $this->state = $state;
            $this->zip = $zip;
            $this->country = $country;
            $this->is_admin = $is_admin;
            addUser($this);
        }
    }

    // Returns a string with the full address of the User, HTML formatted.
    function getFullAddress() {
        return "$this->address<br>$this->city, "
             . "$this->state $this->zip<br>$this->country";
    }
    
    // Returns the order object that is the user's cart.
    function getCart() {
        return $this->cart;
    }

    // Takes an Order object and sets it as the user's cart.
    function setCart($cart) {
        $this->cart = $cart;
    }

    // Returns the user's country (string)
    function getCountry() {
        return $this->country;
    }

    // Takes a string as a parameter: the user's country
    function setCountry($country) {
        $this->country = $country;

        modifyUser($this->username, "country", $country);
    }

    // Returns the users ZIP code (int)
    function getZip() {
        return $this->zip;
    }
    
    // Takes an int as a parameter (the user's zip code) 
    function setZip($zip) {
        $this->zip = $zip;
        
        modifyUser($this->username, "zip", $zip);
    }

    // Returns the user's State (strinng)
    function getState() {
        return $this->state;
    }
    
    // Takes the user's state as a parameter (string)
    function setState($state) {
        $this->state = $state;
        
        modifyUser($this->username, "state", $state);
    }

    // Returns the user's city (string)
    function getCity() {
        return $this->city;
    }
    
    // Takes the user's city as a parameter (string)
    function setCity($city) {
        $this->city = $city;
        
        modifyUser($this->username, "city", $city);
    }

    // Returns the user's street address (string)
    function getStreetAddress() {
        return $this->address;
    }
    
    // Takes the user's street address as a parameter (string)
    function setStreetAddress($address) {
        $this->address = $address;
        
        modifyUser($this->username, "address", $address);
    }

    // Returns the user's password (string)
    function getPassword() {
        return $this->password;
    }
    
    // Takes the user's password as a param (string).
    // Does not encrypt the password.
    function setPassword($password) {
        $this->password = $password;
        
        modifyUser($this->username, "password", $password);
    }
    
    // Returns the user's email (string)
    function getEmail() {
        return $this->email;
    }
    
    // Takes the user's email as a parameter (string)
    function setEmail() {
        $this->email = $email;
        
        modifyUser($this->username, "email", $email);
    }

    // Returns the user's username (string)
    function getUsername() {
        return $this->username;
    }
    
    // Takes the username as a param (string)
    function setUsername($username) {
        $this->username = $username;
        
        modifyUser($this->username, "username", $username);
    }
    
    // Returns an array of order ids associated with the user.
    function getOrderIds() {
        $this->updatePastOrders();
        return $this->past_orders;
    }
    
    /*
     * Updates the list of past orders.  This is automatically called in
     * getOrderIds().
     */
    function updatePastOrders() {
        $this->past_orders = getAllUserOrders($this->username);
    }
    
    //Returns true if the user is an admin, flase otherwise.
    function isAdmin() {
        return $this->is_admin;
    }
    
    // Takes a boolean indicating whether the user is an admin.
    function setAdmin($is_admin) {
        $this->is_admin = $is_admin;
        
        modifyUser($this->username, "is_admin", $is_admin);
    }
    
    // Private helper method.
    private function setVariables($data) {
        $this->username = $data['username'];
        $this->password = $data['password'];
        $this->email = $data['email'];
        $this->address = $data['street'];
        $this->city = $data['city'];
        $this->state = $data['state'];
        $this->zip = $data['zip'];
        $this->country = $data['country'];
        $this->is_admin = $data['is_admin'];
    }
}

/*============================================================================*/

/*
 * Everything below here is stuff that may be removed, but is currently only
 * commented out.
 */

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

/*class PastOrder extends Order
{
    function processOrder() {
        return null;
    }
}*/

/*
     * Fetches a user with the given username
     */
    /*public static function fetchUser($username) {
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
    }*/
?>
