<?php 
include '../../config.php';

if(isset($_GET['sms_aktivasi'])){
	$query = mysqli_query($con, "UPDATE settings SET value='$_GET[sms_aktivasi]' WHERE name='aktivasi_mahasiswa'");

	if($query){ ?>
		<script type="text/javascript">
			location.href="../mahasiswa.php";
		</script> <?php
	}

} else if(isset($_GET['sms_mingguan'])){
	$query = mysqli_query($con, "UPDATE settings SET value='$_GET[sms_mingguan]' WHERE name='update_kuota_mahasiswa'");

	if($query){ ?>
		<script type="text/javascript">
			location.href="../mahasiswa.php";
		</script> <?php
	}
}
?>