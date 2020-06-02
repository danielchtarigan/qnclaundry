<?php

$id = intval($_REQUEST['id']);
$no_nota = $_REQUEST['no_nota'];
$status = $_REQUEST['status'];

include 'conn.php';

$sql = "update void set status='1' where id=$id";
@mysqli_query($con,$sql);
echo json_encode(array(
	'id' => $id,
	'no_nota' => $no_nota,
	'status' => $status
	
));
?>