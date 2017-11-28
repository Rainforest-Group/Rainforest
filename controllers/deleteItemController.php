<?php
require_once("../rainforestClasses.php");

$item_id = $_POST["item"];

$item = new Item($item_id);

$item->setExpired(true);

header("Location: ../inventory.php");
die();

?>
