<?php

$id = intval($_REQUEST['id']);

include '../config.php';

$sql = "delete from tutup_kasir where id=$id";
$result = @mysqli_query($con,$sql);
if ($result){
	echo json_encode(array('success'=>true));
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>