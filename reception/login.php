<?php
include 'config.php';
session_start();
	$userId = mysqli_real_escape_string($con,$_POST['user_id']);
	$outlet = $_POST['nama_outlet'];
	$data = mysqli_fetch_array(mysqli_query($con,"select * from user where name='".$userId."'"));
	if($data !== false && $data['password'] == $_POST['password']){
		//login berhasil
		$_SESSION['id'] = $data['user_id'];
		$_SESSION['level'] = $data['level'];
		$_SESSION['user_id'] = $data['name'];
		$_SESSION['nama_outlet']=$outlet;
		$_SESSION['my_user_agent'] = md5($_SERVER['HTTP_USER_AGENT']);
		if ($_SESSION['level'] == "admin"){
		header("location: admin/index.php");
		}
		else if ($_SESSION['level'] == "reception"){
		header("location: reception/index.php");	
		}
		else if ($_SESSION['level'] == "operator"){
		header("location: operator/index.php");	
		}
		else if ($_SESSION['level'] == "packer"){
		header("location: packer/index.php");	
		}
	}else{
		echo "ID User atau password salah!";
		header("location: index.php");
	}
?>


