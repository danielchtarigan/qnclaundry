<?php

$id = intval($_REQUEST['id']);
$bank = htmlspecialchars($_REQUEST['bank']);
$tgl_setor = htmlspecialchars($_REQUEST['tgl_setor']);
$ket = htmlspecialchars($_REQUEST['ket']);
$setoran_bersih = htmlspecialchars($_REQUEST['setoran_bersih']);

include '../config.php';

$sql = "update tutup_kasir set bank='$bank',setoran_bersih='$setoran_bersih', tgl_setor='$tgl_setor',ket='$ket' where id=$id";
$result = @mysqli_query($con,$sql);
if ($result){
	echo json_encode(array(
		'id' => $id,
		'bank' => $bank,
		'setoran_bersih'=>$setoran_bersih,
		'tgl_setor' => $tgl_setor,
		'ket' => $ket
	));
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>