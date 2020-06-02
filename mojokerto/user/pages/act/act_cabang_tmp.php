<?php
include '../../../../config.php';
session_start();

 if ($_GET['cabang']){
	 $cabang = $_GET['cabang'];
	 }
 if (isset($_GET['id'])){
	 $id = $_GET['id'];
	 }

$qrincian5 = mysqli_query($con, "update order_tmp set cabang='$cabang' where id_customer='$id'");
$qrincian5 = mysqli_query($con, "update order_potongan_tmp set cabang='$cabang' where id_customer='$id'");
?>