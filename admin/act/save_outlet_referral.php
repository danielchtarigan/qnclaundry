<?php
include '../../config.php';
session_start();
	$outlets=$_GET['outlet'];
	$joinedoutlets = implode(";",$outlets);
	mysqli_query($con,"UPDATE settings SET value='$joinedoutlets' WHERE name='outlet_referral'");
?>
<script type="text/javascript">
 location.href="../index.php?menu=referral";
</script>
