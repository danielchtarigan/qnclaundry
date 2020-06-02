<?php 
if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $redirect);
    exit();
}

include 'encrypt-url.php';

$hal = '
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="refresh" content="0; url=https://www.qnclaundry.net">
    <link rel="icon" href="Logo bulat 2017.png">
    <title>QnC Laundry</title>
  </head> 
</html>
';

if(isset($_GET['delivery'])){
  $delivery = decrypt($_GET['delivery'],$key);
  if($delivery=="antarjemput"){
    include 'delivery.php';
  }
  else {
    echo $hal;
  }

}
  
else 
{
  echo $hal;
}


