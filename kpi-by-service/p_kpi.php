<?php 
include '../config.php';

if(isset($_POST['submit'])){

	$tgl_mulai = date('Y-m-d', strtotime($_POST['tanggal_mulai']));

	$d = $con->query("INSERT INTO absen_by_service VALUES ('','$_POST[nama]','$_POST[lembur_reguler]','$_POST[lembur_12]','$_POST[izin]','$_POST[sakit]','$_POST[alpa]','$_POST[terlambat]','$tgl_mulai',NOW())");

	if($d){
		header('location: ../reception/');
	}

}