<?php

function getLoginButton() {
    session_start();

    $loggedIn = isset($_SESSION['username']);

    if (!$loggedIn) echo '<a class="btn btn-success" id="login" href="login.php">Log In</a>';
          else            echo '<a class="btn btn-success" id="login" href="logout.php">Logout</a>';

}

?>

