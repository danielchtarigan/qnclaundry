<?php 
include 'config.php';
include 'send_sms.php';

date_default_timezone_set('Asia/Makassar');
$date = date('Y-m-d H:i:s');
$newDate = date('Y-m-d H:i:s', strtotime('+7 days', strtotime($date)));

$query = mysqli_query($con, "SELECT id_customer FROM member_mahasiswa WHERE status='aktif' AND kuota<3 AND berakhir<'$date' ORDER BY berakhir ASC LIMIT 1");
$counts = mysqli_num_rows($query); 
if($counts>0){
	$data = mysqli_fetch_row($query);
	$id = $data[0];
	echo $id;
	$query = mysqli_query($con, "UPDATE member_mahasiswa SET kuota='6', berakhir='$newDate' WHERE id_customer='$id'");

	$smsUpd = mysqli_query($con, "SELECT value FROM settings WHERE name='update_kuota_mahasiswa'");
	$updateSms = mysqli_fetch_row($smsUpd)[0];

	$customers = mysqli_query($con, "SELECT telp FROM member_mahasiswa WHERE id_customer='$id'");
	$telp = mysqli_fetch_row($customers)[0];

	sendSMS($telp,$updateSms);

	?>
	<script type="text/javascript">
		location.href="update_member_mahasiswa.php";
	</script>
	<?php
} else{
	?>
	<script type="text/javascript">
		location.href="index.php";
	</script>
	<?php
}
	

?>