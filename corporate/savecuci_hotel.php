<?php
include "../config.php";


session_start();
$us             = $_SESSION['user_id'];
date_default_timezone_set('Asia/Makassar');
$date         = date("Y-m-d H:i:s");


$no_nota     = $_POST['no_nota'];
$nama_hotel  = $_POST['nama_hotel'];
//$email       = $_POST['email'];
$id =$_POST['id'];
$cucian =$_POST['cucian'];


$jumlah = count($id);
for($i=0; $i < $jumlah; $i++) 
{
$updatev  = mysqli_query($con,"update detail_hotel set cuci='$cucian[$i]' WHERE id='$id[$i]' ");
	
}

if ($updatev) {
	echo "<script>alert('Nota hotel telah dicuci, lakukan proses kering');</script>";
	echo "<script>document.location='index.php';</script>";
	
	
} else {
	echo "Data Gagal disimpan";
	
}

$sql5=$con->query("SELECT sum(cuci) as total FROM detail_hotel WHERE no_nota= '$no_nota'");
$r = $sql5->fetch_assoc();
$tot=$r['total'];  


$query="insert into cuci_hotel (tgl_cuci,op_cuci,no_nota,jumlah,nama_hotel,ket) VALUES('$date','$us','$no_nota','$tot','$nama_hotel','$ket')";
$hasil=mysqli_query($con,$query);

?>
