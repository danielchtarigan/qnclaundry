<?php 
include '../../config.php';
include '../zonawaktu.php';


$jam = date('Y-m-d');
$reception = $_SESSION['user_id'];
$outlet = $_SESSION['outlet'];

$nomer=$jam . ','.$reception;
$no_nota = explode(" ",$_POST["nota"]);
  foreach($no_nota as $key => $value){
  	if($value!='') {
  		$q = mysqli_query($con,"INSERT into dariworkshop (tgl_input,no_nota,rcp_input) VALUES('$nowDate','$value','$reception')");
  		$q +=mysqli_query($con,"UPDATE reception set tgl_kembali='$nowDate',reception_kembali='$reception',kembali='1' WHERE no_nota = '$value'");
  	}   	
  }


?>