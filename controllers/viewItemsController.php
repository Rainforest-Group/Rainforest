<?
require_once("rainforestClasses.php");
require_once("databaseOps.php");
require_once("controllers/helpers.php");

function getItems($search) {
    $item_ids = getAllItemIDs();

    $items = array();
    foreach ($item_ids as $id) {
        $item = new Item($id);
        if (!$search || substr($item->getName(), 0, strlen($search)) == $search) {
            $items[] = $item;
        }
    }

    return $items;
}
?>
