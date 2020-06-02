<?php 
include '../config.php';
session_start();
date_default_timezone_set('Asia/Makassar');
$date = date('Y-m-d H:i:s');

$date_d_r = $_GET['date_d_r'];
$prepared = $_SESSION['user_id'];
$no = $_GET['nomor'];
$vendor = $_GET['vendor'];
$item = $_GET['item'];
$qty = $_GET['quantity'];
$uom_qty = $_GET['qty_satuan'];
$lsb = $_GET['lsb'];
$uom_lsb = $_GET['lsb_satuan'];

$pros = mysqli_query($con, "INSERT INTO purchase_order_data (nomor_rf,tanggal_rf,item,qty,uom,last_stock_balance,uom_lsb,date_delivery_required,vendor,created_rf) VALUES ('$no','$date','$item','$qty','$uom_qty','$lsb','$uom_lsb','$date_d_r','$vendor','$prepared') ");

if($pros){
	echo "Berhasil ditambahkan !";
} else {
	echo "Gagal diproses !";
}


?>

