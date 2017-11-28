<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("rainforestClasses.php");

// Is someone already logged in? If so, forward them to the correct
// page. (HINT: Implement this last, you cannot test this until
//              someone can log in.)

/*****
 * currentLogin
 * Find out if a user is logged in. If so, redirect to the
 * appropriate page.
 *****/
function currentLogin()
{
    if (!isset($_SESSION)) {
        session_start();
    }
    if (isset($_SESSION['username'])) {
      if ($_SESSION['type'] == 'admin') {
          $url = "index.php";
      }
      else if ($_SESSION['type'] == 'customer') {
          $url = "index.php";
      }
      header("Location: $url");
      die();
    }
}


/****
 * checkCredentials
 * Fetch the users entry from the database and check the passwords.
 ****/
 
function checkCredentials($username, $password)
{
    $user = new User($username);

    return $user && encrypt($password) == $user->getPassword();
}

/*****
 * createSession
 * Use sessions to login the user.
 *****/
function createSession($username, $password)
{
    // Assume user exists
    $user = new User($username);
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['type'] = $user->isAdmin() ? 'admin' : 'customer';
}



?>
