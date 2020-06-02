<?php 
$date = date('Y-m-d');



?>	
<div class=" panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Pengeluaran Pety Cash</h3>
	</div>
	<div class="panel-body">
			<div class="hapus-item"></div>
		<div class="row">
			<form id="formUpload" method="POST" action="action/simpan_pengeluaran.php">
				<div class="col-md-4 order" align="right">
					<table>
						<tr>
							<td><label class="" for="tanggal">Tanggal</label></td>
							<td>:</td>
							<td>&nbsp;</td>
							<td><input class="form-control" type="text" name="tanggal" id="tanggal" value="<?php echo date('d/m/Y H:i:s') ?>" readonly></td>
						</tr>
						<tr>
							<td><label class="" for="tanggal">Nomor</label></td>
							<td>:</td>
							<td>&nbsp;</td>
							<?php 
							$query = mysqli_query($con, "SELECT MAX(nomor) AS nomor FROM pengeluaran_pety_cash");
							$row = mysqli_fetch_row($query);
							$lastNoUrut = (int)substr($row[0], 5, 6);
							$no_nota = 'PLC'.sprintf('%08s', $lastNoUrut+1);
							?>
							<td><input class="form-control" type="text" name="nomor" id="nomor" value="<?php echo $no_nota ?>" readonly></td>
						</tr>
						<tr>
							<td><label class="" for="tanggal">Penerima</label></td>
							<td>:</td>
							<td>&nbsp;</td>
							<td>
	      						<select class="form-control" id="karyawan" name="karyawan">
									<option>--Nama Karyawan--</option>
									<option>Akbar</option>
									<option>Rusman</option>
									<option>Ari</option>
									<?php 
									$query = mysqli_query($conn, "SELECT name FROM user WHERE aktif='Ya'");
									while($row = mysqli_fetch_assoc($query)){ ?>
									<option><?php echo $row['name'] ?></option> <?php
									}
									?>
								</select>								
							</td>
						</tr>
						<tr>
							<td><label class="" for="tanggal">Item</label></td>
							<td>:</td>
							<td>&nbsp;</td>
							<td>
	      						<input class="form-control" type="text" name="item" id="item" placeholder="Nama Barang">								
							</td>
						</tr>
						<tr>
							<td><label class="" for="harga">Harga</label></td>
							<td>:</td>
							<td>&nbsp;</td>
							<td>
								<div class="input-group">
									<div class="input-group-addon">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Rp</div>
		      						<input type="number" class="form-control" id="harga" name="harga" placeholder="" value="0">
								</div>	      						
							</td>
						</tr>
						<tr>
							<td><label for="quantity">Quantity</label></td>
							<td>:</td>
							<td>&nbsp;</td>
							<td>
								<div class="input-group my-group">
									<input class="form-control" type="number" name="quantity" id="quantity" value="">
									<select class="form-control" name="satuan" id="satuan">
										<option>--Satuan--</option>
										<option>Pcs</option>
										<option>Gln</option>
										<option>Ltr</option>
										<option>Kg</option>
										<option>Blk</option>
										<option>Lbr</option>
										<option>Psg</option>
									</select>	
								</div>
							</td>
						</tr>
						<tr>
							<td><label for="total">Total</label></td>
							<td>:</td>
							<td>&nbsp;</td>
							<td>
								<div class="input-group">
	      							<div class="input-group-addon">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Rp</div>
	      							<input type="text" class="form-control" id="total" name="total" placeholder="" readonly="">
	    						</div>
	    					</td>
						</tr>
						<tr>
							<td colspan="4"><textarea class="form-control" type="text" id="ket" name="ket" placeholder="Keterangan (optional)"></textarea></td>
						</tr>
						<tr>
							<td><label for="total">Nota</label></td>
							<td>:</td>
							<td>&nbsp;</td>
							<td>
								<input class="form-control" type="file" name="gbr_nota" id="gbr_nota" required="true">
	    					</td>
						</tr>
						<tr>
							<td colspan="4"><input class="btn btn-primary" type="submit" name="submit" id="submit" name="submit" value="Go!!"></td>
						</tr>
					</table>
				</div>
			</form>
				
			<div class="col-md-7 col-xs-12 rincian" style="overflow-x: auto">
				<table class="table table-bordered table-condensed table-hover" style="font-size: 7pt">
					<thead>
						<tr>
							<th>Tanggal</th>
							<th>Nomor</th>
							<th>Nota</th>
							<th>Penerima</th>
							<th>Nama Barang</th>
							<th>Harga</th>
							<th>Quantity</th>
							<th>Total</th>
						</tr>
					</thead>
					<tbody class="tampilkan">
						<?php 
						$query = mysqli_query($con, "SELECT *FROM pengeluaran_pety_cash WHERE tanggal LIKE '%$date%' ORDER BY tanggal DESC");
						while($row = mysqli_fetch_assoc($query)){ ?>
						<tr>
							<td align="center"><?php echo date('d/m/Y H:i:s', strtotime($row['tanggal'])) ?></td>
							<td><?php echo $row['nomor'] ?></td>
							<td><?php echo '<a href="doc/image/'.$row['nota'].'">'.$row['nota'].'</a>' ?></td>
							<td><?php echo $row['pay_to'] ?></td>
							<td><?php echo $row['nama_barang'] ?></td>
							<td><?php echo $row['harga'] ?></td>
							<td><?php echo $row['quantity'].' '. $row['satuan'] ?></td>
							<td><?php echo $row['harga']*$row['quantity'] ?></td>
						</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>

		</div>
	</div>
</div>

<style type="text/css">
.my-group .form-control{
    width:50%;
}
</style>


<script type="text/javascript">
	$("#quantity").keyup(function(){
		var harga = $("#harga").val();
		var qty = $("#quantity").val();
		var total = parseInt(harga)*parseInt(qty);
		$("#total").val(total);
	});


	$("#formUpload").on('submit',function(e){
		e.preventDefault();
		var gambar = new FormData(this);
		$.ajax({
			type	: 'POST',
			url		: 'action/simpan_pengeluaran.php',
			data	: gambar,
			contentType: false,
    	    cache: false,
			processData:false,
			success	: function(data){
				$(".tampilkan").html(data);
			}
		})
	});
		
</script>
