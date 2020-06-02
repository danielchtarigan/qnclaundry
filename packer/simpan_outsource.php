<?php 
include '../config.php';
session_start();
date_default_timezone_set('Asia/Makassar');
$nowDate = date('Y-m-d H:i:s');


$jam = date('Y-m-d');
$user = $_SESSION['user_id'];

$jenisO = $_POST['jenis_out'];


if($jenisO=="") {
	echo "Pilih dulu jenis outsourcenya yah!!";
}
else {
	$nomer=$jam . ','.$user;
	$no_nota = explode(" ",$_POST["nota"]);
	  foreach($no_nota as $key => $value){
	  	if($value!='') {
	  		$q = mysqli_query($con,"INSERT into outsource (tgl_input,no_nota,user_input,jenis_outsource) VALUES('$nowDate','$value','$user','$jenisO')");
	  		if($jenisO=="Cuci Kering Setrika Packing") {
				mysqli_query($con, "UPDATE reception SET cuci='1',op_cuci='Out',tgl_cuci='$nowDate',pengering='1',op_pengering='Out',tgl_pengering='$nowDate',setrika='1',user_setrika='Out',tgl_setrika='$nowDate',packing='1',user_packing='Out',tgl_packing='$nowDate' WHERE no_nota='$value'");
			}
	  		else if($jenisO=="Cuci Kering Setrika") {
				mysqli_query($con, "UPDATE reception SET cuci='1',op_cuci='Out',tgl_cuci='$nowDate',pengering='1',op_pengering='Out',tgl_pengering='$nowDate',setrika='1',user_setrika='Out',tgl_setrika='$nowDate' WHERE no_nota='$value'");
			}	
			else if($jenisO=="Cuci Kering") {
				mysqli_query($con, "UPDATE reception SET cuci='1',op_cuci='Out',tgl_cuci='$nowDate',pengering='1',op_pengering='Out',tgl_pengering='$nowDate' WHERE no_nota='$value'");
			}
			else if($jenisO=="Setrika") {
				mysqli_query($con, "UPDATE reception SET setrika='1',user_setrika='Out',tgl_setrika='$nowDate' WHERE no_nota='$value'");
			}
	  	}   	
	  }
	  ?>

	  <script type="text/javascript">
	  	location.href="form_outsource.php";
	  </script>

	  <?php

}




?>