<?php
include "../../../config.php";
include "../../../send_sms.php";
session_start();

function rupiah($angka)
{
	$jadi = "Rp.".number_format($angka,0,',','.');
	return $jadi;
}
$us             = $_SESSION['name'];
$ot             = $_SESSION['nama_outlet'];
$id_cs = $_GET['id_cs'];
$total = $_GET['total'];
$sisakuota = $_GET['sisakuota'];
$ot = $_SESSION['nama_outlet'];

/*
if (isset($_GET['voucher'])){
	$voucher=$_GET['voucher'];
}
else{
	$voucher='';
}
*/
include 'code.php';


$query = "SELECT max(no_faktur) AS last FROM faktur_penjualan  WHERE nama_outlet='$ot' LIMIT 1";
$hasil = mysqli_query($con,$query);
$k  = mysqli_fetch_array($hasil);
$no_urut = $k['last'];

$lastNoUrut =(int)substr($no_urut, 5, 6);
$lastNoUrut1 = $lastNoUrut+1;

$no_faktur = "F".$char1.sprintf('%06s', $lastNoUrut1);
$nofaktur=$no_faktur;

date_default_timezone_set('Asia/Jakarta');
$jam = date("Y-m-d H:i:s");


if (($_GET['bankedc']<>"") and ($_GET['cash']<>"0")){
	$carabayar = $_GET['bankedc'].", cash";
	mysqli_query($con, "insert into cara_bayar values ('', '$nofaktur', 'Cash', '$_GET[cash]', '$us', '$ot', '$jam')");
	mysqli_query($con, "insert into cara_bayar values ('', '$nofaktur', '$_GET[bankedc]', '$_GET[nilaiedc]', '$us', '$ot', '$jam')");
	}
else if ($_GET['bankedc']<>""){
	$carabayar = $_GET['bankedc'];
	mysqli_query($con,"insert into cara_bayar values ('', '$nofaktur', '$_GET[bankedc]', '$_GET[nilaiedc]', '$us', '$ot', '$jam')");
	}
else if (($_GET['bankedc']<>"") and ($_GET['cash']<>"0")){
	$carabayar = $_GET['bankedc'].", cash";
	$query = mysqli_query($con,"insert into cara_bayar values ('', '$nofaktur', 'Cash', '$_GET[cash]', '$us', '$ot', '$jam')");
	mysqli_query($con,"insert into cara_bayar values ('', '$nofaktur', '$_GET[bankedc]', '$_GET[nilaiedc]', '$us', '$ot', '$jam')");
	}
else if ($_GET['cash']<>"0"){
	$carabayar = "cash";
	mysqli_query($con,"insert into cara_bayar values ('', '$nofaktur', 'Cash', '$_GET[cash]', '$us', '$ot', '$jam')");
	}
else if ($_GET['bankedc']<>""){
	$carabayar = $_GET['bankedc'];
	mysqli_query($con,"insert into cara_bayar values ('', '$nofaktur', '$_GET[bankedc]', '$_GET[nilaiedc]', '$us', '$ot', '$jam')");
	}
else if ($_GET['cash']<>"0"){
	 $carabayar = "cash";
 	 mysqli_query($con,"insert into cara_bayar values ('', '$nofaktur', 'Cash', '$_GET[cash]', '$us', '$ot', '$jam')");
	}
else if ($_GET['kuota']<>"0"){
	 $carabayar = "kuota";
 	 mysqli_query($con,"insert into cara_bayar values ('', '$nofaktur', 'Kuota', '$_GET[cash]', '$us', '$ot', '$jam')");
	}

$qrecep = mysqli_query($con, "select * from reception where id_customer='$id_cs' and lunas='0'");
$referralvoucher = false;
while ($rrecep = mysqli_fetch_array($qrecep)){
	mysqli_query($con,"update reception set lunas='1',tgl_lunas='$jam',no_faktur='$nofaktur',rcp_lunas='$us',cara_bayar='$carabayar' WHERE no_nota = '$rrecep[no_nota]'");

	mysqli_query($con,"insert into rincian_faktur (no_nota,jumlah,no_faktur,id_customer) values ('$rrecep[no_nota]' ,'$rrecep[total_bayar]','$nofaktur','$id_cs')");
		if (!$referralvoucher) {
			$referralquery = mysqli_query($con, "SELECT keterangan FROM detail_penjualan WHERE item LIKE 'Voucher Referral%' AND no_nota='$rrecep[no_nota]'");
			if (mysqli_num_rows($referralquery) > 0) {
				$referraldata = mysqli_fetch_array($referralquery);
				$customerquery = mysqli_query($con, "SELECT id,kode_terpakai FROM customer WHERE kode_referral='$referraldata[keterangan]' OR kode_referral_baru='$referraldata[keterangan]'");
				$customerdata = mysqli_fetch_array($customerquery);
				if ($customerdata['id']==$id_cs) {
					$diskonterpakaiquery = mysqli_query($con,"UPDATE customer SET diskon_terpakai=1 WHERE id='$id_cs'");
				} else {
					$referrerquery = mysqli_query($con,"UPDATE customer SET referrer='$referraldata[keterangan]' WHERE id='$id_cs'");
					if ($customerdata['kode_terpakai']==false) $kodeterpakaiquery = mysqli_query($con, "UPDATE customer SET kode_terpakai=1 WHERE id='$customerdata[id]'");
				}
				$referralvoucher = true;
			}
		}
	}

