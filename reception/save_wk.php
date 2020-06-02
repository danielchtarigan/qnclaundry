<?php 
include '../config.php';
	session_start();
	date_default_timezone_set('Asia/Makassar');
	  
    $us=$_SESSION['user_id'];
    $ot=$_SESSION['nama_outlet'];
	$jam=date("Y-m-d H:i:s");
	$no_nota = explode("\n", $_POST["no_nota"]);
  	foreach($no_nota as $key => $value){
  	$q=mysqli_query($con,"insert into dariworkshop (rcp_input,tgl_input,no_nota) VALUES ('$us','$jam','$value')");
  	$q2=mysqli_query($con,"UPDATE reception SET kembali='1',reception_kembali='$us',tgl_kembali='$jam' WHERE no_nota='$value'");
  }
	 if($q){
	 	
	 echo '<font color="green">Sukses Mbak</font>';
	 	}
	else {
	 echo '<font color="red">Error, Data Tidak Tersimpan</font>';
	 }


?>
