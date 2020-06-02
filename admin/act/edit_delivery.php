<?php
include '../../config.php';
session_start();

if (isset($_POST['id'])) {
	$id = $_POST['id'];
	if (isset($_POST['delivery'])) {
		$delivery = $_POST['delivery'];
		$qedit = mysqli_query($con,"UPDATE delivery SET nama_pengantar='$delivery',status='Taken' WHERE id='$id'");
		$qselect = mysqli_query($con,"SELECT jenis_permintaan, no_telp, DATEDIFF(NOW(),tgl_permintaan) AS selisih FROM delivery WHERE id='$id'");
		$qsms = mysqli_query($con,"SELECT value FROM settings WHERE name='sms_siap_delivery'");
		$rselect = mysqli_fetch_assoc($qselect);
		$no_telp = $rselect["no_telp"];
		$sms = mysqli_fetch_array($qsms)[0];
		$sms = str_replace("[JENIS_PERMINTAAN]",strtolower($rselect["jenis_permintaan"]),$sms);
		$sms = str_replace("[NAMA_PENGANTAR]",$delivery,$sms);
		if ($rselect["selisih"]<0) { //belum hari pengantaran
			$qantreansms = mysqli_query($con,"INSERT INTO antrean_sms VALUES ('$no_telp','$sms')");
		} else {
			sendSMS($no_telp,$sms);
		}
	} else if (isset($_POST['tgl_permintaan'])) {
		$tgl_permintaan = $_POST['tgl_permintaan'];
		$no_faktur = $_POST['no_faktur'];
		$nama_customer = $_POST['nama_customer'];
		$no_telp = $_POST['no_telp'];
		$alamat = $_POST['alamat'];
		$catatan = $_POST['catatan'];
		$nama_pengantar = $_POST['nama_pengantar'];
		$waktu_permintaan = $_POST['waktu_permintaan'];
		$status = $_POST['status'];
		$qedit = mysqli_query($con,"UPDATE delivery SET tgl_permintaan=STR_TO_DATE('$tgl_permintaan','%d/%m/%Y'), no_faktur='$no_faktur', nama_customer='$nama_customer', no_telp='$no_telp', alamat='$alamat', catatan='$catatan', nama_pengantar='$nama_pengantar', waktu_permintaan='$waktu_permintaan', status=IF('$status'='Open' AND '$nama_pengantar'<>'','Taken',IF('$nama_pengantar'='','Open','$status')) WHERE id='$id'");
	}

	if ($qedit) {?>
	<script type="text/javascript">
		alert("Data berhasil diubah!");
	 location.href="../data_delivery.php";
	</script>
	<?php } else { ?>
	<script type="text/javascript">
	   alert("Data gagal diubah!");
	   location.href="../data_delivery.php";
	</script>
<?php }
}

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