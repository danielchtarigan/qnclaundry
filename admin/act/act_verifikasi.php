<?php
session_start();
include '../../config.php';
include '../../auth.php';
$user_id= $_SESSION['user_id'];
$id = $_GET['id'];
	$qhapus = mysqli_query($con, "update setoran_bank set verifikasi='Terverifikasi', op_verifikasi='$user_id' where id='$id'");
?>
<script type="text/javascript">
 location.href="../index.php";
</script>