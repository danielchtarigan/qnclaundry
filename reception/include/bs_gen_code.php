<?php
include '../../config.php';

$items = $con->query("SELECT kode FROM retail ORDER BY id DESC");
if (mysqli_num_rows($items) > 0) {
    $item = $items->fetch_row();
    $last = $item[0];
    $newnumber = sprintf('%04s', $last + 1);
}
else {
    $newnumber = '0001';
}

echo $newnumber;

?>