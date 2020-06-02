<?php 
include 'config.php';
$error_message = "";
$error = false;
if(isset($_POST['error'])){
	$json_response = json_decode($_POST['message']);
	$error = true;
	$error_jenis = $json_response->jenis;
	$error_message = $json_response->message;
}

$list_outlet = [];
$query_get_outlet = "SELECT nama_outlet FROM outlet";
$result = mysqli_query($con, $query_get_outlet);
while ($row = mysqli_fetch_row($result)) {
	array_push($list_outlet, $row[0]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>QnC Delivery</title>
	<meta name="viewport" content="initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="reception/css/datepicker.css">
	<link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<script src="lib/js/jquery.js"></script>
	<script src="lib/js/bootstrap.min.js"></script>
	<script src="reception/js/bootstrap-datepicker.js"></script>
	<style>
		.datepicker{z-index:1151;}
		.alert-noget,
		.alert-noget-recaptcha,
		.alert-error{
			color: red;
			font-size: 14px;
		}
		.nav-tabs>li>a {
			font-weight: bold;
			font-size: 13.5px;
			line-height: 3;
		}
		textarea.form-control{
			height: 80px;
		}
		.new-user{
			display: none;
		}
		.container {
			margin-top: 25px;
			margin-bottom: 25px;
		}
		@media(min-width:768px) {
			.container {
				width: 70%;
			}
			.nav-tabs>li>a {
				font-size: 20px;
			}
		}
	</style>
	<script>

		function cek(){
			if($("#info").val() == 'Teman'){
				$("#referensi").prop('readonly',false);
			}else{
				$("#referensi").val("");
				$("#referensi").prop('readonly',true);
			}
		}

		var date = new Date();
		var today = new Date(date.getFullYear(), date.getMonth(), date.getDate(), 0, 0, 0, 0);

		$(function(){
		    $("#tglantar,#tgljemput").datepicker({
				format:'dd/mm/yyyy',
				startDate: '+1d'
		    });
		});

		var focusToRecaptcha1 = true;
		var focusToRecaptcha2 = true;

		var onClickSubmit = function(clicked_id){
			if(clicked_id == "antar" && focusToRecaptcha1){
				$('#alert-g-recaptcha1').text('Please click on the reCaptcha box');
				return false;
			} else if(clicked_id == "jemput" && focusToRecaptcha2){
				$('#alert-g-recaptcha2').text('Please click on the reCaptcha box');
				return false;
			} else {
				return true;
			}
		}

		var enableAntarField = function(booldis){
			$("#namaantar").prop('disabled',!booldis);
			$("#nohpantar").prop('disabled',!booldis);
			$("#alamatantar").prop('disabled',!booldis);
			$("#tglantar").prop('disabled',!booldis);
			$("#waktuantar").prop('disabled',!booldis);
			$("#submitantar").prop('disabled',!booldis);
			$("#catatanantar").prop('disabled',!booldis);
			$("#namaantar").val("");
			$("#nohpantar").val("");
			$("#alamatantar").val("");
		}

		var enableJemputField = function(booldis){
			$("#namajemput").prop('disabled',!booldis);
			$("#outlet").prop('disabled',!booldis);
			$("#alamatjemput").prop('disabled',!booldis);
			$("#tgljemput").prop('disabled',!booldis);
			$("#waktujemput").prop('disabled',!booldis);
			$("#kodepromo").prop('disabled',!booldis);
			$("#submitjemput").prop('disabled',!booldis);
			$("#info").prop('disabled',!booldis);
			$("#referensi").prop('disabled',!booldis);
			$("#catatanjemput").prop('disabled',!booldis);
			$("#namajemput").val("");
			$("#outlet").val("--");
			$("#alamatjemput").val("");
		}

		$(document).ready(function(){
			var url = document.location.toString();
			if (url.match('#')) {
			    $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
			} else {
				$('.nav-tabs a[href="#delivery"]').tab('show');
			}
			$("#ceknomor1").click(function(event){
				var nofaktur = $("#nofaktur").val();
				$.ajax({
					url: 'p_delivery.php',
					type: 'post',
					data: {'nofaktur': nofaktur, 'jenis': 'ceknofaktur'},
					success: function(result){
						var temp_result = "{" + result.split("{")[1];
						resultjson = JSON.parse(temp_result);
						if(resultjson.status == "yes"){
							enableAntarField(true);
							$('#namaantar').val(resultjson.nama);
							$('#nohpantar').val(resultjson.nohp);
							$('#alamatantar').val(resultjson.alamat);
							$('#nogetfaktur').text("Nomor faktur ditemukan");
							$('.alert-noget').css("color","green");
						}else{
							enableAntarField(false);
							$('#nogetfaktur').text("Nomor faktur tidak ditemukan");
							$('.alert-noget').css("color","red");
						}
					}
				});
			});
			$("#ceknomor2").click(function(event){
				var nohpjemput = $("#nohpjemput").val();
				$.ajax({
					url: 'p_delivery.php',
					type: 'post',
					data: {'nohpjemput': nohpjemput, 'jenis': 'ceknohp'},
					success: function(result){
						var temp_result = "{" + result.split("{")[1];
						resultjson = JSON.parse(temp_result);
						enableJemputField(true);
						if(resultjson.status == "yes"){
							$('#namajemput').val(resultjson.nama);
							$('#alamatjemput').val(resultjson.alamat);
							$('#outlet').val(resultjson.outlet);
							$('#nogethp').text("Nomor handphone sudah terdaftar");
							$('.new-user').css("display","none");
							$('.alert-noget').css("color","green");
							$('#namajemput').prop("readonly",true);
							$('#info').prop("required", false);
						}else{
							$('#namajemput').prop("readonly",false);
							$("#namajemput").val("");
							$("#alamatjemput").val("");
							$('#nogethp').text("Nomor handphone belum terdaftar");
							$('.new-user').css("display","block");
							$('.alert-noget').css("color","red");
							$('#info').prop("required", true);
						}
					}
				});
			});
			$("#nohpjemput").on("input", function() {
				enableJemputField(false);
			});
		});

		var verifyCallback1 = function(response){
			$('#alert-g-recaptcha1').text('');
			focusToRecaptcha1 = false;
		};

		var verifyCallback2 = function(response){
			$('#alert-g-recaptcha2').text('');
			focusToRecaptcha2 = false;
		};

		var onloadCallback = function(){
			grecaptcha.render('g-recaptcha1', {
				'sitekey': '6Ld4xBMUAAAAAC20d4NOcVgJpacr_G3kB-GIxcQQ',
				'callback': verifyCallback1
			});
			grecaptcha.render('g-recaptcha2', {
				'sitekey': '6Ld4xBMUAAAAAC20d4NOcVgJpacr_G3kB-GIxcQQ',
				'callback': verifyCallback2
			});
		}
	</script>
</head>
<body>
	<section>
		<div class="container">
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#delivery">Form Pengantaran</a></li>
				<li><a data-toggle="tab" href="#pick">Form Penjemputan</a></li>
			</ul>

			<div class="tab-content">

				<div id="delivery" class="tab-pane fade in active" align="center">
					<img src="logo.png"/>
					<h2>Form Pengantaran Cucian</h2>
					<?php
						if($error && $error_jenis == 'delivery'){
					?>
					<div id="error-response-delivery" class="alert-error"><?php echo $error_message ?></div>
					<?php
						}
					?>
					<form action="p_delivery.php" method="post" name="antar" id="antar" onsubmit="return onClickSubmit(this.id)">
						<div class="form-group row">
							<label class="control-label col-xs-12 col-md-3" for="nofaktur">Nomor Faktur</label>
							<div class="col-xs-12 col-md-7">
								<input type="text" autocomplete="off" class="form-control" name="nofaktur" id="nofaktur" required/>
							</div>
							<input type="button" id="ceknomor1" class="col-xs-offset-4 col-xs-4 col-md-offset-0 col-md-2 btn btn-primary" value="Cek Nomor" style="height: 35px;"/>
						</div>
						<div id="nogetfaktur" class="alert-noget"></div>
						<div class="form-group row">
							<label class="control-label col-xs-12 col-md-3" for="namaantar">Nama</label>
							<div class="col-xs-12 col-md-7">
								<input type="text" autocomplete="off" class="form-control" name="namaantar" id="namaantar" required disabled/>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label col-xs-12 col-md-3" for="nohpantar">Nomor Handphone</label>
							<div class="col-xs-12 col-md-7">
								<input type="text" autocomplete="off" class="form-control" name="nohpantar" id="nohpantar" required disabled/>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label col-xs-12 col-md-3" for="alamatantar">Alamat Pengantaran</label>
							<div class="col-xs-12 col-md-7" align="left">
								<textarea class="form-control" name="alamatantar" id="alamatantar" required disabled></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label col-xs-12 col-md-3" for="tglantar">Tanggal Pengantaran</label>
							<div class="col-xs-12 col-md-7">
								<input type="text" autocomplete="off" class="form-control" name="tglantar" id="tglantar" required disabled/>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label col-xs-12 col-md-3" for="waktuantar">Waktu Pengantaran</label>
							<div class="col-xs-12 col-md-7">
								<select class="form-control" name="waktuantar" id="waktuantar" required disabled>
									<option value="">--</option>
									<option value="Pagi">Pagi(09.00 - 12.00)</option>
									<option value="Siang">Siang(12.00 - 15.00)</option>
									<option value="Sore">Sore(15.00 - 18.00)</option>
									<option value="Malam">Malam(18.00 - 21.00)</option>
									<option value="Bebas">Bebas(09.00-21.00)</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label col-xs-12 col-md-3" for="catatanantar">Catatan (Opsional)</label>
							<div class="col-xs-12 col-md-7" align="left">
								<textarea class="form-control" name="catatanantar" id="catatanantar" disabled></textarea>
							</div>
						</div>
						<input type="hidden" id="jenis" name="jenis" value="formantar"/>
						<div class="form-group row">
							<div class="col-xs-12">
								<div id="alert-g-recaptcha1" class="alert-noget-recaptcha"></div>
								</div>
						</div>
						<div class="form-group row">
							<div class="col-xs-12 col-md-offset-3 col-md-9 text-left">
								<div id="g-recaptcha1"></div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-xs-12 col-md-offset-3 col-md-9 text-left">
								<input class="btn btn-primary col-xs-offset-4 col-xs-4 col-md-offset-0 col-md-3" id="submitantar" type="submit" name="submit" value="Submit" disabled>
							</div>
						</div>
					</form>
				</div>


				<div id="pick" class="tab-pane fade" align="center">
					<img src="logo.png"/>
					<h2>Form Penjemputan Cucian</h2>
					<?php
						if($error && $error_jenis == 'pick'){
					?>
					<div id="error-response-pick" class="alert-error"><?php echo $error_message ?></div>
					<?php
						}
					?>
					<form action="p_delivery.php" method="post" name="jemput" id="jemput" onsubmit="return onClickSubmit(this.id)">
						<div class="form-group row">
							<label class="control-label col-xs-12 col-md-3" for="nohpjemput">Nomor Handphone</label>
							<div class="col-xs-12 col-md-7">
								<input type="text" autocomplete="off" class="form-control" name="nohpjemput" id="nohpjemput" required/>
							</div>
							<input type="button" id="ceknomor2" class="col-xs-offset-4 col-xs-4 col-md-offset-0 col-md-2 btn btn-primary" value="Cek Nomor" style="height: 35px;"/>
						</div>
						<div id="nogethp" class="col-xs-12 alert-noget"></div>
						<div class="form-group row">
							<label class="control-label col-xs-12 col-md-3" for="namajemput">Nama</label>
							<div class="col-xs-12 col-md-7">
								<input type="text" autocomplete="off" class="form-control" name="namajemput" id="namajemput" required disabled/>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label col-xs-12 col-md-3" for="outlet">Outlet</label>
							<div class="col-xs-12 col-md-7">
								<select class="form-control" name="outlet" id="outlet" required disabled>
									<option value="">--</option>
									<?php
										$len_list_outlet = count($list_outlet);
										for($i = 0; $i < $len_list_outlet; $i++){
											$nama_outlet = $list_outlet[$i];
									?>
									<option value="<?=$nama_outlet?>"><?=$nama_outlet?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label col-xs-12 col-md-3" for="alamatjemput">Alamat Penjemputan</label>
							<div class="col-xs-12 col-md-7" align="left">
								<textarea class="form-control" name="alamatjemput" id="alamatjemput" required disabled></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label col-xs-12 col-md-3" for="tgljemput">Tanggal Penjemputan</label>
							<div class="col-xs-12 col-md-7">
								<input type="text" autocomplete="off" class="form-control" name="tgljemput" id="tgljemput" required disabled/>
							</div>
						</div>
						<div class="form-group row new-user">
							<label class="control-label col-xs-12 col-md-3" for="info">Tau QuicknClean dari?</label>
							<div class="col-xs-12 col-md-7">
								<select class="form-control" name="info" id="info" onchange="cek()" required disabled>
			                        <option value="">--</option>
			                        <option value="Brosur">Brosur</option>
			                        <option value="Spanduk">Spanduk</option>
			                        <option value="Teman">Teman</option>
			                    </select>
							</div>
						</div>
						<div class="form-group row new-user">
							<label class="control-label col-xs-12 col-md-3" for="referensi">No. Telepon Referensi</label>
							<div class="col-xs-12 col-md-7">
								<input class="form-control" name="referensi" id="referensi" readonly="readonly">
							</div>
		                </div>
						<div class="form-group row">
							<label class="control-label col-xs-12 col-md-3" for="waktujemput">Waktu Penjemputan</label>
							<div class="col-xs-12 col-md-7">
								<select class="form-control" name="waktujemput" id="waktujemput" required disabled>
									<option value="">--</option>
									<option value="Pagi">Pagi(09.00 - 12.00)</option>
									<option value="Siang">Siang(12.00 - 15.00)</option>
									<option value="Sore">Sore(15.00 - 18.00)</option>
									<option value="Malam">Malam(18.00 - 21.00)</option>
									<option value="Bebas">Bebas(09.00-21.00)</option>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label col-xs-12 col-md-3" for="kodepromo">Kode Promo (Opsional)</label>
							<div class="col-xs-12 col-md-7">
								<input typeT="text" autocomplete="off" class="form-control" name="kodepromo" id="kodepromo" disabled/>
							</div>
						</div>
						<div class="form-group row">
							<label class="control-label col-xs-12 col-md-3" for="catatanjemput">Catatan (Opsional)</label>
							<div class="col-xs-12 col-md-7" align="left">
								<textarea class="form-control" name="catatanjemput" id="catatanjemput" disabled></textarea>
							</div>
						</div>
						<input type="hidden" id="jenis" name="jenis" value="formjemput"/>
						<div class="form-group row">
							<div class="col-xs-12">
								<div id="alert-g-recaptcha2" class="alert-noget-recaptcha"></div>
								</div>
						</div>
						<div class="form-group row">
							<div class="col-xs-12 col-md-offset-3 col-md-9 text-left">
								<div id="g-recaptcha2"></div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-xs-12 col-md-offset-3 col-md-9 text-left">
								<input class="btn btn-primary col-xs-offset-4 col-xs-4 col-md-offset-0 col-md-3" id="submitjemput" type="submit" name="submit" value="Submit" disabled>
							</div>
						</div>
					</form>
				</div>

			</div>
		</div>
	</section>
	<script src='https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit' async defer></script>
</body>

</html>