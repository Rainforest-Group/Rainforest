<?php
    
    // Make sure that this file is in the same directory as login_creds,
    // or specify a path to login_creds.php
    require_once 'login_creds.php';
    
    // newItem inserts a new Item into the database and returns it's item id.
    function getUserInfo($username) {
        $query = "SELECT * FROM Users WHERE username = $username";
        $result = executeQuery($query);
        $result->data_seek(0);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $result->close();
        return $row;
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
?>
