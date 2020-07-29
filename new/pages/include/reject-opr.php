
<div class="row">
	<div class="" id="proses-spk">

	</div>
	<div class="col-md-12" id="informasi-reject">
		<div class="widget-box">
			<div class="widget-header">
				<h4 class="widget-title">Informasi Reject Operator</h4>
			</div>
		
			<div class="widget-body">
				<div class="widget-main table-responsive">
		
					<table class="table table-striped" style="width: 100%;" id="dataCheckin">
						<thead>
							<tr>
								<th>Tanggal Reject</th>
								<th>No Order</th>				
								<th>Nama Customer</th>
								<th>Direject Oleh</th>
								<th>Alasan</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
		
						<tbody>
							<?php 
		
							$sql = $con-> query("SELECT * FROM rijeck a, reception b WHERE a.no_nota=b.no_nota AND b.nama_outlet='$outlet' ORDER BY a.id DESC");
							while($data = $sql-> fetch_array()){
		
								?>
								<tr>
									<td style="vertical-align: middle"><?= $data['tgl_rijeck'] ?></td>
									<td style="vertical-align: middle;"><?= $data['no_nota'];?></td>
									<td style="vertical-align: middle" namaCst="<?= $data['nama_customer'] ?>" class="nama-cst"><?= $data['nama_customer'] ?></td>
									<td style="vertical-align: middle"><?= $data['user_rijeck'] ?></td>
									<td style="vertical-align: middle;"><?= ucfirst($data['alasan']);?></td>
									<td style="vertical-align: middle;"><?= $data['status'] == 1 ? "Terproses" : "Belum Diproses" ?></td>
									<td>
										<button class="btn btn-xs btn-warning btn-editSpk" id="<?= $data['no_nota'] ?>" <?= $data['status'] == 1 ? "disabled" : "" ?>>Edit SPK</button>
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
</div>



<script type="text/javascript">
	$('.btn-editSpk').on('click', function(e){

		nota = $(this).attr('id');
		customer = $('.nama-cst').attr('namaCst');
		data = 'nota='+nota+'&customer='+customer;
		$('#informasi-reject').removeClass('col-md-12').addClass('col-md-8');
		$('#proses-spk').addClass('col-md-4');
		$.ajax({
			url 	: 'include/spk.php',
			data 	: data,
			method 	: 'GET',
			beforeSend: function() {
				$('#proses-spk').html('<b align="center">Sedang memuat...</b>');
			},
			success	: function(data){
				$('#proses-spk').html(data);
			}
		})
		e.preventDefault();
				
	});

</script>