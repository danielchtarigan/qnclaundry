			<div class="col-md-8 col-md-offset-0" >
			<form  action="act/penyesuaian.php" method="get" class="form-horizontal">
				<br>
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3" >
						<p align="left">Kode Setoran Bank</p>
					</label>
					<div class="col-xs-4">
						<input type="text" value="<?php echo $_GET['ids']; ?>" id="id" name="id" class="form-control" required="required" readonly>
					</div>
				</div>
                                <div class="form-group">
					<label for="no_nota" class="control-label col-xs-3" >
						<p align="left"></p>
					</label>
					<div class="col-xs-4">
						<input type="hidden" value="<?php echo $_GET['rcp']; ?>" id="rcp" name="rcp" class="form-control"    required="required" readonly>
					</div>
				</div>
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3" align="left">
						<p align="left">Nilai Penyesuaian</p>
					</label>
					<div class="col-xs-4">
						<input type="text" id="nilai" name="nilai" class="form-control"  value="" placeholder="0" required="required">
					</div>
				</div>
			
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3">
						<p align="left">Keterangan Penyesuaian</p>
					</label>
					<div class="col-xs-4">
						<textarea name="keterangan" cols="33" rows="5" placeholder="Masukkan keterangan penyesuaian"></textarea>
					</div>
				</div>

<input name="d15" class="btn btn-lg btn-danger" type="submit" id="d15" value="Save">   
			</form>			
			</div>			