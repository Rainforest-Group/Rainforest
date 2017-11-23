
<html>
<head>
<style>

</style>
</head>
<body>

<table border="1">
<tr><th>test</th><th>input</th><th>output</th></tr>
<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);


require_once("databaseOps.php");

function test($val) { return ($val ? (string)$val : "false"); }


function testGetUser() {
    echo "<tr><td rowspan=\"2\">getUserInfo()</td>";

    echo "<td>bjones1 (existing)</td>";
    $val = getUserInfo("bjones1");
    echo "<td>" . test($val) . "</td></tr>";

    echo "<tr><td>bob (nonexisting)</td>";
    $val = getUserInfo("bob");
    echo "<td>" . test($val) . "</td></tr>";
}

function testGetItem() {
    echo "<tr><td rowspan=\"2\">getItemInfo()</td>";

    echo "<td>2 (existing)</td>";
    $val = getItemInfo(2);
    echo "<td>" . test($val) . "</td></tr>";

    echo "<tr><td>5 (nonexisting)</td>";
    echo "<td>" . test(getItemInfo(5)) . "</td></tr>";
}

function testGetOrderInfo() {
    echo "<tr><td rowspan=\"2\">getOrderInfo()</td>";
    echo "<td>1 (existing)</td>";
    echo "<td>" . test(getOrderInfo(1)) . "</td></tr>";

    echo "<td> 5 (nonexisting)</td>";
    echo "<td>" . test(getOrderInfo(5)) . "</td></tr>";
}

function testGetItemsInOrder() {
    echo "<tr><td rowspan=\"2\">getItemsInOrder()</td>";
    echo "<td>1 (existing)</td>";
    echo "<td>" . test(getItemsInOrder(1)) . "</td></tr>";

    echo "<tr><td>5 (nonexisting)</td>";
    echo "<td>" . test(getItemsInOrder(5)) . "</td></tr>";
}


testGetUser();
testGetItem();
testGetOrderInfo();
testGetItemsInOrder();

?>

</table>
</body>
</html>

    
