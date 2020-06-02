<?php
include '../../../config.php';
 $id = $_GET['id'];
 $qrincian = mysqli_query($con, "delete from detail_retail where id='$id'");  
?>
<script type="text/javascript">
 history.back();
</script>