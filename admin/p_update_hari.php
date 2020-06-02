<?php
include '../config.php';

$hari=$_POST['hari'];
$up=mysqli_query($con,"update tgl_selesai set tgl_selesai='$hari' where id='2' ");
if ($up){
	echo 'sukses :'.$hari;
}else{
	echo 'gagal';
}

?>