<?php

include '../config.php';
$rs = mysqli_query($con,"SELECT * FROM item_spk WHERE jenis_item='k' ORDER BY kategory asc");
$result = array();
while($row = mysqli_fetch_object($rs)){
	array_push($result, $row);
}

echo json_encode($result);

?>
