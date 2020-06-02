<style type="text/css">
	
	h2 {
	
		text-align: center;
		margin-top: -5px;
	}

	#info {
		margin-top: 15px;
		height:auto;
		width: 600px;
		padding: 10px;
		background: #ccddad;
		border:2px solid #fff;
		border-radius:8px;
		font:normal 1em Cambria,Georgia,Serif;
		color:#111;
		-webkit-box-shadow:0px 1px 3px rgba(0,0,0,0.4);
		-moz-box-shadow:0px 1px 3px rgba(0,0,0,0.4);
		box-shadow:0px 1px 3px rgba(0,0,0,0.4);
	}	
</style>


	<div id="info" class="col-lg-12">
		
		<h2>Form KPIku</h2>
		<p align="center"><strong>Namaku : <?= $_SESSION['user_id'] ?></strong></p>
		<div class="col-lg-12">
			<p>Wajib isi</p>
			<p>Form ini untuk keperluan gaji periode sekarang</p>
			<form class="form-horizontal" method="POST" action="../kpi-by-service/p_kpi.php">
				<input type="text" class="hidden" name="nama" value="<?= $_SESSION['user_id'] ?>">
				<div class="form-group">
					<label class="control-label col-lg-4 pull-left"><p align="left">Lembur Regularku (Jam)</p></label>
					<div class="col-lg-8">
						<input class="form-control" type="number" name="lembur_reguler"  placeholder="Isi berapa jam" required="" min="0">
					</div>			
				</div>
				<div class="form-group">
					<label class="control-label col-lg-4 pull-left"><p align="left">Lembur 12 jamku (Hari)</p></label>
					<div class="col-lg-8">
						<input class="form-control" type="number" name="lembur_12" placeholder="Isi berapa hari" required="" min="0">
					</div>			
				</div>
				<div class="form-group">
					<label class="control-label col-lg-4 pull-left"><p align="left">Izin (Hari)</p></label>
					<div class="col-lg-8">
						<input class="form-control" type="number" name="izin" placeholder="Isi berapa hari" required="" min="0">
					</div>			
				</div>
				<div class="form-group">
					<label class="control-label col-lg-4 pull-left"><p align="left">Sakit (Hari)</p></label>
					<div class="col-lg-8">
						<input class="form-control" type="number" name="sakit" placeholder="Isi berapa hari" required="" min="0">
					</div>			
				</div>
				<div class="form-group">
					<label class="control-label col-lg-4 pull-left"><p align="left">Alpha (Hari)</p></label>
					<div class="col-lg-8">
						<input class="form-control" type="number" name="alpa" placeholder="Isi berapa hari" required="" min="0">
					</div>			
				</div>
				<div class="form-group">
					<label class="control-label col-lg-4 pull-left"><p align="left">Terlambat (Menit)</p></label>
					<div class="col-lg-8">
						<input class="form-control" type="number" name="terlambat" placeholder="Isi berapa menit" required="" min="0">
					</div>			
				</div>

				<div class="form-group">
					<label class="control-label col-lg-4 pull-left"><p align="left">Awal masuk kerja</p></label>
					<div class="col-lg-8">
						<input class="form-control" type="text" name="tanggal_mulai" id="tanggal1" placeholder="Isi tanggal pertama masuk kerja" autocomplete="off" required="">
					</div>			
				</div>

				<div class="form-group">
					<div class="col-lg-12">
						<input class="form-control btn btn-primary" type="submit" name="submit">
					</div>			
				</div>

			</form>
		</div>

	</div>	
	