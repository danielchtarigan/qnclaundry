<?php

function sendWassenger($phone,$message,$fileId){

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.wassi.chat/v1/messages",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => '
    {
      "phone":"'.$phone.'",
      "message":"'.$message.'",
      "priority": "low",
      "media": {
          "file": "'.$fileId.'",
          "format": "native"
      }
    }
    ',
    CURLOPT_HTTPHEADER => array(
      "content-type: application/json",
      "token: 1efd3adc842210cd487b0a328758f0509ece36cb8e1aa82b1909416ac4154a34bc4e86967d2e7126"
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);  
}

