<?php

include "config.php";
include "send_sms.php";

date_default_timezone_set('Asia/Makassar');
$currtime = (int)date('Gi');
if ($currtime >= 900) {
  $qantrean = mysqli_query($con,"SELECT * FROM antrean_sms");
  while ($rantrean = mysqli_fetch_assoc($qantrean)) {
    sendSMS($rantrean['no_telp'],$rantrean['pesan']);
    $qdelete = mysqli_query($con,"DELETE FROM antrean_sms WHERE no_telp='$rantrean[no_telp]' AND pesan='$rantrean[pesan]'");
  }
}
?>
