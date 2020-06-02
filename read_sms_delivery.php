<?php

include "config.php";
include "send_sms.php";

function readSMS() {
  date_default_timezone_set('Asia/Jakarta');
  $tgl = date('Y-m-d');
  $userkey="tuut04fxu5a790op59wjqkk6du";
  $passkey="0xy367ndp35qrym8gr8s";
  $url = "http://qnc.zenziva.com/api/inboxgetbydate.php";
  $curlHandle = curl_init();
  curl_setopt($curlHandle, CURLOPT_URL, $url);
  curl_setopt($curlHandle, CURLOPT_POSTFIELDS, 'userkey='.$userkey.'&passkey='.$passkey.'&from='.$tgl.'&to='.$tgl.'&status=all');
  curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curlHandle, CURLOPT_FOLLOWLOCATION,1);
  curl_setopt($curlHandle, CURLOPT_FAILONERROR,1);
  curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
  curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
  curl_setopt($curlHandle, CURLOPT_POST, 1);
  if (!$result = curl_exec($curlHandle)) {
    trigger_error(curl_error($curlHandle));
  }
  curl_close($curlHandle);
  return $result;
}


$xml = simplexml_load_string(readSMS());
foreach($xml->message as $message){
  $no_telp = str_replace('+62','0',$message->dari);
  $pesan = $message->isiPesan;
  $pesan = strtolower($pesan);
  if (stripos($pesan,'req antar') !== false) {
    $qcus = mysqli_query($con, "select * from customer where no_telp='$no_telp'");
    if (mysqli_num_rows($qcus)>0) {
      $rcus = mysqli_fetch_array($qcus);
      $qfaktur = mysqli_query($con,"SELECT no_faktur FROM reception WHERE id_customer='$rcus[id]' AND sms_sent=1 AND ambil=0 ORDER BY tgl_input DESC LIMIT 1");
      if (mysqli_num_rows($qfaktur)>0) {
        $nofaktur = mysqli_fetch_array($qfaktur)[0];
        $row_faktur_delivery = mysqli_query($con, "SELECT id from delivery WHERE no_faktur='$nofaktur' AND jenis_permintaan='Antar' AND gateway='SMS'");
        if (mysqli_num_rows($row_faktur_delivery) > 0) {

        } else {
          mysqli_query($con,"INSERT INTO delivery (tgl_input, tgl_permintaan, waktu_permintaan, alamat, no_telp, id_customer, nama_customer, jenis_permintaan, no_faktur, status, gateway, catatan) VALUES (NOW(),DATE_ADD(NOW(),INTERVAL 1 DAY),'Bebas','$rcus[alamat]','$no_telp','$rcus[id]','$rcus[nama_customer]','Antar','$nofaktur','Open','SMS','')");
        }
      }
    }
  }
}