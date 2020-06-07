<?php 
include '../../config.php';
session_start();
$us = $_SESSION['user_id'];
$ot = $_SESSION['nama_outlet'];

date_default_timezone_set('Asia/Makassar');
$jam = date("Y-m-d H:i:s");

$id_cs = $_POST['idcs'];
$noFaktur = $_POST['idFaktur'];
$tagihan = $_POST['tagihan'];
$cash = $_POST['nilaicash'];
$bni = $_POST['nilaibni'];
$bri = $_POST['nilaibri'];
$bca = $_POST['nilaibca'];
$mandiri = $_POST['nilaimandiri'];
$ovo = $_POST['nilaiovo'];
$cashback = $_POST['nilaicashb'];
$kuota = $_POST['nilaikuota'];

$jumlahMasuk = mysqli_fetch_array(mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) FROM cara_bayar WHERE no_faktur='$noFaktur'"))[0];
if($jumlahMasuk!=$tagihan){

	if($bni>0) {
		$carabayar = "BNI";
		$con->query("INSERT INTO cara_bayar VALUES ('', '$noFaktur', '$carabayar', '$bni', '$us', '$ot', '$jam','','','') ");
	}
	if($bri>0) {
		$carabayar = "BRI";
		$con->query("INSERT INTO cara_bayar VALUES ('', '$noFaktur', '$carabayar', '$bri', '$us', '$ot', '$jam','','','') ");
	}
	if($bca>0) {
		$carabayar = "BCA";
		$con->query("INSERT INTO cara_bayar VALUES ('', '$noFaktur', '$carabayar', '$bca', '$us', '$ot', '$jam','','','') ");
	}
	if($mandiri>0) {
		$carabayar = "Mandiri";
		$con->query("INSERT INTO cara_bayar VALUES ('', '$noFaktur', '$carabayar', '$mandiri', '$us', '$ot', '$jam','','','') ");
	}
	if($ovo>0) {
		$carabayar = "OVO";
		$con->query("INSERT INTO cara_bayar VALUES ('', '$noFaktur', '$carabayar', '$ovo', '$us', '$ot', '$jam','','','') ");
	}
	if($cash>0) {
		$carabayar = "Cash";
		$con->query("INSERT INTO cara_bayar VALUES ('', '$noFaktur', '$carabayar', '$cash', '$us', '$ot', '$jam','','','') ");
	}
	if($kuota>0) {
		$carabayar = "Kuota";
		$con->query("INSERT INTO cara_bayar VALUES ('', '$noFaktur', '$carabayar', '$kuota', '$us', '$ot', '$jam','','','') ");
	}
	if($cashback>0) {
		$carabayar = "Cashback";
		$kodevoucher = $_POST['kodevoucher2'];
		$con->query("INSERT INTO cara_bayar VALUES ('', '$noFaktur', '$carabayar', '$cashback', '$us', '$ot', '$jam','','','') ");
		$con->query("UPDATE voucher_rupiah set status='Terpakai', rcp='$us' where kode='$kodevoucher' "); 
	 	$con->query("UPDATE voucher_recovery set status='Terpakai', rcp='$us' where kode='$kodevoucher' "); 
	 	$con->query("INSERT into using_voucher values ('', '$jam', '$kodevoucher', '$cashback', '$noFaktur', '$id_cs') ");
	}

	if($cash>0 && $bni>0) {
		$carabayar = "Cash, BNI";
	}
	if($cash>0 && $bri>0) {
		$carabayar = "Cash, BRI";
	}
	if($cash>0 && $bca>0) {
		$carabayar = "Cash, BCA";
	}
	if($cash>0 && $mandiri>0) {
		$carabayar = "Cash, Mandiri";
	}
	if($cash>0 && $ovo>0) {
		$carabayar = "Cash, OVO";
	}
	if($cash>0 && $kuota>0) {
		$carabayar = "Cash, Kuota";
	}
	if($cash>0 && $cashback>0) {
		$carabayar = "Cash, Cashback";
	}

	if($kuota>0 && $bni>0) {
		$carabayar = "Kuota, BNI";
	}
	if($kuota>0 && $bri>0) {
		$carabayar = "Kuota, BRI";
	}
	if($kuota>0 && $bca>0) {
		$carabayar = "Kuota, BCA";
	}
	if($kuota>0 && $mandiri>0) {
		$carabayar = "Kuota, Mandiri";
	}
	if($kuota>0 && $ovo>0) {
		$carabayar = "Kuota, OVO";
	}
	if($kuota>0 && $cashback>0) {
		$carabayar = "Kuota, Cashback";
	}

	if($cashback>0 && $bni>0) {
		$carabayar = "Cashback, BNI";
	}
	if($cashback>0 && $bri>0) {
		$carabayar = "Cashback, BRI";
	}
	if($cashback>0 && $bca>0) {
		$carabayar = "Cashback, BCA";
	}
	if($cashback>0 && $mandiri>0) {
		$carabayar = "Cashback, Mandiri";
	}
	if($cashback>0 && $ovo>0) {
		$carabayar = "Cashback, OVO";
	}


}


	


