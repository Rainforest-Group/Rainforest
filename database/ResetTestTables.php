<?php
    // This file, as well as login_creds.php and TestTables.txt must be on
    // pluto to work.  They can be on anyone's pluto account.

    // the following turns on error reporting (important on pluto)
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    // file to be opened
    $file_name = "TestTables.txt";

    // create connection to the database
    require_once 'login_creds.php';
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error)
        die($conn->connect_error);
    
    // get an array of queries from tables file
    $file = fopen($file_name, "r") or die("Unable to open file!");
    $contents = fread($file, filesize($file_name));
    fclose($file);
    $queries = getQueryArray($contents);
    
    
    
    // execute queries
    $success = TRUE;
    for ($j = 0; $j < count($queries); $j++) {
        $result = $conn->query($queries[$j]);
        if (!$result) {
            echo "Table reset failed: " . $conn->error . "<br><br>";
            $success = FALSE;
            break;
        }
    }
    if ($success == TRUE) {
        echo "Table reset successful!";
    }
    
    $conn->close();
    
    
    // This function takes a string that can contain multiple queries and
    // returns an array where each element is a single query.  The ';' is used
    // as a delimiter between queries.  You must end each query with a ';'.
    function getQueryArray($query_string) {
        $current_query = "";
        $query_list = array();
        $n_queries = 0;
        for ($i = 0; $i < strlen($query_string); $i++) {
            if ($query_string[$i] != ";") {
                $current_query = $current_query . $query_string[$i];
            } else {
                $query_list[$n_queries] = $current_query;
                $current_query = "";
                $n_queries++;
            }
        }
        return $query_list;
    }
?>