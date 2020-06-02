<?php
include '../../config.php';
session_start();
	$sms=$_GET['sms'];
	mysqli_query($con,"delete from sms_kembali");
	mysqli_query($con,"insert into sms_kembali values ('','$sms')");
?>
<script type="text/javascript">
 location.href="../index.php";
</script>