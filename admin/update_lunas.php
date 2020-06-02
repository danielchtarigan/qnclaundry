<?php
include '../config.php';
if (isset($_POST['cuci'])){
$id=$_POST['selector'];
$N = count($id);
			for($i=0; $i < $N; $i++){
	$result = mysqli_query($con,"UPDATE reception set lunas = '1' WHERE id='$id[$i]'");}
	header("location: d_piutang.php");
	exit;

}
?>