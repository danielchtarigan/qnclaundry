<?php
include '../../config.php';
session_start();

$ot = $_SESSION['nama_outlet'];

 if (isset($_GET['hanger_own'])){
	 $hanger_own = $_GET['hanger_own'];
	 }
 if (isset($_GET['hanger'])){
	 $hanger = $_GET['hanger'];
	 }
 if (isset($_GET['hanger_plastik'])){
	 $hanger_plastik = $_GET['hanger_plastik'];
	 }
 if (isset($_GET['id'])){
	 $id = $_GET['id'];
	 }

$qrincian5 = mysqli_query($con, "update order_tmp set hanger_own='$hanger_own', hanger='$hanger', hanger_plastic= '$hanger_plastik' where id_customer='$id'");
$qrincian5 = mysqli_query($con, "update order_potongan_tmp set hanger_own='$hanger_own', hanger='$hanger', hanger_plastic= '$hanger_plastik' where id_customer='$id'");
?>