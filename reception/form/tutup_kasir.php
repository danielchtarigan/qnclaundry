			
			
	<p style="font-size:18px; font-weight:bold">TUTUP KASIR</p>
		<marquee behavior=alternate onmouseover="this.stop()" onmouseout="this.start()" style="color:#0033cc">Info: Tutup Kasir berdasarkan pecahan uang yang diterima, bukan dari nota pembayaran!</marquee><br>
			<div class="panel panel-default">
				<div class="panel-body">					
					<div class="col-sm-9 col-sm-offset-1">
					<form class="form-horizontal" action="index.php?menu=tutup_kasir_lanjut" method="post">						
						<div class="col-sm-3 col-md-9 col-sm-offset-0" style="color:#0033cc"><strong>Pecahan Uang Kertas</strong></div><br><br>
						<div class="form-group">
							<label for="seratusribu" class="control-label col-sm-4">Rp 100.000</label>
							<div class="col-sm-5">
								<input type="number" class="form-control" id="seratusribu" name="seratusribu" required value="0">								
							</div>
						</div>
						<div class="form-group">
							<label for="limapuluhribu" class="control-label col-sm-4">Rp 50.000</label>
							<div class="col-sm-5">
								<input type="number" class="form-control" id="limapuluhribu" name="limapuluhribu" required value="0">								
							</div>
						</div>
						<div class="form-group">
							<label for="duapuluhribu" class="control-label col-sm-4">Rp 20.000</label>
							<div class="col-sm-5">
								<input type="number" class="form-control" id="duapuluhribu" name="duapuluhribu" required value="0">								
							</div>
						</div>
						<div class="form-group">
							<label for="sepuluhribu" class="control-label col-sm-4">Rp 10.000</label>
							<div class="col-sm-5">
								<input type="number" class="form-control" id="sepuluhribu" name="sepuluhribu" required value="0">								
							</div>
						</div>
						<div class="form-group">
							<label for="limaribu" class="control-label col-sm-4">Rp 5.000</label>
							<div class="col-sm-5">
								<input type="number" class="form-control" id="limaribu" name="limaribu" required value="0">								
							</div>
						</div>
						<div class="form-group">
							<label for="duaribu" class="control-label col-sm-4">Rp 2.000</label>
							<div class="col-sm-5">
								<input type="number" class="form-control" id="duaribu" name="duaribu" required value="0">								
							</div>
						</div>
						<div class="form-group">
							<label for="seribu" class="control-label col-sm-4">Rp 1.000</label>
							<div class="col-sm-5">
								<input type="number" class="form-control" id="seribu" name="seribu" required value="0">								
							</div>
						</div>
						<div class="col-sm-3 col-md-9 col-sm-offset-0" style="color:#0033cc"><strong>Pecahan Uang Koin</strong></div><br><br>
						<div class="form-group">
							<label for="duaribuk" class="control-label col-sm-4">Rp 2.000</label>
							<div class="col-sm-5">
								<input type="number" class="form-control" id="duaribuk" name="duaribuk" required value="0">								
							</div>
						</div>
						<div class="form-group">
							<label for="seribuk" class="control-label col-sm-4">Rp 1.000</label>
							<div class="col-sm-5">
								<input type="number" class="form-control" id="seribuk" name="seribuk" required value="0">								
							</div>
						</div>
						<div class="form-group">
							<label for="limaratusk" class="control-label col-sm-4">Rp 500</label>
							<div class="col-sm-5">
								<input type="number" class="form-control" id="limaratusk" name="limaratusk" required value="0">								
							</div>
						</div>
						<div class="form-group">
							<label for="duaratusk" class="control-label col-sm-4">Rp 200</label>
							<div class="col-sm-5">
								<input type="number" class="form-control" id="duaratusk" name="duaratusk" required value="0">								
							</div>
						</div>
						<div class="form-group">
							<label for="seratusk" class="control-label col-sm-4">Rp 100</label>
							<div class="col-sm-5">
								<input type="number" class="form-control" id="seratusk" name="seratusk" required value="0">								
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-5">
								<button type="submit" class="btn btn-info btn-md" id="kirim" name="kirim">Lanjutkan</button>															
							</div>
						</div>
					</form>				
					</div>
				</div>
			</div>
			