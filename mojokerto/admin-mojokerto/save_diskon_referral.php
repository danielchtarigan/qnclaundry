<?php
include '../../config.php';
session_start();
	$diskon=$_GET['diskon'];
	$sql = mysqli_query($con, "UPDATE settings SET value='$diskon' WHERE name='diskon_referral_mojokerto'");
?>
<script type="text/javascript">
 location.href="index.php?menu=referral";
</script>
