<?php


include '../config.php';
date_default_timezone_set('Asia/Makassar');
$jam=date("Y-m-d H:i:s");
$no_nota = htmlspecialchars($_REQUEST['no_nota']);
$sebab = htmlspecialchars($_REQUEST['sebab']);
$jenis = htmlspecialchars($_REQUEST['jenis']);
session_start();
$us=$_SESSION['user_id'];

$sql =  "insert into order_void(tanggal,rcp,no_nota,sebab,jenis) values('$jam','$us','$no_nota','$sebab','$jenis')";
$result = @mysqli_query($con,$sql);
if ($result){

echo "sukses";
} else {
	echo json_encode(array('errorMsg'=>'Some errors occured.'));
}

?>