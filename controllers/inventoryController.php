<?php
require_once("rainforestClasses.php");
require_once("databaseOps.php");
require_once("controllers/helpers.php");

function getItems($search) {
    $item_ids = getAllItemIDs();

    $items = array();
    foreach ($item_ids as $id) {
        $item = new Item($id);
        if ((!$search || strtoupper(substr($item->getName(), 0, strlen($search))) == strtoupper($search)) && !$item->isExpired()) {
            $items[] = $item;
        }
    }

    return $items;
}

function addToCart($item_id) {
    $user = getCurrentUser();
    if (!$user) {
        echo '<div class="container text-center"><h3>Must <a href="login.php">login</a> to add an item to your cart.';
        echo '<br><a href="inventory.php">Back to Shop</a></h3></div>';
        die();
    }
    $user_id = $user->getUsername();
    $cookie = "cart".$user_id;
    if (isset($_COOKIE[$cookie])) {
        $cart = Cart::getFromCookie($_COOKIE[$cookie]);
    }
    else {
        $cart = new Cart();
    }
    $cart->addItem($item_id);

    setcookie($cookie, $cart->toCookie(), time() + 604800);
}
?>
