<?php
include '../../../config.php';
session_start();

date_default_timezone_set('Asia/Jakarta');
$date = date("Y-m-d");
$ot = $_SESSION['nama_outlet'];

	$userId = mysqli_real_escape_string($con,$_POST['user']);	
	$data = mysqli_fetch_array(mysqli_query($con,"select * from user where name='".$userId."'"));
	if($data !== false && $data['password'] == md5($_POST['password'])){
		//login berhasil		
		
		$_SESSION['id'] = $data['user_id'];
		$_SESSION['level'] = $data['level'];		
		$_SESSION['user'] = $data['name'];	
		$_SESSION['nama_outlet'] = $ot;
		$_SESSION['my_user_agent'] = md5($_SERVER['HTTP_USER_AGENT']);
		if ($_SESSION['level'] == "admin"){
		header("location: ../../admin-mojokerto/index.php");
		}
	}
		if ($_SESSION['level'] !== "admin"){
		?>
		<script type="text/javascript">
		alert("Harus izin admin!");
		location.href='index.php';
		</script>
		<?php
		}			
		else {
		?>
		<script type="text/javascript">
		alert("Username dan Password Salah!");
		location.href='index.php';
		</script>
		<?php
		}
	
?>
