<?php
include '../../../../config.php';
session_start();

 if (isset($_GET['id'])){
	 $id = $_GET['id'];
	 }
 if (isset($_GET['charge'])){
	 $charge = $_GET['charge'];
		 if ($charge=="0"){
		 $ch = "0";
			 }
		 else if ($charge=="193"){
		 $ch = "3";
			 }
		 else if ($charge=="192"){
		 $ch = "2";
			 }
		 else{
		 $ch = "1";
			 }
 }

$qrincian5 = mysqli_query($con, "update order_tmp set charge='$ch' where id_customer='$id'");
$qrincian5 = mysqli_query($con, "update order_potongan_tmp set charge='$ch' where id_customer='$id'");
?>