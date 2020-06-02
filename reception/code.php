<?php

date_default_timezone_set('Asia/Makassar');
$cY = substr(date('Y'),2,2);
$cM = date('m');
$cD = date('d');
$charToday = $cY.$cM.$cD;

$ot = $_SESSION['nama_outlet'];

$sql = mysqli_query($con, "SELECT kode FROM outlet WHERE nama_outlet='$ot'");
$res = mysqli_fetch_array($sql);

$charOrder = "SO".$res['kode'].$charToday;
$charFaktur = "FO".$res['kode'].$charToday;

$query = "SELECT * FROM reception WHERE nama_outlet='$ot' AND no_so LIKE '$charOrder%' AND cabang<>'Delivery' order by id desc LIMIT 0,1";
$hasil = mysqli_query($con,$query);
$data  = mysqli_fetch_array($hasil);
$lastNoTransaksi = $data['no_so'];
// baca nomor urut transaksi dari id transaksi terakhir
//soCDW000001
$lastNoUrut = (int)substr($lastNoTransaksi, 11, 3);
// nomor urut ditambah 1
$nextNoUrut1 = $lastNoUrut + 1;


$noso = $charOrder.sprintf('%03s', $nextNoUrut1);


/*charFaktur ==Start==*/

$query   = "SELECT max(no_faktur) AS last FROM faktur_penjualan  WHERE nama_outlet='$ot' AND sub_cabang='' AND no_faktur_urut LIKE '$charFaktur%' LIMIT 1";
$hasil   = mysqli_query($con,$query);
$k       = mysqli_fetch_array($hasil);
$no_urut = $k['last'];
// baca nomor urut transaksi dari id transaksi terakhir
//fCDW000001
$terakhir= (int)substr($no_urut, 11, 3);
// nomor urut ditambah 1
$nextNoUrut = $terakhir + 1;

// membuat format nomor transaksi berikutnya
$nofaktur = $charFaktur.sprintf('%03s', $nextNoUrut);
   
?>