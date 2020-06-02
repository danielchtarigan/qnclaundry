<?php

$id = intval($_REQUEST['id']);
$kode_item = htmlspecialchars($_REQUEST['kode_item']);
$nama_item = htmlspecialchars($_REQUEST['nama_item']);
$penanggung_jawab = htmlspecialchars($_REQUEST['penanggung_jawab']);
date_default_timezone_set('Asia/Makassar');
$jam=date("Y-m-d H:i:s");
include '../config.php';

$sql = "update inventory set kode_item='$kode_item',nama_item='$nama_item',penanggung_jawab='$penanggung_jawab',tanggal='$jam' where id=$id";
$result = @mysqli_query($con,$sql);
if ($result){
	echo json_encode(array(
		'id' => $id,
		'kode_item' => $kode_item,
		'nama_item' => $nama_item,
		'penanggung_jawab' => $penanggung_jawab
	));
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>