<?php 
include 'config.php';

date_default_timezone_set('Asia/Makassar');

function order_bayar($userId,$caraBayar,$nowDate){
	global $con;
	$sql = $con->query("SELECT COALESCE(SUM(a.jumlah),0) FROM cara_bayar AS a, faktur_penjualan AS b WHERE a.no_faktur=b.no_faktur AND a.cara_bayar LIKE '%$caraBayar%' AND a.tgl_order = '$nowDate' AND a.rcp_order='$userId'");
	$data = $sql->fetch_array();
	return $data[0];
}

function berlangganan_bayar($userId,$caraBayar,$nowDate,$berlangganan){
	global $con;
	$sql = $con->query("SELECT COALESCE(SUM(total),0) FROM faktur_penjualan WHERE cara_bayar LIKE '%$caraBayar%' AND tgl_transaksi LIKE '%$nowDate%' AND jenis_transaksi LIKE '$berlangganan' AND rcp='$userId'");
	$data = $sql->fetch_array();
	return $data[0];
}

function belum_lunas($userId,$nowDate){
	global $con;
	$sql = $con->query("SELECT COALESCE(SUM(total_bayar),0) FROM reception WHERE tgl_input LIKE '%$nowDate%' AND nama_reception='$userId' AND lunas=false AND (cara_bayar<>'Void' OR cara_bayar<>'Reject') ");
	$data = $sql->fetch_array();
	return $data[0];
}


$jam = date('Y-m-d H:i:s');
$nowDate = date('Y-m-d');
// $jam = $_GET['jam'].' 23:00:00';
// $nowDate = date('Y-m-d', strtotime($jam));

