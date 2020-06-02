<?php

include '../config.php';
$rs = mysqli_query($con,'select * from order_void');
$result = array();
while($row = mysqli_fetch_object($rs)){
	array_push($result, $row);
}

echo json_encode($result);

?>