<html>
	<?php
	include 'header.php';
	include '../config.php';
	
	?>
	

	 <script type="text/javascript">
		$(document).ready(function()
			{
				/*$('#cari').keyup(function(e) {
				if (e.which == 13) {  // detect the enter key
				$('#cuci').click(); // fire a sample click,  you can do anything
				}
				});*/

				$('#cari').click(function(e)
					{

						var tgl  = $('#tgl').val();
						var tgl2  = $('#tgl2').val();


						//kode 1
						var request = $.ajax (
							{
								url : "lap_cash.php",
								data     : 'tgl='+tgl+'&tgl2='+tgl2,
								type : "post",
								dataType: "html"
							});

						//menampilkan pesan Sedang mencari saat aplikasi melakukan proses pencarian
						$('#hasil-cari').html('Sedang Mencari...');

						//Jika pencarian selesai
						request.done(function(output)
							{
								//Tampilkan hasil pencarian pada tag div dengan id hasil-cari
								$('#kotak2').slideDown();
								$('#hasil-cari').html(output);
							});

					});
			});


		//membuat variabel val_cari dan mengisinya dengan nilai pada field cari


	</script>


	<head>

	</head>
	<body>
		<div  class="container-fluid" style="width:500px;
   margin:0 auto;
   position:relative;
   border:3px solid rgba(0,0,0,0);
   -webkit-border-radius:5px;
   -moz-border-radius:5px;
   border-radius:5px;
   -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4);
   -moz-box-shadow:0 0 18px rgba(0,0,0,0.4);
   box-shadow:0 0 18px rgba(0,0,0,0.4);
   color:#000000;
   margin-bottom: 10px;
   ">
			<marquee behavior=alternate style="font-size: 25px;color: #ff0000"  >
				<h1>
					Cari Lap Pemasukan
				</h1>
			</marquee>


       
         
				<label class="control-label col-xs-5" for="setrika">
					Pilih Tanggal masuk
				</label>
			
			<div class="col-xs-5" >
				<input type="date" class="form-control" name="tgl" id="tgl" required="true" >sd
			
				<input type="date" class="form-control" name="tgl2" id="tgl2" required="true" >
				<input type="submit" value="cari" name="cari" id="cari"  class="btn btn-primary">
			
			</div>
	

		</div>

		<!-- tempat hasil pencarian ditampilkan -->
		<div class="container-fluid" style="
   width:100%;
   margin:0 auto;
   position:relative;
   border:3px solid rgba(0,0,0,0);
   -webkit-border-radius:5px;
   -moz-border-radius:5px;
   border-radius:5px;
   -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4);
   -moz-box-shadow:0 0 18px rgba(0,0,0,0.4);
   box-shadow:0 0 18px rgba(0,0,0,0.4);
   color:#000000;
   margin-bottom: 70px;	">
			<div id="hasil-cari">
			</div>
		</div>

		

	</body>
</html>
