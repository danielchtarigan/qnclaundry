<?php
include '../../../config.php';
	date_default_timezone_set('Asia/Jakarta');
	$jam=date("Y-m-d H:i:s");
  	$nama_customer1=$_GET['nama_customer1'];
    $alamat1=$_GET['alamat1'];
    $no_telp1=$_GET['no_telp1'];
     $info=$_GET['info'];
     session_start();
  $us=$_SESSION['name'];
  $con->query("INSERT INTO customer(nama_customer,alamat,no_telp,tgl_input,info_dari,outlet,user_input) VALUES ('$nama_customer1','$alamat1','$no_telp1','$jam','$info','mojokerto','$us')");
    
    if($con)
    {
    	
     }else
    {
        echo "ERROR";
    }
   
?>