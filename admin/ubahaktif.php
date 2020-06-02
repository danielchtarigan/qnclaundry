<?php
include 'header.php';
include '../config.php';
if ($_GET['aktif']=='Ya'){
 mysqli_query($con, "update user set aktif='Tidak' where user_id='$_GET[user]'");
}
else{
 mysqli_query($con, "update user set aktif='Ya' where user_id='$_GET[user]'");
}
?>
<script type="text/javascript">
 history.back();
</script>