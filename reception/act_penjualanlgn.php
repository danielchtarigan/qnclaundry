<?php 
include '../config.php';
include "../send_sms.php";


session_start();

$us = $_SESSION['user_id'];
$ot = $_SESSION['nama_outlet'];

$tagihan_kiloan = $_GET['totalk'];
$tagihan_potongan = $_GET['totalp'];
$kuota_kiloan = $_GET['kuotak'];
$kuota_potongan = $_GET['kuotap'];
$id = $_GET['id_cs'];

$total = (8800*$tagihan_kiloan+$tagihan_potongan);
$allkuota = (8800*$kuota_kiloan+$kuota_potongan)-$total;
$nofaktur = $_GET['no_faktur'];


$qcarabayar = mysqli_query($con, "SELECT SUM(jumlah) AS jumlah FROM cara_bayar WHERE no_faktur='$nofaktur'");
$jumbayar = mysqli_fetch_row($qcarabayar)[0];

if($jumbayar<$total){

$querydelivery = mysqli_query($con,"UPDATE delivery SET no_faktur='$nofaktur' WHERE id_customer='$id' AND no_faktur IS NULL AND jenis_permintaan='Antar' ORDER BY tgl_input DESC LIMIT 1");

mysqli_query($con, "update langganan set all_kuota='$allkuota', kilo_cks='$_GET[sisakuotak]', potongan='$_GET[sisakuotap]' where id_customer='$id' ");

date_default_timezone_set('Asia/Makassar');
$jam = date("Y-m-d H:i:s");

if(($kuota_kiloan>0 || $kuota_potongan>0) && $_GET['cash']>0 ){
	$carabayar = "kuota, cash";
	$bkuota = $total-$_GET['cash'];
	mysqli_query($con, "insert into cara_bayar values ('', '$nofaktur', 'Kuota', '$bkuota', '$us', '$ot', '$jam','','','')");
	mysqli_query($con, "insert into cara_bayar values ('', '$nofaktur', 'Cash', '$_GET[cash]', '$us', '$ot', '$jam','','','')");	
	}
else if(($kuota_kiloan>0 || $kuota_potongan>0) && $_GET['cash']>0 ){
	$carabayar = "kuota, cash";
	$bkuota = $total-$_GET['cash'];
	mysqli_query($con, "insert into cara_bayar values ('', '$nofaktur', 'Kuota', '$bkuota', '$us', '$ot', '$jam','','','')");
	mysqli_query($con, "insert into cara_bayar values ('', '$nofaktur', 'Cash', '$_GET[cash]', '$us', '$ot', '$jam','','','')");	
	}
else if(($kuota_kiloan>0 || $kuota_potongan>0) && $_GET['nilaiedc']>0){
	$carabayar = "kuota, ".$_GET['bankedc'];
	$bkuota = $total-$_GET['nilaiedc'];
	mysqli_query($con, "insert into cara_bayar values ('', '$nofaktur', 'Kuota', '$bkuota', '$us', '$ot', '$jam','','','')");
	mysqli_query($con, "insert into cara_bayar values ('', '$nofaktur', '$_GET[bankedc]', '$_GET[nilaiedc]', '$us', '$ot', '$jam','','','')");	
	}
else if($_GET['cash']>0 && $_GET['nilaiedc']>0){
	$carabayar = "cash, ".$_GET['bankedc'];
	mysqli_query($con, "insert into cara_bayar values ('', '$nofaktur', 'Cash', '0', '$us', '$ot', '$jam','','','')");
	mysqli_query($con, "insert into cara_bayar values ('', '$nofaktur', '$_GET[bankedc]', '$_GET[nilaiedc]', '$us', '$ot', '$jam','','','')");	
	}
else if ($kuota_kiloan>0 || $kuota_potongan>0){
	$carabayar = "kuota";
	mysqli_query($con, "insert into cara_bayar values ('', '$nofaktur', 'Kuota', '$total', '$us', '$ot', '$jam','','','')");
	}
else if ($kuota_kiloan>0 && $kuota_potongan>0){
	$carabayar = "kuota";
	mysqli_query($con, "insert into cara_bayar values ('', '$nofaktur', 'Kuota', '$total', '$us', '$ot', '$jam','','','')");
	}
else if($_GET['cash']>0){
	$carabayar = "cash";
	mysqli_query($con, "insert into cara_bayar values ('', '$nofaktur', 'Cash', '$_GET[cash]', '$us', '$ot', '$jam','','','')");	
	}
else if($_GET['nilaiedc']>0){
	$carabayar = $_GET['bankedc'];
	mysqli_query($con, "insert into cara_bayar values ('', '$nofaktur', '$_GET[bankedc]', '$_GET[nilaiedc]', '$us', '$ot', '$jam','','','')");	
	}





$qrecep = mysqli_query($con, "select * from reception where id_customer='$id' and lunas='0'");
$referralvoucher = false;
while ($rrecep = mysqli_fetch_array($qrecep)){
	mysqli_query($con,"update reception set lunas='1',tgl_lunas='$jam',no_faktur='$nofaktur',rcp_lunas='$us',cara_bayar='$carabayar' WHERE no_nota = '$rrecep[no_nota]'");

	mysqli_query($con,"insert into rincian_faktur (no_nota,jumlah,no_faktur,id_customer) values ('$rrecep[no_nota]' ,'$rrecep[total_bayar]','$nofaktur','$id')");
		if (!$referralvoucher) {
			$referralquery = mysqli_query($con, "SELECT keterangan FROM detail_penjualan WHERE item LIKE 'Voucher Referral%' AND no_nota='$rrecep[no_nota]'");
			if (mysqli_num_rows($referralquery) > 0) {
				$referraldata = mysqli_fetch_array($referralquery);
				$customerquery = mysqli_query($con, "SELECT id,kode_terpakai FROM customer WHERE kode_referral='$referraldata[keterangan]' OR kode_referral_baru='$referraldata[keterangan]'");
				$customerdata = mysqli_fetch_array($customerquery);
				if ($customerdata['id']==$id) {
					$diskonterpakaiquery = mysqli_query($con,"UPDATE customer SET diskon_terpakai=1 WHERE id='$id'");
				} else {
					$referrerquery = mysqli_query($con,"UPDATE customer SET referrer='$referraldata[keterangan]' WHERE id='$id'");
					if ($customerdata['kode_terpakai']==false) $kodeterpakaiquery = mysqli_query($con, "UPDATE customer SET kode_terpakai=1 WHERE id='$customerdata[id]'");
				}
				$referralvoucher = true;
			}
		}
	}
	
$sql_rcp = mysqli_query($con, "SELECT * FROM reception WHERE no_faktur='$nofaktur' ORDER BY tgl_input ASC LIMIT 1");
$rcps = mysqli_fetch_assoc($sql_rcp);
$tgl_order = date('Y-m-d', strtotime($rcps['tgl_input']));
$rcp_order = $rcps['nama_reception'];
$tambahan_bayar = mysqli_query($con, "UPDATE cara_bayar SET tgl_order='$tgl_order',rcp_order='$rcp_order',outlet_order='$rcps[nama_outlet]' WHERE no_faktur='$nofaktur'");

$qretail = mysqli_query($con, "select sum(total) as total_retail from detail_retail where no_faktur = '$nofaktur'");
$rretail = mysqli_fetch_array($qretail);
mysqli_query($con,"insert into rincian_faktur (no_nota,jumlah,no_faktur,id_customer) values ('Retail' ,'$rretail[total_retail]','$nofaktur','$id')");
$tambah = mysqli_query($con,"insert into faktur_penjualan(no_faktur,nama_outlet,rcp,tgl_transaksi,total,cara_bayar,id_customer,jenis_transaksi,no_faktur_urut) VALUES('$nofaktur','$ot','$us','$jam','$total','$carabayar','$id','ritel','$nofaktur')");
mysqli_query($con,"update detail_retail set lunas='1' where no_faktur='$nofaktur'");

$qcus = mysqli_query($con, "select * from customer where id='$id'");
$rcus = mysqli_fetch_array($qcus);

/* make and/or send referral code */
if ($rcus['kode_referral_baru']==null) {
  	$nameletters = strtoupper(preg_replace("/[^a-zA-Z\s]+/", "", $rcus['nama_customer']));
		$namearray = explode(" ",$nameletters);
		$name = $nameletters;
		if (count($namearray)>1) {
			$last = count($namearray)-1;
			if (strlen($namearray[$last])<3) {
				$name = $namearray[$last-1].$namearray[$last];
			}
			else $name = $namearray[$last];
		}
		$subnama = substr($name,0,4);
		// if ($rcus['no_telp']!=null) $subtelp = substr(str_replace(".","",$rcus['no_telp']),-3);
		// else $subtelp = rand(0,9);
		$loopkode = true;
		while ($loopkode) {
			$koderef = $subnama.rand(0,9).rand(0,9).rand(0,9);
			$cekduplikat = mysqli_query($con, "SELECT id FROM customer WHERE kode_referral_baru='$koderef'");
			if (mysqli_num_rows($cekduplikat)==0) {
				$addkoderefquery = mysqli_query($con, "UPDATE customer SET kode_referral_baru='$koderef' WHERE id='$id'");
				$rcus['kode_referral_baru'] = $koderef;
				$loopkode = false;
			}
		}
}
$updatenilaidiskonquery = mysqli_query($con, "UPDATE customer SET nilai_diskon=(SELECT value FROM settings WHERE name='diskon_referral') WHERE id='$id'");

$outlets = explode(";",mysqli_fetch_array(mysqli_query($con,"SELECT value FROM settings WHERE name='outlet_referral'"))[0]);
if (in_array($ot,$outlets) && $rcus['diskon_terpakai']==false) {
	$referralsmsquery = mysqli_query($con, "SELECT value FROM settings WHERE name='sms_referral'");
	$referralsms = mysqli_fetch_array($referralsmsquery)[0];
	$referralsms = str_replace("[KODE]",$rcus['kode_referral_baru'],$referralsms);
	$diskonreferralquery = mysqli_query($con, "SELECT value FROM settings WHERE name='diskon_referral'");
	$diskonreferral = mysqli_fetch_array($diskonreferralquery)[0];
	$referralsms = str_replace("[DISKON]",$diskonreferral,$referralsms);
	$destination = $rcus['no_telp'];
	// sendSMS($destination,$referralsms);
	

}



} else {
	echo 'Gagal';
} 
?>

<script type="text/javascript">
 location.href="index.php?id=<?php echo $_GET['id_cs']; ?>";
</script>

