<?php
require_once("rainforestClasses.php");

function validateProfile($username, $password, $verify_password, $address, $city, $state, $zip)
{
    $errors = "";
    if (!$username) {
        $errors = $errors . "<br>Must specify username.";
    }
    else {
        // Check if username exists
        $user = User::fetchUser($username);
        if ($user) {
            $errors = $errors . "<br>Username taken.";
        }
    }
    if (!$password) {
        $errors = $errors . "<br>Must specify a password.";
    }
    else if ($verify_password != $password) {
        $errors = $errors . "<br>Passwords do not match.";
    }
    if (!$address) {
        $errors = $errors . "<br>Must specify address.";
    }
    if (!$city) {
        $errors = $errors . "<br>Must specify city.";
    }
    if (!$state) {
        $errors = $errors . "<br>Must specify state.";
    }
    if (!$zip) {
        $errors = $errors . "<br>Must specify zip.";
    }
    
    return $errors;
}

function createAccount($username, $password, $address, $city, $state, $zip)
{
    // Assume all the fields are valid
    $new_user = new User($username, encrypt($password), "", $address, $city, $state, $zip);

    return $new_user;
}

?>
