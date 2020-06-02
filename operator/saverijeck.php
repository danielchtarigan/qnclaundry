<?php 
include '../config.php';
session_start();
$us=$_SESSION['user_id'];
date_default_timezone_set('Asia/Makassar');
$jam=date("Y-m-d H:i:s");
	   $no_nota=$_POST['no_nota'];
    	$nama_customer=$_POST['nama_customer'];
       $alasan=$_POST['alasan'];
       $sql=$con->query("update reception set rijeck=true WHERE  no_nota= '$no_nota'");
	$q="insert into rijeck (no_nota,nama_customer,alasan,tgl_rijeck,user_rijeck) VALUES('$no_nota','$nama_customer','$alasan','$jam','$us')";
	
	 $hasil=mysqli_query($con,$q);
	 if($hasil){
	 	
	 echo '<font color="green">Sukses</font>';
	}
	else {
	 echo '<font color="red">Error, Data Sudah Ada</font>';
	 }


?>
