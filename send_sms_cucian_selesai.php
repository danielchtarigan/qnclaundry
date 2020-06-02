<?php
include "config.php";

date_default_timezone_set('Asia/Makassar');
$currtime = (int)date('Gi');
if ($currtime >= 900 && $currtime <= 2100) {
  $messagequery = mysqli_query($con, "SELECT value FROM settings WHERE name='sms_cucian_selesai'");
  $messagetemplate = mysqli_fetch_array($messagequery)[0];
  $messagedeliveryquery = mysqli_query($con, "SELECT value FROM settings WHERE name='sms_cucian_selesai_delivery'");
  $messagedeliverytemplate = mysqli_fetch_array($messagedeliveryquery)[0];
  $qfaktur = mysqli_query($con,"SELECT DISTINCT no_faktur,no_telp FROM reception INNER JOIN customer ON reception.id_customer = customer.id WHERE packing=1 AND DATE_ADD(tgl_packing,INTERVAL 12 HOUR) <= NOW() AND ambil=0 AND sms_sent=0");
  while ($rfaktur = mysqli_fetch_assoc($qfaktur)) {
    $no_faktur = $rfaktur['no_faktur'];
    $telp = $rfaktur['no_telp'];
    $qnotdone = mysqli_query($con,"SELECT id FROM reception WHERE no_faktur='$no_faktur' AND ambil=0 AND (packing=0 OR (packing=1 AND DATE_ADD(tgl_packing, INTERVAL 12 HOUR) > NOW()))");
    if (mysqli_num_rows($qnotdone)==0) {
      $qdelivery = mysqli_query($con,"SELECT id FROM delivery WHERE no_faktur='$no_faktur'");
      if (mysqli_num_rows($qdelivery) > 0)
      $message = str_replace("[NO_FAKTUR]",$no_faktur,$messagetemplate);
      else
      $message = str_replace("[NO_FAKTUR]",$no_faktur,$messagedeliverytemplate);
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
      mysqli_query($con,"UPDATE reception SET sms_sent=1 WHERE no_faktur='$no_faktur'");
    }
  }
}
?>
