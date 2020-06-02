<?php 
include '../../config.php';
include '../zonawaktu.php';

$tagihan = $_GET['tagihan'];
$voucher = $_GET['voucher'];


$kode1 = mysqli_query($con, "SELECT * FROM kode_promo_new WHERE kode='$voucher' AND tgl_berakhir>='$nowDate' AND status='1' AND outlet='$_SESSION[outlet]' AND cabang='$_SESSION[cabang]'");
$res1 = mysqli_fetch_assoc($kode1);
$confirm1 = mysqli_num_rows($kode1);

$kode2 = mysqli_query($con, "SELECT * FROM voucher_rupiah WHERE kode='$voucher' AND tgl_akhir>='$nowDate' AND status='Aktif'");
$res2 = mysqli_fetch_assoc($kode2);
$confirm2 = mysqli_num_rows($kode2);



if($confirm1>0) {
	$diskon = ($res1['diskon']/100)*$tagihan;	
} 
else if($confirm2>0) {
	$diskon = $res2['nilai'];
}
else {
	$diskon = 0;
}

echo $diskon;

?>