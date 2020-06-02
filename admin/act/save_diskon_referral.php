<?php
include '../../config.php';
session_start();
	$diskon=$_GET['diskon'];
	mysqli_query($con,"UPDATE settings SET value='$diskon' WHERE name='diskon_referral'");
?>
<script type="text/javascript">
 location.href="../index.php?menu=referral";
</script>
