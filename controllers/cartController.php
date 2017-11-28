<?php
require_once("rainforestClasses.php");
require_once("controllers/helpers.php");

function getCartKey() {
    $user_id = getCurrentUser()->getUsername();
    return "cart".$user_id;
}

function getCart() {
    $cookie = getCartKey();
    $items = array();
    if (isset($_COOKIE[$cookie])) {
        $cart = Cart::getFromCookie($_COOKIE[$cookie]);
        return $cart;
    }
    else return false;
}


function getCartItems() {
    $items = array();

    $cart = getCart();
    if ($cart) {
        foreach ($cart->getItems() as $item_id) {
            $items[] = new Item($item_id);
        }
    }

    return $items;
}

function getCartQuantities() {
    $cart = getCart();
    return $cart->getQuantities();
}

function removeFromCart($item_id) {
    $cart = getCart();
    $cart->removeItem($item_id);

    setcookie(getCartKey(), $cart->toCookie(), time() + 604800);
}

function placeOrder() {
    echo "Placed";
    $username = getCurrentUser()->getUsername();
    $cart = getCart();

    $items = $cart->getItems();
    $quants = $cart->getQuantities();

    $is = array_fill_keys($items, $quants);

    $order = new Order(-1, $username, $is);
}

?>

