<?php 
include '../../config.php';
session_start();
$user = $_SESSION['user_id'];

if($_SESSION['subagen']<>''){
	$scab = $_SESSION['subagen'];
} else {
	$scab = 'Delivery';
}
date_default_timezone_set('Asia/Makassar');
$nowDate = date('Y-m-d H:i:s');


$idcst = $_GET['id'];
$reception = $_SESSION['user_id'];
$total = $_GET['total_tagihan'];

$outlets = mysqli_query($con, "SELECT nama_outlet FROM reception WHERE id_customer='$idcst' AND lunas=false AND cara_bayar='' ORDER BY id ASC");
$outlet = mysqli_fetch_row($outlets)[0];

include '../code_order.php';

$jenis = "ritel";

$cekbayar = mysqli_query($con, "SELECT * FROM reception WHERE id_customer='$idcst' AND lunas=false AND cara_bayar=''");
$terbayar = mysqli_num_rows($cekbayar);


if($terbayar=='0') {
	echo "Error";
} else {
	if($_GET['bayar_cash']<>0 && $_GET['diskon']<>0){
		$carabayar = "Cash, Voucher";
		$voucher = strtoupper($_GET['voucher']);
		mysqli_query($con, "INSERT INTO cara_bayar (no_faktur,cara_bayar,jumlah,resepsionis,outlet,tanggal_input) VALUES ('$no_faktur','Cash','$_GET[bayar_cash]','$reception','$outlet','$nowDate')");
		mysqli_query($con, "INSERT INTO cara_bayar (no_faktur,cara_bayar,jumlah,resepsionis,outlet,tanggal_input) VALUES ('$no_faktur','$voucher','$_GET[diskon]','$reception','$outlet','$nowDate')");

	}
	else if($_GET['bayar_cash']<>0 && $_GET['bayar_edc']<>0){
		$carabayar = "Cash,".$_GET['edc'];
		mysqli_query($con, "INSERT INTO cara_bayar (no_faktur,cara_bayar,jumlah,resepsionis,outlet,tanggal_input) VALUES ('$no_faktur','Cash','$_GET[bayar_cash]','$reception','$outlet','$nowDate')");
		mysqli_query($con, "INSERT INTO cara_bayar (no_faktur,cara_bayar,jumlah,resepsionis,outlet,tanggal_input) VALUES ('$no_faktur','$_GET[edc]','$_GET[bayar_edc]','$reception','$outlet','$nowDate')");

	} 
	else if($_GET['bayar_cash']<>0 && $_GET['kuota']<>0) {
		$carabayar = "cash, kuota";
		mysqli_query($con, "INSERT INTO cara_bayar (no_faktur,cara_bayar,jumlah,resepsionis,outlet,tanggal_input) VALUES ('$no_faktur','Cash','$_GET[bayar_cash]','$reception','$outlet','$nowDate')");
		mysqli_query($con, "INSERT INTO cara_bayar (no_faktur,cara_bayar,jumlah,resepsionis,outlet,tanggal_input) VALUES ('$no_faktur','Kuota','$_GET[kuota]','$reception','$outlet','$nowDate')");

	} 
	else if($_GET['bayar_edc']<>0 && $_GET['diskon']<>0){
		$carabayar = "Cash, Voucher";
		$voucher = strtoupper($_GET['voucher']);
		mysqli_query($con, "INSERT INTO cara_bayar (no_faktur,cara_bayar,jumlah,resepsionis,outlet,tanggal_input) VALUES ('$no_faktur','$_GET[edc]','$_GET[bayar_edc]','$reception','$outlet','$nowDate')");
		mysqli_query($con, "INSERT INTO cara_bayar (no_faktur,cara_bayar,jumlah,resepsionis,outlet,tanggal_input) VALUES ('$no_faktur','$voucher','$_GET[diskon]','$reception','$outlet','$nowDate')");

	}
	else if($_GET['bayar_edc']<>0 && $_GET['kuota']<>0) {
		$carabayar = $_GET['edc'].", kuota";
		mysqli_query($con, "INSERT INTO cara_bayar (no_faktur,cara_bayar,jumlah,resepsionis,outlet,tanggal_input) VALUES ('$no_faktur','$_GET[edc]','$_GET[bayar_edc]','$reception','$outlet','$nowDate')");
		mysqli_query($con, "INSERT INTO cara_bayar (no_faktur,cara_bayar,jumlah,resepsionis,outlet,tanggal_input) VALUES ('$no_faktur','Kuota','$_GET[kuota]','$reception','$outlet','$nowDate')");

	} 
	else if($_GET['bayar_cash']<>0){
		$carabayar = "cash";
		mysqli_query($con, "INSERT INTO cara_bayar (no_faktur,cara_bayar,jumlah,resepsionis,outlet,tanggal_input) VALUES ('$no_faktur','Cash','$_GET[bayar_cash]','$reception','$outlet','$nowDate')");

	} 
	elseif($_GET['bayar_edc']<>0){
		$carabayar = $_GET['edc'];
		mysqli_query($con, "INSERT INTO cara_bayar (no_faktur,cara_bayar,jumlah,resepsionis,outlet,tanggal_input) VALUES ('$no_faktur','$_GET[edc]','$_GET[bayar_edc]','$reception','$outlet','$nowDate')");

	} 
	elseif($_GET['kuota']<>0){
		$carabayar = "kuota";
		mysqli_query($con, "INSERT INTO cara_bayar (no_faktur,cara_bayar,jumlah,resepsionis,outlet,tanggal_input) VALUES ('$no_faktur','Kuota','$_GET[kuota]','$reception','$outlet','$nowDate')");
	}


	if($_GET['diskon']>0) {	
		$voucher = $_GET['voucher'];
		$kode1 = mysqli_query($con, "SELECT * FROM kode_promo_new WHERE kode='$voucher' AND tgl_berakhir>='$nowDate' AND status='1' AND id_outlet='$_SESSION[outlet]' AND cabang='$_SESSION[cabang]'");
		$res1 = mysqli_fetch_assoc($kode1);
		$confirm1 = mysqli_num_rows($kode1);

		$kode2 = mysqli_query($con, "SELECT * FROM voucher_rupiah WHERE kode='$voucher' AND tgl_akhir>='$nowDate' AND status='Aktif'");
		$res2 = mysqli_fetch_assoc($kode2);
		$confirm2 = mysqli_num_rows($kode2);

		if($confirm1>0) {
			$using = $res1['penggunaan']+1;
			mysqli_query($con, "UPDATE kode_promo_new SET penggunaan='$using' WHERE kode='$voucher'");
		}
		else if($confirm2>0) {;
			mysqli_query($con, "UPDATE voucher_rupiah SET status='Terpakai',rcp='$reception' WHERE kode='$voucher'");
		}

	}

	mysqli_query($con, "INSERT INTO faktur_penjualan (no_faktur,no_faktur_urut,nama_outlet,rcp,tgl_transaksi,total,cara_bayar,id_customer,jenis_transaksi,sub_cabang) VALUES ('$no_faktur','$no_faktur','$outlet','$reception','$nowDate','$total','$carabayar','$idcst','$jenis','$scab')");

	mysqli_query($con, "UPDATE reception SET lunas='1',cara_bayar='$carabayar',rcp_lunas='$reception',tgl_lunas='$nowDate',no_faktur='$no_faktur' WHERE id_customer='$idcst' AND lunas='0' AND cara_bayar=''");


	$dataorder = mysqli_query($con, "SELECT * FROM reception WHERE no_faktur='$no_faktur' ORDER BY id DESC LIMIT 0,1");
	$rorder = mysqli_fetch_assoc($dataorder);
	$tgl_order = date('Y-m-d', strtotime($rorder['tgl_input']));
	$rcp_order = $rorder['nama_reception'];
	$outlet_order = $rorder['nama_outlet'];

	mysqli_query($con, "UPDATE cara_bayar SET tgl_order='$tgl_order',rcp_order='$rcp_order',outlet_order='$outlet_order' WHERE no_faktur='$no_faktur'");

	$kiloan = ($_GET['cks']*8800+$_GET['ss']*6400)/8800;
	$potongan = $_GET['kuota_potongan'];
	$allkuota = $potongan+$kiloan*8800;;

	$datalangganan = mysqli_query($con, "SELECT * FROM langganan WHERE id_customer='$idcst'");
	$rlgn = mysqli_fetch_assoc($datalangganan);
	$sisa_kiloan = $rlgn['kilo_cks'];
	$sisa_potongan = $rlgn['potongan'];
	$sisa_allkuota = $rlgn['all_kuota'];

	$nowkiloan = $sisa_kiloan-$kiloan;
	$nowpotongan = $sisa_potongan-$potongan;
	$nowallkuota = $sisa_allkuota-$allkuota;

	mysqli_query($con, "UPDATE langganan SET all_kuota='$nowallkuota',kilo_cks='$nowkiloan',potongan='$nowpotongan' WHERE id_customer='$idcst'");

	//tambahkan poin jika customer adalah membership

	$cstmember = mysqli_query($con, "SELECT * FROM customer WHERE id='$idcst' AND member='1'");
	if(mysqli_num_rows($cstmember)>0) {
		$rmember = mysqli_fetch_assoc($cstmember);
		if($total>25000) {
			$poin = $total/25000+$rmember['poin'];
			mysqli_query($con, "UPDATE customer SET poin='$poin' WHERE id='$idcst'");
		}
	}

	$sql2 = mysqli_query($con, "SELECT * FROM saldo_subagen WHERE subagen='$_SESSION[subagen]' ");
	$s = mysqli_fetch_assoc($sql2);

	$saldo = $s['saldo'];
	$bonus = $s['bonus'];

	if($bonus >= $_GET['bayar_cash']) {
		$bonus = $bonus-$_GET['bayar_cash'];
		mysqli_query($con, "UPDATE saldo_subagen SET bonus='$bonus' WHERE subagen='$_SESSION[subagen]'");

		mysqli_query($con, "UPDATE reception SET x='1' WHERE no_faktur='$no_faktur'");

	} else if(($bonus < $_GET['bayar_cash'])) {
		$endSaldo = $s['saldo']-$_GET['bayar_cash'];
		mysqli_query($con, "UPDATE saldo_subagen SET saldo='$endSaldo' WHERE subagen='$_SESSION[subagen]'");
	}

	$customers = mysqli_query($con, "SELECT * FROM customer WHERE id='$idcst'");
	$rcust = mysqli_fetch_assoc($customers);
	$nama = $rcust['nama_customer'];
	$no_telp = $rcust['no_telp'];
	$alamat = $rcust['alamat'];
	if($_SESSION['subagen']=='') {
		$tgl_permintaan = date('Y-m-d', strtotime('+3 days', strtotime($nowDate)));

		$delivery = mysqli_query($con, "INSERT INTO delivery (tgl_input,tgl_permintaan,waktu_permintaan,alamat,no_telp,id_customer,nama_customer,jenis_permintaan,no_faktur,status,nama_pengantar,gateway) VALUES ('$nowDate','$tgl_permintaan','Bebas','$alamat','$no_telp','$idcst','$nama','Antar','$no_faktur','Taken','$_SESSION[user_id]','Jemput')");
	}
	
}

$scab = ($scab=="GerrySuper") ? "Onta Lama" : $scab;

$ot = $scab;
$id_cs = $idcst;
$noFaktur = $no_faktur;
$tagihan = $total;

// Load Composer's autoloader mailer
require '../../../phpmailer/vendor/autoload.php';
require_once '../../messages_to_customer.php';

?>

<script type="text/javascript">
	alert("Transaksi Selesai");
	if(confirm("Ingin Mencetak Struk Pembayaran?")){
		window.open("struk/cetak_faktur.php?id="+no_faktur+"", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,width=840,height=300").focus();
		window.location = "";
	}
	else {
		window.location = "";
	}
</script>