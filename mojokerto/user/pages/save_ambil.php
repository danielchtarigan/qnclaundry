<?php 
include '../../../config.php';
session_start();
date_default_timezone_set('Asia/Jakarta');
$us=$_SESSION['name'];
$jam=date("Y-m-d H:i:s");
$no_nota=$_GET['no_nota'];

	$q="insert into pengambilan (tgl_ambil,rcp_ambil,no_nota) VALUES('$jam','$us','$no_nota')";
	$hasil2 = mysqli_query($con,$q);
	$q2 = "update reception set ambil='1',tgl_ambil='$jam',reception_ambil='$us'  WHERE no_nota = '$no_nota'";
	$hasil=mysqli_query($con,$q2);
	 if($hasil){
	 	
	 echo '<font color="green">Sukses</font>';
	 	}
	else {
	 echo '<font color="red">Error, Data Sudah Ada</font>';
	 }


?>
