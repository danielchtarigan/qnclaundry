<?php 
include 'config.php';
session_start();

date_default_timezone_set('Asia/Makassar');

if(isset($_POST['tgl'])) {
	$date = $_POST['tgl'];
	$nowDate = $_POST['tgl'];
	$userId = $_POST['rcp'];
	$outlet = "";
}
else {
	$date = date('Y-m-d H:i:s');
	$nowDate = date('Y-m-d');
	$userId = $_SESSION['user_id'];
	$outlet = $_SESSION['nama_outlet'];
}

function rupiah($angka){
	$data = number_format($angka,0,',','.');
	return $data;
}

function order_bayar($userId,$caraBayar,$nowDate){
	global $con;
	$sql = $con->query("SELECT COALESCE(SUM(a.jumlah),0) FROM cara_bayar AS a, faktur_penjualan AS b WHERE a.no_faktur=b.no_faktur AND a.cara_bayar LIKE '%$caraBayar%' AND a.tgl_order = '$nowDate' AND a.rcp_order='$userId' AND b.sub_cabang=''");
	$data = $sql->fetch_array();
	return $data[0];
}

function order_bayar_delivery($userId,$caraBayar,$nowDate,$cabang){
	global $con;
	$sql = $con->query("SELECT COALESCE(SUM(a.jumlah),0) FROM cara_bayar AS a, faktur_penjualan AS b WHERE a.no_faktur=b.no_faktur AND a.cara_bayar LIKE '%$caraBayar%' AND a.tgl_order LIKE '%$nowDate%' AND a.rcp_order='$userId' AND b.sub_cabang='$cabang'");
	$data = $sql->fetch_array();
	return $data[0];
}

function berlangganan_bayar($userId,$caraBayar,$nowDate,$berlangganan){
	global $con;
	$sql = $con->query("SELECT COALESCE(SUM(total),0) FROM faktur_penjualan WHERE cara_bayar LIKE '%$caraBayar%' AND tgl_transaksi LIKE '%$nowDate%' AND jenis_transaksi LIKE '$berlangganan' AND rcp='$userId'");
	$data = $sql->fetch_array();
	return $data[0];
}

function delivery_setor($userId,$nowDate){
	global $con;
	$sql = $con->query("SELECT COALESCE(SUM(jumlah),0) FROM setoran_delivery WHERE tanggal LIKE '%$nowDate%' AND nama_reception='$userId'");
	$data = $sql->fetch_array();
	return $data[0];
}

function belum_lunas($userId,$nowDate){
	global $con;
	$sql = $con->query("SELECT COALESCE(SUM(total_bayar),0) FROM reception WHERE tgl_input LIKE '%$nowDate%' AND nama_reception='$userId' AND lunas=false AND (cara_bayar<>'Void' OR cara_bayar<>'Reject') ");
	$data = $sql->fetch_array();
	return $data[0];
}


$rcp_cash = order_bayar($userId,'Cash',$nowDate);
$rcp_bni = order_bayar($userId,'BNI',$nowDate);
$rcp_bri = order_bayar($userId,'BRI',$nowDate);
$rcp_bca = order_bayar($userId,'BCA',$nowDate);
$rcp_mandiri = order_bayar($userId,'Mandiri',$nowDate);
$rcp_kuota = order_bayar($userId,'Kuota',$nowDate);
$rcp_cashback = order_bayar($userId,'Cashback',$nowDate);
$rcp_piutang = belum_lunas($userId,$nowDate);

$delivery_cash = order_bayar_delivery($userId,'Cash',$nowDate,'Delivery');
$delivery_kuota = order_bayar_delivery($userId,'Kuota',$nowDate,'Delivery');

$rcp_cash_membership = berlangganan_bayar($userId,'Cash',$nowDate,'membership');
$rcp_bni_membership = berlangganan_bayar($userId,'BNI',$nowDate,'membership');
$rcp_bri_membership = berlangganan_bayar($userId,'BRI',$nowDate,'membership');
$rcp_bca_membership = berlangganan_bayar($userId,'BCA',$nowDate,'membership');
$rcp_mandiri_membership = berlangganan_bayar($userId,'Mandiri',$nowDate,'membership');

