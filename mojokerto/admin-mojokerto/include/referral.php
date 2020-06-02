<h4><strong>Pengaturan Diskon Referral</strong></h4>
<?php
$qdiskref = mysqli_query($con, "SELECT value FROM settings WHERE name='diskon_referral'");
$diskon = mysqli_fetch_array($qdiskref)[0];
?>
			<div class="col-md-8 col-md-offset-0" >
			<form action="act/save_diskon_referral.php" method="get" class="form-horizontal">
				<br>
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3" style="text-align:left">
						Persen Diskon
					</label>
					<div class="col-xs-4">
						<input type="text" name="diskon" value="<?php echo $diskon; ?>">
					</div>
					%
				</div>
				<button type="submit" class="btn btn-default">Save</button>
			</form>
			</div>
			<div class="col-md-8 col-md-offset-0" >
			<form action="act/save_outlet_referral.php" method="get" class="form-horizontal">
				<br>
				<div class="form-group">
					<label for="no_nota" class="control-label col-xs-3" style="text-align:left">
						Outlet Diskon
					</label>
					<div class="col-xs-12">
					<?php
					$selectedoutlets = explode(";",mysqli_fetch_array(mysqli_query($con,"SELECT value FROM settings WHERE name='outlet_referral'"))[0]);
					$outlets = mysqli_query($con,"SELECT nama_outlet FROM outlet");
					while ($outlet = mysqli_fetch_assoc($outlets)) { ?>
						<input type="checkbox" name="outlet[]" value="<?php echo $outlet['nama_outlet']?>" <?php if (in_array($outlet['nama_outlet'],$selectedoutlets)) echo 'checked="checked"'; ?>> <?php echo $outlet['nama_outlet']; ?><br/>
					<?php } ?>
					<input type="checkbox" name="outlet[]" value="mojokerto" <?php if (in_array("mojokerto",$selectedoutlets)) echo 'checked="checked"'; ?>> mojokerto<br/>
				</div>
			</div>
				<button type="submit" class="btn btn-default">Save</button>
			</form>
			</div>
