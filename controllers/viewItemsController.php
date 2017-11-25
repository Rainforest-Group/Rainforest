<?
require_once("rainforestClasses.php");
require_once("databaseOps.php");

function getItems() {
    $item_ids = getAllItemIDs();

    $items = array();
    foreach ($item_ids as $id) {
        $items[] = new Item($id);
    }

    return $items;
}
?>