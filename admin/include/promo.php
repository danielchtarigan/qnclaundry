<?php
$qcustomer = mysqli_query($con, "select * from kode_promo where kode='$_GET[kode]'");
$rcustomer = mysqli_fetch_array($qcustomer);
?>
			<div class="col-md-8 col-md-offset-0" >
			<form  action="p_kode_promo.php" method="post" class="form-horizontal">
				<br>
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3" >
						<p align="left">Kode Promo</p>
					</label>
					<div class="col-xs-4">
						<input type="text" value="<?php echo $rcustomer['kode']; ?>" id="kode" name="kode" placeholder='MHS50' class="form-control" required="required">
					</div>
				</div>
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3" >
						<p align="left"> Kategori </p>
					</label>
					<div class="col-xs-4">
					    <select name="kategori" id="kategori" name="kategori" class="form-control">
                        <?php if ($rcustomer['kategori']<>''){
							echo "<option value=$rcustomer[kategori]>$rcustomer[kategori]</option>";
							} ?>
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
						<p align="left">Diskon</p>
					</label>
					<div class="col-xs-4">
						<input type="text" value="<?php echo $rcustomer['diskon']; ?>" id="diskon" name="diskon" placeholder='Persentase (exp. 50)' class="form-control" required="required">
					</div>
				</div>
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3" align="left">
						<p align="left">Minimum Transaksi</p>
					</label>
					<div class="col-xs-4">
						<input type="text" id="minimum_transaksi" name="minimum_transaksi" class="form-control"  value="<?php echo $rcustomer['minimum_transaksi']; ?>" placeholder="0" required="required">
					</div>
				</div>
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3" align="left">
						<p align="left">Maksimum Transaksi</p>
					</label>
					<div class="col-xs-4">
						<input type="text" id="maksimum_transaksi" name="maksimum_transaksi" class="form-control"  value="<?php echo $rcustomer['maksimum_transaksi']; ?>" placeholder="0" required="required">
					</div>
				</div>
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3" align="left">
						<p align="left">Hari</p>
					</label>
					<div class="col-xs-4">
                        <?php 
						$hari1 = mysqli_query($con, "select * from kode_promo where kode='$rcustomer[kode]' and hari like '%Monday%'");
						$nhari1 = mysqli_num_rows($hari1);
						if ($nhari1>0){
							$monday = "checked='checked'";
						}
						else{
							$monday = "";
							}

						$hari2 = mysqli_query($con, "select * from kode_promo where kode='$rcustomer[kode]' and hari like '%Tuesday%'");
						$nhari2 = mysqli_num_rows($hari2);
						if ($nhari2>0){
							$tuesday = "checked='checked'";
						}
						else{
							$tuesday = "";
							}

						$hari3 = mysqli_query($con, "select * from kode_promo where kode='$rcustomer[kode]' and hari like '%Wednesday%'");
						$nhari3 = mysqli_num_rows($hari3);
						if ($nhari3>0){
							$wednesday = "checked='checked'";
						}
						else{
							$wednesday = "";
							}

						$hari4 = mysqli_query($con, "select * from kode_promo where kode='$rcustomer[kode]' and hari like '%Thursday%'");
						$nhari4 = mysqli_num_rows($hari4);
						if ($nhari4>0){
							$thursday = "checked='checked'";
						}
						else{
							$thursday = "";
							}

						$hari5 = mysqli_query($con, "select * from kode_promo where kode='$rcustomer[kode]' and hari like '%Friday%'");
						$nhari5 = mysqli_num_rows($hari5);
						if ($nhari5>0){
							$friday = "checked='checked'";
						}
						else{
							$friday = "";
							}

						$hari6 = mysqli_query($con, "select * from kode_promo where kode='$rcustomer[kode]' and hari like '%Saturday%'");
						$nhari6 = mysqli_num_rows($hari6);
						if ($nhari6>0){
							$saturday = "checked='checked'";
						}
						else{
							$saturday = "";
							}

						$hari7 = mysqli_query($con, "select * from kode_promo where kode='$rcustomer[kode]' and hari like '%Sunday%'");
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
					<label class="control-label col-xs-3"><p align="left">Jam Penggunaan</p></label>
					<div class="col-xs-5">
					    <?php 
					    $qjam = $con->query("SELECT * FROM kode_promo WHERE kode='$_GET[kode]'");
					    $djam = $qjam->fetch_array();
					    ?>
						<div class="input-group">
							<select  class="form-control" name="jam1" id="jam2" required="true">
							    <?php
							    if(mysqli_num_rows($qjam)>0) {
							        echo '<option value="'.date('H:i', strtotime($djam['jam_mulai'])).'">'.date('H:i', strtotime($djam['jam_mulai'])).'</option>';
							    }
							    ?>
							    
								<option value="09:00">09:00</option>
								<option value="11:00">11:00</option>
								<option value="13:00">13:00</option>
								<option value="15:00">15:00</option>
								<option value="17:00">17:00</option>
								<option value="19:00">19:00</option>
								<option value="21:00">21:00</option>
							</select>
							<div class="input-group-addon">Sampai</div>
							<select  class="form-control" name="jam2" id="jam2" required="true">
							    <?php
							    if(mysqli_num_rows($qjam)>0) {
							        echo '<option value="'.date('H:i', strtotime($djam['jam_berakhir'])).'">'.date('H:i', strtotime($djam['jam_berakhir'])).'</option>';
							    }
							    ?>
								<option value="09:00">09:00</option>
								<option value="11:00">11:00</option>
								<option value="13:00">13:00</option>
								<option value="15:00">15:00</option>
								<option value="17:00">17:00</option>
								<option value="19:00">19:00</option>
								<option value="21:00">21:00</option>
							</select>
						</div>
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
						$bayar1 = mysqli_query($con, "select * from kode_promo where kode='$rcustomer[kode]' and pembayaran like '%Cash%'");
						$nbayar1 = mysqli_num_rows($bayar1);
						if ($nbayar1>0){
							$cash = "checked='checked'";
						}
						else{
							$cash = "";
						}


						$bayar2 = mysqli_query($con, "select * from kode_promo where kode='$rcustomer[kode]' and pembayaran like '%EDC%'");
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


