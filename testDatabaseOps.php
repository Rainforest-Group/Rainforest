
<html>
<head>
<style>

</style>
</head>
<body>

<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);


require_once("databaseOps.php");

function test($val) { return ($val ? (string)$val : "false"); }


function testGetUser() {
    
    echo "<table border=\"1\">\n";
    echo "<tr><th>User</th><th>username</th><th>password</th><th>street</th></tr>\n\n";
    echo "<tr><td rowspan=\"2\">getUserInfo()</td>";

    //echo "<td>bjones1 (existing)</td>";
    $val = getUserInfo("bjones");
    echo "<td>" . test($val['username']) . "</td>";
    echo "<td>" . test($val['password']) . "</td>";
    echo "<td>" . test($val['street']) . "</td></tr>";

    //echo "<tr><td>fakeuser (nonexisting)</td>";
    $val = getUserInfo("newusername");
    echo "<td>" . test($val['username']) . "</td>";
    echo "<td>" . test($val['password']) . "</td>";
    echo "<td>" . test($val['street']) . "</td></tr></table><br><br>";
}

function testGetItem($num) {
    echo "<table border=\"1\">\n";
    echo "<tr><th>Item</th><th>item ID</th><th>description</th><th>price</th></tr>\n\n";
    echo "<tr><td rowspan=\"2\">getItemInfo()</td>";

    $val = getItemInfo(3);
    echo "<td>" . test($val['item_id']) . "</td>";
    echo "<td>" . test($val['description']) . "</td>";
    echo "<td>" . test($val['price']) . "</td></tr>";

    $val = getItemInfo($num);
    echo "<td>" . test($val['item_id']) . "</td>";
    echo "<td>" . test($val['description']) . "</td>";
    echo "<td>" . test($val['price']) . "</td></tr></table><br><br>";
}

function testGetOrder($id) {
    echo "<table border=\"1\">\n";
    echo "<tr><th>Order</th><th>order ID</th><th>username</th><th>item ids</th></tr>\n\n";
    echo "<tr><td rowspan=\"2\">getItemInfo()</td>";

    $val = getOrderInfo(2);
    echo "<td>" . test($val['order_id']) . "</td>";
    echo "<td>" . test($val['username']) . "</td><td>";
    for ($i = 0; $i < count($val['item_list']); $i++) {
        echo $val['item_list'][$i] . "(" . $val['quant_list'][$i] . "),";
    }
    echo "</td></tr>";

    $val = getOrderInfo($id);
    echo "<td>" . test($val['order_id']) . "</td>";
    echo "<td>" . test($val['username']) . "</td><td>";
    for ($i = 0; $i < count($val['item_list']); $i++) {
        echo $val['item_list'][$i] . "(" . $val['quant_list'][$i] . "),";
    }
    echo "</td></tr></table><br><br>";
}

function testModifyUser() {
    modifyUser("bjones", "password", "newpassword");
    testGetUser("bjones");
    modifyUser("bjones", "password", "password");
}

function testModifyItem() {
    modifyItem(3, "price", 10);
    testGetItem(5);
    modifyItem(3, "price", 1999.95);
}

function testAddItem() {
    $item = new Item(-1, "New Item", 12.12, "Epic Item");
    $id = addItem($item, 4);
    testGetItem($id);
}

function testAddUser() {
    $user = new User("newusername", "pw", "email@gmail.com", "street1", "city", "st", 09989, "country");
    addUser($user);
    testGetUser();
}

function testAddOrder() {
    $items = array();
    $items[1] = 2;
    $items[2] = 4;
    $items[3] = 1;
    $order = new Order("bjones", -1, $items);
    $id = addOrder($order);
    testGetOrder($id);
}



testGetUser();
testGetItem(5);
testGetOrder(5);
testModifyUser();
testModifyItem();
testAddItem();
testAddUser();
testAddOrder();

?>

</body>
</html>

    
