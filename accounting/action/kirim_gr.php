<?php 
include '../config.php';


$sql = mysqli_query($con, "UPDATE purchase_order_data SET submit='2' WHERE nomor_po='$_POST[nomor]'");

if($sql){
	echo "Data QR disimpan";
}
else {
	echo "Gagal";
}

?>