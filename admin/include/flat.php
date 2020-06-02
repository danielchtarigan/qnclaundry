<?php
$qcustomer = mysqli_query($con, "select * from promo_flat where kode='$_GET[kode]'");
$rcustomer = mysqli_fetch_array($qcustomer);
?>
			<div class="col-md-8 col-md-offset-0" >
			<form  action="p_kode_flat.php" method="post" class="form-horizontal">
				<br>
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3" >
						<p align="left">Kode Promo Flat</p>
					</label>
					<div class="col-xs-4">
						<input type="text" value="<?php echo $rcustomer['kode']; ?>" id="kode" name="kode" placeholder='exp. FLAT7000' class="form-control" required="required">
					</div>
				</div>
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3" >
						<p align="left"> Kategori </p>
					</label>
					<div class="col-xs-4">
						<input type="text" value="Kiloan" id="kategori" name="kategori" class="form-control" readonly="readonly">
						
					</div>
				</div>
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3" >
						<p align="left"> Outlet </p>
					</label>
					<div class="col-xs-4">
					    <select name="outlet" id="outlet" name="outlet" class="form-control">
                        <?php if ($rcustomer['outlet']<>''){
							echo "<option value=$rcustomer[outlet]>$rcustomer[outlet]</option>";
							} ?>
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
						<p align="left">Harga Flat</p>
					</label>
					<div class="col-xs-4">
						<input type="text" value="<?php echo $rcustomer['flat']; ?>" id="flat" name="flat" placeholder='Harga Flat (exp. 7000)' class="form-control" required="required">
					</div>
				</div>
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3" align="left">
						<p align="left">Minimum Berat</p>
					</label>
					<div class="col-xs-4">
						<input type="text" id="minimum_berat" name="minimum_berat" class="form-control"  value="<?php echo $rcustomer['minimum_berat']; ?>" placeholder="exp. 2" required="required">
					</div>
				</div>
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3" align="left">
						<p align="left">Maksimum Berat</p>
					</label>
					<div class="col-xs-4">
						<input type="text" id="maksimum_berat" name="maksimum_berat" class="form-control"  value="<?php echo $rcustomer['maksimum_berat']; ?>" placeholder="exp. 5" required="required">
					</div>
				</div>
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3" align="left">
						<p align="left">Hari</p>
					</label>
					<div class="col-xs-4">
                        <?php 
						$hari1 = mysqli_query($con, "select * from promo_flat where kode='$rcustomer[kode]' and hari like '%Monday%'");
						$nhari1 = mysqli_num_rows($hari1);
						if ($nhari1>0){
							$monday = "checked='checked'";
						}
						else{
							$monday = "";
							}

						$hari2 = mysqli_query($con, "select * from promo_flat where kode='$rcustomer[kode]' and hari like '%Tuesday%'");
						$nhari2 = mysqli_num_rows($hari2);
						if ($nhari2>0){
							$tuesday = "checked='checked'";
						}
						else{
							$tuesday = "";
							}

						$hari3 = mysqli_query($con, "select * from promo_flat where kode='$rcustomer[kode]' and hari like '%Wednesday%'");
						$nhari3 = mysqli_num_rows($hari3);
						if ($nhari3>0){
							$wednesday = "checked='checked'";
						}
						else{
							$wednesday = "";
							}

						$hari4 = mysqli_query($con, "select * from promo_flat where kode='$rcustomer[kode]' and hari like '%Thursday%'");
						$nhari4 = mysqli_num_rows($hari4);
						if ($nhari4>0){
							$thursday = "checked='checked'";
						}
						else{
							$thursday = "";
							}

						$hari5 = mysqli_query($con, "select * from promo_flat where kode='$rcustomer[kode]' and hari like '%Friday%'");
						$nhari5 = mysqli_num_rows($hari5);
						if ($nhari5>0){
							$friday = "checked='checked'";
						}
						else{
							$friday = "";
							}

						$hari6 = mysqli_query($con, "select * from promo_flat where kode='$rcustomer[kode]' and hari like '%Saturday%'");
						$nhari6 = mysqli_num_rows($hari6);
						if ($nhari6>0){
							$saturday = "checked='checked'";
						}
						else{
							$saturday = "";
							}

						$hari7 = mysqli_query($con, "select * from promo_flat where kode='$rcustomer[kode]' and hari like '%Sunday%'");
						$nhari7 = mysqli_num_rows($hari7);
						if ($nhari7>0){
							$sunday = "checked='checked'";
						}
						else{
							$sunday = "";
						}
						?>
						<input type="CheckBox" value="Monday" name="hari1" <?php echo $monday; ?> > Senin <br>
						<input type="CheckBox" value="Tuesday" name="hari2" <?php echo $tuesday; ?> > Selasa <br>
						<input type="CheckBox" value="Wednesday" name="hari3" <?php echo $wednesday; ?> > Rabu <br>
						<input type="CheckBox" value="Thursday" name="hari4" <?php echo $thursday; ?> > Kamis <br>
						<input type="CheckBox" value="Friday" name="hari5" <?php echo $friday; ?> > Jumat <br>
						<input type="CheckBox" value="Saturday" name="hari6" <?php echo $saturday; ?> > Sabtu <br>
						<input type="CheckBox" value="Sunday" name="hari7" <?php echo $sunday; ?> > Minggu						
					</div>
				</div>			
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3">
						<p align="left">Syarat Dokumen</p>
					</label>
					<div class="col-xs-4">
						<textarea name="syarat" cols="33" rows="5" placeholder="Masukkan syarat dokumen disini"><?php echo $rcustomer['syarat']; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3" align="left">
						<p align="left">Pembayaran</p>
					</label>
					<div class="col-xs-4">
<?php
						$bayar1 = mysqli_query($con, "select * from promo_flat where kode='$rcustomer[kode]' and pembayaran like '%Cash%'");
						$nbayar1 = mysqli_num_rows($bayar1);
						if ($nbayar1>0){
							$cash = "checked='checked'";
						}
						else{
							$cash = "";
						}


						$bayar2 = mysqli_query($con, "select * from promo_flat where kode='$rcustomer[kode]' and pembayaran like '%EDC%'");
						$nbayar2 = mysqli_num_rows($bayar2);
						if ($nbayar2>0){
							$edc = "checked='checked'";
						}
						else{
							$edc = "";
						}

						?>
                    
						<input type="CheckBox" value="Cash" name="pembayaran1" <?php echo $cash; ?> > Cash <br>
						<input type="CheckBox" value="EDC" name="pembayaran2" <?php echo $edc; ?> > EDC <br>						
					</div>
				</div><input name="d15" class="btn btn-lg btn-danger" type="submit" id="d15" value="Generate">   
			</form>			
			</div>			