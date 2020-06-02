<?php
session_start();
include '../../config.php';
include '../../auth.php';
$id = $_GET['id'];
$rcpt = $_GET['rcp'];
$nilai = $_GET['nilai'];
$keterangan = $_GET['keterangan'];
$user_id = $_SESSION['user_id'];
	$qhapus = mysqli_query($con, "insert into penyesuaian values ('', '$id','$rcpt','$nilai','$keterangan','$user_id')");
?>
<script type="text/javascript">
 location.href="../index.php";
</script>