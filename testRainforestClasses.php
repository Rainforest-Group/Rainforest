
<html>
<head>
<style>

</style>
</head>
<body>

<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);


require_once("rainforestClasses.php");
require_once('databaseOps.php');


function test($val) { return ($val ? (string)$val : "false"); }


function testItem() {    
    $olditem = new Item(1);
    $newitem = new Item(-1, "testItem", 113, "test description", false, 10);
    
    printItem($olditem);
    printItem($newitem);
    
    $newitem->setName("New Name");
    $newitem->setDescription("New description, same id");
    $newitem->setPrice(12345);
    $newitem->setExpired(true);
    $newitem->setQuantity(0);
    printItem($newitem);
}

function testInventory() {
    //TODO: Test constructor
    //TODO: Test updateInventory()
    //TODO: Test addItem()
    //TODO: Test modifyQuantity()
    //TODO: Test getItem()
    //TODO: Test getItemList()
}

function testOrder() {
    //TODO: Test constructor
    //TODO: Test getUsername()
    //TODO: Test isFilled()
    //TODO: Test setFilled()
    //TODO: Test isPlaced()
    //TODO: Test getOrderId()
    //TODO: Test getItemList()
    //TODO: Test addItem()
    //TODO: Test deleteItem()
    //TODO: Test clearOrder()
    //TODO: Test processOrder()
}

function testUser() {
    //TODO: Test constructor
    //TODO: Test getFullAddress()
    //TODO: Test getCart()
    //TODO: Test setCart()
    //TODO: Test getCountry()
    //TODO: Test setCountry()
    //TODO: Test getZip()
    //TODO: Test setZip()
    //TODO: Test getState()
    //TODO: Test getCity()
    //TODO: Test setCity()
    //TODO: Test getStreetAddress()
    //TODO: Test getPassword()
    //TODO: Test setPassword()
    //TODO: Test getEmail()
    //TODO: Test setEmail()
    //TODO: Test getUsername()
    //TODO: Test setUsername()
    //TODO: Test getOrderIds()
    //TODO: Test updatePastOrders()
    //TODO: Test isAdmin()
    //TODO: Test setAdmin()
}

function printItem($item) {
    echo "<table border=\"1\">\n";
    echo "<tr><th>source<th>item_id</th><th>name</th><th>description</th>"
            . "<th>price</th><th>expired</th></tr>\n";
    $id = $item->getID();
    $name = $item->getName();
    $price = $item->getPrice();
    $desc = $item->getDescription();
    $exp = $item->isExpired();
    echo "<tr><td>Object</td><td>$id</td><td>$name</td><td>$desc</td><td>$price"
            . "</td><td>$exp</td></tr>";
    $vals = getItemInfo($id);
    $dbid = $vals['item_id'];
    $dbname = $vals['title'];
    $dbdesc = $vals['description'];
    $dbprice = $vals['price'];
    $dbexp = $vals['expired'];
    echo "<tr><td>Database</td><td>$dbid</td><td>$dbname</td><td>$dbdesc"
            . "</td><td>$dbprice</td><td>$dbexp</td></tr></table><br><br>";
}

testItem();

?>

</body>
</html>