<?php
    
    // Make sure that this file is in the same directory as login_creds,
    // or specify a path to login_creds.php
    require_once 'login_creds.php';
    
    /***************************************************************************
     * The following functions are getters.  The ask for the primary key of the
     * item you are looking for as parameter(s), and return an associative array
     * containing all of the info in the database involving that object.
     **************************************************************************/
    
    // Returns info from the User table
    function getUserInfo($username) {
        $query = "SELECT * FROM Users WHERE username = $username";
        $result = getAssocArray($query);
        return $result;
    }
    
    // Returns info from the Item table
    function getItemInfo($item_id) {
        $query = "SELECT * FROM Items WHERE item_id = $item_id";
        $result = getAssocArray($query);
        return $result;
    }
    
    // Returns all info about the order, including item ids and quantities
    function getOrderInfo($order_id) {
        $query = "SELECT * FROM Orders WHERE order_id = $order_id";
        $result = getAssocArray($query);
        $items_info = getItemsInOrder($order_id);
        $result["item_list"] = $items_info["items"];
        $result["quant_list"] = $items_info["quants"];
        return $result;
    }
    
    // Returns an array of size 2, with element "items" being an array of item
    // ids, and element "quants" being an array of quantities.
    function getItemsInOrder($order_id) {
        // TODO
    }
    
    function modifyAttribute($sentTable, $sentAtt, $sentVal) {
        return false; // return success/failure
    }

    function addItem($sentItem, $sentQuant) {
        return false; // return success/failure
    }

    function addUser($sentUser) {
        return false; // return success/failure
    }

    function addOrder($sentOrder) {
        return false; // return success/failure
    }

    function addOrderItem($sentOrderID, $sentItemID, $sentQuant) {
        return false; // return success/failure
    }
    
/******************************************************************************/
/*                              Helper Functions                              */
/******************************************************************************/
    
    function executeQuery($query) {
        // create connection to the database
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
        $result->data_seek(0);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $result->close();
        return $row;
    }
?>
