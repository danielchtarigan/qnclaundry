<?php 
include '../config.php';
session_start();
		$userId = mysqli_real_escape_string($con,$_POST['user_id']);
	$data = mysqli_fetch_array(mysqli_query($con,"select * from user where name='".$userId."' and level='admin'"));
	if($data !== false && $data['password'] == md5($_POST['password'])){
		//login berhasil
			$_SESSION['admin'] = $data['name'];
 echo '<font color="red">suksese</font>';
    }
	else {
	 echo '<font color="red">Error, Data Sudah Ada</font>';
	 }


?>
