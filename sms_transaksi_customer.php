<?php 
include 'config.php';
include 'encrypt-url.php';
include 'send_sms.php';

$idcs = $_GET['idcs'];
$struk = encrypt($_GET['struk'],$key);

$sql = mysqli_query($con, "SELECT * FROM customer WHERE id='$idcs'");
$data = mysqli_fetch_assoc($sql);
$telp = $data['no_telp'];
$nama = $data['nama_customer'];

$urlf = 'http://notalaundry.com/?id='.$struk;

$message = 'QNCLAUNDRY
Terima kasih sudah menggunakan layanan laundry kami. Faktur: '.$urlf;

sendSMS($telp,$message);

?>



