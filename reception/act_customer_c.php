<?php
session_start();
include '../config.php';
include '../auth.php';
$user_id= $_SESSION['user_id'];
$typec = $_GET['type_c'];
$id = $_GET['id'];
$message = $_GET['pesan'];
if ($typec==0){
	$qc = mysqli_query($con, "update customer set type_c=1 where id='$id'");
	
$cs=mysqli_query($con,"SELECT * FROM customer WHERE id='$id'");
$q  = mysqli_fetch_array($cs);
$telp = $q['no_telp'];

// send sms
 		 			  //   $userkey="tuut04fxu5a790op59wjqkk6du";
					    // $passkey="0xy367ndp35qrym8gr8s";
					    // $url = "http://qnc.zenziva.com/api/sendsms.php";
					    // $curlHandle = curl_init();
					    // curl_setopt($curlHandle, CURLOPT_URL, $url);
					    // curl_setopt($curlHandle, CURLOPT_POSTFIELDS, 'userkey='.$userkey.'&passkey='.$passkey.'&tipe=reguler&nohp='.$telp.'&pesan='.urlencode($message));
					    // curl_setopt($curlHandle, CURLOPT_HEADER, 0);
					    // curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
					    // curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
					    // curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
					    // curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
					    // curl_setopt($curlHandle, CURLOPT_POST, 1);
					    // if (!$result = curl_exec($curlHandle)) {
					    //   trigger_error(curl_error($curlHandle));
					    // }
					    // curl_close($curlHandle);
}
else{
	$qs = mysqli_query($con, "update customer set type_c=0 where id='$id'");
}
	
	



 		 				
 		 			

?>

<script type="text/javascript">
 location.href="index.php";
</script>
