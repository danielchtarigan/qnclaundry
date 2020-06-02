<?php 
session_start();

date_default_timezone_set('Asia/Makassar');
$cY = substr(date('Y'),2,2);
$cM = date('m');
$cD = date('d');

$user = $_SESSION['user_id'];
$outletp = $_GET['outlet'];

if($_SESSION['subagen']<>''){
	$scab = $_SESSION['subagen'];
	$char1 = "SS".strtoupper(substr($user, 0,2).substr($user, -1)).$cY.$cM.$cD;
	$char2 = "FS".strtoupper(substr($user, 0,2).substr($user, -1)).$cY.$cM.$cD;
} else {
	$scab = 'Delivery';
	$char1 = "SD".strtoupper(substr($user, 0,2).substr($user, -1)).$cY.$cM.$cD;
	$char2 = "FD".strtoupper(substr($user, 0,2).substr($user, -1)).$cY.$cM.$cD;
}


$query = mysqli_query($con, "SELECT MAX(no_so) AS no_so FROM reception WHERE cabang LIKE 'Delivery' AND no_so LIKE '$char1%'");
$row = mysqli_fetch_row($query)[0];

$no_urut = (int)substr($row, 11, 3)+1;
$no_so = $char1.sprintf('%03s', $no_urut);
$no_order = $char1.sprintf('%03s', $no_urut);

/*char Faktur ==Start==*/

$query = mysqli_query($con, "SELECT no_faktur_urut FROM faktur_penjualan WHERE rcp='$user' AND sub_cabang='$scab' AND no_faktur_urut LIKE '$char2%' ORDER BY id DESC LIMIT 0,1");
$result = mysqli_fetch_row($query);

$lastfaktur = (int)substr($result[0], 11, 3)+1;
$no_faktur = $char2.sprintf('%03s', $lastfaktur);

?>