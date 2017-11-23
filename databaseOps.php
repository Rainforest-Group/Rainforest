<?php
    
    // Make sure that this file is in the same directory as login_creds,
    // or specify a path to login_creds.php
    require_once('database/login_creds.php');
    require_once('rainforestClasses.php');
    
    /***************************************************************************
     * The following functions are getters.  The ask for the primary key of the
     * item you are looking for as parameter(s), and return an associative array
     * containing all of the info in the database involving that object.  
     * 
     * If there is no entry in the database that matches your search, the
     * functions will return false.
     **************************************************************************/
    
    // Returns info from the User table, or False if the user doesn't exist.
    function getUserInfo($username) {
        $query = "SELECT * FROM Users WHERE username = \"$username\"";
        $result = getAssocArray($query);
        return $result;
    }
    
    // Returns info from the Item table, or False if the item doesnt exist.
    function getItemInfo($item_id) {
        $query = "SELECT * FROM Items WHERE item_id = $item_id";
        $result = getAssocArray($query);
        return $result;
    }
    
    // Returns all info about the order, or False if the Order doesn't exist.
    function getOrderInfo($order_id) {
        $query = "SELECT * FROM Orders WHERE order_id = $order_id";
        $result = getAssocArray($query);
        if ($result == false) {
            return false;
        }
        $items_info = getItemsInOrder($order_id);
        $result["item_list"] = $items_info["items"];
        $result["quant_list"] = $items_info["quants"];
        return $result;
    }
    
    // Returns an array of size 2, with element "items" being an array of item
    // ids, and element "quants" being an array of quantities.
    function getItemsInOrder($order_id) {
        $query = "SELECT * FROM OrderItems WHERE order_id = $order_id";
        $result = executeQuery($query);
        $item_ids = array();
        $item_quants = array();
        $rows = $result->num_rows;
        if (!$rows) return false;

        for ($i = 0; $i < $rows; $i++) {
            $result->data_seek($i);
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $item_ids[] = $row["item_id"];
            $item_quants[] = $row["item_quantity"];
        }
        $result->close();
        $return_array = array();
        $return_array["items"] = $item_ids;
        $return_array["quants"] = $item_quants;
        return $return_array;
    }
    
    function modifyUser($username, $attribute, $val) {
        // need to check val type.  If it is a string, need to put quotes around it.
        $query = "UPDATE Users SET $attribute = " . quoteStrings($val) . 
                " WHERE username = \"$username\"";
        $result = executeQuery($query);
        if (!$result) {
            return false;
        }
        return true;
    }
    
    function modifyItem($item_id, $attribute, $val) {
        $query = "UPDATE Items SET $attribute = " . quoteStrings($val) . 
                " WHERE item_id = $item_id";
        $result = executeQuery($query);
        if (!$result) {
            return false;
        }
        return true;
    }
    
    // Takes an Item object and adds it to the database
    function addItem($item, $quant) {
        $id = $item->getID();
        $name = $item->getName();
        $desc = $item->getDescription();
        $price = $item->getPrice();
        $exp = $item->isExpired();
        
        $query = "INSERT INTO Items (item_id, title, price, description, "
                . "expired, quantity_in_stock) VALUES ($id, \"$name\", $price, "
                . "\"$desc\", $exp, $quant";
        
        $result = executeQuery($query);
        if (!$result) {
            return false;
        }
        return true;
    }

    // Takes a User object and adds it to the database
    function addUser($user) {
        $username = $user->getUsername();
        $password = $user->getPassword(); // May need to change this
        $email = $user->getEmail();
        $street = $user->getStreetAddress();
        $city = $user->getCity();
        $state = $user->getState();
        $country = $user->getCountry();
        $zip = $user->getZip();
        $admin = $user->isAdmin();
        
        $query = "INSERT INTO Users (username, password, email, "
                . "street, city, state, country, zip, is_admin) VALUES ("
                . "\"$username\", \"$password\", \"$email\", \"$street\", "
                . "\"$city\", \"$state\", \"$country\", $zip, $admin)";
        
        $result = executeQuery($query);
        if (!$result) {
            return false;
        }
        return true;
    }
    
    // Takes an Order object and adds it to the database
    function addOrder($order) {
        $username = $order->getUsername();
        $order_id = $order->getOrderId();
        $items = $order->getItemList();
        
        $query1 = "INSERT INTO Orders (order_id, username) VALUES "
                . "($order_id, \"$username\")";
        
        $result = executeQuery($query1);
        if (!$result) {
            return false;
        }
        
        foreach ($items as $item_id => $quant) {
            $result = addOrderItem($order_id, $item_id, $quant);
            if (!result) {
                return false;
            }
        }
        
        return true;
    }
    
/******************************************************************************/
/*                      Helper Functions - Do Not Call                        */
/******************************************************************************/
    
    function addOrderItem($orderID, $itemID, $quant) {
        $query = "INSERT INTO OrderItems (order_id, item_id, item_quantity)"
                . "VALUES ($orderID, $itemID, $quant";
        
        $result = executeQuery($query);
        if (!$result) {
            return false;
        }
        return true;
    }
    
    function executeQuery($query) {
        // create connection to the database
        global $hn, $un, $pw, $db;
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $result = $conn->query($query);
        $conn->close();
        return $result;
    }
    
    function getAssocArray($query) {
        $result = executeQuery($query);
        if ($result == false) {
            return false;
        } else {
            $result->data_seek(0);
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $result->close();
            return $row;
        }
    }
    
    function quoteStrings($val) {
        $ret_val = $val;
        if (gettype($val) == "string" and strtolower($val) != "true" and
                strtolower($val) != "false") {
            $ret_val = "\"$val\"";
        }
        return $ret_val;
    }
?>
