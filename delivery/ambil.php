<?php
session_start();
include '../config.php';
include 'auth.php';
include '../send_sms.php';


$user = $_SESSION['user_id'];
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$jenis = $_GET['jenis'];
	$qambil = mysqli_query($con,"UPDATE delivery SET nama_pengantar='$user',status='Taken' WHERE id='$id' AND (nama_pengantar IS NULL OR nama_pengantar='') AND DATEDIFF(NOW(),tgl_permintaan)>=-1");
	if ($qambil) {
		$qselect = mysqli_query($con,"SELECT no_telp, DATEDIFF(NOW(),tgl_permintaan) AS selisih FROM delivery WHERE id='$id'");
		$qsms = mysqli_query($con,"SELECT value FROM settings WHERE name='sms_siap_delivery'");
		$rselect = mysqli_fetch_assoc($qselect);
		$no_telp = $rselect["no_telp"];
		$sms = mysqli_fetch_array($qsms)[0];
		$sms = str_replace("[JENIS_PERMINTAAN]",strtolower($jenis),$sms);
		$sms = str_replace("[NAMA_PENGANTAR]",$user,$sms);
		if ($rselect["selisih"]<0) { //belum hari pengantaran
			$qantreansms = mysqli_query($con,"INSERT INTO antrean_sms VALUES ('$no_telp','$sms')");
		} else {
			sendSMS($no_telp,$sms);
		}
       
		?>
		<script type="text/javascript">
			alert("Pesanan berhasil diambil!");
			location.href="index.php#taken-<?= $jenis ?>";
		</script>
		<?php } else { ?>
		<script type="text/javascript">
		   alert("Pesanan gagal diambil!");
		   location.href="index.php#open-<?= $jenis ?>";
		</script>
	<?php }
}
