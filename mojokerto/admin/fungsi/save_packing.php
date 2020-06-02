<?php 
include '../../../config.php';
session_start();
	   $no_nota=$_POST['no_nota'];
$jumlah1=$_POST['jumlah1'];
$ket1=$_POST['ket1'];
$us=$_SESSION['user_id'];
$jam=date("Y-m-d H:i:s");
$harga=$_POST['harga'];
$jenis=$_POST['jenis'];
$us=$_SESSION['user_id'];

date_default_timezone_set('Asia/Makassar');
$jam=date("Y-m-d H:i:s");
	$q=mysqli_query($con,"insert into packing (tgl_packing,user_packing,no_nota,jumlah,ket,harga,jenis) VALUES('$jam','$us','$no_nota','$jumlah1','$ket1','$harga','$jenis')");
	 $query="update reception set packing='1',tgl_packing='$jam',user_packing='$us' WHERE no_nota = '$no_nota'";
	 $hasil=mysqli_query($con,$query);
	 if($hasil){
	 	
	 echo '<font color="green">Sukses</font>';
	}
	else {
	 echo '<font color="red">Error, Data Sudah Ada</font>';
	 }


?>
