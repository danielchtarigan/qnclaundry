<?php
include '../../config.php';
session_start();
	$smsantarsukses=$_GET['sms_antar_sukses'];
	mysqli_query($con,"UPDATE settings SET value='$smsantarsukses' WHERE name='sms_antar_sukses'");
	$smsjemputsukses=$_GET['sms_jemput_sukses'];
	mysqli_query($con,"UPDATE settings SET value='$smsjemputsukses' WHERE name='sms_jemput_sukses'");
	$smsantarjemputgagal=$_GET['sms_antarjemput_gagal'];
	mysqli_query($con,"UPDATE settings SET value='$smsantarjemputgagal' WHERE name='sms_antar_jemput_gagal'");
	$smscucianselesaidelivery=$_GET['sms_cucian_selesai_delivery'];
	mysqli_query($con,"UPDATE settings SET value='$smscucianselesaidelivery' WHERE name='sms_cucian_selesai_delivery'");
	$smscucianselesai=$_GET['sms_cucian_selesai'];
	mysqli_query($con,"UPDATE settings SET value='$smscucianselesai' WHERE name='sms_cucian_selesai'");
	$smsreferral=$_GET['sms_referral'];
	mysqli_query($con,"UPDATE settings SET value='$smsreferral' WHERE name='sms_referral'");
	$smsRemindDep=$_GET['sms_rd'];
	mysqli_query($con,"UPDATE settings SET value='$smsRemindDep' WHERE name='sms_reminder_deposit'");
?>
<script type="text/javascript">
 location.href="../index.php?menu=sms";
</script>
