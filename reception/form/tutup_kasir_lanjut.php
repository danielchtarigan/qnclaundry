					<?php				
					
					
					if(isset($_POST['kirim'])){
						$cek = $_POST['kirim'];
						$seratusribu = $_POST['seratusribu'];
						$limapuluhribu = $_POST['limapuluhribu'];
						$duapuluhribu = $_POST['duapuluhribu'];
						$sepuluhribu =$_POST['sepuluhribu'];
						$limaribu = $_POST['limaribu'];
						$duaribu = $_POST['duaribu'];
						$seribu = $_POST['seribu'];
						$duaribuk = $_POST['duaribuk'];
						$seribuk = $_POST['seribuk'];
						$limaratusk = $_POST['limaratusk'];
						$duaratusk = $_POST['duaratusk'];
						$seratusk = $_POST['seratusk'];					
					
					$jumlahcash = (100000*$seratusribu)+(50000*$limapuluhribu)+(20000*$duapuluhribu)+(10000*$sepuluhribu)+(5000*$limaribu)+(2000*$duaribu)+(1000*$seribu)+(2000*$duaribuk)+(1000*$seribuk)+(500*$limaratusk)+(200*$duaratusk)+(100*$seratusk);
					}								
					?>
					
					
	<p style="font-size:18px; font-weight:bold">TUTUP KASIR</p>
	<marquee behavior=alternate onmouseover="this.stop()" onmouseout="this.start()" style="color:red"></marquee>
		<div class="panel panel-default">
			<div class="panel-body">					
				<div class="col-sm-9 col-sm-offset-1">
					<form class="form-horizontal" action="act_tutup_kasir.php" method="post" id="ff">	
						<div class="form-group">
							<label for="totalcash" class="control-label col-sm-3">Cash Bersih (Rp)</label>
							<div class="col-sm-6 col-sm-offset-0">
								<input type="number" class="form-control" id="totalcash" name="totalcash" readonly required value="<?php echo $jumlahcash ?>">								
							</div>
						</div>						
						<div class="form-group">
							<label for="totalbni" class="control-label col-sm-3">BNI (Rp)</label>
							<div class="col-sm-6 col-sm-offset-0">
								<input type="number" class="form-control" id="totalbni" name="totalbni" required value="0">								
							</div>
						</div>
						<div class="form-group">
							<label for="totalbri" class="control-label col-sm-3">BRI (Rp)</label>
							<div class="col-sm-6 col-sm-offset-0">
								<input type="number" class="form-control" id="totalbri" name="totalbri" required value="0">								
							</div>
						</div>
						<div class="form-group">
							<label for="totalbca" class="control-label col-sm-3">BCA (Rp)</label>
							<div class="col-sm-6 col-sm-offset-0">
								<input type="number" class="form-control" id="totalbca" name="totalbca" required value="0">								
							</div>
						</div>
						<div class="form-group">
							<label for="totalmdr" class="control-label col-sm-3">MANDIRI (Rp)</label>
							<div class="col-sm-6 col-sm-offset-0">
								<input type="number" class="form-control" id="totalmdr" name="totalmdr" required value="0">								
							</div>
						</div>
						<div class="form-group">
							<label for="totaldnm" class="control-label col-sm-3">DANAMON (Rp)</label>
							<div class="col-sm-6 col-sm-offset-0">
								<input type="number" class="form-control" id="totaldnm" name="totaldnm" required value="0">								
							</div>
						</div><hr>
						<div class="form-group">
							<label for="void" class="control-label col-sm-3 hidden">Void (Rp)</label>
							<div class="col-sm-6">
								<input type="number" readonly class="form-control hidden" id="void" name="void" required value="0" placeholder="jumlah rupiah semua void Anda hari ini">								
							</div>
						</div>
						<div class="form-group">
							<label for="nota_void" class="control-label col-sm-4 hidden">Nomor Nota Void</label>
							<div class="col-sm-5">
								<textarea type="text" readonly value="-" class="form-control hidden" id="nota_void" name="nota_void" required rows="3" placeholder="Berisi semua nota void Anda hari ini, jumlah rupiahnya diisi di kolom atas Void (Rp)!!!"></textarea>								
							</div>
						</div>
						Pengeluaran Langsung adalah pengeluaran tunai secara langsung berbentuk fisik uang
						<div class="form-group">
							<label for="keluar" class="control-label col-sm-3 hidden">Pengeluaran Langsung</label>
							<div class="col-sm-6">
								<input type="number" class="form-control hidden" id="keluar" name="keluar" value="0">								
							</div>
						</div>
						<div class="form-group">
							<label for="untuk" class="control-label col-sm-4 hidden">Pengeluaran Untuk</label>
							<div class="col-sm-5">
								<textarea type="text" class="form-control hidden" id="untuk" name="untuk" rows="6" placeholder="Berisi pengeluaran uang yang secara langsung diberikan kepada orang yang minta, jumlah pengeluaran diisi di kolom Pengeluaran Langsung!!!" value="-"></textarea>								
							</div>
						</div>
						<div class="form-group">
							<label for="izin" class="control-label col-sm-4 hidden">Izin Oleh</label>
							<div class="col-sm-5">
								<input type="text" class="form-control hidden" id="izin" name="izin" placeholder="izin pengeluaran dan void" value="-">								
							</div>
						</div>
						
						
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-9">
								<button type="submit" class="btn btn-success btn-md" name="test" id="test" >Kirim</button>															
							</div>
						</div>				
					</form>
				</div>
			</div>
		</div>
		

	
<script type="text/javascript">
	$(document).ready(function()
	{
		$('#test').click(function()
		{
			var jumlah = $('#totalcash').val();
			if (confirm("Jumlah Cash untuk disetor: Rp."+jumlah))
			{				
			}else{
				return false;
			}
		});
	});
</script>
		
		