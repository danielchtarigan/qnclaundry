<?php
include '../../../config.php';
session_start();

function rupiah($angka){
	$jadi = "Rp.".number_format($angka,0,',','.');
	return $jadi;
}
date_default_timezone_set('Asia/Jakarta');
$jam1 = date("Y-m-d H:i:s");	 

if (isset($_GET['item'])){
 $item = $_GET['item'];
}
if (isset($_GET['harga'])){
 $harga = $_GET['harga'];
}
if (isset($_GET['id'])){
 $id = $_GET['id'];
}
if (isset($_GET['ket1'])){
 $ket1 = $_GET['ket1'];
}
if (isset($_GET['hanger_own'])){
 $hanger_own = $_GET['hanger_own'];
}
if (isset($_GET['deliver'])){
 $deliver = $_GET['deliver'];
}
if (isset($_GET['parfum'])){
 $parfum = $_GET['parfum'];
}
if (isset($_GET['charge'])){
 $charge = $_GET['charge'];
}
if (isset($_GET['hanger'])){
 $hanger = $_GET['hanger'];
}
if (isset($_GET['hanger_plastic'])){
 $hanger_plastic = $_GET['hanger_plastic'];
}

$ot = $_SESSION['nama_outlet'];

$query = "SELECT * FROM reception WHERE nama_outlet='$ot' order by id desc LIMIT 0,1";
$hasil = mysqli_query($con,$query);
$data  = mysqli_fetch_array($hasil);
$lastNoTransaksi = $data['no_so'];
// baca nomor urut transaksi dari id transaksi terakhir
//soCDW000001
$lastNoUrut = (int)substr($lastNoTransaksi, 5, 6);
// nomor urut ditambah 1
$nextNoUrut1 = $lastNoUrut + 1;

include 'code.php';
 
// membuat format nomor transaksi berikutnya
	$t = date('Y');
	$m = date('m');
	$d = date('d');
	$h = date('H');
	$i = date('i');
	
	
$noso = $char.sprintf('%06s', $nextNoUrut1);
  
if ($_GET['notanew']<>''){
	 $notanew = $_GET['notanew'];
	 $no_nota = $notanew;
}
else{	
	$no_nota=$noso;
}

$new_nota = $char1.$t.$m.$d.$h.sprintf('%06s', $nextNoUrut1);

$qharga = mysqli_query($con, "select * from item_spk where nama_item='$item'");		 
$rharga = mysqli_fetch_array($qharga);

$qcus = mysqli_query($con, "select * from customer where id='$id'");
$rcus = mysqli_fetch_array($qcus);
$nama_customer = $rcus['nama_customer'];

$cekdata = mysqli_query($con, "select * from order_tmp where id_customer='$id'");
$ncek = mysqli_num_rows($cekdata);

if ($ncek>0){
$qrincian2 = mysqli_query($con, "delete from order_tmp where id_customer = '$id'");
$qrincian2 = mysqli_query($con, "insert into order_tmp (id, tgl, no_nota, no_so, id_customer, item, harga, jumlah, berat, hanger_own, deliver, parfum, charge, hanger, hanger_plastic, ket, new_nota) values ('', '$jam1', '$no_nota', '$noso', '$id', '$rharga[nama_item]', '$harga', '1', '$rharga[berat]', '$hanger_own', '$deliver', '$parfum', '$charge','$hanger', '$hanger_plastic', '$ket1', '$new_nota')");
}
else{
$qrincian2 = mysqli_query($con, "insert into order_tmp (id, tgl, no_nota, no_so, id_customer, item, harga, jumlah, berat, hanger_own, deliver, parfum, charge, hanger, hanger_plastic, ket, new_nota) values ('', '$jam1', '$no_nota', '$noso', '$id', '$rharga[nama_item]', '$harga', '1', '$rharga[berat]', '$hanger_own', '$deliver', '$parfum', '$charge','$hanger', '$hanger_plastic', '$ket1', '$new_nota')");
}
?>