<?php 
include '../../config.php';
date_default_timezone_set('Asia/Makassar');
$pesan = $_POST['konten'];
$jam = $_POST['jam_sms'];
$hariini = date('l');

mysqli_query($con, "UPDATE siap_sms SET konten='$pesan' WHERE sent='0'");

?>

<script type="text/javascript">
	alert('SMS berhasil masuk diantrian');
	location.href="../index.php?menu=SMS-Blast";
</script>