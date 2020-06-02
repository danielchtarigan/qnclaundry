<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

	<title>Registrasi Laundry Mahasiswa</title>

	<link href="media/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="media/css/bootstrap-datepicker3.min.css">
	<!-- <link rel="stylesheet" href="media/ui/jquery-ui.css"> 	 -->

	<script type="text/javascript" src="media/js/bootstrap.min.js"></script>	
	<script src="media/jquery-3.2.0.min.js"></script>		
	<script src="media/js/jquery.validate.js"></script>
	

	<script type="text/javascript">
	$(document).ready(function(){			
		$('#satu').validate({
			rules: {
				nama:"required",
				tlahir:"required",
				outlet:"required",
				gambar:"required",
				nohp:{
					required:true,
					number:true,
					minlength:10,
					maxlength:12
				},
				sekolah:{
					required:true,
					minlength:8
				},
				nokartu:{
					required:true,					
					minlength:5
				},						
			},
			messages: {
				nama:{
					required:'*Nama harus di isi',					
				},
				tlahir:{
					required:'*Isi sesuai tanggal lahir Anda (format: tahun/bulan/tanggal)'
				},
				nohp:{
					required:'*Hanya boleh diisi dengan Angka'
				},
				sekolah:{
					required:'*Isi Nama Sekolah/Kampus Anda',
					minlength: 'Minimal 8 Karakter'
				},
				nokartu:{
					required:'*Isi sesuai dengan Nomor kartu atau Stambuk Anda',
					minlength: 'Minimal 5 Karakter'
				},
				gambar:{
					required:'*Wajib upload foto kartu mahasiswa Anda'
				},
				outlet:{
					required:'*Wajib pilih outlet yang akan dikunjungi'
				},
			}
		});
			
		$("#tanggal1").datepicker({
				format:'yyyy/mm/dd'	
		    });							
		});
	</script>


    <style>		
    	body {
    		font-family: cambria;
    		background-color: ;
    		background-image: url("");
    		background-repeat: no-repeat;
    	}    			
		
		#satu {
			margin-top: 30px;
		}	
		
		@media (min-width: 992px) {
	    #content {
	      background-color: #ebebeb;		      
	      padding-right: : 20px;
		  padding-left: 6px;
		  margin-right: auto;
		  margin-left: auto;
		  border: 15px solid white;	
		  width: 720px;
		  box-shadow:0 0 18px rgba(0,0,0,0.4);	
	    }

		.header {
			width: auto;
			height: 40px;
			background-color: grey;			
		}
		a {
			font-size: 22px;
			display: inline;			
		}

		label.error {
		color: red; padding-left: .5em;
		font-size: 12px;

		}

		.logo {
			text-align: center;
		}

		input {
			font-size: 14px;
			font-family: arial;
		}

		p {
			margin-top: -10px;
			text-align: center;	
			color: green;
		}
	</style>
</head>
<body>

	<!-- <div class="header">	
			<a href="">Home </a>
			<a href="">About </a>
			<a href="">Kontak </a>		
	</div> -->
	
	<div class="container">
	<div class="logo"><img src="../logo.png"></div>
	</div>
	<div class="container" id="content" >		
		<h3 style="text-align:center; font-weight: bold"><u>Form Pendaftaran Member Kartu Mahasiswa</u></h3>
		<div class="col-sm-offset-2"> 
			<form class="form-horizontal" id="satu" action="act_mahasiswa.php" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label for="outlet" class="control-label col-sm-3">Outlet Pilihan :</label>
					<div class="radio col-sm-2 col-sm-offset-0">
						<label><input id="outlet" type="radio" class="" name="outlet" value="DAYA">DAYA</label>
					</div>
					<div class="radio col-sm-2 col-sm-offset-0">
						<label><input id="outlet" type="radio" class="" name="outlet" value="BTP">BTP</label>
					</div>
				</div>
				<div class="form-group">
					<label for="hp" class="control-label col-sm-3">Nomor Hp :</label>
					<div class="col-sm-6"><input id="nohp" type="text" class="form-control" name="nohp" placeholder="Silahkan isi Nomor Telepon Anda!" onkeyup="otomatis()"></div>
				</div>
				<p>*Sebagian Data akan terisi jika Anda pernah menggunakan jasa qnclaundry</p>
				<div class="form-group">
					<label for="id" class="control-label col-sm-3"></label>
					<div class="col-sm-6"><input id="idkey" type="hidden" class="form-control" name="idkey" ></div>
				</div>
				<div class="form-group">
					<label for="nama" class="control-label col-sm-3">*Nama :</label>			
					<div class="col-sm-6"><input class="form-control" type="text" name="nama" id="nama" placeholder="Boleh diisi dengan nama panggilan"></div>		
				</div>
				<div class="form-group">
					<label for="born"  class="control-label col-sm-3">Tanggal Lahir :</label>
					<div class="col-sm-6"><input type="text" class="form-control" id="tanggal1" name="tlahir" placeholder="Tahun bisa diketik saja"></div>
				</div>	
				<div class="form-group">
					<label for="alamat"  class="control-label col-sm-3">*Alamat :</label>
					<div class="col-sm-6"><input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat Anda"></div>
				</div>	
				<div class="form-group">
					<label for="email"  class="control-label col-sm-3">*Email :</label>
					<div class="col-sm-6"><input type="email" class="form-control" id="email" name="email" placeholder="Email Anda"></div>
				</div>			
				<div class="form-group">
					<label for="sekolah" class="control-label col-sm-3">Nama Sekolah :</label>
					<div class="col-sm-6"><input type="text" class="form-control" name="sekolah" placeholder="Nama Perguruan Tinggi"></div>
				</div>
				<div class="form-group">
					<label for="ktm" class="control-label col-sm-3">Nomor KTM :</label>
					<div class="col-sm-6"><input type="text" class="form-control" name="nokartu" placeholder="Kartu Mahasiswa/NIM/Stambuk"></div>
				</div>
				<div class="form-group">
					<label for="gambar" class="control-label col-sm-3">Upload Foto KTM :</label>
					<div class="col-sm-6"><input type="file" class="form-control" id="gambar" name="gambar"></div>
				</div>
					<p>*ukuran file max 1MB</p><br>
				<div class="form-group">
					<div class="col-sm-2 col-sm-offset-3">				
					<div class="g-recaptcha" data-sitekey="6LdM0BkUAAAAAH8t4nYgjso-TIEnzI_utwNKX2UA"></div>
					</div>
				</div>
				<div class="form-group">						     
					<div class="col-xs-4 col-sm-4 col-sm-offset-4">
					<button type="submit" class="btn btn-primary btn-sm btn-active" name="daftar" style="font-weight:bolder; font-size: 16px">Registrasi</button>				
					<button type="reset" class="btn btn-danger btn-sm btn-active" name="reset" style="font-weight:bolder; font-size: 16px">Reset</button>
					</div>
				</div>    
			</form>						
		</div>
	</div>	
<!--   	<script src="media/ui//jquery-ui.js"></script>	 --> 
		<script src="media/js/bootstrap-datepicker.min.js"></script>
		<script src='https://www.google.com/recaptcha/api.js'></script>

  	<script type="text/javascript">  		
  		function otomatis(){	
			var nohp = $("#nohp").val();
			$.ajax({
				url: 'json.php',				
				data: 'nohp='+nohp,
			}).done(function(data){
				var json_data = data,
				obj = JSON.parse(json_data);
				$('#nama').val(obj.nama);
				$('#alamat').val(obj.alamat);	
				$('#idkey').val(obj.idkey);
				$('#email').val(obj.email);
			});
		}
  	</script>
</body>
</html>