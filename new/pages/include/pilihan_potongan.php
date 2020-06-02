
<p class="bolder blue col-md-12">Jika menggunakan nota manual, isi sesuai barcode nota manualnya</p>
	<div class="form-group">
		<div class="col-md-12 col-xs-12">
			<input class="form-control" type="text" name="" id="nota_order" placeholder="No Nota (Auto)">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-4">Item</label>
		<div class="col-md-6">
			<select class="form-control" id="item2">
				<?php 
				echo '<option>--Pilih Item--</option>';
				$order_tmp = mysqli_query($con, "SELECT * FROM order_potongan_tmp WHERE id_customer='$id' AND new_nota='' ORDER BY id DESC LIMIT 0,1");
				if(mysqli_num_rows($order_tmp)>0){
					$tmp = mysqli_fetch_assoc($order_tmp);

					$rkat = mysqli_query($con, "SELECT kategory FROM item_spk WHERE jenis_item='p' AND kategory<>'' AND nama_item='$tmp[item]' GROUP BY kategory ORDER BY kategory ASC");
				}
				else {
					$rkat = mysqli_query($con, "SELECT kategory FROM item_spk WHERE jenis_item='p' AND kategory<>'' GROUP BY kategory ORDER BY kategory ASC");
				}
				
				while($kat = mysqli_fetch_row($rkat)){
					switch ($kat[0]) {
						case '5':
							$katnew = "Bedding";
							break;

						case '6':
							$katnew = "Clothes";
							break;
						
						case '7':
							$katnew = "Doll";
							break;
						case '8':
							$katnew = "Gordyn";
							break;
						case '9':
							$katnew = "Karpet";
							break;
						default :
							$katnew = "Lain";
							break;
					}

					echo '<option disabled>'.$katnew.'</option>';
					$ritem = mysqli_query($con, "SELECT *FROM item_spk WHERE kategory='$kat[0]'");
					while($item = mysqli_fetch_assoc($ritem)){
						if($_SESSION['cabang']=="Mojokerto") {
							$harga = $item['harga_mjkt'];						
						} else if($_SESSION['cabang']=="Medan") {
							$harga = $item['harga_medan'];
						} else {
							$harga = $item['harga_jkt'];
						}


						if($status=="langganan"){
							$harga = $harga*0.8;
							echo '<option value="'.$item['nama_item'].'-'.$harga.'">&nbsp;&nbsp;&nbsp;&nbsp;'.$item['nama_item'].'</option>';
						} else if($status=="member") {
							$harga = $harga*0.8;
							echo '<option value="'.$item['nama_item'].'-'.$harga.'">&nbsp;&nbsp;&nbsp;&nbsp;'.$item['nama_item'].'</option>';
						} else {
							echo '<option value="'.$item['nama_item'].'-'.$harga.'">&nbsp;&nbsp;&nbsp;&nbsp;'.$item['nama_item'].'</option>';
						}
						
					}
				}
				?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-4">Harga</label>
		<div class="col-md-6">
			<input class="hidden" type="text" name="" id="it2">
			<input class="form-control" type="number" name="" id="harga2" placeholder="0">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-4">Jumlah</label>
		<div class="col-md-6">
			<input class="form-control" type="number" name="" id="jumlah2" value="1">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-4">Ket Item</label>
		<div class="col-md-6">
			<input class="form-control" type="text" name="" id="ket2" placeholder="keterangan item">
		</div>
	</div>
	<div class="form-group">
		<div class="col-md-6 col-md-offset-4">
			<input class="btn btn-sm btn-block btn-default" type="submit" name="" value="Save Item" id="save_item">
		</div>
	</div>


		