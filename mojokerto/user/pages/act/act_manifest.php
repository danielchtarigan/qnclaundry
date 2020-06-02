<?php

if (isset($_POST['man']) and $_POST['man']=="terima") {
//manifest terima
$jumlah=$_POST['jumlah'];
$nota=$_POST['nota'];//no nota
$driver=$_POST['driver'];
$serah=$_POST['kd_serah'];
$penerima=$_SESSION['user_id'];
date_default_timezone_set('Asia/Makassar');
$waktu = date("Y-m-d H:i:s");
$query2 = "SELECT kode FROM outlet WHERE nama_outlet='$ot'";
$hasil2 = mysqli_query($con,$query2);
$data2  = mysqli_fetch_array($hasil2);
$kd = $data2['kode'];
$kode = 'MTO'.$kd;
$query = "SELECT * FROM man_terima WHERE kode_terima like '%$kode%' order by kode_terima desc LIMIT 0,1";
$hasil = mysqli_query($con,$query);
if ($hasil) {
	$data  = mysqli_fetch_array($hasil);
	$lastNoTerima = $data['kode_terima'];
	$lastNoUrut = (int)substr($lastNoTerima, 6, 6);
} else $lastNoUrut=0;

// baca nomor urut manifest_terima dari kode terakhir
// nomor urut ditambah 1
$nextNoUrut1 = $lastNoUrut + 1;
$kode_terima = $kode.sprintf('%06s', $nextNoUrut1);
$q=mysqli_query($con,"insert into man_terima value ('$kode_terima', '$waktu', '$penerima', '$driver', $jumlah,3,'$ot')");
$kd_serah = explode(" ",$serah);
  	foreach($kd_serah as $key => $value){
  	$q=mysqli_query($con,"UPDATE man_serah SET kode_terima='$kode_terima' WHERE kode_serah='$value'");
  }
$messagequery = mysqli_query($con, "SELECT value FROM settings WHERE name='sms_cucian_selesai'");
$messagetemplate = mysqli_fetch_array($messagequery)[0];
$no_nota = explode(" ",$nota);
	foreach($no_nota as $key => $value){
  	$q=mysqli_query($con,"UPDATE manifest SET kd_terima3='$kode_terima' WHERE no_nota='$value'");
	$qwk = mysqli_query($con, "update reception set kembali=1, tgl_kembali='$waktu', reception_kembali='$penerima' where no_nota='$value'");
	if ($ot!='Toddopuli' && $ot !='DAYA') {
		$qnota = mysqli_query($con,"SELECT sms_sent,no_faktur,no_telp FROM reception INNER JOIN customer ON reception.id_customer = customer.id WHERE no_nota='$value'");
		$rnota = mysqli_fetch_assoc($qnota);
		if ($rnota['sms_sent']==0) {
			$no_faktur = $rnota['no_faktur'];
			$telp = $rnota['no_telp'];
			$qfaktur = mysqli_query($con,"SELECT COUNT(id) FROM reception WHERE no_faktur='$no_faktur' AND (kembali=0 OR packing=0)");
			$notdone = mysqli_fetch_array($qfaktur)[0];
			if ($notdone==0) {
				$currtime = (int)date('Gi');
				$message = str_replace("[NO_FAKTUR]",$no_faktur,$messagetemplate);
				if ($currtime >= 900 && $currtime <= 2100) {
					sendSMS($telp,$message);
				} else {
					$antresmsquery = mysqli_query($con, "INSERT INTO antrean_sms VALUES ('$telp','$message')");
				}
				$qsmssent = mysqli_query($con,"UPDATE reception SET sms_sent=1 WHERE no_faktur='$no_faktur'");
			}
		}
	}
}
?>
<script type="text/javascript">
 location.href="index.php?menu=mterima";
</script>
<?php
}

//======================================== manifest serah
else if (isset($_POST['man']) and $_POST['man']=="serah"){
$driver=$_POST['driver'];
$jumlah=$_POST['jumlah'];
$type=$_POST['type']; //no nota
$pemberi=$_SESSION['user_id'];
$tempat=$ot;
date_default_timezone_set('Asia/Makassar');
$waktu = date("Y-m-d H:i:s");
$query2 = "SELECT * FROM outlet WHERE nama_outlet='$tempat'";
$hasil2 = mysqli_query($con,$query2);
$data2  = mysqli_fetch_array($hasil2);
$kd = $data2['kode'];
$kode = 'MSW'.$kd;
$query = "SELECT * FROM man_serah WHERE kode_serah like '%$kode%' order by kode_serah desc LIMIT 0,1";
$hasil = mysqli_query($con,$query);
if ($hasil) {
	$data  = mysqli_fetch_array($hasil);
	$lastNoTransaksi = $data['kode_serah'];
	$lastNoUrut = (int)substr($lastNoTransaksi, 6, 6);
} else $lastNoUrut=0;

// baca nomor urut manifest_serah dari kode terakhir
// nomor urut ditambah 1
$nextNoUrut1 = $lastNoUrut + 1;
$kode_serah = $kode.sprintf('%06s', $nextNoUrut1);
$q=mysqli_query($con,"insert into man_serah value ('$kode_serah', '$waktu', '$pemberi', '$driver', $jumlah,'',1,'$tempat')");

$no_nota = explode(" ",$type);
  	foreach($no_nota as $key => $value){
  	$q=mysqli_query($con,"UPDATE manifest SET kd_serah='$kode_serah' WHERE no_nota='$value'");
  }
?>
<script type="text/javascript">
//window.open('https://www.google.co.id','CNN_WindowName');
//window.open('cetak_manifest.php?kode=<?=$kode_serah;?>','CNN_WindowName');
//windowObjectReference = window.open("cetak_manifest.php?kode=<?=$kode_serah;?>", "CNN_WindowName", strWindowFeatures);
 location.href="index.php?menu=dmserah";
</script>
<?php }

function sendSMS($phone,$message) {
  $userkey="tuut04fxu5a790op59wjqkk6du";
  $passkey="0xy367ndp35qrym8gr8s";
  $url = "http://qnc.zenziva.com/api/sendsms.php";
  $curlHandle = curl_init();
  curl_setopt($curlHandle, CURLOPT_URL, $url);
  curl_setopt($curlHandle, CURLOPT_POSTFIELDS, 'userkey='.$userkey.'&passkey='.$passkey.'&tipe=reguler&nohp='.$phone.'&pesan='.urlencode($message));
  curl_setopt($curlHandle, CURLOPT_HEADER, 0);
  curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
  curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
  curl_setopt($curlHandle, CURLOPT_POST, 1);
  if (!$result = curl_exec($curlHandle)) {
    trigger_error(curl_error($curlHandle));
  }
  curl_close($curlHandle);
}
?>
