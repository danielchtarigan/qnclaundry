<?php

$id = intval($_REQUEST['id']);
$berat= $_REQUEST['berat'];
$kategory= $_REQUEST['kategory'];
$harga_mjkt= $_REQUEST['harga_mjkt'];
include '../config.php';

$sql = "update item_spk set berat='$berat',kategory='$kategory',harga_mjkt='$harga_mjkt' where id=$id";
@mysqli_query($con,$sql);
echo json_encode(array(
	'id' => $id,
	'berat' => $berat,
	'kategory' => $kategory,
        'harga_mjkt' => $harga_mjkt	
));
?>