<?php

function validateProfile($username, $password, $address, $city, $state, $zip)
{
    $errors = "";
    if (!$username) {
        $errors = $errors . "<br>Must specify username.";
    }
    if (!$password) {
        $errors = $errors . "<br>Must specify a password.";
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

?>
