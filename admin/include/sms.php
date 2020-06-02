<form action="act/save_sms.php" class="form-horizontal">
<?php
$qsmsantar = mysqli_query($con, "SELECT value FROM settings WHERE name='sms_antar_sukses'");
$smsantar = mysqli_fetch_array($qsmsantar)[0];
$qsmsjemput = mysqli_query($con, "SELECT value FROM settings WHERE name='sms_jemput_sukses'");
$smsjemput = mysqli_fetch_array($qsmsjemput)[0];
$qsmsantarjemputgagal = mysqli_query($con, "SELECT value FROM settings WHERE name='sms_antar_jemput_gagal'");
$smsantarjemputgagal = mysqli_fetch_array($qsmsantarjemputgagal)[0];
?>
<div class="col-md-8 col-xs-12" >
	<br>
	<div class="form-group">
		<label for="no_nota" class="control-label col-md-3 col-xs-12" >
			<p align="left">SMS Antar Sukses<br>
				<small style="font-weight:normal"><b>[NO_FAKTUR]</b> akan otomatis diganti dengan nomor faktur dan <b>[PENERIMA]</b> akan diganti dengan nama penerima</small>
			</p>
		</label>
		<div class="col-md-4 col-xs-12">
			<textarea name="sms_antar_sukses" id="sms_antar_sukses" cols="50" rows="10"><?php echo $smsantar; ?></textarea>
		</div>
	</div>
</div>
<div class="col-md-8 col-xs-12" >
	<br>
	<div class="form-group">
		<label for="no_nota" class="control-label col-md-3 col-xs-12" >
			<p align="left">SMS Jemput Sukses<br></p>
		</label>
		<div class="col-md-4 col-xs-12">
			<textarea name="sms_jemput_sukses" id="sms_jemput_sukses" cols="50" rows="10"><?php echo $smsjemput; ?></textarea>
		</div>
	</div>
</div>
<div class="col-md-8 col-xs-12" >
	<br>
	<div class="form-group">
		<label for="no_nota" class="control-label col-md-3 col-xs-12" >
			<p align="left">SMS Antar Jemput Gagal<br>
				<small style="font-weight:normal"><b>[JENIS_PERMINTAAN]</b> akan otomatis diganti dengan jenis permintaan dan <b>[ALASAN]</b> akan diganti dengan alasan kegagalan</small>
			</p>
		</label>
		<div class="col-md-4 col-xs-12">
			<textarea name="sms_antarjemput_gagal" id="sms_antarjemput_gagal" cols="50" rows="10"><?php echo $smsantarjemputgagal; ?></textarea>
		</div>
	</div>
</div>
<?php
$qsmscucianselesai = mysqli_query($con, "SELECT value FROM settings WHERE name='sms_cucian_selesai'");
$smscucianselesai = mysqli_fetch_array($qsmscucianselesai)[0];
$qsmscucianselesaidelivery = mysqli_query($con, "SELECT value FROM settings WHERE name='sms_cucian_selesai_delivery'");
$smscucianselesaidelivery = mysqli_fetch_array($qsmscucianselesaidelivery)[0];
?>
<div class="col-md-8 col-xs-12" >
	<br>
	<div class="form-group">
		<label for="no_nota" class="control-label col-md-3 col-xs-12" >
			<p align="left">SMS Cucian Selesai (Belum Memesan Delivery)<br>
				<small style="font-weight:normal"><b>[NO_FAKTUR]</b> akan otomatis diganti dengan no. faktur dari cucian</small>
			</p>
		</label>
		<div class="col-md-4 col-xs-12">
			<textarea name="sms_cucian_selesai_delivery" id="sms_cucian_selesai_delivery" cols="50" rows="10"><?php echo $smscucianselesaidelivery; ?></textarea>
		</div>
	</div>
</div>
<div class="col-md-8 col-xs-12" >
	<br>
	<div class="form-group">
		<label for="no_nota" class="control-label col-md-3 col-xs-12" >
			<p align="left">SMS Cucian Selesai (Sudah Memesan Delivery)<br>
				<small style="font-weight:normal"><b>[NO_FAKTUR]</b> akan otomatis diganti dengan no. faktur dari cucian</small>
			</p>
		</label>
		<div class="col-md-4 col-xs-12">
			<textarea name="sms_cucian_selesai" id="sms_cucian_selesai" cols="50" rows="10"><?php echo $smscucianselesai; ?></textarea>
		</div>
	</div>
</div>
<?php
$qsmsreferral = mysqli_query($con, "SELECT value FROM settings WHERE name='sms_referral'");
$smsreferral = mysqli_fetch_array($qsmsreferral)[0];
?>
<div class="col-md-8 col-xs-12" >
	<br>
	<div class="form-group">
		<label for="no_nota" class="control-label col-md-3 col-xs-12" >
			<p align="left">SMS Referral<br>
				<small style="font-weight:normal"><b>[KODE]</b> akan otomatis diganti dengan kode referral dan <b>[DISKON]</b> akan diganti dengan persentase diskon</small>
			</p>
		</label>
		<div class="col-md-4 col-xs-12">
			<textarea name="sms_referral" id="sms_referral" cols="50" rows="10"><?php echo $smsreferral; ?></textarea>
		</div>
	</div>
	
</div>
<?php
$qremindDeposit = mysqli_query($con, "SELECT value FROM settings WHERE name='sms_reminder_deposit'");
$remindDeposit = mysqli_fetch_array($qremindDeposit)[0];
?>
<div class="col-md-8 col-xs-12" >
	<br>
	<div class="form-group">
		<label for="no_nota" class="control-label col-md-3 col-xs-12" >
			<p align="left">SMS Reminder Deposit<br>
			
			</p>
		</label>
		<div class="col-md-4 col-xs-12">
			<textarea name="sms_rd" id="sms_rd" cols="50" rows="10"><?php echo $remindDeposit; ?></textarea>
		</div>
	</div>
	<button type="submit" class="btn btn-default">Save All SMS</button>
</div>


</form>
