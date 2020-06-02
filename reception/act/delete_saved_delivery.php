<?php
include '../../config.php';
mysqli_query($con,"DELETE FROM delivery WHERE id='$_GET[id]'");
?>

<script type="text/javascript">
 location.href="../data_delivery.php";
</script>
