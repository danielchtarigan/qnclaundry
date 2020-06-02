<?php
session_start();
include '../../config.php';
include '../../auth.php';
$status = $_GET['status'];
if ($status=='Tidak Aktif'){
	$qhapus = mysqli_query($con, "update kode_promo set status='Aktif' where kode='$_GET[kode]'");
	}
else{
	$qhapus = mysqli_query($con, "update kode_promo set status='Tidak Aktif' where kode='$_GET[kode]'");
	}
?>
<script type="text/javascript">
 location.href="../index.php?menu=promo";
</script>