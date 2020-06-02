<?php
include '../config.php';
if (isset($_GET['outlet']) and isset($_GET['ws'])) {
if ($_GET['ws']=='Daya'){
 mysqli_query($con, "update control set ws_setrika='Toddopuli' where nama_outlet='$_GET[outlet]'");
}
else{
 mysqli_query($con, "update control set ws_setrika='Daya' where nama_outlet='$_GET[outlet]'");
}
}
?>
<script type="text/javascript">
 location.href="index.php?menu=csetrika";
</script>