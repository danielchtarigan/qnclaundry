<?php

$kode_item = htmlspecialchars($_REQUEST['kode_item']);
$nama_item = htmlspecialchars($_REQUEST['nama_item']);
$penanggung_jawab = htmlspecialchars($_REQUEST['penanggung_jawab']);
date_default_timezone_set('Asia/Makassar');
$jam=date("Y-m-d H:i:s");
include '../config.php';

$sql =  "insert into inventory(kode_item,nama_item,penanggung_jawab,tanggal) values('$kode_item','$nama_item','$penanggung_jawab','$jam')";
$result = @mysqli_query($con,$sql);
if ($result){
	echo json_encode(array(
		
		'kode_item' => $kode_item,
		'nama_item' => $nama_item,
		'penanggung_jawab' => $penanggung_jawab
	));
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>