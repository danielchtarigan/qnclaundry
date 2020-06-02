<?php

$id = intval($_REQUEST['id']);
include '../config.php';

$rq = mysqli_query($con, "select *from faktur_penjualan where id='$id'");
if($rc = mysqli_num_rows($rq)){
while($rw = mysqli_fetch_assoc($rq)){
$qlc=mysqli_query($con, "delete from cara_bayar where no_faktur='$rw[no_faktur]'");
}
}
	
$sql = "delete from faktur_penjualan where id='$id'";

$result = @mysqli_query($con,$sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}

?>