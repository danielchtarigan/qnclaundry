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
  		$q = mysqli_query($con,"UPDATE reception set workshop='$outlet',tgl_workshop='$nowDate',op_workshop='$reception' WHERE no_nota = '$value'");
  	}   	
  }


?>