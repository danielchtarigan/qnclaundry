<?php
include '../config.php';
session_start();

function rupiah($angka){
	$jadi = "Rp.".number_format($angka,0,',','.');
	return $jadi;
}
date_default_timezone_set('Asia/Makassar');

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
if (isset($_GET['jumlah'])){
 $jumlah = $_GET['jumlah'];
}
if (isset($_GET['hanger_plastic'])){
 $hanger_plastic = $_GET['hanger_plastic'];
}


include 'code.php';
 
// membuat format nomor transaksi berikutnya
	$t = date('Y');
	$m = date('m');
	$d = date('d');
	$h = date('H');
	$i = date('i');	
  
if ($_GET['notanew']<>''){
	 $notanew = $_GET['notanew'];
	 $no_nota = $notanew;
}
else{	
	$no_nota=$noso;
}

$cek_nota = mysqli_query($con, "SELECT * FROM reception WHERE no_nota='$no_nota'");
if(mysqli_num_rows($cek_nota)>0){
	$no_nota = "Nomor Notanya Error!!";
} else{
	$no_nota = $no_nota;
}

$new_nota = $res['kode'].$t.$m.$d.$h.sprintf('%03s', $nextNoUrut1);

$qharga = mysqli_query($con, "select * from item_spk where nama_item='$item'");		 
$rharga = mysqli_fetch_array($qharga);

$qcus = mysqli_query($con, "select * from customer where id='$id'");
$rcus = mysqli_fetch_array($qcus);
$nama_customer = $rcus['nama_customer'];

$cekdata = mysqli_query($con, "SELECT * FROM order_tmp where id_customer='$id' AND cabang<>'Delivery'");
$ncek = mysqli_num_rows($cekdata);

if ($ncek>0){
$qrincian2 = mysqli_query($con, "DELETE from order_potongan_tmp where id_customer = '$id' AND cabang<>'Delivery'");
$qrincian2 = mysqli_query($con, "insert into order_potongan_tmp (id, tgl, no_nota, no_so, id_customer, item, harga, jumlah, berat, hanger_own, deliver, parfum, charge, hanger, hanger_plastic, ket, new_nota) values ('', '$jam1', '$no_nota', '$noso', '$id', '$rharga[nama_item]', '$harga', '$jumlah', '$rharga[berat]', '$hanger_own', '$deliver', '$parfum', '$charge','$hanger', '$hanger_plastic', '$ket1', '$new_nota')");
}
else{
$qrincian2 = mysqli_query($con, "insert into order_potongan_tmp (id, tgl, no_nota, no_so, id_customer, item, harga, jumlah, berat, hanger_own, deliver, parfum, charge, hanger, hanger_plastic, ket, new_nota) values ('', '$jam1', '$no_nota', '$noso', '$id', '$rharga[nama_item]', '$harga', '$jumlah', '$rharga[berat]', '$hanger_own', '$deliver', '$parfum', '$charge','$hanger', '$hanger_plastic', '$ket1', '$new_nota')");
}

//masuk ke tabel kategori_item_order

$qitem = mysqli_query($con, "SELECT kategory FROM item_spk WHERE nama_item LIKE '$rharga[nama_item]'");
$kat = mysqli_fetch_array($qitem)[0];

mysqli_query($con, "DELETE FROM kategori_item_order WHERE no_nota='$no_nota'");
mysqli_query($con, "INSERT INTO kategori_item_order VALUES ('$no_nota','p','$kat','$jam1')");

?>