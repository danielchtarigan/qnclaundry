<?php 
include '../../../config.php';
session_start();
date_default_timezone_set('Asia/Jakarta');
$ot='mojokerto';
$query1 = "SELECT max(no_coc) AS last FROM reception WHERE nama_outlet='$ot'";
$hasil = mysqli_query($con,$query1);
$datano  = mysqli_fetch_array($hasil);
$lastNoTransaksi = $datano['last'];
// baca nomor urut transaksi dari id transaksi terakhir
//PCDW000001
$lastNoUrut = (int)substr($lastNoTransaksi, 5, 6);
// nomor urut ditambah 1
$nextNoUrut = $lastNoUrut + 1;

$char = "CCMJK";

// membuat format nomor transaksi berikutnya
$nextNoTransaksi = $char.sprintf('%06s', $nextNoUrut); 


$no_nota=$_POST['no_nota'];
$jumlah1=$_POST['jumlah1'];
$ket1=$_POST['ket1'];
$us=$_SESSION['name'];
$jam=date("Y-m-d H:i:s");
$harga=$_POST['harga'];
$jenis=$_POST['jenis'];

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

	$q=mysqli_query($con,"insert into packing (tgl_packing,user_packing,no_nota,jumlah,ket,harga,jenis,no_coc) VALUES('$jam','$us','$no_nota','$jumlah1','$ket1','$harga','$jenis','$nextNoTransaksi')");
	 $query="update reception set packing='1',tgl_packing='$jam',user_packing='$us',no_coc='$nextNoTransaksi' WHERE no_nota = '$no_nota'";
	 $hasil=mysqli_query($con,$query);
	 if($query){
	 	include"../../../reception/bar128.php";

	 	$edit = mysqli_query($con,"SELECT nama_customer,no_faktur,id,id_customer,nama_outlet,sms_sent FROM reception WHERE no_nota='$no_nota'");
    	$r    = mysqli_fetch_array($edit);
    	$id_cs=$r['id_customer'];
    	$cs=mysqli_query($con,"SELECT * FROM customer WHERE id='$id_cs'");
    	$q    = mysqli_fetch_array($cs);
		if ($r['sms_sent']==0) {
			$no_faktur = $r['no_faktur'];
			$telp = $q['no_telp'];
			$qfaktur = mysqli_query($con,"SELECT COUNT(id) FROM reception WHERE no_faktur='$no_faktur' AND packing=0");
			$notdone = mysqli_fetch_array($qfaktur)[0];
			if ($notdone==0) {
				$messagequery = mysqli_query($con, "SELECT value FROM settings WHERE name='sms_selesai_mojokerto'");
				$messagetemplate = mysqli_fetch_array($messagequery)[0];
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
	 	?>
<div align="center" style="font-family: Arial;font-size: 12px"  class="style1 style4">Checkout Control</div>
<div style="font-size: 30px; font-family: Arial" >
<?php echo ($r['nama_outlet'])?></div>
<div style="font-family: Arial" >
<?php
echo 'Nama : '.$q['nama_customer'].'<br>';
echo 'Alamat : '.$q['alamat'].'<br>';
echo 'No Telp : '.$q['no_telp'].'<br>';

?>
</div><br /><br />
<div align="center"><?php echo bar128(stripslashes($no_nota))?></div>
<br />
<div style="font-family: Arial" >
<?php echo "Tgl $jam<br />" ?>
<?php echo "Quality Control : $us" ?>
</div>
<?php
    }else
    {
        echo "ERROR";
    }
	 


?>
