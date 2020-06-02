			<div class="col-md-8 col-md-offset-0" >
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
						$query5           = "SELECT max(right(kode_voucher,5)) AS last FROM mjk_voucher_berkala order by kode_voucher desc LIMIT 1";
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
						<input type="number" placeholder="no awal" id="awal" name="awal" class="form-control">
					
					</div>
				</div>
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3">
						<p align="left">No Akhir</p>
					</label>
					<div class="col-xs-4">
						<input type="number" placeholder="akhir" id="akhir" name="akhir" class="form-control">								
					</div>
				</div>
				<input name="d15" class="btn btn-lg btn-danger" type="submit" id="d15" value="Generate">   
			</form>
			</div>