<?php
include '../config.php';
session_start();
$user_id= $_SESSION['user_id'];
$workshop = $_SESSION['workshop'];

{

date_default_timezone_set('Asia/Makassar');
$tgl = date('Y-m-d H:i:s');{
mysqli_query($con,"insert into log_pulang (tgl,id_user,id_workshop) values ('$tgl', '$user_id','$workshop')");

}
//exit;
}
?>
<script type="text/javascript">
 alert("Sampai Jumpa"); 
 location.href="../../logout.php"
</script>