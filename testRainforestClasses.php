<html>
<body>
<?php

    /* To use this file:
    * All tests are called at the end of this file.
    * Uncomment the test(s) you want to run. All tests
    * are compatible with each other but each of them
    * will create new users, orders, and items in the
    * database with test data in each of them.
    */

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
        $testInv = new Inventory();
        
        //Test updateInventory()
        echo("Testing update...");
        $testInv->updateInventory();
        echo(" Pass<br/>");

        //Test addItem()
        echo("Adding item...");
        $item2 = new Item(-1, "Apple", 12.5, "A red apple.", false, 6);
        $addPass = $testInv->addItem($item2);
        if ($addPass) {
            echo(" Pass<br/>");
        } else {
            echo(" Fail<br/>");
        }

        //Test modifyQuantity()
        echo("Modifying Quantities...");
        $modTestsPass = true;
        $modTestsPass = $modTestsPass and $testInv->modifyQuantity(1, 3);
        $modTestsPass = $modTestsPass and $testInv->modifyQuantity(1, -3);
        $modTestsPass = $modTestsPass and !$testInv->modifyQuantity(3, 12);
        if ($modTestsPass) {
            echo(" Pass<br/>");
        } else {
            echo(" Fail<br/>");
        }

        //Test getItem()
        echo("Getting item info...");
        $getItem = $testInv->getItem(2);
        if ($getItem) {
            echo(" Pass<br/><br/>");
            printItem($getItem);
        } else {
            echo(" Fail<br/>");
        }

        //Test getItemList()
        $itemList = $testInv->getItemList();
        echo("Item IDs:<br/>");
        foreach ($itemList as $curVal) {
            echo($curVal . ", ");
        }
    }

    function testOrder() {
        //Test constructor
        $itemList[1] = 3;
        $itemList[2] = 5;
        $itemList[3] = 6;
        $newOrder = new Order(-1, "oldme", $itemList, false, false);
        $oldOrder = new Order(1);

        //Test getUsername()
        echo("getUsername... ");
        if ($newOrder->getUsername() == "oldme") { echo(" Pass (1/2) "); }
        else { echo(" Fail (1/2) "); }

        if ($oldOrder->getUsername() == "bjones") { echo(" Pass (2/2)<br/>"); }
        else { echo(" Fail (2/2)<br/>"); }

        //Test isFilled()
        echo("isFilled... ");
        if ($newOrder->isFilled() == false) { echo(" Pass (1/2) "); }
        else { echo(" Fail (1/2) "); }

        if ($oldOrder->isFilled() == true) { echo(" Pass (2/2)<br/>"); }
        else { echo(" Fail (2/2)<br/>"); }

        //Test setFilled()
        echo("setFilled...");
        $newOrder->setFilled(true);
        if ($newOrder->isFilled() == true) { echo(" Pass (1/2) "); }
        else { echo(" Fail (1/2) "); }

        $newOrder->setFilled(false);
        if ($newOrder->isFilled() == false) { echo(" Pass (2/2)<br/>"); }
        else { echo(" Fail (2/2)<br/>"); }

        //Test isPlaced()
        echo("isPlaced...");
        if ($newOrder->isPlaced() == false) { echo(" Pass (1/2) "); }
        else { echo(" Fail (1/2) "); }

        if ($oldOrder->isPlaced() == true) { echo(" Pass (2/2)<br/>"); }
        else { echo(" Fail (2/2)<br/>"); }

        //Test getOrderId()
        echo("getOrderID...");
        if($newOrder->getOrderId() == -1) { echo(" Pass (1/2) "); }
        else { echo(" Fail (1/2) "); }
        if($oldOrder->getOrderId() == 1) { echo(" Pass (2/2)<br/>"); }
        else { echo(" Fail (2/2)<br/>"); }

        //Test getItemList()
        echo("getItemList...<br/>");
        echo("New Oder items:<br/>");
        $tempItemList = $newOrder->getItemList();
        foreach ($tempItemList as $key => $value) {
            echo($key . ": " . $value . "<br/>");
        }

        echo("<br/>Old Order items:<br/>");
        $tempItemList = $oldOrder->getItemList();
        foreach ($tempItemList as $key => $value) {
            echo($key . ": " . $value . "<br/>");
        }

        //Test addItem()
        echo("addItem...");
        $testPass = false;
        $newOrder->addItem(1, 3);
        $tempItemList = $newOrder->getItemList();
        foreach ($tempItemList as $key => $value) {
            if ($key == 1 and $value == 6) {
                $testPass = true;
            }
        }
        if($testPass) {
            echo(" Pass (1/2) ");
            $testPass = false;
        } else { echo(" Fail (1/2) "); }

        $oldOrder->addItem(1, 3);
        $tempItemList = $oldOrder->getItemList();
        foreach ($tempItemList as $key => $value) {
            if ($key == 1 and $value == 1) {
                $testPass = true;
            }
        }
        if($testPass) { echo(" Pass (2/2)<br/>"); }
        else { echo(" Fail (2/2)<br/>"); }

        //Test deleteItem()
        echo("deleteItem...");
        $testPass = true;
        $newOrder->deleteItem(1);
        $tempItemList = $newOrder->getItemList();
        foreach ($tempItemList as $key => $value) {
            if ($key == 1) {
                $testPass = false;
            }
        }
        if($testPass) {
            echo(" Pass (1/2) ");
            $testPass = false;
        } else {
            echo(" Fail (1/2) ");
        }

        $oldOrder->deleteItem(1);
        $tempItemList = $oldOrder->getItemList();
        foreach ($tempItemList as $key => $value) {
            if ($key == 1) {
                $testPass = true;
            }
        }
        if($testPass) { echo(" Pass (2/2)<br/>"); }
        else { echo(" Fail (2/2)<br/>"); }

        //Test clearOrder()
        echo("clearOrder...");
        $newOrder->clearOrder();
        $tempItemList = $newOrder->getItemList();
        if(count($tempItemList) == 0) { echo(" Pass (1/2) "); }
        else { echo(" Fail (1/2) "); }
        $tempItemList = $oldOrder->getItemList();
        if(count($tempItemList) > 0) { echo(" Pass (2/2)<br/>"); }
        else { echo(" Fail (2/2)<br/>"); }

        //Test processOrder()
        echo("processOrder (assuming order not placed yet)...");
        
        $newOrder->addItem(1, 3);
        $newOrder->addItem(2, 5);
        $newOrder->addItem(3, 6);
        
        if($newOrder->isPlaced() == false) { echo(" Pass (1/2) "); }
        else { echo(" Fail (1/2) "); }
        $newOrder->processOrder();
        if($newOrder->isPlaced() == true) { echo(" Pass (2/2)<br/>"); }
        else { echo(" Fail (2/2)<br/>"); }

        echo("Items placed in new order:<br/>");
        $tempItemList = $newOrder->getItemList();
        foreach ($tempItemList as $key => $value) {
            echo("ItemID:" . $key . " | Quant:" . $value . "<br/>");
        }
    }

    function testUser() {
        //Test constructor
        $testUser = new User("testUser", "testPass", "test@email.com", "123 Street Rd.", "Jackson", "MS", 39202, "USA", false);

        //Test getFullAddress()
        echo("getFullAddress...");
        if ($testUser->getFullAddress() == "123 Street Rd.<br>Jackson, MS 39202<br>USA") {
            echo(" Pass<br/>");
        } else { echo("Fail<br/>"); }

        //Test setCart()
        echo("set/getCart...");
        $itemList[1] = 3;
        $newOrder = new Order(-1, "testUser", $itemList, false, false);
        $testUser->setCart($newOrder);

        //Test getCart()
        $tempCart = $testUser->getCart();
        if (count($tempCart->getItemList()) == 1) {
            echo(" Pass<br/>");
        } else { echo(" Fail<br/>"); }

        //Test setCountry()
        echo("set/getCountry...");
        $testUser->setCountry("Turkey");

        //Test getCountry()
        if ($testUser->getCountry() == "Turkey") {
            echo(" Pass<br/>");
        } else { echo(" Fail<br/>"); }

        //Test setZip()
        echo("set/getZip...");
        $testUser->setZip(12345);

        //Test getZip()
        if ($testUser->getZip() == 12345) {
            echo(" Pass<br/>");
        } else { echo(" Fail<br/>"); }

        //Test setState()
        echo("set/getState...");
        $testUser->setState("TX");

        //Test getState()
        if ($testUser->getState() == "TX") {
            echo(" Pass<br/>");
        } else { echo(" Fail<br/>"); }

        //Test setCity()
        echo("set/getCity...");
        $testUser->setCity("Austin");

        //Test getCity()
        if ($testUser->getCity() == "Austin") {
            echo(" Pass<br/>");
        } else { echo(" Fail<br/>"); }

        //Test setStreetAddress()
        echo("set/getStreetAddress...");
        $testUser->setStreetAddress("321 Road St.");

        //Test getStreetAddress()
        if ($testUser->getStreetAddress() == "321 Road St.") {
            echo(" Pass<br/>");
        } else { echo(" Fail<br/>"); }

        //Test setPassword()
        echo("set/getPassword...");
        $testUser->setPassword("TestPass2");

        //Test getPassword()
        if ($testUser->getPassword() == "TestPass2") {
            echo(" Pass<br/>");
        } else { echo(" Fail<br/>"); }
        
        //Test setEmail()
        echo("set/getEmail...");
        $testUser->setEmail("testMail@mail.mail");

        //Test getEmail()
        if ($testUser->getEmail() == "testMail@mail.mail") {
            echo(" Pass<br/>");
        } else { echo(" Fail<br/>"); }

        //Test setUsername()
        echo("set/getUsername...");
        $testUser->setUsername("nameuserTest");

        //Test getUsername()
        if ($testUser->getUsername() == "nameuserTest") {
            echo(" Pass<br/>");
        } else { echo(" Fail<br/>"); }

        //TODO: Test updatePastOrders()
        $testUser->updatePastOrders();

        //TODO: Test getOrderIds()
        $newOrder->processOrder();
        $orderList = $testUser->getOrderIds();
        if (count($orderList) == 1) {
            echo(" Pass<br/>");
        } else { echo(" Fail<br/>"); }

        //Test setAdmin()
        echo("set/getAdmin...");
        $testUser->setAdmin(true);

        //Test isAdmin()
        if ($testUser->isAdmin() == true) {
            echo(" Pass<br/>");
        } else { echo(" Fail<br/>"); }
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

    // ITEM TEST:
    // Disable to prevent item creations.
    //echo("Testing Item class...<br/><br/>"); testItem();

    // INVENTORY TEST:
    // Disable to prevent item creations.
    //echo("Testing Inventory class...<br/><br/>"); testInventory();

    // ORDER TEST:
    // Diable to prevent order creations.
    //echo("Testing Order class...<br/>"); testOrder(); 

    // USER TEST:
    // Running this test will create a user and order data in the DB.
    //echo("Testing User class...<br/>"); testUser();

?>
</body>
</html>
