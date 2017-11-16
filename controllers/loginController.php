<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("../database/login_creds.php");
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
    $conn = new mysqli($hn, $un, $pw, $db);
    if ($conn->connect_error) die($conn->connect_error);

    $query = $conn->prepare("SELECT username,user_password,type FROM
      users WHERE username=?");

    $query->bind_param('s', $username);
    $query->execute();
    $results = $query->get_result();

    $row = $results->fetch_array(MYSQLI_ASSOC);

    return encrypt($password) == $row['user_password'];
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

?>
