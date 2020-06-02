<?php 
include '../config.php';

date_default_timezone_set('Asia/Makassar');
$nowDate = date('Y-m-d H:i:s');

$sql = mysqli_query($con, "SELECT nama_item FROM nama_item WHERE kode_item='$_GET[ki]'");
$data = mysqli_fetch_row($sql);
$nitem = $data[0];


$q = mysqli_query($con, "INSERT INTO jurnal_u (tgl_input,kode_item,nama_item,nominal,balance) VALUES ('$nowDate','$_GET[ki]','$nitem','$_GET[nominal]','$_GET[balance]')");

if($q){
	echo "Berhasil";
} 

?>