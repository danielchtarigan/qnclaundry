<?php
include "../config.php";


session_start();
$us             = $_SESSION['user_id'];
date_default_timezone_set('Asia/Makassar');
$date         = date("Y-m-d H:i:s");


$no_nota     = $_POST['no_nota'];
$nama_hotel  = $_POST['nama_hotel'];
$berat       = $_POST['berat'];
$id 		 = $_POST['id'];
$packer 	 = $_POST['packer'];


$jumlah = count($id);
for($i=0; $i < $jumlah; $i++) 
{
$updatev  = mysqli_query($con,"update detail_hotel set packer='$packer[$i]' WHERE id='$id[$i]' ");
}

if ($updatev) {
	echo "<script>alert('Nota hotel telah dipacker, proses telah lengkap');</script>";
	echo "<script>document.location='index.php';</script>";
		
} else {
	echo "Data Gagal disimpan";
	
}

$query="insert into packing_hotel (tgl_packing,packer,no_nota,berat,nama_hotel,ket) VALUES('$date','$us','$no_nota','$berat','$nama_hotel','$ket')";
$hasil=mysqli_query($con,$query);

?>
