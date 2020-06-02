<?php 
include '../config.php';

$id = explode(",", $_POST['id']);

foreach ($id as $key) {
	$id = explode("-", $key);
	$id = $id[0];
	$sql = $con->query("UPDATE daftar_pembayaran SET lunas='1' WHERE id='$id'");
}

if($sql) echo "Sukses"; else echo "Gagal";



?>