$sql = mysqli_query($con, "SELECT DISTINCT id_user FROM log_rcp a, outlet b WHERE a.id_outlet=b.nama_outlet AND b.Kota='Makassar' AND tgl_log LIKE '%$nowDate%' ORDER BY tgl_log DESC, id_user ASC");
while($data=mysqli_fetch_array($sql)){
	$userId = $data[0];
	$idUser = mysqli_fetch_array(mysqli_query($con, "SELECT user_id FROM user WHERE name='$userId'"))[0];

	$no_produk_penjualan1 = date('Ymd', strtotime($jam)).sprintf('%04s', $idUser);


	$deposit_cash = berlangganan_bayar($userId,'Cash',$nowDate,'deposit');
	$deposit_bni = berlangganan_bayar($userId,'BNI',$nowDate,'deposit');
	$deposit_bri = berlangganan_bayar($userId,'BRI',$nowDate,'deposit');
	$deposit_bca = berlangganan_bayar($userId,'BCA',$nowDate,'deposit');
	$deposit_mandiri = berlangganan_bayar($userId,'Mandiri',$nowDate,'deposit');
	$deposit_ovo = berlangganan_bayar($userId,'OVO',$nowDate,'deposit');

	if($deposit_cash!='0' || $deposit_bni!='0' || $deposit_bri!='0' || $deposit_bca!='0' || $deposit_mandiri!='0' || $deposit_ovo!='0' ) {
		$no_produk_penjualan = $no_produk_penjualan1.'21';
		mysqli_query($con, "INSERT INTO penjualan_kasir VALUES ('$userId','cash','deposit','$jam','$deposit_cash','$jam','$no_produk_penjualan')");
		$no_produk_penjualan = $no_produk_penjualan1.'22';
		mysqli_query($con, "INSERT INTO penjualan_kasir VALUES ('$userId','bni','deposit','$jam','$deposit_bni','$jam','$no_produk_penjualan')");
		$no_produk_penjualan = $no_produk_penjualan1.'23';
		mysqli_query($con, "INSERT INTO penjualan_kasir VALUES ('$userId','bri','deposit','$jam','$deposit_bri','$jam','$no_produk_penjualan')");
		$no_produk_penjualan = $no_produk_penjualan1.'24';
		mysqli_query($con, "INSERT INTO penjualan_kasir VALUES ('$userId','bca','deposit','$jam','$deposit_bca','$jam','$no_produk_penjualan')");
		$no_produk_penjualan = $no_produk_penjualan1.'25';
		mysqli_query($con, "INSERT INTO penjualan_kasir VALUES ('$userId','mandiri','deposit','$jam','$deposit_mandiri','$jam','$no_produk_penjualan')");
		$no_produk_penjualan = $no_produk_penjualan1.'26';
		mysqli_query($con, "INSERT INTO penjualan_kasir VALUES ('$userId','ovo','deposit','$jam','$deposit_ovo','$jam','$no_produk_penjualan')");
	}

	$member_cash = berlangganan_bayar($userId,'Cash',$nowDate,'membership');
	$member_bni = berlangganan_bayar($userId,'BNI',$nowDate,'membership');
	$member_bri = berlangganan_bayar($userId,'BRI',$nowDate,'membership');
	$member_bca = berlangganan_bayar($userId,'BCA',$nowDate,'membership');
	$member_mandiri = berlangganan_bayar($userId,'Mandiri',$nowDate,'membership');
	$member_ovo = berlangganan_bayar($userId,'OVO',$nowDate,'membership');

	if($member_cash!='0' || $member_bni!='0' || $member_bri!='0' || $member_bca!='0' || $member_mandiri!='0' || $member_ovo!='0' ) {
		$no_produk_penjualan = $no_produk_penjualan1.'31';
		mysqli_query($con, "INSERT INTO penjualan_kasir VALUES ('$userId','cash','membership','$jam','$member_cash','$jam','$no_produk_penjualan')");
		$no_produk_penjualan = $no_produk_penjualan1.'32';
		mysqli_query($con, "INSERT INTO penjualan_kasir VALUES ('$userId','bni','membership','$jam','$member_bni','$jam','$no_produk_penjualan')");
		$no_produk_penjualan = $no_produk_penjualan1.'33';
		mysqli_query($con, "INSERT INTO penjualan_kasir VALUES ('$userId','bri','membership','$jam','$member_bri','$jam','$no_produk_penjualan')");
		$no_produk_penjualan = $no_produk_penjualan1.'34';
		mysqli_query($con, "INSERT INTO penjualan_kasir VALUES ('$userId','bca','membership','$jam','$member_bca','$jam','$no_produk_penjualan')");
		$no_produk_penjualan = $no_produk_penjualan1.'35';
		mysqli_query($con, "INSERT INTO penjualan_kasir VALUES ('$userId','mandiri','membership','$jam','$member_mandiri','$jam','$no_produk_penjualan')");
		$no_produk_penjualan = $no_produk_penjualan1.'36';
		mysqli_query($con, "INSERT INTO penjualan_kasir VALUES ('$userId','ovo','membership','$jam','$member_ovo','$jam','$no_produk_penjualan')");		
	}

	$laundry_cash = order_bayar($userId,'Cash',$nowDate);
	$laundry_bni = order_bayar($userId,'BNI',$nowDate);
	$laundry_bri = order_bayar($userId,'BRI',$nowDate);
	$laundry_bca = order_bayar($userId,'BCA',$nowDate);
	$laundry_mandiri = order_bayar($userId,'Mandiri',$nowDate);
	$laundry_ovo = order_bayar($userId,'OVO',$nowDate);
	$laundry_kuota = order_bayar($userId,'Kuota',$nowDate);
	$laundry_cashback = order_bayar($userId,'Cashback',$nowDate);
	$laundry_piutang = belum_lunas($userId,$nowDate);

	if($laundry_cash!='0' || $laundry_bni!='0' || $laundry_bri!='0' || $laundry_bca!='0' || $laundry_mandiri!='0' || $laundry_ovo!='0' || $laundry_kuota!='0' || $laundry_cashback!='0' || $laundry_piutang!='0') {
		$no_produk_penjualan = $no_produk_penjualan1.'11';
		mysqli_query($con, "INSERT INTO penjualan_kasir VALUES ('$userId','cash','laundry','$jam','$laundry_cash','$jam','$no_produk_penjualan')");
		$no_produk_penjualan = $no_produk_penjualan1.'12';
		mysqli_query($con, "INSERT INTO penjualan_kasir VALUES ('$userId','bni','laundry','$jam','$laundry_bni','$jam','$no_produk_penjualan')");
		$no_produk_penjualan = $no_produk_penjualan1.'13';
		mysqli_query($con, "INSERT INTO penjualan_kasir VALUES ('$userId','bri','laundry','$jam','$laundry_bri','$jam','$no_produk_penjualan')");
		$no_produk_penjualan = $no_produk_penjualan1.'14';
		mysqli_query($con, "INSERT INTO penjualan_kasir VALUES ('$userId','bca','laundry','$jam','$laundry_bca','$jam','$no_produk_penjualan')");
		$no_produk_penjualan = $no_produk_penjualan1.'15';
		mysqli_query($con, "INSERT INTO penjualan_kasir VALUES ('$userId','mandiri','laundry','$jam','$laundry_mandiri','$jam','$no_produk_penjualan')");
		$no_produk_penjualan = $no_produk_penjualan1.'16';
		mysqli_query($con, "INSERT INTO penjualan_kasir VALUES ('$userId','ovo','laundry','$jam','$laundry_ovo','$jam','$no_produk_penjualan')");	
		$no_produk_penjualan = $no_produk_penjualan1.'17';	
		mysqli_query($con, "INSERT INTO penjualan_kasir VALUES ('$userId','kuota','laundry','$jam','$laundry_kuota','$jam','$no_produk_penjualan')");
		$no_produk_penjualan = $no_produk_penjualan1.'18';		
		mysqli_query($con, "INSERT INTO penjualan_kasir VALUES ('$userId','cashback','laundry','$jam','$laundry_cashback','$jam','$no_produk_penjualan')");		
		$no_produk_penjualan = $no_produk_penjualan1.'19';	
		mysqli_query($con, "INSERT INTO penjualan_kasir VALUES ('$userId','piutang','laundry','$jam','$laundry_piutang','$jam','$no_produk_penjualan')");
	}

	mysqli_query($con, "DELETE FROM penjualan_kasir WHERE jumlah='0'");

}


// Nomor Penjualan Produk
// 20181201000111
// Tahun.bulan.tanggal.userId.id





?>