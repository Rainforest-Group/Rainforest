<?php
require_once("rainforestClasses.php");
require_once("controllers/helpers.php");

$user_id = getCurrentUser()->getUsername();
$cookie = "cart".$user_id;

if (isset($_COOKIE[$cookie])) {
    $cart = Cart::getFromCookie($_COOKIE[$cookie]);
    echo $cart->toCookie();
}
else echo "Empty.";

?>

<br><br>
<a href="inventory.php">back</a>
