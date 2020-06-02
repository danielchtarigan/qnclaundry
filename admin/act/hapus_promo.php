<?php
session_start();
include '../../config.php';
include '../../auth.php';
$qhapus = mysqli_query($con, "delete from kode_promo where kode='$_GET[kode]'");
?>
<script type="text/javascript">
 location.href="../index.php?menu=promo";
</script>