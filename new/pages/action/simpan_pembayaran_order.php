<?php 
include '../../config.php';
include '../zonawaktu.php';
include '../kode.php';

// Load Composer's autoloader mailer
// require '../../../../phpmailer/vendor/autoload.php';


$query = mysqli_query($con, "SELECT no_faktur_urut FROM faktur_penjualan WHERE nama_outlet='$_SESSION[outlet]' AND no_faktur_urut LIKE '$kode_faktur%' ORDER BY id DESC LIMIT 0,1");
$result = mysqli_fetch_row($query);

if(strlen($result[0]) == 10) {
	$lastfaktur = (int)substr($result[0], 4, 6)+1;
}
else {
	$lastfaktur = (int)substr($result[0], 10, 3)+1;
}

$no_faktur = $kode_faktur.sprintf('%03s', $lastfaktur);

$idcst = $_GET['id'];
$outlet = $_SESSION['outlet'];
$reception = $_SESSION['user_id'];
$total = $_GET['total_tagihan'];
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

	mysqli_query($con, "INSERT INTO faktur_penjualan (no_faktur,no_faktur_urut,nama_outlet,rcp,tgl_transaksi,total,cara_bayar,id_customer,jenis_transaksi) VALUES ('$no_faktur','$no_faktur','$outlet','$reception','$nowDate','$total','$carabayar','$idcst','$jenis')");

	mysqli_query($con, "UPDATE reception SET lunas='1',cara_bayar='$carabayar',rcp_lunas='$reception',tgl_lunas='$nowDate',no_faktur='$no_faktur' WHERE id_customer='$idcst' AND lunas='0' AND cara_bayar=''");


	$dataorder = mysqli_query($con, "SELECT * FROM reception WHERE no_faktur='$no_faktur' ORDER BY id DESC LIMIT 0,1");
	$rorder = mysqli_fetch_assoc($dataorder);
	$tgl_order = date('Y-m-d', strtotime($rorder['tgl_input']));
	$rcp_order = $rorder['nama_reception'];
	$outlet_order = $rorder['nama_outlet'];

	mysqli_query($con, "UPDATE cara_bayar SET tgl_order='$tgl_order',rcp_order='$rcp_order',outlet_order='$outlet_order' WHERE no_faktur='$no_faktur'");
    
    if($cabang=="Medan") {
        $kiloan = ($_GET['cks']*7000+$_GET['ss']*4000+$_GET['ckl']*5000)/7000;
    	$potongan = $_GET['kuota_potongan'];
    	$allkuota = $potongan+$kiloan*7000;

    } else {
        $kiloan = ($_GET['cks']*8800+$_GET['ss']*6400+$_GET['ckl']*7400)/8800;
    	$potongan = $_GET['kuota_potongan'];
    	$allkuota = $potongan+$kiloan*8800;
    }
    	
    	?>
    	<script type="text/javascript">
    		alert(<?= $kiloan ?>);
    	</script>

    	<?php

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
  

    $ot = $outlet ;
	$id_cs = $idcst;
	$noFaktur = $no_faktur;
	$tagihan = $total;
   
   	include '../../../messages_to_customer.php';

	?>
	<script>
	    var id = "<?php echo $idcst ?>";
	    alert("Pembayaran Order Berhasil!!");
	    location.href = "";
	</script>
	
	<?php

}


?>