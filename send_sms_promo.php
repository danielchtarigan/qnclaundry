<?php 
include 'config.php';
include "send_sms.php";
date_default_timezone_set('Asia/Makassar');
$hariini = date('l');
$jamini = date('H:i:s');


$sql = mysqli_query($con, "SELECT * FROM siap_sms WHERE sent='0' AND hari LIKE '%$hariini%' AND jam<='$jamini' AND konten<>''");
if(mysqli_num_rows($sql)>0) {
	while($rkirim = mysqli_fetch_array($sql)) {
		 sendSMS($rkirim['no_telp'],$rkirim['konten']);
		 mysqli_query($con, "UPDATE siap_sms SET sent='1' WHERE no_telp='$rkirim[no_telp]' AND konten='$rkirim[konten]'");
	}
}


?>