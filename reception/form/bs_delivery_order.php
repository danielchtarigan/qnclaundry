<div class="popup-wrapper" id="popupdelivery">
	<div class="popup-container">
		<label class="control-label col-xs-12">
			Pilih Delivery
		</label>
			<input type="button" class="btn btn-success" value="Diantar" style="width:32%; background-color:#FFF; color:#6C0" onclick="deliveryform()" id ="tombol-delivery">
			<a href="act/delete_delivery.php?id=<?php echo $id ?>" class="popup-link">
			<input type="button" class="btn btn-success btpotongan" value="Ambil Sendiri" style="width:32%; background-color:#FFF; color:#6C0"/>
			</a>
			<form method="GET" action="act/act_delivery.php" id="form-delivery" style="display:none">
				<hr>
					<input type="hidden" name="id_customer" value="<?php echo $id; ?>">
					<input type="hidden" name="nama_customer" value="<?php echo $rcustomer1['nama_customer'] ?>">
          <div class="form-group">
						<label class="control-label col-xs-12" for="no_telp_antar">
								No. Telepon (CP Pengantaran)
						</label>
						<input class="form-control" type="text" name="no_telp_antar" value="<?= $delivery!=null ? $delivery['no_telp'] : $rcustomer1['no_telp'] ?>" required/>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-12" for="alamat_antar">
								Alamat Pengantaran (isi dengan alamat lengkap)
						</label>
						<textarea class="form-control" rows="3" name="alamat_antar" required><?= $delivery!=null ? $delivery['alamat'] : $rcustomer1['alamat'] ?></textarea>
          </div>
					<div class="form-group">
						<label class="control-label col-xs-12" for="tanggal_antar">
								Tanggal Pengantaran
						</label>
						<input type="text" autocomplete="off" class="form-control" name="tanggal_antar" id="tglantar" value="<?php if ($delivery!=null) echo $delivery['tgl_permintaan']; else if ($express) echo date('d/m/Y', strtotime('+1 day')); else echo date('d/m/Y', strtotime('+3 days')); ?>" required/>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-12" for="waktu_antar">Waktu Pengantaran</label>
							<select class="form-control" name="waktu_antar">
								<?php if ($delivery!=null) $waktu = $delivery['waktu_permintaan']; else $waktu=null?>
								<option value="Bebas" <?=$waktu == null||"Bebas" ? 'selected="selected"' : '';?>>Bebas</option>
								<option value="Pagi" <?=$waktu == "Pagi" ? 'selected="selected"' : '';?>>Pagi (09.00 - 12.00)</option>
								<option value="Siang" <?=$waktu == "Siang" ? 'selected="selected"' : '';?>>Siang (12.00 - 15.00)</option>
								<option value="Sore" <?=$waktu == "Sore" ? 'selected="selected"' : '';?>>Sore (15.00 - 18.00)</option>
								<option value="Malam" <?=$waktu == "Malam" ? 'selected="selected"' : '';?>>Malam (18.00 - 21.00)</option>
							</select>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-12" for="catatan">
								Catatan Pengantaran (Opsional)
						</label>
						<textarea class="form-control" rows="3" name="catatan"><?= $delivery!=null ? $delivery['catatan'] : '' ?></textarea>
          </div>
          <input type="submit" class="btn btn-success" value="Lanjut" style="width:49%; background-color:#FFF; color:#6C0;"/>
			</form><br />
			<a class="popup-close" href="#" onclick="closedeliverypopup()"><img src="back.png" />
			</a><br/>
    </div>
</div>