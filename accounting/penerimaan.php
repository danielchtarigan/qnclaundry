<?php 
$date = date('Y-m-d');


?>	
<div class=" panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Penerimaan Bahan Baku</h3>
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
						<td><label class="" for="tanggal">Nomor</label></td>
						<td>:</td>
						<td>&nbsp;</td>
						<?php 
						$query = mysqli_query($con, "SELECT MAX(no_penerimaan) AS nomor FROM penerimaan_bahan_baku");
						$row = mysqli_fetch_row($query);
						$lastNoUrut = (int)substr($row[0], 5, 6);
						$no_nota = 'AO'.sprintf('%08s', $lastNoUrut+1);
						?>
						<td colspan="2"><input class="form-control" type="text" name="nomor" id="nomor" value="<?php echo $no_nota ?>" readonly></td>
					</tr>
					<tr>
						<td><label class="" for="tanggal">supplier</label></td>
						<td>:</td>
						<td>&nbsp;</td>
						<td colspan="2">
      						<select class="form-control" id="nama_supplier">
								<option>--Pilih Nama Supplier--</option>
								<?php 								
								$query = mysqli_query($con, "SELECT DISTINCT nama_supplier FROM pemesanan");
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
							</select>								
						</td>
					</tr>
					<tr>
						<td><label for="quantity">Qty Terima</label></td>
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
						<td colspan="5"><textarea class="form-control" placeholder="Keterangan (optional)"></textarea></td>
					</tr>
					<tr>
						<td colspan="5"><input class="btn btn-primary" type="submit" name="submit" id="submit" value="Pesan diterima"></td>
					</tr>
				</table>
			</div>
			<div class="col-md-7 col-xs-12 rincian" style="overflow-x: auto">
				<table class="table table-bordered table-condensed table-hover" style="font-size: 9pt">
					<thead>
						<tr>
							<th>Tanggal</th>
							<th>Nomor</th>
							<th>supplier</th>
							<th>Nama Item</th>
							<th>Qty Terima</th>
							<th>Qty Order</th>
							<th>Hapus</th>
						</tr>
					</thead>
					<tbody class="tampilkan">
						<?php 
						$query = mysqli_query($con, "SELECT * FROM penerimaan_bahan_baku AS a INNER JOIN pemesanan AS b ON a.no_pesanan=b.no_nota WHERE a.tanggal_terima LIKE '%$date%' ORDER BY a.tanggal_terima DESC");
						while($row = mysqli_fetch_assoc($query)){ ?>
						<tr>
							<td align="center"><?php echo $row['tanggal_terima'] ?></td>
							<td><?php echo $row['no_penerimaan'] ?></td>
							<td><?php echo $row['nama_supplier'] ?></td>
							<td><?php echo $row['nama_item'] ?></td>
							<td><?php echo $row['qty_terima'].' '.$row['satuan_terima'] ?></td>
							<td><?php echo $row['quantity'].' '.$row['satuan'] ?></td>
							<td align="center">
								<button class="btn btn-xs btn-danger remove-data" id="<?php echo $row['no_penerimaan'] ?>">X</button>				
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

	$('#nama_supplier').change(function(){
		var supplier = $('#nama_supplier').val();
		$.ajax({
			url		: 'action/penerimaan.php',
			data	: 'supplier=' + supplier,
			success	: function(data){
				$('#item').html(data);
			}
		})
	});

	$('#item').change(function(){
		var item = $('#item').val();
		$.ajax({
			url		: 'action/penerimaan.php',
			data	: 'item=' + item,
			success	: function(data){
				$('#harga').val(data);
			}
		})
	});

	$("#submit").click(function(){
		var tanggal = $("#tanggal").val();
		var nomor = $("#nomor").val();
		var supplier = $("#nama_supplier").val();
		var item = $("#item").val();
		var harga = $("#harga").val();
		var quantity = $("#quantity").val();
		var satuan = $("#satuan").val();
		$.ajax({
			type	: 'POST',
			url		: 'action/simpan_penerimaan.php',
			data	: {tanggal : tanggal, nomor : nomor, supplier : supplier, item : item, harga : harga, quantity : quantity, satuan : satuan},
			success	: function(data){
				$(".tampilkan").html(data);
			}
		})
	});

	$('.remove-data').click(function(){
	    var id = $(this).attr("id");
		$.ajax({
			type : 'post',
		    url : 'action/penerimaan.php',
		    data :  'id='+ id,
		    success : function(data){
		    $('.hapus-item').html(data);//menampilkan data ke dalam modal
		    }
		})
	});

	
		
</script>
