<?php  
include '../config.php';
session_start();

$us=$_SESSION['user_id'];
$ot=$_SESSION['nama_outlet'];

$nama_customer=$_POST['nama_customer'];
$no_nota=$_POST['no_nota'];
$jumlah=$_POST['jumlah'];
$berat=$_POST['berat'];
$jenis=$_POST['jenis'];
$express=$_POST['express'];
$ket=$_POST['ket'];

date_default_timezone_set('Asia/Makassar');
$jam=date("Y-m-d H:i:s");
$tgl2=date("Y-m-d");
if(mysqli_query($con,"insert into reception(tgl_masuk,nama_outlet,nama_reception,tgl_input,nama_customer,no_nota,jumlah,berat,jenis,express,ket) VALUES('$tgl2','$ot','$us','$jam', '$nama_customer', '$no_nota', '$jumlah', '$berat','$jenis','$express','$ket')"))
echo '<font color="green" size=5>Sukses-'.$no_nota.'-'.$nama_customer.' </font>';
else{
echo "Data Gagal Di Input";
}
?>