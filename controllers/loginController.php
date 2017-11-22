<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
    session_start();
    if (isset($_SESSION['username'])) {
      if ($_SESSION['type'] == 'admin') {
          // TODO: Fill in url
          $url = "<admin page>";
      }
      else if ($_SESSION['type'] == 'user') {
          // TODO: Fill in url
          $url = "<customer page>";
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
    $user = User::fetchUser($username);

    return encrypt($password) == $user->getPassword();
}

/*****
 * createSession
 * Use sessions to login the user.
 *****/
function createSession($username, $password)
{
  session_start();
  $_SESSION['username'] = $username;
  $_SESSION['forename'] = $row['forename'];
  $_SESSION['type'] = $row['type'];
}

function encrypt($pwd)
{
    $salt1    = "qm&h*";
    $salt2    = "pg!@";

    return hash('ripemd128', "$salt1$pwd$salt2");
}

?>
