<?php 
include '../../config.php';
session_start();
$user = $_SESSION['user_id'];


mysqli_query($con, "INSERT INTO catatan_order_terlambat (no_order,catatan,user) VALUES ('$_GET[order]','$_GET[cat]','$user')");




?>
<script type="text/javascript">
	location.href="terlambat.php";
</script>
