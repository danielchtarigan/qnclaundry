<?php
include 'akses.php';
?>
<div class=" panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Laporan Pembayaran</h3>
	</div>
	<div class="panel-body">
		<div>
			<table>
				<tr>
					<td>	
						<select class="form-control" id="supplier">
							<option>--Pilih Nama Supplier--</option>
							<?php 
							$query = mysqli_query($con, "SELECT DISTINCT nama_supplier FROM pemesanan ORDER BY nama_supplier ASC");
							while($row = mysqli_fetch_row($query)){ 
							echo '<option>'.$row[0].'</option>';
							}
							?>
						</select>				
					</td>
					<td>&nbsp; &nbsp;</td>
					<td>	
						<input class="form-control" type="text" id="start" name="" value="" placeholder="Tanggal Awal">						
					</td>
					<td>&nbsp;</td>
					<td>	
						<input class="form-control" type="text" id="end" name="" value="" placeholder="Tanggal Akhir">						
					</td>
					<td>&nbsp;</td>
					<td>
						<input class="btn btn-md btn-success" type="submit" name="" id="btn" value="Cari">					
					</td>
				</tr>
			</table>
		</div>

		<hr>
<!-- 	<div>
			<table class="table table-bordered table-condensed data-tabel">
				<thead>
					<tr>
						<th>Tanggal Order</th>
						<th>No Order</th>
						<th>Nama supplier</th>
						<th>Nama Item</th>
						<th>Quantity</th>
						<th>Tanggal Penerimaan Order</th>
						<th>Quantity Penerimaan</th>
						<th>Di terima Oleh</th>
						<th>Status Pembayaran</th>
						<th>Tanggal Pembayaran</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$query = mysqli_query($con, "SELECT a.tanggal_pesan AS tanggal_pesan, a.no_nota AS no_nota, a.nama_supplier AS nama_supplier, a.nama_item AS nama_item, a.quantity AS quantity, a.satuan AS satuan, b.tanggal_terima AS tanggal_terima, b.qty_terima AS qty_terima, b.satuan_terima AS satuan_terima, b.nama_penerima AS nama_penerima, a.lunas AS lunas, a.tanggal_lunas AS tanggal_lunas FROM pemesanan AS a LEFT JOIN penerimaan_bahan_baku AS b ON a.no_nota=b.no_pesanan");
					while($data = mysqli_fetch_array($query)){ ?>
					<tr>
						<td><?php echo $data['tanggal_pesan'] ?></td>
						<td><?php echo $data['no_nota'] ?></td>
						<td><?php echo $data['nama_supplier'] ?></td>
						<td><?php echo $data['nama_item'] ?></td>
						<td><?php echo $data['quantity'].' '.$data['satuan'] ?></td>
						<td><?php if($data['tanggal_terima']=='') echo "Belum"; else echo $data['tanggal_terima'] ?></td>
						<td><?php if($data['tanggal_terima']=='') echo "Belum"; else echo $data['qty_terima'].' '.$data['satuan_terima'] ?></td>
						<td><?php if($data['tanggal_terima']=='') echo "Belum"; else echo $data['nama_penerima'] ?></td>
						<td><?php if($data['lunas']==1) echo "Lunas"; else echo "Pending" ?></td>
						<td><?php if($data['lunas']==0) echo "Belum"; else echo $data['tanggal_lunas'] ?></td>
					</tr>
					<?php
					}

					?>
				</tbody>
			</table>
		</div> -->

		<div>
			<button id="cetak" class="btn pull-right btn-default">Cetak</button>
		</div>
		<div class="data-cetak" style="font-family: arial;">				
		</div>

	</div>
</div>



<script type="text/javascript">
	$('#btn').click(function(){
		var start = $('#start').val();
		var end = $('#end').val();
		var supplier = $('#supplier').val();
		$.ajax({
			url		: 'document/faktur_supplier.php',
			data 	: {supplier : supplier, start : start, end : end},
			success : function(data){
				$('.data-cetak').html(data);
			}
		})
	});

	(function($) {
    	$(document).ready(function(e) {
        	$("#cetak").bind("click", function(event) {
        		$('.data-cetak').printArea();
            });
        });
    }) (jQuery);
</script>
        