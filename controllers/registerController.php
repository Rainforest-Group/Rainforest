<?php

    function validateProfile($username, $password, $verify_password, $email, $address, $city, $state, $zip)
    {
        $errors = "";
        if (!$username) {
            $errors = $errors . "Must specify username.";
        }
        else {
            // Check if username exists
            try {
                $user = new User($username);
                $errors = $errors . "Username taken.";
            }
            catch (Exception $e) {
                ;
            }
        }
        if (!$password) {
            if ($errors != "") {
                $errors = $errors . "<br>";
            }
            $errors = $errors . "Must specify a password.";
        }
        else if ($verify_password != $password) {
            if ($errors != "") {
                $errors = $errors . "<br>";
            }
            $errors = $errors . "Passwords do not match.";
        }
        if (!$email) {
            if ($errors != "") {
                $errors = $errors . "<br>";
            }
            $errors = $errors . "Must specify email.";
        }
        if (!$address) {
            if ($errors != "") {
                $errors = $errors . "<br>";
            }
            $errors = $errors . "Must specify address.";
        }
        if (!$city) {
            if ($errors != "") {
                $errors = $errors . "<br>";
            }
            $errors = $errors . "Must specify city.";
        }
        if (!$state) {
            if ($errors != "") {
                $errors = $errors . "<br>";
            }
            $errors = $errors . "Must specify state.";
        }
        if (!$zip) {
            if ($errors != "") {
                $errors = $errors . "<br>";
            }
            $errors = $errors . "Must specify zip.";
        }

        return $errors;
    }

    function createAccount($username, $password, $email, $address, $city, $state, $zip)
    {
        // Assume all the fields are valid
        $new_user = new User($username, encrypt($password), $email, $address, $city, $state, $zip);
        return $new_user;
    }
?>
