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
        $item_ids = $cart->getItems();
        if (!$item_ids) throw new Exception();
        foreach ($item_ids as $item_id) {
            $items[] = new Item($item_id);
        }
    }
    else {
        throw new Exception();
    }

    return $items;
}

function getCartQuantities() {
    $cart = getCart();
    if (!$cart) throw new Exception();
    return $cart->getQuantities();
}

function removeFromCart($item_id) {
    $cart = getCart();
    if (!$cart) throw new Exception();
    $cart->removeItem($item_id);

    setcookie(getCartKey(), $cart->toCookie(), time() + 604800);
}

function placeOrder() {
    $username = getCurrentUser()->getUsername();
    $cart = getCart();

    $items = $cart->getItems();
    $quants = $cart->getQuantities();

    $is = array_combine($items, $quants);

    $order = new Order(-1, $username, $is);
    try {
        $order->processOrder();
        setcookie(getCartKey(), "", time() - 100);

        header("Location: inventory.php");
        die();
    }
    catch (Exception $e) {
        echo '<div class="container text-center"><h4 class="alert alert-danger">Not enough items in stock to fill order.</h4></div>';
    }

}

?>

