<?php
include '../../config.php';
	$smsreferral=$_GET['sms_referral'];
	$sql = mysqli_query($con, "UPDATE settings SET value='$smsreferral' WHERE name='sms_referral_mojokerto'");
?>
<script type="text/javascript">
 location.href="index.php?menu=referral";
</script>
