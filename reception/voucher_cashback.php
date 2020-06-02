<?php
include '../config.php';

date_default_timezone_set('Asia/Makassar');
$datev = date('Y-m-d');
$datevl = date('Y-m-d H:i:s');


$kode = $_GET['cashback'];
$harga = $_GET['harga'];
$faktur = $_GET['faktur'];
$idc = $_GET['idc'];
$query = mysqli_query($con, "select *from voucher_rupiah where kode='$kode' and status='Aktif' and tgl_awal<='$datev' and tgl_akhir>='$datev' and id_customer='$idc'");
$qc = mysqli_fetch_array($query);

$query2 = mysqli_query($con, "SELECT *FROM voucher_recovery WHERE kode='$kode' AND tgl_akhir>='$datev' AND status='Aktif'");
$qc2 = mysqli_fetch_array($query2);

if(mysqli_num_rows($query)>0){
    $diskon = $qc['nilai'];
    $newharga = $harga - $diskon;
    $pesan = "Voucher berhasil digunakan!";
 
} 
else if(mysqli_num_rows($query2)>0 && $harga>=50000){
    $diskon = $qc2['nilai'];
    $newharga = $harga - $diskon;
    $pesan = "Voucher berhasil digunakan!";
}
else{
    $diskon = 0;
    $newharga = $harga - $diskon;
    $pesan = "Pastikan penggunaan telah sesuai syarat dan ketentuan!";
}

$data = array(
 		'diskon'		=>	$diskon,
 		'hargabaru'		=>	$newharga,
 		'pesan'			=> 	$pesan,	
 		);
echo json_encode($data);

?>