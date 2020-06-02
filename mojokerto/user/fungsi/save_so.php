<?php 
include '../../../config.php';
		session_start();
		date_default_timezone_set('Asia/Jakarta');
	  
       $us=$_SESSION['name'];
       $ot=$_SESSION['nama_outlet'];


	$jam=date("Y-m-d H:i:s");
	$jam2=date("Y-m-d");
	
	$nomer=$jam2 . ','.$us;

$no_nota = explode("\n", $_POST["no_nota"]);
  foreach($no_nota as $key => $value){
  	$q=mysqli_query($con,"insert into detail_so (tgl_so,outlet,no_nota,rcp_so,nomer) VALUES('$jam','$ot','$value','$us','$nomer')");
  	$q2=mysqli_query($con,"update reception set tgl_so='$jam',rcp_so='$us'  WHERE no_nota = '$value'");
  }
	 if($q){
	 	
	 echo '<font color="green">Sukses Mbak</font>';
	 	}
	else {
	 echo '<font color="red">Error, Data Tidak Tersimpan</font>';
	 }


?>
