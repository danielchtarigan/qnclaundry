			<strong>Form Pengaktifan Voucher Recovery</strong>
			<div class="col-md-12 col-md-offset-0" >
			<form  action="act/aktifkan_voucher_recovery.php" method="get" class="form-horizontal">
				<br>
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-4" >
						<p align="left">Kode Voucher Rupiah</p>
					</label>
					<div class="col-xs-6">
						<input type="text" value="" id="kode" name="kode" class="form-control" required="required">
					</div>
				</div>
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-4" >
						<p align="left">Nilai Recovery</p>
					</label>
					<div class="col-xs-6">
						<input type="text" value="0" id="nilai" name="nilai" class="form-control" required="required">
					</div>
				</div>
<input name="d15" class="btn btn-lg" type="submit" id="d15" value="Aktifkan">   
			</form>			
			</div>			