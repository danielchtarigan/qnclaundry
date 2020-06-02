<?php 
include '../config.php';

$query = mysqli_query($con, "SELECT value FROM settings WHERE name='aktivasi_mahasiswa'");
$data = mysqli_fetch_row($query);

$query2 = mysqli_query($con, "SELECT value FROM settings WHERE name='update_kuota_mahasiswa'");
$data2 = mysqli_fetch_row($query2);

?>


<div class="panel panel-default">
	<div class="panel-body">
		<div><legend align="center">Control</legend></div>
		<div>
			<ul class="nav nav-tabs">
				<li class="nav-item active" role="presentation"><a class="nav-link active" role="tab" data-toggle="tab" href="#info"><strong>Info</strong></a></li>	
				<li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-toggle="tab" href="#sms"><strong>SMS Aktivasi</strong></a></li>
				<li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-toggle="tab" href="#sms2"><strong>SMS Update Mingguan</strong></a></li>
			</ul>

		<div class="tab-content">
			
			<div id="sms" role="tabpanel" class="tab-pane">
				<br>			
				<form class="form-horizontal" action="act/setting_mahasiswa.php">
					<div class="form-group">
						<div class="col-md-8 col-md-offset-2"><textarea class="form-control" rows="5" name="sms_aktivasi"><?php echo $data[0] ?></textarea></div>
					</div>
					<div class="form-group">
						<div class="col-md-8 col-md-offset-2">
							<input class="btn btn-md btn-default" type="submit" name="simpan" value="Ubah">
						</div></div>
				</form>
			</div>

			<div id="info" role="tabpanel" class="tab-pane active">	
				<br>			
				<p>Nomor Kartu Mahasiswa berfungsi sebagai kode promo, Scan atau masukkan <strong>nomor kartu</strong> ke kolom kode voucher pada saat order dibuat.</p>
				<p>Member mahasiswa dengan masa aktif 1 minggu :
					<li>Laundry Kiloan flat Rp6.600/Kg, minimal transaksi 3Kg dengan kuota 6kg Perminggu</li>
					<li>Laundry Potongan Diskon 25%, tanpa syarat</li>
				</p>				
			</div>	

			<div id="sms2" role="tabpanel" class="tab-pane">
				<br>			
				<form class="form-horizontal" action="act/setting_mahasiswa.php">
					<div class="form-group">
						<div class="col-md-8 col-md-offset-2"><textarea class="form-control" rows="5" name="sms_mingguan"><?php echo $data2[0] ?></textarea></div>
					</div>
					<div class="form-group">
						<div class="col-md-8 col-md-offset-2">
							<input class="btn btn-md btn-default" type="submit" name="simpan" value="Ubah">
						</div></div>
				</form>
			</div>	
		</div>
	</div>

</div>