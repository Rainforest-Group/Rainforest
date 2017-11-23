
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
    echo "<td>" . test($val['user_password']) . "</td>";
    echo "<td>" . test($val['street']) . "</td></tr>";

    //echo "<tr><td>fakeuser (nonexisting)</td>";
    $val = getUserInfo("fakeuser");
    echo "<td>" . test($val['username']) . "</td>";
    echo "<td>" . test($val['user_password']) . "</td>";
    echo "<td>" . test($val['street']) . "</td></tr></table><br><br>";
}

function testGetItem() {
    echo "<table border=\"1\">\n";
    echo "<tr><th>Item</th><th>item ID</th><th>description</th><th>price</th></tr>\n\n";
    echo "<tr><td rowspan=\"2\">getItemInfo()</td>";

    $val = getItemInfo(2);
    echo "<td>" . test($val['item_id']) . "</td>";
    echo "<td>" . test($val['description']) . "</td>";
    echo "<td>" . test($val['price']) . "</td></tr>";

    $val = getItemInfo(5);
    echo "<td>" . test($val['item_id']) . "</td>";
    echo "<td>" . test($val['description']) . "</td>";
    echo "<td>" . test($val['price']) . "</td></tr></table><br><br>";
}

function testGetOrder() {
    echo "<table border=\"1\">\n";
    echo "<tr><th>Order</th><th>order ID</th><th>username</th><th>item ids</th></tr>\n\n";
    echo "<tr><td rowspan=\"2\">getItemInfo()</td>";

    $val = getOrderInfo(2);
    echo "<td>" . test($val['order_id']) . "</td>";
    echo "<td>" . test($val['username']) . "</td>";
    echo "<td>" . $val['item_list'][1] . "(" . $val['quant_list'][1] . ")";
    echo "</td></tr>";

    $val = getOrderInfo(5);
    echo "<td>" . test($val['order_id']) . "</td>";
    echo "<td>" . test($val['username']) . "</td>";
    echo "<td>" . test($val['item_list'][0]);
    echo "</td></tr></table><br><br>";
}



testGetUser();
testGetItem();
testGetOrder();

?>

</body>
</html>

    
