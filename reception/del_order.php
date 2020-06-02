<?php
$no_nota = $_REQUEST['no_nota'];
include '../config.php';
$sql = "delete from reception where no_nota='$no_nota'";
$sql1 = "delete from detail_penjualan where no_nota='$no_nota'";
$result = @mysqli_query($con,$sql);
$result1 = @mysqli_query($con,$sql1);

if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>