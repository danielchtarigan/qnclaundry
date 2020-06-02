<div class="col-md-4 hidden" id="s">
	
</div>
	
<div class="col-md-8">
	<div class="panel panel-default">		
		<div class="panel-body">
			<h4><i class="ace-icon glyphicon glyphicon-tag"></i> Rincian Belum SPK</h4>
			<div class="table-responsive">
				<table class="table table-bordered table-condensed" id="choose-spk">
					<thead>
						<tr>
							<th class="hidden"></th>
							<th>Tanggal Masuk</th>
							<th>No Nota</th>
							<th>Nama Customer</th>
							<th>Keterangan</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						if($_SESSION['cabang']=="Mojokerto"  || ($_SESSION['cabang']=="Jakarta" && $_SESSION['outlet']=="Cinere"  && $_SESSION['outlet']=="Casa deParco")){
							$query = mysqli_query($con, "SELECT a.tgl_input AS tgl_input, a.no_nota AS no_nota, b.nama_customer AS nama_customer, a.express AS express, a.priority AS priority, a.jenis AS jenis FROM reception AS a, customer AS b WHERE a.id_customer=b.id AND a.spk=false AND a.nama_outlet='$outlet' AND a.lunas=true AND a.cara_bayar<>'Void' AND a.cara_bayar<>'Reject' AND a.kembali=false ORDER BY a.id ASC ");
						} else {
							$query = mysqli_query($con, "SELECT a.tgl_input AS tgl_input, a.no_nota AS no_nota, b.nama_customer AS nama_customer, a.express AS express, a.priority AS priority, a.jenis AS jenis FROM reception AS a, customer AS b WHERE a.id_customer=b.id AND a.spk=false AND a.nama_outlet='$outlet' AND a.cara_bayar<>'Void' AND a.cara_bayar<>'Reject' AND a.kembali=false ORDER BY a.id ASC ");
						}
						while($data = mysqli_fetch_array($query)) {
							?>
							<tr>
								<td class="hidden"><?php echo $data['tgl_input'] ?></td>
								<td><?php echo date('d/m/Y H:i', strtotime($data['tgl_input'])) ?></td>
								<td><?php echo $data['no_nota'] ?></td>
								<td><?php echo $data['nama_customer'] ?></td>
								<td>
									<?php
									if($data['priority']=="1") {
										$pr = "Priority";
									} else {
										$pr = "";
									} 
									if($data['express']=="1") echo "Express ".$pr; else if($data['express']=="2") echo "Double Express ".$pr; else if($data['express']=="3") echo "Super Express ".$pr; else echo $pr; ?>
								</td>
								<td><button href="#" title="Pilih untuk diSPK" class="btn btn-sm btn-white btn-primary btn-pilih" id="<?php echo $data['no_nota'] ?>">Pilih</button></td>
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
	$(document).ready(function(){
		$('.btn-pilih').on('click', function(){
			var nota = $(this).attr('id');
			var jenis = $("#jenis").html();
			$.ajax({
				url 	: 'include/spk.php',
				data 	: 'nota='+nota,
				beforeSend : function(){
					$("#s").removeClass('hidden').html("sedang memuat...");

				},
				success : function(data){
					$('#s').removeClass('hidden').html(data);
				},
			})
		});

		$('#choose-spk').dataTable({
			"aaSorting": [[ 0, "asc" ]],
	      "oLanguage": {
		      "sLengthMenu": "Tampilkan _MENU_",
		      "sSearch": "Pencarian: ",
		      "sZeroRecords": "Maaf, tidak ada data yang ditemukan",
		      "sInfo": "Show _START_ s/d _END_ dari _TOTAL_ data",
		      "sInfoEmpty": "Show 0 s/d 0 dari 0 data",
		      "sInfoFiltered": "(di filter dari _MAX_ total data)",
		      "oPaginate": {
		          "sFirst": "First",
		          "sLast": "Last", 
		          "sPrevious": "<", 
		          "sNext": ">"
	            }
            },
          "sPaginationType":"full_numbers",
          "bJQueryUI":true
        });		

		
					
	})
</script>


