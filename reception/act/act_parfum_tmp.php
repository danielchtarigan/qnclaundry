<?php
include '../../config.php';

 if (isset($_GET['parfum'])){
	 $parfum = $_GET['parfum'];
	 }
 if (isset($_GET['id'])){
	 $id = $_GET['id'];
	 }

$qrincian5 = mysqli_query($con, "update order_tmp set parfum='$parfum' where id_customer='$id'");
$qrincian5 = mysqli_query($con, "update order_potongan_tmp set parfum='$parfum' where id_customer='$id'");
?>