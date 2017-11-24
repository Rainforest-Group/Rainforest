    <?php
        // remove session and session cookie
        session_start();
        $_SESSION = array();
        setcookie(session_name(), '', time() - 1000, '/');
        session_destroy();

        // Redirect back to index
        header("Location: index.php");
        die();
        
    ?> 

