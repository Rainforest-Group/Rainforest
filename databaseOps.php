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
        if (!$rows) {
            return false;
        }

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
    
    /***************************************************************************
     * The following functions are modifiers.  They ask for the primary key of
     * the item you want to modify, as well as the name of the attribute you
     * want to modify and the value that should go there.  Returns true if
     * successful, false if unsuccessful for any reason.
     **************************************************************************/
     
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
    
    function modifyOrder($order_id, $attribute, $val) {
        $query = "UPDATE Orders SET $attribute = " . quoteStrings($val) . 
                " WHERE order_id = $order_id";
        $result = executeQuery($query);
        if (!$result) {
            return false;
        }
        return true;
    }
    
    /***************************************************************************
     * The following functions are adders.  They ask for an object to add to
     * the database, as well as any other needed info.
     * 
     * Returns true if successful, false if unsuccessful for any reason.
     **************************************************************************/
    
    // Takes an Item object and adds it to the database.  Returns Item ID.
    function addItem($item) {
        global $hn, $un, $pw, $db;
        $name = $item->getName();
        $desc = $item->getDescription();
        $price = $item->getPrice();
        $exp = quoteStrings($item->isExpired());
        $quant = $item->getQuantity();
        
        $query = "INSERT INTO Items (title, price, description, "
                . "expired, quantity_in_stock) VALUES (\"$name\", $price, "
                . "\"$desc\", $exp, $quant)";
        
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $result = $conn->query($query);
        $id = $conn->insert_id;
        
        $conn->close();
        if (!$result) {
            return false;
        }
        return $id;
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
        $admin = quoteStrings($user->isAdmin());
        
        $query = "INSERT INTO Users (username, user_password, email, "
                . "street, city, state, country, zip, is_admin) VALUES ("
                . "\"$username\", \"$password\", \"$email\", \"$street\", "
                . "\"$city\", \"$state\", \"$country\", $zip, $admin)";
        
        $result = executeQuery($query);
        if (!$result) {
            return $query;
        }
        return true;
    }
    
    // Takes an Order object and adds it to the database.  Returns the order ID.
    function addOrder($order) {
        global $hn, $un, $pw, $db;
        $username = $order->getUsername();
        $items = $order->getItemList();
        $filled = quoteStrings($order->isFilled());
        $query = "INSERT INTO Orders (username, filled) VALUES"
                . " (\"$username\", $filled)";
        
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error) {
            die($conn->connect_error);
        }
        $result = $conn->query($query);
        $order_id = $conn->insert_id;
        $conn->close();
        
        foreach ($items as $item_id => $quant) {
            $result = addOrderItem($order_id, $item_id, $quant);
            if (!$result) {
                return false;
            }
        }
        return $order_id;
    }
    
    // Returns a numerical array of all item IDs in the database.
    function getAllItemIDs() {
        $query = "SELECT item_id FROM Items";
        $result = executeQuery($query);
        $rows = $result->num_rows;
        $ids = array();
        if (!$rows) {
            return false;
        }
        for ($i = 0; $i < $rows; $i++) {
            $result->data_seek($i);
            $row = $result->fetch_array(MYSQLI_NUM);
            $ids[] = $row[0];
        }
        $result->close();
        return $ids;
    }
    
/******************************************************************************/
/*                      Helper Functions - Do Not Call                        */
/******************************************************************************/
    
    function addOrderItem($orderID, $itemID, $quant) {
        $query = "INSERT INTO OrderItems (order_id, item_id, item_quantity)"
                . "VALUES ($orderID, $itemID, $quant)";
        
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
        if (gettype($val) == "boolean") {
            if ($val == true) {
                $ret_val = "true";
            } else {
                $ret_val = "false";
            }
        }
        if (gettype($val) == "NULL") {
            $ret_val = "NULL";
        }
        return $ret_val;
    }

function encrypt($pwd)
{
    $salt1    = "qm&h*";
    $salt2    = "pg!@";

    return hash('ripemd128', "$salt1$pwd$salt2");
}
?>
