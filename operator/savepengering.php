<?php 
include '../config.php';
session_start();
	   $no_nota=$_POST['no_nota'];
    	$jumlah1=$_POST['jumlah1'];
       $no_mesin=$_POST['no_mesin'];
       $ket=$_POST['ket'];
$us=$_SESSION['user_id'];

date_default_timezone_set('Asia/Makassar');
$jam=date("Y-m-d H:i:s");
	$q=mysqli_query($con,"insert into pengering (tgl_pengering,op_pengering,no_nota,jumlah,no_mesin) VALUES('$jam','$us','$no_nota','$jumlah1','$no_mesin')");
	 $query="update reception set pengering='1',tgl_pengering='$jam',op_pengering='$us'  WHERE no_nota = '$no_nota'";
	 $hasil=mysqli_query($con,$query);
	 if($hasil){
	 	
	 echo '<font color="green">Sukses</font>';
	}
	else {
	 echo '<font color="red">Error, Data Sudah Ada</font>';
	 }


?>
