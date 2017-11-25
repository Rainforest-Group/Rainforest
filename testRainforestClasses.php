
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