<?php
include "../config.php";


session_start();
$us             = $_SESSION['user_id'];
date_default_timezone_set('Asia/Makassar');
$date         = date("Y-m-d H:i:s");


$no_nota     = $_POST['no_nota'];
$nama_hotel  = $_POST['nama_hotel'];
//$email       = $_POST['email'];


$query="insert into hotel_trans (no_so,nama_hotel,tgl_input) VALUES ('$no_nota','$nama_hotel','$date')";
$hasil=mysqli_query($con,$query);
if($hasil){
	echo( '<font color="green" size=5>Sukses </font>');
		}
		else {
			echo '<font color="red" size=5>Error data gagal disimpan</font>';
		}

//$qry="insert into detail_hotel (no_nota,tgl_transaksi) VALUES ('$no_nota','$date')";
//$jadi=mysqli_query($con,$qry);
?>
