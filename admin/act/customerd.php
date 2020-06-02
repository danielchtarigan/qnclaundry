<?php
session_start();
include '../../config.php';
include '../../auth.php';
date_default_timezone_set('Asia/Makassar');
$date = date('Y-m-d');

$tanggalb = date('d', (strtotime('+7 day', strtotime($date))));
$bulanb = date('m', (strtotime('+7 day', strtotime($date))));
$tahunb = date('y', (strtotime('+7 day', strtotime($date))));

$listbulanb = array(
		'01' => 'Januari',
		'02' => 'Februari',
		'03' => 'Maret',
		'04' => 'April',
		'05' => 'Mei',
		'06' => 'Juni',
		'07' => 'Juli',
		'08' => 'Agustus',
		'09' => 'September',
		'10' => 'Oktober',
		'11' => 'November',
		'12' => 'Desember'
	);
	
$user_id= $_SESSION['user_id'];
$typed = $_GET['type_d'];
$id = $_GET['id'];
if ($typed==0){
	$qc = mysqli_query($con, "update customer set type_d=1 where id='$id'");
	
$cs=mysqli_query($con,"SELECT * FROM customer WHERE id='$id'");
$q  = mysqli_fetch_array($cs);
$telp = $q['no_telp'];
$message = "QNCLAUNDRY
Laundry Kiloan Flat Rp.6600/kg untuk Anda khusus di QNC BTP dan DAYA. Berlaku s/d $tanggalb $listbulanb[$bulanb] $tahunb";

// send sms
 		 				$userkey="tuut04fxu5a790op59wjqkk6du";
					    $passkey="0xy367ndp35qrym8gr8s";
					    $url = "http://qnc.zenziva.com/api/sendsms.php";
					    $curlHandle = curl_init();
					    curl_setopt($curlHandle, CURLOPT_URL, $url);
					    curl_setopt($curlHandle, CURLOPT_POSTFIELDS, 'userkey='.$userkey.'&passkey='.$passkey.'&tipe=reguler&nohp='.$telp.'&pesan='.urlencode($message));
					    curl_setopt($curlHandle, CURLOPT_HEADER, 0);
					    curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
					    curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
					    curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
					    curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
					    curl_setopt($curlHandle, CURLOPT_POST, 1);
					    if (!$result = curl_exec($curlHandle)) {
					      trigger_error(curl_error($curlHandle));
					    }
					    curl_close($curlHandle);
}
else{
	$qs = mysqli_query($con, "update customer set type_d=0 where id='$id'");
}
	
	



 		 				
 		 			

?>

<script type="text/javascript">
 location.href="../customer_khusus.php";
</script>
