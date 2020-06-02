<?php 
include '../../config.php';
session_start();

if(isset($_GET['order'])){
	$query = mysqli_query($con, "SELECT * FROM reception WHERE no_nota='$_GET[order]'");
	$data = mysqli_fetch_assoc($query);

	$movevoid = mysqli_query($con, "UPDATE order_batal SET verifikasi='$_SESSION[user_id]' WHERE no_order='$_GET[order]'");	

}


?>

<script type="text/javascript">
	location.href="index.php?menu=void_dan_reject";
</script>