<?php
function sendSMS($phone,$message) {
  $userkey="tuut04fxu5a790op59wjqkk6du";
  $passkey="0xy367ndp35qrym8gr8s";
  $url = "http://qnc.zenziva.com/api/sendsms.php";
  $curlHandle = curl_init();
  curl_setopt($curlHandle, CURLOPT_URL, $url);
  curl_setopt($curlHandle, CURLOPT_POSTFIELDS, 'userkey='.$userkey.'&passkey='.$passkey.'&tipe=reguler&nohp='.$phone.'&pesan='.urlencode($message));
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
?>
