<?php
include '../../../../config.php';
session_start();

 if ($_GET['deliver']){
	 $deliver = $_GET['deliver'];
	 }
 if (isset($_GET['id'])){
	 $id = $_GET['id'];
	 }

$qrincian5 = mysqli_query($con, "update order_tmp set deliver='$deliver' where id_customer='$id'");
$qrincian5 = mysqli_query($con, "update order_potongan_tmp set deliver='$deliver' where id_customer='$id'");
?>