<?php
include '../../config.php';


if($_GET['pembayaran']=="edc"){ ?>
	<label class="control-label col-md-5"> EDC Bank</label>
	<div class="col-md-7">
		<select class="form-control" placeholder="Click to Choose..." id="carabayar">
			<option></option>
			<option value="BCA">BCA</option>
			<option value="BNI">BNI</option>
			<option value="BRI">BRI</option>
			<option value="Mandiri">Mandiri</option>
			<option value="Mega">Mega</option>				
		</select>
	</div> <?php
}

else if($_GET['pembayaran']=="transfer"){ ?>
	<label class="control-label col-md-5"> Transfer Bank</label>
	<div class="col-md-7">
		<select class="form-control" placeholder="Click to Choose..." id="carabayar">
			<option></option>
			<option value="BCA_T">BCA</option>
			<option value="BNI_T">BNI</option>
			<option value="BRI_T">BRI</option>
			<option value="Mandiri_T">Mandiri</option>
			<option value="Mega_T">Mega</option>				
		</select>
	</div> <?php
} 


?>