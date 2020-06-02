			<div class="col-md-8 col-md-offset-0" >
			<form  action="act/voucher_recovery.php" method="post" class="form-horizontal">
				<br>
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3">
						<p align="left">Kode Depan</p>
					</label>
					<div class="col-xs-4">
						<input type="text" placeholder="exp. 50RB" id="kode" name="kode" class="form-control" required>
					
					</div>
				</div>
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3" align="left">
						<p align="left">No Voucher Terakhir</p>
					</label>
					<div class="col-xs-4">
						<?php
						$query5           = "SELECT max(right(kode,4)) AS last FROM voucher_recovery order by kode desc LIMIT 1";
						$hasil5           = mysqli_query($con,$query5);
						$data5            = mysqli_fetch_array($hasil5);
						$lastNoTransaksi5 = $data5['last'];

						?>
						<input type="text" value="<?php echo $lastNoTransaksi5 ?>" id="user_id" name="user_id" class="form-control" readonly='readonly'>
					</div>
				</div>
			
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3">
						<p align="left">No Awal</p>
					</label>
					<div class="col-xs-4">
						<input type="text" placeholder="no awal" id="awal" name="awal" class="form-control" required>
					
					</div>
				</div>
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3">
						<p align="left">No Akhir</p>
					</label>
					<div class="col-xs-4">
						<input type="text" placeholder="akhir" id="akhir" name="akhir" class="form-control" required>								
					</div>
				</div>
				

<input name="d15" class="btn btn-lg btn-danger" type="submit" id="d15" value="Generate">   
			</form>			
			</div>			