<?php 
include '../config.php';
session_start();
$us=$_SESSION['user_id'];
date_default_timezone_set('Asia/Makassar');
$today = date("Ymd");
$query = "SELECT max(no_nota) AS last FROM cuci_hotel WHERE no_nota like '$today%'";
$hasil = mysqli_query($con,$query);
$data  = mysqli_fetch_array($hasil);
$lastNoTransaksi = $data['last'];
 
// baca nomor urut transaksi dari id transaksi terakhir
$lastNoUrut = substr($lastNoTransaksi, 8, 4);
 
// nomor urut ditambah 1
$nextNoUrut = $lastNoUrut + 1;
 
// membuat format nomor transaksi berikutnya
$nextNoTransaksi = $today.sprintf('%04s', $nextNoUrut);


	date_default_timezone_set('Asia/Makassar');
	$jam=date("Y-m-d H:i:s");
	
	$jumlah=$_POST['jumlah'];
	$nama_customer=$_POST['nama_customer'];
	$ket=$_POST['ket'];
	
	$query="insert into cuci_hotel (tgl_cuci,op_cuci,no_nota,jumlah,nama_hotel,ket) VALUES('$jam','$us','$nextNoTransaksi','$jumlah','$nama_customer','$ket')";
 	$hasil=mysqli_query($con,$query);
	 if($hasil){
	echo( '<font color="green" size=5>Sukses-'.$nextNoTransaksi.'-'.$nama_customer.' </font>');
	
	}
	
	else {
	 echo '<font color="red" size=5>ERROR DATA GAGAL DI SIMPAN</font>';
	 }
	
?>