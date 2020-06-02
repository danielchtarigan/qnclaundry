<div class="container col-md-12 col-md-offset-0">
<p style="font-size:16px; font-weight:bold">Laporan Delivery</th>
	<form action="act/delivery3.php" method="POST" class="form-horizontal" name="input" style="font-size:14px">	
	<br>
		<div class="form-group">
			<label class="control-label col-md-2" for="nama">Nama Delivery</label>				
				<div class="col-md-3">					
					<select name="nama_delivery" class="form-control" required="required">
						<option value=""></option>
						<option value="Mety" >Mety</option>
						<option value="Rizal">Rizal</option>
						<option value="Zul" >Zul</option>
						<option value="Sulli">Sulli</option>    
					</select>
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-2" for="antar">Pengantaran</label>
				<div class="col-md-2">
					<input type="number" class="from-control" name="antar" required="required">Alamat
				</div>
		</div>		
		<div class="form-group">
			<label class="control-label col-md-2" for="jemput">Penjemputan</label>
				<div class="col-md-2">
					<input type="number" class="from-control" name="jemput" required="required">Alamat
				</div>
		</div>				
			<div class="col-md-2">
				<input type="submit" style="font-size:14px" class="btn btn-lg btn-danger" name="pulang" value="kirim">				
			</div>
	</form>
</div>