$qretail = mysqli_query($con, "select sum(total) as total_retail from detail_retail where no_faktur = '$nofaktur'");
$rretail = mysqli_fetch_array($qretail);

	mysqli_query($con,"insert into rincian_faktur (no_nota,jumlah,no_faktur,id_customer) values ('Retail' ,'$rretail[total_retail]','$nofaktur','$id_cs')");


$tambah           = mysqli_query($con,"insert into faktur_penjualan(no_faktur,nama_outlet,rcp,tgl_transaksi,total,cara_bayar,id_customer,jenis_transaksi,no_faktur_urut) VALUES('$nofaktur','$ot','$us','$jam','$total','$carabayar','$id_cs','ritel','$nofaktur')");


	mysqli_query($con,"update detail_retail set lunas='1' where no_faktur='$nofaktur'");


$qcus = mysqli_query($con, "select * from customer where id='$id_cs'");
$rcus = mysqli_fetch_array($qcus);

$sisa = $total % 25000;
$jum = $total-$sisa;
$poin = $jum / 25000;
$poinbaru = $rcus['poin']+$poin;

$qcus = mysqli_query($con, "update customer set poin='$poinbaru' where id='$id_cs'");


$carilgn = mysqli_query($con, "select * from customer where id='$id_cs'");
$rlgn = mysqli_fetch_array($carilgn);
if ($rlgn['lgn']=='1'){
	$qq = mysqli_query($con, "update customer set sisa_kuota='$sisakuota' where id='$id_cs'");
	}

if ($poin>2){
$vr = mysqli_query($con, "select * from voucher_lucky where jenis_voucher='VR' and id_customer='' and aktif='0' order by no_voucher limit 0,2");
while ($rvr = mysqli_fetch_array($vr)){
 mysqli_query($con, "update voucher_lucky set aktif='1', id_customer='$id_cs' where no_voucher='$rvr[no_voucher]'");
 mysqli_query($con,"insert into voucher_expired (voucher,expired,user,outlet) VALUES('$rvr[no_voucher]',NOW() + INTERVAL 3 MONTH,'$us','$ot')");
}
}
else{
$vr = mysqli_query($con, "select * from voucher_lucky where jenis_voucher='VR' and id_customer='' and aktif='0' order by no_voucher limit 0,1");
while ($rvr = mysqli_fetch_array($vr)){
 mysqli_query($con,"update voucher_lucky set aktif='1', id_customer='$id_cs' where no_voucher='$rvr[no_voucher]'");
 mysqli_query($con,"insert into voucher_expired (voucher,expired,user,outlet) VALUES('$rvr[no_voucher]',NOW() + INTERVAL 3 MONTH,'$us','$ot')");
}
}


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
				$addkoderefquery = mysqli_query($con, "UPDATE customer SET kode_referral_baru='$koderef' WHERE id='$id_cs'");
				$rcus['kode_referral_baru'] = $koderef;
				$loopkode = false;
			}
		}
}
$updatenilaidiskonquery = mysqli_query($con, "UPDATE customer SET nilai_diskon=(SELECT value FROM settings WHERE name='diskon_referral') WHERE id='$id_cs'");

$outlets = explode(";",mysqli_fetch_array(mysqli_query($con,"SELECT value FROM settings WHERE name='outlet_referral'"))[0]);
if (in_array($ot,$outlets) && $rcus['diskon_terpakai']==false) {
	$referralsmsquery = mysqli_query($con, "SELECT value FROM settings WHERE name='sms_referral'");
	$referralsms = mysqli_fetch_array($referralsmsquery)[0];
	$referralsms = str_replace("[KODE]",$rcus['kode_referral_baru'],$referralsms);
	$diskonreferralquery = mysqli_query($con, "SELECT value FROM settings WHERE name='diskon_referral'");
	$diskonreferral = mysqli_fetch_array($diskonreferralquery)[0];
	$referralsms = str_replace("[DISKON]",$diskonreferral,$referralsms);
	$destination = $rcus['no_telp'];
	sendSMS($destination,$referralsms);
}

?>
<script type="text/javascript">
 location.href="transaksi.php?id=<?php echo $_GET['id_cs']; ?>";
</script>
