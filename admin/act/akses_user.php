<?php 
include '../../config.php';


if($_GET['akses']=='setrika'){
	$id = $_GET['id'];
	$akses = mysqli_query($con, "UPDATE user SET izinkan='setrika' WHERE user_id='$id'");

} elseif($_GET['akses']=='Remove'){
	$id = $_GET['id'];
	$akses = mysqli_query($con, "UPDATE user SET izinkan=NULL WHERE user_id='$id'");
}
?>

<script type="text/javascript">	
	location.href="../user.php";
</script>