$con->query("INSERT INTO faktur_penjualan (no_faktur,nama_outlet,rcp,tgl_transaksi,total,cara_bayar,id_customer,jenis_transaksi,no_faktur_urut) VALUES ('$noFaktur','$ot','$us','$jam','$tagihan','$carabayar','$id_cs','ritel','$noFaktur')");


// 1. Cash
// 2. EDC 
// 3. Kuota
// 4. Cashback


$qrecep = mysqli_query($con, "select * from reception where id_customer='$id_cs' and lunas='0'");
$referralvoucher = false;
while ($rrecep = mysqli_fetch_array($qrecep)){
	mysqli_query($con,"update reception set lunas='1',tgl_lunas='$jam',no_faktur='$noFaktur',rcp_lunas='$us',cara_bayar='$carabayar' WHERE no_nota = '$rrecep[no_nota]'");

	mysqli_query($con,"insert into rincian_faktur (no_nota,jumlah,no_faktur,id_customer) values ('$rrecep[no_nota]' ,'$rrecep[total_bayar]','$noFaktur','$id_cs')");
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
	
$sql_rcp = mysqli_query($con, "SELECT * FROM reception WHERE no_faktur='$noFaktur' ORDER BY tgl_input ASC LIMIT 1");
$rcps = mysqli_fetch_assoc($sql_rcp);
$tgl_order = date('Y-m-d', strtotime($rcps['tgl_input']));
$rcp_order = $rcps['nama_reception'];
$tambahan_bayar = mysqli_query($con, "UPDATE cara_bayar SET tgl_order='$tgl_order',rcp_order='$rcp_order',outlet_order='$rcps[nama_outlet]' WHERE no_faktur='$noFaktur'");

$querydelivery = mysqli_query($con,"UPDATE delivery SET no_faktur='$noFaktur' WHERE id_customer='$id_cs' AND no_faktur IS NULL AND jenis_permintaan='Antar' ORDER BY tgl_input DESC LIMIT 1");


/*==Belum dicek==*/

$qretail = mysqli_query($con, "select sum(total) as total_retail from detail_retail where no_faktur = '$noFaktur'");
$rretail = mysqli_fetch_array($qretail);

mysqli_query($con,"insert into rincian_faktur (no_nota,jumlah,no_faktur,id_customer) values ('Retail' ,'$rretail[total_retail]','$noFaktur','$id_cs')");


	mysqli_query($con,"UPDATE detail_retail set lunas='1' where no_faktur='$noFaktur'");


$qcus = mysqli_query($con, "select * from customer where id='$id_cs'");
$rcus = mysqli_fetch_array($qcus);


$sisa = $tagihan % 25000;
$jum = $tagihan-$sisa;
$poin = $jum / 25000;
$poinbaru = $rcus['poin']+$poin;


$carilgn = mysqli_query($con, "select * from customer where id='$id_cs'");
$rlgn = mysqli_fetch_array($carilgn);
if ($rlgn['lgn']=='1'){
	$lgnes = mysqli_query($con, "SELECT * FROM langganan WHERE id_customer='$id_cs'");
	$lgn = mysqli_fetch_array($lgnes);
	   
	$hargakonversi = round($lgn['harga_satuan']);
    $hargakonversiss = round($hargakonversi*0.7);
    $hargakonversickl = round($hargakonversi*0.6);
    $hargakonversick = round($hargakonversi*0.3);
	
	$kuotaK = $_POST['kuotacks']+($_POST['kuotass']*$hargakonversiss/$hargakonversi)+($_POST['kuotackl']*$hargakonversickl/$hargakonversi)+($_POST['kuotack']*$hargakonversick/$hargakonversi);
	$kuotakiloan = $lgn['kilo_cks']-floatval($kuotaK);
	$kuotapotongan = $lgn['potongan']-floatval($_POST['kuotaP']);
	$allkuota = $kuotakiloan*$hargakonversi+$kuotapotongan;


	$qq = mysqli_query($con, "UPDATE langganan set all_kuota='$allkuota', kilo_cks='$kuotakiloan', potongan='$kuotapotongan' where id_customer='$id_cs'");
}
if($rlgn['member']=='1'){
	$qcus = mysqli_query($con, "update customer set poin='$poinbaru' where id='$id_cs'");
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

// Load Composer's autoloader mailer
// require '../../../phpmailer/vendor/autoload.php';
require_once '../../messages_to_customer.php';

  
 ?>
<script type="text/javascript">
 location.href="../index.php?id=<?= $id_cs; ?>";
</script>

?>