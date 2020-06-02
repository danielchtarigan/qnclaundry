<?php

include '../config.php';
$id=$_GET['id'];
$rs = mysqli_query($con,"select no_nota,total_bayar from reception WHERE id_customer='$id' and lunas=false");
$result = array();
while($row = mysqli_fetch_object($rs)){
	array_push($result, $row);
}

echo json_encode($result);

?>
