<?php
include '../../config.php';

$item = $_POST['item'];
$desc = $_POST['desc'];
$price = $_POST['price'];

if ($item != "")
{
    $items = $con->query("INSERT INTO retail VALUES ('$item', '$desc', '$price') ");
    
    if ($items) {
        echo "#new_item_order";
    }
}

?>