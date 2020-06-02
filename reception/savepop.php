<?php
session_start();
include '../config.php';
include '../auth.php';
$key = $_POST['key100'];
$code = $_POST['code100'];
date_default_timezone_set('Asia/Makassar');
$ot = $_SESSION['nama_outlet'];
$tgl = date('Y-m-d H:i:s');
$user = $_SESSION['user_id'];
if ($code==md5("QnC".$key."QnC") and isset($user)){
$sql = mysqli_query($con, "insert into ping values ('','$ot','$tgl','YA','$user')");

?>
<script type="text/javascript">
 location.href="index.php?menu=customer";
</script>
<?php
} else {
?>
<script type="text/javascript">
 history.back();
</script>
<?php
} 
?>