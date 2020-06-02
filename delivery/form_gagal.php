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

	$query = "SELECT nama_customer, alamat, jenis_permintaan, no_telp, no_faktur FROM delivery WHERE id=$id_delivery";
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
	<title>QnC Laundry - Form Pengantaran Cucian</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../font-awesome-4.1.0/css/font-awesome.min.css">
	<link href="css/sidenav.css" rel="stylesheet" type="text/css">
	<script src="../js/jquery-1.11.0.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src='js/sidenav.js'></script>
	<style>
		canvas {
			border: 1px solid black;
		}
		.alasanlain{
			display: none;
		}
		.alert-error{
			color: red;
			font-size: 14px;
		}
		.alert-success{
			color: green;
			font-size: 14px;	
		}
	</style>
	<script>
		function showPosition(position){
			alert('success get location from browser');
			$('#latitude').val(position.coords.latitude);
			$('#longitude').val(position.coords.longitude);
			$('#error-field').html("<div class='alert-error'></div>");
			$('#success-location').html("<div class='alert-success'>Info lokasi berhasil diambil</div>");
		}
		function showError(error){
			alert('Cannot get location from your browser. Please allow to use your current location or enable location setting for your browser.');
			$('#error-field').html("<div class='alert-error'>"+"Api geolocation error"+"</div>");
			location.reload();
		}
		function requestPosition(){
			var geo_options = {
				enableHighAccuracy: true,
				timeout: 5000
			}
			if(navigator.geolocation){
				navigator.geolocation.getCurrentPosition(showPosition, showError, geo_options);
			} else {
				alert('Geoloction is not enabled in your browser');
			}
		}
		var apiLocation = function() {
			jQuery.post(
				"https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyDA_-SJEINLHiF4aIlTCQH4UVM4o-Unbm0", 
				function(success) {
					alert('success get location from google api');
					$('#latitude').val(success.location.lat);
					$('#longitude').val(success.location.lng);
					$('#error-field').html("<div class='alert-error'></div>");
					$('#success-location').html("<div class='alert-success'>Info lokasi berhasil diambil</div>");
				}).fail(function(err) {
					$('#error-field').html("<div class='alert-error'>"+"Api geolocation error"+"</div>");
				});
		};
		function checkField() {
			var errorMessage = [];
			if($('#namapelanggan').val() == '') {
				errorMessage.push("Nama pelanggan harus diisi!");
			}
			if($('#alamat').val() == '') {
				errorMessage.push("Alamat harus diisi!");	
			}
			if($('#notelepon').val() == '') {
				errorMessage.push("Nama telepon pelanggan harus diisi!");
			}
			if($('#pilihanalasan').val() == '') {
				errorMessage.push("Alasan harus diisi!");
			} else {
				if($('#pilihanalasan').val() == 'alasan4' && $('#alasan').val() == '') {
					errorMessage.push("Alasan harus diisi!");
				}
			}
			if($('#namapenerima').val() == '') {
				errorMessage.push("Nama penerima harus diisi!");
			}
			if($('#latitude').val() == '' || $('#longitude').val() == '') {
				errorMessage.push("Share Location harus diaktifkan!");
			}
			return errorMessage;
		}
		function submitAction(){
			var errorMessage = checkField();
			if(errorMessage.length != 0){
				var textError = "";
				for(var i = 0; i < errorMessage.length; ++i){
					textError += "<div class='alert-error'>";
					textError += errorMessage[i];
					textError += "</div>\n";
				}
				$('#error-field').html(textError);
				$('#confirm-submit').modal('hide');
			} else {
				$('#form_submit').submit();
			}
		}
		function changeSelectReason(){
			var reason = $('#pilihanalasan').val();
			if (reason == 'alasan4'){
				$('.alasanlain').css('display','block');
			} else {
				$('.alasanlain').css('display','none');
			}
		}
	</script>
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
		<div id="delivery" class="tab-pane fade in active main" align="center" onclick="openNav(false);">
			<?php
				if($jenis == 'antar'){
			?>
				<h2>Form Pengantaran Gagal</h2>
			<?php
				} else {
			?>
				<h2>Form Penjemputan Gagal</h2>
			<?php
				}
			?>
			<div id='error-field'></div>
			<?php 
				if($error){
					$messagelength = count($error_message);
					for($i = 0; $i < $messagelength; $i++){
			?>
			<div class="alert-error"><?php echo $error_message[$i] ?></div>
			<?php			
					}
				}
			?>
			<form action="p_antarjemput.php" method="post" id="form_submit">
				<div class="form-group row">
					<label class="control-label col-xs-12 col-md-3" for="namapelanggan">Nama Pelanggan</label>
					<div class="col-xs-12 col-md-7">
						<input type="text" autocomplete="off" class="form-control" name="namapelanggan" id="namapelanggan" value="<?=$data['nama_customer']?>" required readonly="readonly"/>
					</div>
				</div>
				<div class="form-group row">
					<label class="control-label col-xs-12 col-md-3" for="alamat">Alamat</label>
					<div class="col-xs-12 col-md-7" align="left">
						<textarea class="form-control" name="alamat" id="alamat" required><?=$data['alamat']?></textarea>
					</div>
				</div>
				<div class="form-group row">
					<label class="control-label col-xs-12 col-md-3" for="notelepon">Nomor Telepon</label>
					<div class="col-xs-12 col-md-7">
						<input type="text" autocomplete="off" class="form-control" name="notelepon" id="notelepon" value="<?=$data['no_telp']?>" required/>
					</div>
				</div>
				<div class="form-group row">
					<label class="control-label col-xs-12 col-md-3" for="pilihanalasan">Alasan Gagal</label>
					<div class="col-xs-12 col-md-7">
						<select class="form-control" name="pilihanalasan" id="pilihanalasan" onchange="changeSelectReason()" required>
							<option value="">--</option>
							<option value="alasan1">Alamat tidak ditemukan walau customer sudah dihubungi</option>
							<option value="alasan2">Pelanggan tidak dapat dihubungi</option>
							<option value="alasan3">Pelanggan tidak ada di rumah</option>
							<option value="alasan4">Alasan lain</option>
						</select>
					</div>
				</div>
				<div class="form-group row alasanlain">
					<label class="control-label col-xs-12 col-md-3" for="alasan">Alasan</label>
					<div class="col-xs-12 col-md-7" align="left">
						<textarea class="form-control" name="alasan" id="alasan" required></textarea>
					</div>
				</div>
				<input type="hidden" id="jenis_permintaan" name="jenis_permintaan" value="<?=$jenis?>" />
				<input type="hidden" id="id_delivery" name="id_delivery" value="<?=$id_delivery?>"/>
				<input type="hidden" id="no_faktur" name="no_faktur" value="<?=$data['no_faktur']?>" />
				<input type="hidden" id="latitude" name="latitude" value=""/>
				<input type="hidden" id="longitude" name="longitude" value=""/>
				<input type="hidden" id="jenis" name="jenis" value="gagal"/>
				<div id='success-location'></div>
				<div class="form-group row">
					<div class="col-xs-12 col-md-offset-3 col-md-9 text-left">
						<input class="btn btn-primary col-xs-offset-3 col-xs-6 col-md-offset-0 col-md-3 requestlocation" type="button" name="requestlocation" value="Request Location" onclick="requestPosition();"/>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-xs-12 col-md-offset-3 col-md-9 text-left">
						<input class="btn btn-primary col-xs-offset-4 col-xs-4 col-md-offset-0 col-md-3" id="submitBtn" type="button" name="btn" value="Submit" data-toggle="modal" data-target="#confirm-submit" />
					</div>
				</div>
			</form>
			<div class="modal fade" id="confirm-submit">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-body">
							<?php
								if($jenis == 'antar'){
							?>
								Apakah anda yakin gagal mengantarkan cucian tersebut?
							<?php
								} else {
							?>
								Apakah anda yakin gagal menjemput cucian tersebut?
							<?php
								}
							?>
							<br><br>
							<div class="text-center">
								<button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Batal</button>
								<button type="button" class="btn btn-lg btn-success" onclick="submitAction()">Yakin</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>