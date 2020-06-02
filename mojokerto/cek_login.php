<?php
include '../config.php';
session_start();
	$userId = mysqli_real_escape_string($con,$_POST['user_id']);
	$outlet = 'mojokerto';
	$data = mysqli_fetch_array(mysqli_query($con,"select * from user where name='".$userId."'"));
	if($data !== false && $data['password'] == md5($_POST['password'])){
		//login berhasil
		$_SESSION['level'] = $data['level'];
		$_SESSION['name'] = $data['name'];
		$_SESSION['nama_outlet']='mojokerto';
		$_SESSION['my_user_agent'] = md5($_SERVER['HTTP_USER_AGENT']);
		if ($_SESSION['level'] == "admin"){
		header("location: user/index.html");
		}
		else if ($_SESSION['level'] == "reception"){
		header("location: user/index.html");	
		}
		else if ($_SESSION['level'] == "setrika"){
		header("location: user/index.html");
		}
		else if ($_SESSION['level'] == "packer"){
		header("location: user/index.html");
		}
	}else{
		echo "ID User atau password salah!";
		header("location: index.php");
	}

?>


