<?php 
include 'akses.php';
$date = date('Y-m-d');

?>	
<div class=" panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Pembayaran Tagihan supplier</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12 col-xs-12" align="right" style="overflow-x: auto">
				<table class="table table-condensed table-bordered" style="font-size: 11px">
					<thead>
						<tr>
							<th>Tanggal Order</th>
							<th>No Order</th>
							<th>Nama Supplier</th>
							<th>Item Order</th>
							<th>Harga Satuan</th>
							<th>Qty Order</th>
							<th>Tanggal Terima</th>
							<th>Qty Terima</th>
							<th>Total</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$query = mysqli_query($con, "SELECT * FROM pemesanan");
						while($row = mysqli_fetch_array($query)){ ?>
						<tr>
							<td><?php echo $row['tanggal_pesan'] ?></td>
							<td><?php echo $row['no_nota'] ?></td>
							<td><?php echo $row['nama_supplier'] ?></td>
							<td><?php echo $row['nama_item'] ?></td>
							<td><?php echo rupiah($row['harga']) ?></td>
							<td><?php echo $row['quantity'].' '.$row['satuan'] ?></td>
							<?php 
							$qterima = mysqli_query($con, "SELECT *FROM penerimaan_bahan_baku WHERE no_pesanan='$row[no_nota]'");
							$terima = mysqli_fetch_array($qterima);
							if(mysqli_num_rows($qterima)>0){ ?>
								<td><?php echo $terima['tanggal_terima']; ?></td>
								<td><?php echo $terima['qty_terima'].' '.$terima['satuan_terima'] ?></td> <?php
							} else{ ?>
								<td>Belum Diterima</td>
								<td>Belum Diterima</td> <?php
							}
							?>								
							<td><?php echo rupiah($row['harga']*$row['quantity']) ?></td>
							<td align="center">
								<?php 
								if($row['lunas']==0){ ?>
									<button class="btn btn-xs btn-danger pembayaran" data-toggle="modal" data-target=".bayar" id="<?php echo $row['no_nota'] ?>">Pembayaran</button> <?php
								} else{ ?>
									<a class="btn btn-xs btn-success" href="document/struk_bayar.php?id=<?php echo $row['no_nota'] ?>" target="_blank">&nbsp;Cetak Struk&nbsp; </a> <?php
								}
								?>
								
							</td>
						</tr>
						<?php
						}
						?>
					</tbody>

				</table>
			</div>
		</div>

		<div class="modal fade bayar" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
			<div class="modal-dialog modal-xs" role="document">
		    	<div class="modal-content">    	
					<div class="panel-body list-pembayaran">
						<div class="data-pembayaran" align="center"></div>
					</div>
		    	</div>
		  	</div>
		</div>	
		

	</div>
</div>
						
<script type="text/javascript">
	$(document).ready(function(){
		$('.pembayaran').click(function(){
	    	var id = $(this).attr('id');
	    	$.ajax({	    		
	    		url 	: 'modul_pembayaran.php',
	    		data 	: 'id='+ id,
	    		success : function(data){
	    			$('.data-pembayaran').html(data);
	    		}
	    	})  
	    });
	})
</script>