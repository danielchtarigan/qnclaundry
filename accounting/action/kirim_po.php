<?php 
include '../config.php';
date_default_timezone_set('Asia/Makassar');

$supplier = $_POST['supplier'];
$nomor = $_POST['nomor'];
$jumlah = $_POST['total'];
$tanggal_po = date('Y-m-d');

$cekdraf = mysqli_query($con, "SELECT * FROM daftar_pembayaran WHERE nomor_po='$nomor'");

if(mysqli_num_rows($cekdraf)>0){
	echo "PO sudah pernah dikirim!";
} else {
	$sql = mysqli_query($con, "UPDATE purchase_order_data SET submit='1' WHERE nomor_po='$_POST[nomor]'");

	$sql2 = mysqli_query($con, "INSERT INTO daftar_pembayaran (nama_supplier,nomor_po,jumlah,tanggal_po) VALUES ('$supplier','$nomor','$jumlah','$tanggal_po')");

	if($sql){
		echo "PO suksess dikirim";
	}  else {
		echo "PO gagal dikirim!";
	}
}

	

?>
