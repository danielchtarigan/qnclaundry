<?php
include '../../config.php';
session_start();
if (isset($_POST['d15'])){
	if (isset($_POST['kode'])){
	$kode=$_POST['kode'];
	$tgl_mulai=$_POST['tgl_mulai'];
	$tgl_selesai=$_POST['tgl_selesai'];
	$sms=$_POST['sms'];
	$target=$_POST['target'];
	$telp=$_POST['telp'];
	mysqli_query($con,"delete from sms_customer where kode='$kode'");
	mysqli_query($con,"insert into sms_customer values ('$kode','$tgl_mulai','$tgl_selesai','$sms', '$target', '$telp')");
	}
	else{
	$tgl_mulai=$_POST['tgl_mulai'];
	$tgl_selesai=$_POST['tgl_selesai'];
	$sms=$_POST['sms'];
	$target=$_POST['target'];
	$telp=$_POST['telp'];
	mysqli_query($con,"insert into sms_customer values ('','$tgl_mulai','$tgl_selesai','$sms', '$target', '$telp')");
	}
}
?>
<script type="text/javascript">
 location.href="../index.php?menu=sms";
</script>