<?php 
include '../../../config.php';
session_start();
	   $no_nota=$_POST['no_nota'];
    	$jumlah1=$_POST['jumlah1'];
       $no_mesin=$_POST['no_mesin'];
       $ket=$_POST['ket'];
$us=$_SESSION['name'];

date_default_timezone_set('Asia/Jakarta');
$jam=date("Y-m-d H:i:s");
	$q=mysqli_query($con,"insert into pengering (tgl_kering,op_kering,no_nota,jumlah,no_mesin,ket) VALUES('$jam','$us','$no_nota','$jumlah1','$no_mesin','$ket')");
	 $query="update reception set pengering='1',tgl_pengering='$jam',op_pengering='$us'  WHERE no_nota = '$no_nota'";
	 $hasil=mysqli_query($con,$query);
	 if($hasil){
	 	
	 echo '<font color="green">Sukses</font>';
	}
	else {
	 echo '<font color="red">Error, Data Sudah Ada</font>';
	 }


?>