$rcp_cash_deposit = berlangganan_bayar($userId,'Cash',$nowDate,'deposit');
$rcp_bni_deposit = berlangganan_bayar($userId,'BNI',$nowDate,'deposit');
$rcp_bri_deposit = berlangganan_bayar($userId,'BRI',$nowDate,'deposit');
$rcp_bca_deposit = berlangganan_bayar($userId,'BCA',$nowDate,'deposit');
$rcp_mandiri_deposit = berlangganan_bayar($userId,'Mandiri',$nowDate,'deposit');


$cash = order_bayar($userId,'Cash',$nowDate)+berlangganan_bayar($userId,'Cash',$nowDate,'membership')+berlangganan_bayar($userId,'Cash',$nowDate,'deposit')+order_bayar_delivery($userId,'Cash',$nowDate,'Delivery');
$bni = order_bayar($userId,'BNI',$nowDate)+berlangganan_bayar($userId,'BNI',$nowDate,'membership')+berlangganan_bayar($userId,'BNI',$nowDate,'deposit')+order_bayar_delivery($userId,'BNI',$nowDate,'Delivery');
$bri = order_bayar($userId,'BRI',$nowDate)+berlangganan_bayar($userId,'BRI',$nowDate,'membership')+berlangganan_bayar($userId,'BRI',$nowDate,'deposit')+order_bayar_delivery($userId,'BRI',$nowDate,'Delivery');
$bca = order_bayar($userId,'BCA',$nowDate)+berlangganan_bayar($userId,'BCA',$nowDate,'membership')+berlangganan_bayar($userId,'BCA',$nowDate,'deposit')+order_bayar_delivery($userId,'BCA',$nowDate,'Delivery');
$mandiri = order_bayar($userId,'Mandiri',$nowDate)+berlangganan_bayar($userId,'Mandiri',$nowDate,'membership')+berlangganan_bayar($userId,'Mandiri',$nowDate,'deposit')+order_bayar_delivery($userId,'Mandiri',$nowDate,'Delivery');


$idChar =  $con->query("SELECT user_id FROM user WHERE name='$userId'")->fetch_array()[0];
$kode = sprintf('%03s', $idChar);

$charrcp = strtoupper(substr($userId, 0, 2).substr($userId, 3, 1));
$nomor = $charrcp.$kode.date('Ymd');


$sql = $con->query("SELECT * FROM tutup_shift WHERE nomor='$nomor'");
if(mysqli_num_rows($sql)>0){
	
	$tutup = $con->query("UPDATE tutup_shift SET rcp_cash='$rcp_cash', rcp_bni='$rcp_bni', rcp_bri='$rcp_bri', rcp_bca='$rcp_bca', rcp_mandiri='$rcp_mandiri', rcp_kuota='$rcp_kuota',rcp_cashback='$rcp_cashback', rcp_piutang='$rcp_piutang',rcp_cash_membership='$rcp_cash_membership',rcp_bni_membership='rcp_bni_membership',rcp_bri_membership='$rcp_bri_membership',rcp_bca_membership='$rcp_bca_membership',rcp_mandiri_membership='$rcp_mandiri_membership',rcp_cash_deposit='$rcp_cash_deposit',rcp_bni_deposit='rcp_bni_deposit',rcp_bri_deposit='$rcp_bri_deposit',rcp_bca_deposit='$rcp_bca_deposit',rcp_mandiri_deposit='$rcp_mandiri_deposit',delivery_cash='$delivery_cash',delivery_kuota='$delivery_kuota',tanggal_tutup='$date',outlet='$outlet' WHERE nomor='$nomor'");
}
else {
	
	$tutup = $con->query("INSERT INTO tutup_shift VALUES ('$nomor','$rcp_cash','$rcp_bni','$rcp_bri','$rcp_bca','$rcp_mandiri','$rcp_kuota','$rcp_cashback','$rcp_piutang','$rcp_cash_membership','$rcp_bni_membership','$rcp_bri_membership','$rcp_bca_membership','$rcp_mandiri_membership','$rcp_cash_deposit','$rcp_bni_deposit','$rcp_bri_deposit','$rcp_bca_deposit','$rcp_mandiri_deposit','$delivery_cash','$delivery_kuota','$date','$userId','$outlet') ");
}



	


	

