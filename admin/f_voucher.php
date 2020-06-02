<html>
	<?php
	include 'header.php';
	include '../config.php';
	?>
	<head>
	</head>
	<body>
		
		<div  class="container-fluid" style="width:100%;
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
   margin-top: 70px;
   ">
   <div class="row featurette">

			<div class="col-md-4 col-md-offset-0" >
			<form  action="p_voucher.php" method="post" class="form-horizontal">
				<br>
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3">
						NO Terakhir diskon 15
					</label>
					<div class="col-xs-4">
						<?php
						$query5           = "SELECT max(right(no_voucher,3)) AS last FROM voucher_lucky WHERE left(no_voucher,3)='d15' LIMIT 1";
						$hasil5           = mysqli_query($con,$query5);
						$data5            = mysqli_fetch_array($hasil5);
						$lastNoTransaksi5 = $data5['last'];

						?>
						<input type="text" value="<?php echo $lastNoTransaksi5 ?>" placeholder="username" id="user_id" name="user_id" class="form-control">
					</div>
				</div>
			
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3">
						no awal
					</label>
					<div class="col-xs-4">
						<input type="number" placeholder="no awal" id="awal" name="awal" class="form-control">
					
					</div>
				</div>
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3">
						no akhir
					</label>
					<div class="col-xs-4">
						<input type="number" placeholder="akhir" id="akhir" name="akhir" class="form-control">
					
					
					</div>
				</div>


	<input name="d15" class="btn btn-lg btn-danger" type="submit" id="d15" value="Diskon 15%">

			</form>

			
			</div>
			<div class="col-md-4 col-md-offset-0" >
			<form  action="p_voucher.php" method="post" class="form-horizontal">
				<br>
				
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3">
						no terakhir diskon 25
					</label>
					<div class="col-xs-4">
						<?php
						$query5           = "SELECT max(right(no_voucher,3)) AS last FROM voucher_lucky WHERE left(no_voucher,3)='d25' LIMIT 1";
						$hasil5           = mysqli_query($con,$query5);
						$data5            = mysqli_fetch_array($hasil5);
						$lastNoTransaksi5 = $data5['last'];

						?>
						<input type="text" value="<?php echo $lastNoTransaksi5 ?>" placeholder="username" id="user_id" name="user_id"  class="form-control">
					</div>
				</div>
				

				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3">
						no awal
					</label>
					<div class="col-xs-4">
						<input type="number" placeholder="no awal" id="awal" name="awal" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3">
						no akhir
					</label>
					<div class="col-xs-4">
						<input type="number" placeholder="no akhir" class="form-control" id="akhir" name="akhir">
					</div>
				</div>



				<input name="d25" class="btn btn-lg btn-danger" type="submit" id="d25" value="Diskon 25%">
			</form>

			
			</div>
			<div class="col-md-4 col-md-offset-0" >
			<form  action="p_voucher.php" method="post" class="form-horizontal">
				<br>
				
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3">
						no terakhir diskon 35
					</label>
					<div class="col-xs-4">
						<?php
						$query5           = "SELECT max(right(no_voucher,3)) AS last FROM voucher_lucky WHERE left(no_voucher,3)='d35' LIMIT 1";
						$hasil5           = mysqli_query($con,$query5);
						$data5            = mysqli_fetch_array($hasil5);
						$lastNoTransaksi5 = $data5['last'];

						?>
						<input type="text" value="<?php echo $lastNoTransaksi5 ?>" placeholder="username" id="user_id" name="user_id" class="form-control">
					</div>
				</div>

				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3">
						no awal
					</label>
					<div class="col-xs-4">
						<input type="number" placeholder="awal" id="awal" name="awal" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3">
						no akhir
					</label>
					<div class="col-xs-4">
						<input type="number" placeholder="akhir" class="form-control" id="akhir" name="akhir" required="true">
					</div>
				</div>



				<input name="d35" class="btn btn-lg btn-danger" type="submit" id="d35" value="Diskon 35%">

			</form>

			
			</div>
		</div>

					</div>
	</body>
</html>

