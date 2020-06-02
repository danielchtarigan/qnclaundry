<?php 
include '../../config.php';

date_default_timezone_set('Asia/Makassar');
$date = date('Y-m-d H:i:s');

if($_GET['denda']=='cucianTelat'){
	$sql = mysqli_query($con, "SELECT *FROM denda_cucian_telat WHERE no_nota='$_GET[no_nota]' ");
	if(mysqli_num_rows($sql)>0){?>
		<script type="text/javascript">
			alert("Sudah pernah didenda!");
			location.href="../terlambat.php";
		</script><?php
	}else{
		mysqli_query($con, "INSERT INTO denda_cucian_telat VALUES ('','$date','$_GET[no_nota]','$_GET[operator]','$_GET[packer]') ");?>
		<script type="text/javascript">
			location.href="../terlambat.php";
		</script><?php
	}
}
else if($_GET['denda']=='hilangkanData'){
	$sql = mysqli_query($con, "UPDATE reception SET kembali=1 WHERE no_nota='$_GET[no_nota]'");
	if($sql){?>
	<script type="text/javascript">
		location.href="../terlambat.php";
	</script><?php
	}
}




?>

