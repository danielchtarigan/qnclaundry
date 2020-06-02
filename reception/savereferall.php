<?php 
include '../config.php';
session_start();
	  	$id_customer=$_POST['id_customer'];
    	$nama_customer=$_POST['nama_customer'];
       	$Jns_vocher=$_POST['Jns_vocher'];
       	//$disk=$_POST['disk'];
		$vocher=$_POST['vocher'];
		$us=$_SESSION['user_id'];
                $ot= $_SESSION['nama_outlet'];
date_default_timezone_set('Asia/Makassar');
$jam=date("Y-m-d H:i:s");

$data=mysqli_query($con,"insert into voucher_lucky (No_voucher,disk,aktif,Jenis_voucher,id_customer) VALUES('$vocher','0.15','0','RV','$id_customer')");
	if($data){
         mysqli_query($con,"insert into voucher_expired (voucher,expired,user,outlet) VALUES('$vocher',NOW() + INTERVAL 3 MONTH,'$us','$ot')");   
	 echo '<font color="green">Sukses</font>';
	}
	else {
	 echo '<font color="red">Error, Data Gagal di Input</font>';
	 }


?>
