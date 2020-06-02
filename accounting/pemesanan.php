<?php 
include 'akses.php';
$date = date('Y-m-d');

?>	
<div class=" panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Pemesanan</h3>
	</div>
	<div class="panel-body">
			<div class="hapus-item"></div>
		<div class="row">
			<div class="col-md-4 order" align="right">
				<table>
					<tr>
						<td><label class="" for="tanggal">Tanggal</label></td>
						<td>:</td>
						<td>&nbsp;</td>
						<td colspan="2"><input class="form-control" type="text" name="" value="<?php echo date('d/m/Y H:i:s') ?>" readonly></td>
					</tr>
					<tr>
						<td><label class="" for="tanggal">No. Order</label></td>
						<td>:</td>
						<td>&nbsp;</td>
						<?php 
						$query = mysqli_query($con, "SELECT MAX(no_nota) AS nota FROM pemesanan");
						$row = mysqli_fetch_row($query);
						$lastNoUrut = (int)substr($row[0], 5, 6);
						$no_nota = 'PO'.sprintf('%08s', $lastNoUrut+1);
						?>
						<td colspan="2"><input class="form-control" type="text" name="no_nota" id="no_nota" value="<?php echo $no_nota ?>" readonly></td>
					</tr>
					<tr>
						<td><label class="" for="tanggal">Supplier</label></td>
						<td>:</td>
						<td>&nbsp;</td>
						<td colspan="2">
      						<select class="form-control" id="nama_supplier">
								<option>--Pilih Nama Supplier--</option>
								<?php 
								$query = mysqli_query($con, "SELECT nama_supplier FROM supplier");
								while($row = mysqli_fetch_assoc($query)){ ?>
								<option><?php echo $row['nama_supplier'] ?></option> <?php
								}
								?>
							</select>								
						</td>
					</tr>
					<tr>
						<td><label class="" for="tanggal">Nama Item</label></td>
						<td>:</td>
						<td>&nbsp;</td>
						<td colspan="2">
      						<select class="form-control" id="item">
								<option>--Pilih Nama Item--</option>
								<?php 
								$query = mysqli_query($con, "SELECT nama_item FROM item_bahan_baku");
								while($row = mysqli_fetch_assoc($query)){ ?>
								<option><?php echo $row['nama_item'] ?></option> <?php
								}
								?>
							</select>								
						</td>
					</tr>
					<tr>
						<td><label class="" for="harga">Harga</label></td>
						<td>:</td>
						<td>&nbsp;</td>
						<td colspan="2">
							<div class="input-group">
								<div class="input-group-addon">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Rp</div>
	      						<input type="number" class="form-control" id="harga" placeholder="" value="0">
							</div>	      						
						</td>
					</tr>
					<tr>
						<td><label for="quantity">Quantity</label></td>
						<td>:</td>
						<td>&nbsp;</td>
						<td><input class="form-control" type="number" name="quantity" id="quantity" value="0"></td>
						<td>
							<select class="form-control" style="font-style: oblique;" id="satuan">
								<option>Ltr</option>
								<option>Kg</option>
								<option>Blk</option>
								<option>Gln</option>
								<option>Pcs</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><label for="total">Total</label></td>
						<td>:</td>
						<td>&nbsp;</td>
						<td colspan="3">
							<div class="input-group">
      							<div class="input-group-addon">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Rp</div>
      							<input type="text" class="form-control" id="total" placeholder="" readonly="">
    						</div>
    					</td>
					</tr>
					<tr>
						<td colspan="5"><textarea class="form-control" placeholder="Keterangan (optional)"></textarea></td>
					</tr>
					<tr>
						<td colspan="5"><input class="btn btn-primary" type="submit" name="submit" id="submit" value="Pesan Sekarang"></td>
					</tr>
				</table>
			</div>
			<div class="col-md-7 col-xs-12 rincian" style="overflow-x: auto">
				<table class="table table-bordered table-condensed table-hover" style="font-size: 9pt">
					<thead>
						<tr>
							<th>Tanggal</th>
							<th>No Order</th>
							<th>supplier</th>
							<th>Nama Item</th>
							<th>Harga</th>
							<th>Quantity</th>
							<th>Total</th>
							<th>Hapus</th>
						</tr>
					</thead>
					<tbody class="tampilkan">
						<?php 
						$query = mysqli_query($con, "SELECT *FROM pemesanan WHERE tanggal_pesan LIKE '%$date%' AND lunas=false ORDER BY tanggal_pesan DESC");
						while($row = mysqli_fetch_assoc($query)){ ?>
						<tr>
							<td align="center"><?php echo $row['tanggal_pesan'] ?></td>
							<td><?php echo $row['no_nota'] ?></td>
							<td><?php echo $row['nama_supplier'] ?></td>
							<td><?php echo $row['nama_item'] ?></td>
							<td><?php echo $row['harga'] ?></td>
							<td><?php echo $row['quantity'].' '. $row['satuan'] ?></td>
							<td><?php echo $row['harga']*$row['quantity'] ?></td>
							<td align="center">
								<button class="btn btn-xs btn-danger remove-data" id="<?php echo $row['no_nota'] ?>">X</button>				
							</td>
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




<script type="text/javascript">
	$("#quantity").keyup(function(){
		var harga = $("#harga").val();
		var qty = $("#quantity").val();
		var total = parseInt(harga)*parseInt(qty);
		$("#total").val(total);
	});

	$("#submit").click(function(){
		var tanggal = $("#tanggal").val();
		var nota = $("#no_nota").val();
		var supplier = $("#nama_supplier").val();
		var item = $("#item").val();
		var harga = $("#harga").val();
		var quantity = $("#quantity").val();
		var satuan = $("#satuan").val();
		$.ajax({
			type	: 'POST',
			url		: 'action/simpan_pesanan.php',
			data	: {tanggal : tanggal, nota : nota, supplier : supplier, item : item, harga : harga, quantity : quantity, satuan : satuan},
			success	: function(data){
				$(".tampilkan").html(data);
			}
		})
	});

	$('.remove-data').click(function(){
	    var id = $(this).attr("id");
		$.ajax({
			type : 'post',
		    url : 'action/hapus_pesanan.php',
		    data :  'id='+ id,
		    success : function(data){
		    $('.hapus-item').html(data);//menampilkan data ke dalam modal
		    }
		})
	});

	
		
</script>
