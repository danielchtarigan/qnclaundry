<?php

$id = intval($_REQUEST['id']);
$no_faktur= htmlspecialchars($_REQUEST['no_faktur']);
$total = htmlspecialchars($_REQUEST['total']);
$rcp = htmlspecialchars($_REQUEST['rcp']);
$byr = htmlspecialchars($_REQUEST['cara_bayar']);
date_default_timezone_set('Asia/Makassar');
$jam=date("Y-m-d H:i:s");
include '../config.php';

$sql = "update faktur_penjualan set total='$total',cara_bayar='$byr' where id=$id";
$sql2=$con->query("update cara_bayar set jumlah='$total',cara_bayar='$byr' where no_faktur='$no_faktur' and jumlah<>'0' ");
$sql3=$con->query("update reception set cara_bayar='$byr' where no_faktur='$no_faktur' ");
$result = @mysqli_query($con,$sql);
if ($result){
	echo json_encode(array(
		'id' => $id,
		'no_faktur' => $no_faktur,
		'total' => $total,
		'rcp' => $rcp,
		'cara_bayar' => $byr
	));
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}
?>