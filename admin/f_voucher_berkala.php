

			<form  action="p_voucher_berkala.php" method="post" class="form-horizontal">
				<br>
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3" >
						<p align="left"> Kategori </p>
					</label>
					<div class="col-xs-4">
					    <select name="kategori" id="kategori" name="kategori" class="form-control">
						 <option value="ALL">ALL</option>
						 <option value="Kiloan">Kiloan</option>
						 <option value="Potongan">Potongan</option>
						</select>
						
					</div>
				</div>
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3" >
						<p align="left"> Outlet </p>
					</label>
					<div class="col-xs-4">
					    <select name="outlet" id="outlet" name="outlet" class="form-control">
						 <option value="ALL">ALL</option>
						 <?php 
						 $qot = mysqli_query($con, "select * from outlet");
						 while ($rot = mysqli_fetch_array($qot)){
						 ?>
						 <option value="<?php echo $rot['nama_outlet']; ?>"><?php echo $rot['nama_outlet']; ?></option>
						 <?php	 
						 }
						 ?> 
						</select>
						
					</div>
				</div>
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3" >
						<p align="left">Diskon</p>
					</label>
					<div class="col-xs-4">
						<input type="text" value="" id="diskon" name="diskon" placeholder='Persentase (exp. 50)' class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3" >
						<p align="left">Periode Awal</p>
					</label>
					<div class="col-xs-4">
						<input type="text" value="<?php echo date('Y-m-d'); ?>" id="periode_awal" name="periode_awal" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3" align="left">
						<p align="left">Periode Akhir</p>
					</label>
					<div class="col-xs-4">
						<input type="text" value="<?php echo date('Y-m-d'); ?>" id="periode_akhir" name="periode_akhir" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3" align="left">
						<p align="left">Minimum Transaksi</p>
					</label>
					<div class="col-xs-4">
						<input type="text" id="minimum_transaksi" name="minimum_transaksi" class="form-control"  value="0">
					</div>
				</div>
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3" align="left">
						<p align="left">Maksimum Transaksi</p>
					</label>
					<div class="col-xs-4">
						<input type="text" id="maksimum_transaksi" name="maksimum_transaksi" class="form-control"  value="0">
					</div>
				</div>
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3" align="left">
						<p align="left">No Voucher Terakhir</p>
					</label>
					<div class="col-xs-4">
						<?php
						$query5           = "SELECT max(right(kode_voucher,5)) AS last FROM voucher_berkala WHERE kode_voucher LIKE 'BC%' order by kode_voucher desc LIMIT 1";
						$hasil5           = mysqli_query($con,$query5);
						$data5            = mysqli_fetch_array($hasil5);
						$lastNoTransaksi5 = $data5['last'];

						
						?>
						<input type="text" value="<?php echo $lastNoTransaksi5 ?>" id="user_id" name="user_id" class="form-control" readonly>
					</div>
				</div>
			
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3">
						<p align="left">No Awal</p>
					</label>
					<div class="col-xs-4">
						<input type="text" placeholder="no awal" id="awal" name="awal" class="form-control" maxlength="5" minlength="5" value="<?= sprintf('%05s', $data5['last']+1); ?>" readonly>					
					</div>
					<div id="c"></div>
				</div>
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3">
						<p align="left">No Akhir</p>
					</label>
					<div class="col-xs-4">
						<input type="text" placeholder="akhir" id="akhir" name="akhir" class="form-control" maxlength="5" minlength="5">					
					</div>
					<div id="d"></div>
				</div>				
				<input name="d15" class="btn btn-lg btn-danger" type="submit" id="d15" value="Generate" >   
			</form>


<script type="text/javascript">
	$(function(){
		$('#periode_awal, #periode_akhir').datepicker({
			dateFormat:'yy-mm-dd',
		});

		$('#awal').on('keypress', function(e){
			if(e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)){
				$("#c").html("Isikan Angka").css('color', 'red');
             	return false;
			}
		});

		$('#akhir').on('keypress', function(e){
			if(e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)){
				$("#d").html("Isikan Angka").css('color', 'red');
             	return false;
			}
		});


	});
		
</script>