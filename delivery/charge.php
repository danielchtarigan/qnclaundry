<?php 
include 'head.php';

$id_delivery = $_GET['id'];

$sql = mysqli_query($con, "SELECT * FROM delivery WHERE id='$id_delivery' AND gateway='Jemput'");
$ndelivery = mysqli_num_rows($sql);
if($ndelivery>0) {
	?>
	<script type="text/javascript">
		window.location = "index.php";
	</script>

	<?php
}
else {
	?>
	<div class="tab-pane fade in active main" align="center">
			<h2>Charge Pengantaran Cucian</h2>
			<form class="form-horizontal" action="action/p_charge.php" method="POST">
				<input type="text" class="hidden" name="id" value="<?= $id_delivery ?>">
				<div class="form-group row">
					<label class="control-label col-xs-12 col-md-3" for="namapelangganantar">Nama Pelanggan</label>
					<div class="col-xs-12 col-md-7">
						<input type="text" autocomplete="off" class="form-control" name="namapelangganantar" name="nama_pelanggan" id="namapelangganantar" value="<?=$data['nama_customer']?>" required readonly="readonly"/>
					</div>
				</div>
				<div class="form-group row">
					<label class="control-label col-xs-12 col-md-3" for="alamatantar">Alamat Pengantaran</label>
					<div class="col-xs-12 col-md-7" align="left">
						<textarea class="form-control" name="alamatantar" id="alamatantar" required readonly=""><?=$data['alamat']?></textarea>
					</div>
				</div>
				<div class="form-group row" id="konf">
					<label class="control-label col-xs-12 col-md-3" for="">Apakah ada cuciannya yang dijemput?</label>
					<div class="col-xs-12 col-md-7" align="left">
						<input class="" type="radio" name="konfirmasi" value="ada" id="konfirmasi"> Ada <br>
						<input class="" type="radio" name="konfirmasi" value="tidak_ada" id="konfirmasi"> Tidak Ada
					</div>
				</div>
				<div class="form-group row" id="f_biaya">
					<label class="control-label col-xs-12 col-md-3" for="">Biaya Delivery</label>
					<div class="col-xs-12 col-md-7" align="left">
						<input class="form-control" type="number" name="biaya_delivery" value="0" id="biaya_delivery">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-xs-12">
						<input class="btn btn-block btn-primary submit-btn" type="submit" name="btn" value="Submit"/>
					</div>
				</div>
			</form>
		</div>

		</div>


		<script type="text/javascript">
			
			$('#konf').change(function(){
				var konfirmasi = $('#konfirmasi:checked').val();
				if(konfirmasi=="tidak_ada"){
					$('#biaya_delivery').val("7500");
				} else {
					$('#biaya_delivery').val("0");
				}
			});
			
		</script>


	<?php
}

?>

		