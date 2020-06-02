

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
							<td style="vertical-align: middle;"><?= $data['status'];?></td>
							<td>
								<button class="btn btn-xs btn-white btn-editSpk" id="<?= $data['no_nota'] ?>">Edit SPK</button>
								|
								<button class="btn btn-xs btn-white btn-reorder">Reorder</button>
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


<div id="my-modal" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="smaller lighter blue no-margin" id="titleR">
					
				</h3>
			</div>

			<div class="modal-body" id="bodyR">
				
			</div>

			<div class="modal-footer">
				<button class="btn btn-sm btn-danger pull-right" data-dismiss="modal">
					<i class="ace-icon fa fa-times"></i>
					Close
				</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<script type="text/javascript">
	$('.btn-reorder').on('click', function(){
		if(confirm("Apakah cucian ini sudah dikirim kembali ke outlet Anda?")){
			$('#titleR').html("Rincian Order")
			$('#my-modal').modal('show');
		}
	});

	$('.btn-editSpk').on('click', function(e){

		idNota = $(this).attr('id');
		namaCst = $('.nama-cst').attr('namaCst');
		data = 'idNota='+idNota+'&namaCst='+namaCst;

		$.ajax({
			url 	: 'include/rincian_spk.php',
			data 	: data,
			method 	: 'POST',
			success	: function(data){
				$('#titleR').html("Rincian SPK");
				$('#bodyR').html(data);
				$('#my-modal').modal('show');
			}
		})
		e.preventDefault();
				
	});

</script>