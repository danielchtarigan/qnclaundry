<?php
	session_start();
	include '../config.php';
	if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
	    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	    header('Location: ' . $redirect);
	    exit();
	}
	$error = false;

	$user_id = $_SESSION['user_id'];
	$workshop = $_SESSION['workshop'];

	if (isset($_SESSION['level'])) {
		if($_SESSION['level'] == "delivery"){

		} else if($_SESSION['level'] == "operator") {
			header('location:../operator/index.php');
		} else if($_SESSION['level'] == "reception") {
			header('location:../reception/index.php');
		} else if($_SESSION['level'] == "packer") {
			header('location:../packer/index.php');
		}
	}
	if (!isset($_session['user_id']) && !isset($_SESSION['level']) && !isset($_SESSION['nama_outlet'])) {
		header('location:../index.php');
	}
	
	$id_delivery = $_GET['id']; //get id from delivery/index.php
	if (isset($_POST['error'])){
		$json_response = json_decode($_POST['message']);
		$error = true;
		$error_message = $json_response->message;
	}

	date_default_timezone_set('Asia/Makassar');
	$tgl = date('Y-m-d');

	$query = "SELECT nama_customer, alamat, jenis_permintaan, no_telp, no_faktur, kode_promo FROM delivery WHERE id=$id_delivery";
	$result = mysqli_query($con, $query);
	$data = mysqli_fetch_array($result);
	$jenis = strtolower($data['jenis_permintaan']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>QnC Laundry - Form Cucian</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../font-awesome-4.1.0/css/font-awesome.min.css">
	<link href="css/sidenav.css" rel="stylesheet" type="text/css">
	<script src="../js/jquery-1.11.0.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="js/sketch.js"></script>
	<script src='js/sidenav.js'></script>
	<style>
		canvas {
			border: 1px solid black;
		}
		.alert-error{
			color: red;
			font-size: 14px;
		}
		form .alert-success{
			color: green;
			font-size: 14px;
			background-color: white;
			margin-top: 0px;
			padding-top: 0px;
			top: 0;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="http://www.qnclaundry.com" class="navbar-brand navbar-center" >QnC Laundry</a>
                <a class="navbar-brand navbar-button" onclick="openNav(true);">&#9776;</a>
            </div>
        </div>
    </nav>
	<div class="container">
		<div id="mySidenav" class="nav nav-tabs sidenav">
			<a href="index.php#taken-antar" class="active">Taken (Antar)</a>
			<a href="index.php#taken-jemput">Taken (Jemput)</a>
			<a href="index.php#open-antar">Open (Antar)</a>
			<a href="index.php#open-jemput">Open (Jemput)</a>
			<a href="../logout.php">Logout</a>
		</div>

</body>
</html>