
<h4>Void dan Reject</h4>
<div class="pesan"></div>
<div class="" style="overflow-x: auto">
	<table class="table table-bordered table-condensed table-striped" style="font: 9pt arial;">
		<thead>
			<tr>
				<th>Tgl Masuk</th>
				<th>No Order</th>
				<th>Nama Customer</th>
				<th>Harga</th>
				<th>Rcp Order</th>
				<th>No Faktur</th>
				<th>Rcp Input</th>
				<th>Status Order</th>
				<th>Diverifikasi</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			include '../config.php';

			$query = mysqli_query($con, "SELECT a.tgl_input AS tgl_input, a.no_nota AS no_nota, a.nama_customer AS customer, a.total_bayar AS total_bayar, a.nama_reception AS nama_reception, a.no_faktur AS no_faktur, b.rcp_input AS rcp_void,b.status AS status,b.verifikasi AS verify FROM reception AS a INNER JOIN order_batal AS b ON a.no_nota=b.no_order WHERE (a.cara_bayar='Void' OR a.cara_bayar='Reject') AND a.lunas=true ORDER BY b.id DESC");
			if(mysqli_num_rows($query)>0){
				while($data = mysqli_fetch_array($query)){ ?>

				<tr>
					<td><?php echo date('d/m/Y', strtotime($data['tgl_input'])) ?></td>
					<td><a href="#" class="data-order" data-toggle="modal" data-target="#rincian" id="<?php echo $data['no_nota']; ?>"><?php echo $data['no_nota'] ?></a></td>
					<td><?php echo $data['customer'] ?></td>
					<td><?php echo $data['total_bayar'] ?></td>
					<td><?php echo $data['nama_reception'] ?></td>
					<td><a href="#" class="faktur" data-toggle="modal" data-target="#rincian" id="<?php echo $data['no_faktur'] ?>"><?php echo $data['no_faktur'] ?></a></td>
					<td><?php echo $data['rcp_void'] ?></td>
					<td><?php echo $data['status'] ?></td>
					<td align="center">
						<?php 
						if($data['verify']=='') echo '<button class="btn btn-xs btn-danger void" id="'.$data['no_nota'].'">verifikasi</button>'; 
						else echo $data['verify'];
						?>

					</td>
				</tr>

				<?php
				}
			}
				

			?>
		</tbody>
	</table>
</div>



<div class="modal fade" id="rincian" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="rincian">
				
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('.faktur').click(function(){
		var faktur = $(this).attr("id");
		$.ajax({
			url 	: 'rincian_faktur.php',
			data 	: 'faktur=' + faktur,
			success	: function(data){
				$('.rincian').html(data); //menampilkan rincian faktur
			}
		})
	})

	$('.void').click(function(){
		var order = $(this).attr("id");
		$.ajax({
			url 	: 'act/void.php',
			data 	: 'order=' + order,
			success : function(data){
				$('.pesan').html(data);
			}
		})
	})

	$('.data-order').click(function(){
		var order = $(this).attr('id');
		$.ajax({
			url 	: 'rincian_order.php',
			data 	: 'order='+order,
			success : function(data){
				$('.rincian').html(data);
			}
		})
	})

</script>