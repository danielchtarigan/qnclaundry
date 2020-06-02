<?php
include '../../../config.php';
	date_default_timezone_set('Asia/Makassar');
	$jam=date("Y-m-d H:i:s");
  	$nama_customer1=$_GET['nama_customer1'];
    $alamat1=$_GET['alamat1'];
    $no_telp1=$_GET['no_telp1'];
     $info=$_GET['info'];
     session_start();
  $us=$_SESSION['user_id'];
  $con->query("INSERT INTO customer(nama_customer,alamat,no_telp,tgl_input,info_dari,outlet) VALUES ('$nama_customer1','$alamat1','$no_telp1','$jam','$info','mojokerto')");
    
    if($con)
    {
    	
     }else
    {
        echo "ERROR";
    }
   
?>