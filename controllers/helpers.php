<?php
    function getLoginButton() {
        if (!isset($_SESSION)) session_start();

        $loggedIn = isset($_SESSION['username']);

        if (!$loggedIn) {
            // Login button
            echo '<li><a class="btn btn-success" id="login" href="login.php">Log In</a></li>';
            // Cart button
        }
        else {
            echo '&nbsp;<li><a class="btn btn-success" href="cart.php">Cart</a>';
            echo '&nbsp;<a class="btn btn-success" id="login" href="logout.php">Logout</a></li>';
        }
    }

    function getCurrentUser() {
        if (!isset($_SESSION)) session_start();

        if (!isset($_SESSION['username'])) return false;

        return new User($_SESSION['username']);
    }
?>
