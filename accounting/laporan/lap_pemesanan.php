<?php
include 'akses.php';
?>
<div class=" panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Laporan Pemesanan Bahan Baku</h3>
	</div>
	<div class="panel-body">
		<div class="" style="overflow-x: auto; font-size: 8pt">
			<table class="table table-bordered table-condensed">
				<thead>
					<tr>
						<th>Tanggal Order</th>
						<th>No Order</th>
						<th>Nama Supplier</th>
						<th>Nama Item</th>
						<th>Harga</th>
						<th>Quantity</th>
						<th>Total</th>
						<th>Dipesan Oleh</th>
						<th>Diterima Oleh</th>
						<th>Qty Terima</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$query = mysqli_query($con, "SELECT a.tanggal_pesan AS tanggal, a.no_nota AS no_order, a.nama_supplier AS supplier, a.nama_item AS item, a.harga AS harga, a.quantity AS quantity, a.satuan AS satuan, a.nama_pemesan AS nama_pemesan, b.nama_penerima AS nama_penerima, b.qty_terima AS qty_terima FROM pemesanan AS a LEFT JOIN penerimaan_bahan_baku AS b ON a.no_nota=b.no_pesanan ORDER BY a.tanggal_pesan DESC");
					while($data = mysqli_fetch_array($query)){ ?>
					<tr>
						<td><?php echo $data['tanggal'] ?></td>
						<td><?php echo $data['no_order'] ?></td>
						<td><?php echo $data['supplier'] ?></td>
						<td><?php echo $data['item'] ?></td>
						<td style="text-align: right"><?php echo $data['harga'] ?></td>
						<td style="text-align: center"><?php echo $data['quantity'].' '.$data['satuan'] ?></td>
						<td style="text-align: right"><?php echo rupiah($data['harga']*$data['quantity']) ?></td>
						<td><?php echo $data['nama_pemesan'] ?></td>
						<td><?php if($data['nama_penerima']!='') echo $data['nama_penerima']; else echo "Belum" ?></td>
						<td style="text-align: center"><?php if($data['qty_terima']!='') echo $data['qty_terima']; else echo "-" ?></td>
						<td id="act">
							<button class="btn btn-xs btn-warning edit-pesanan" id="<?php echo $data['no_order'] ?>" data-toggle="modal" data-target=".diag-edit">Edit</button>
							<button class="btn btn-xs btn-danger remove-pesanan" id="<?php echo $data['no_order'] ?>" data-toggle="modal" data-target=".diag-edit">X</button>
						</td>
					</tr>
					<?php 
					}
					?>
				</tbody>
			</table>
		</div>

		<div class="modal fade diag-edit" tabindex="-1" role="dialog" aria-labelledby="">
	  		<div class="modal-dialog modal-xs" role="document">
		    	<div class="modal-content">
		      		<div class="panel-body">
						<div class="data-edit" align="center"></div>
					</div>	
		    	</div>
		  	</div>
		</div>

</div>		

<style type="text/css">
	#act{
		width :80px;
		text-align: center;
	}
</style>

<script type="text/javascript">
	$(document).ready(function(){
		$('.edit-pesanan').click(function(){
			var edit = "edit";
		    var id = $(this).attr("id");
			$.ajax({
				type 	: 'post',
			    url 	: 'edit_pesanan.php',
			    data 	: 'edit=' + edit + '&id='+ id,
			    success : function(data){
			    $('.data-edit').html(data);//menampilkan data ke dalam modal
			    }
			})
		});

		$('.remove-pesanan').click(function(){
			var hapus = "hapus";
		    var id = $(this).attr("id");
			$.ajax({
				type 	: 'post',
			    url 	: 'edit_pesanan.php',
			    data 	:  'hapus=' + hapus + '&id='+ id,
			    success : function(data){
			    $('.data-edit').html(data);//menampilkan data ke dalam modal
			    }
			})
		});
	})
</script>