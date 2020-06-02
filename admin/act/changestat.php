<?php
include '../config.php';
if (isset($_GET['aktif']) and isset($_GET['park'])) {
if ($_GET['aktif']==1){
 mysqli_query($con, "update parkir set status=0 where id_park='$_GET[park]'");
}
else{
 mysqli_query($con, "update parkir set status=1 where id_park='$_GET[park]'");
}
}
?>
<script type="text/javascript">
 history.back();
</script>