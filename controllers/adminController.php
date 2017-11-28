<?php
require_once("rainforestClasses.php");
require_once("controllers/helpers.php");

function checkAdmin() {
    $user = getCurrentUser();

    if (!$user->isAdmin()) {
        echo '<div class="text-center"><h4>You do not have administrative privileges.</h4></div>';
        die();
    }
}

function getAllUsers() {
    $usernames = getAllUsernames();

    $users = array();
    foreach ($usernames as $name) {
        $users[] = new User($name);
    }

    return $users;
}

function toggleAdmin($username) {
    $user = new User($username);

    $user->setAdmin(!$user->isAdmin());
}
?>
