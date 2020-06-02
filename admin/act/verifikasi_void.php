<?php
session_start();
include '../../config.php';
include '../../auth.php';
$user_id= $_SESSION['user_id'];
$id = $_GET['id'];
	$qhapus = mysqli_query($con, "update nota_void set status=1, user_verifikasi='$user_id' where id='$id'");
?>
<script type="text/javascript">
 location.href="../report_void.php";
</script>