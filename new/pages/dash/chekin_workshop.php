<?php 



?>

<div class="widget-box">
	<div class="widget-header">
		<h4 class="widget-title">Cucian Kiloan</h4>
	</div>

	<div class="widget-body">
		<div class="widget-main table-responsive">

			<table class="table table-striped" style="width: 100%;" id="dataCheckin">
				<thead>
					<tr>
						<th>Tanggal Input</th>
						<th>No Order</th>
						<th class="hide"></th>
						<th>Nama Customer</th>
						<th>Total</th>
						<th>SPK</th>
						<th>Cuci</th>
						<th>Setrika</th>
						<th>Time</th>
						<th class="hide"></th>
					</tr>
				</thead>

				<tbody>
					<?php 

					$sql = $con-> query("SELECT tgl_input, spk, no_nota, jenis,nama_customer,total_bayar,tgl_cuci,tgl_setrika,tgl_packing,timediff('$nowDate',tgl_input) as waktu, op_cuci, user_setrika, user_packing, tgl_spk, rcp_spk FROM reception WHERE jenis='k' AND workshop='$outlet' AND kembali=false AND tgl_so='0000-00-00 00:00:00' AND rijeck=false AND packing=false AND cara_bayar<>'Void' AND cara_bayar<>'Reject' AND spk=true AND rijeck=false ORDER by tgl_input DESC");
					while($data = $sql-> fetch_array()){
						$waktus = explode(":",$data['waktu']); 

						?>
						<tr>
							<td style="vertical-align: middle"><?= $data['tgl_input'] ?></td>
							<td style="vertical-align: middle;"><a href="#" style="color: black" class="data-order" data-toggle="modal" data-target="#rincian_order" id="<?php echo $data['no_nota'];?>"><?= $data['no_nota'];?></a></td>
							<td class="hide"><?= $data['spk'] ?></td>
							<td style="vertical-align: middle"><?= $data['nama_customer'] ?></td>
							<td style="vertical-align: middle"><?= number_format($data['total_bayar']) ?></td>
							<td style="vertical-align: middle">
								<?php 
								$title = $data['rcp_spk'].' '.$data['tgl_spk'];
								$cuci = ($data['tgl_spk']<>"0000-00-00 00:00:00") ? '<a href="#" id="show-option" class="grey" title="'.$title.'">Selesai' : 'Belum';
								echo $cuci;

								?>
								</div>
							</td>
							<td style="vertical-align: middle">
								<?php 
								$title = $data['op_cuci'].' '.$data['tgl_cuci'];
								$cuci = ($data['tgl_cuci']<>"0000-00-00 00:00:00") ? '<a href="#" id="show-option" class="grey" title="'.$title.'">Selesai' : 'Belum';
								echo $cuci;

								?>
								</div>
							</td>
							<td style="vertical-align: middle">
								<?php 
								$title = $data['user_setrika'].' '.$data['tgl_setrika'];
								$cuci = ($data['tgl_setrika']<>"0000-00-00 00:00:00") ? '<a href="#" id="show-option" class="grey" title="'.$title.'">Selesai' : 'Belum';
								echo $cuci;

								?>
								</div>
							</td>
							<td style="vertical-align: middle">
								<?php 							
								echo $waktus[0].' Jam<br>'.$waktus[1].' Menit ';
								?>
							</td>
							<td class="hide"><?= $waktus[0]; ?></td>
						</tr>

						<?php
					}


					?>
				</tbody>
			</table>

		</div>
	</div>
</div>

<div class="widget-box">
	<div class="widget-header">
		<h4 class="widget-title">Cucian Potongan</h4>
	</div>

	<div class="widget-body">
		<div class="widget-main table-responsive">

			<table class="table table-striped" style="width: 100%;" id="dataCheckin2">
				<thead>
					<tr>
						<th>Tanggal Input</th>
						<th>No Order</th>
						<th class="hide"></th>
						<th>Nama Customer</th>
						<th>Total</th>
						<th>SPK</th>
						<th>Cuci</th>
						<th>Setrika</th>
						<th>Time</th>
						<th class="hide"></th>
					</tr>
				</thead>

				<tbody>
					<?php 

					$sql = $con-> query("SELECT tgl_input, spk, no_nota, jenis,nama_customer,total_bayar,tgl_cuci,tgl_setrika,tgl_packing,timediff('$nowDate',tgl_input) as waktu, op_cuci, user_setrika, user_packing, tgl_spk, rcp_spk FROM reception WHERE jenis='p' AND workshop='$outlet' AND kembali=false AND tgl_so='0000-00-00 00:00:00' AND rijeck=false AND packing=false AND cara_bayar<>'Void' AND cara_bayar<>'Reject' AND spk=true AND rijeck=false ORDER by tgl_input DESC");
					while($data = $sql-> fetch_array()){
						$waktus = explode(":",$data['waktu']); 

						?>
						<tr>
							<td style="vertical-align: middle"><?= $data['tgl_input'] ?></td>
							<td style="vertical-align: middle;"><a href="#" style="color: black" class="data-order" data-toggle="modal" data-target="#rincian_order" id="<?php echo $data['no_nota'];?>"><?= $data['no_nota'];?></a></td>
							<td class="hide"><?= $data['spk'] ?></td>
							<td style="vertical-align: middle"><?= $data['nama_customer'] ?></td>
							<td style="vertical-align: middle"><?= number_format($data['total_bayar']) ?></td>
							<td style="vertical-align: middle">
								<?php 
								$title = $data['rcp_spk'].' '.$data['tgl_spk'];
								$cuci = ($data['tgl_spk']<>"0000-00-00 00:00:00") ? '<a href="#" id="show-option" class="grey" title="'.$title.'">Selesai' : 'Belum';
								echo $cuci;

								?>
								</div>
							</td>
							<td style="vertical-align: middle">
								<?php 
								$title = $data['op_cuci'].' '.$data['tgl_cuci'];
								$cuci = ($data['tgl_cuci']<>"0000-00-00 00:00:00") ? '<a href="#" id="show-option" class="grey" title="'.$title.'">Selesai' : 'Belum';
								echo $cuci;

								?>
								</div>
							</td>
							<td style="vertical-align: middle">
								<?php 
								$title = $data['user_setrika'].' '.$data['tgl_setrika'];
								$cuci = ($data['tgl_setrika']<>"0000-00-00 00:00:00") ? '<a href="#" id="show-option" class="grey" title="'.$title.'">Selesai' : 'Belum';
								echo $cuci;

								?>
								</div>
							</td>
							<td style="vertical-align: middle">
								<?php 							
								echo $waktus[0].' Jam<br>'.$waktus[1].' Menit ';
								?>
							</td>
							<td class="hide"><?= $waktus[0]; ?></td>
						</tr>

						<?php
					}


					?>
				</tbody>
			</table>

		</div>
	</div>
</div>


<script type="text/javascript">

	jQuery(function($) {

		//tooltips
		$( document ).tooltip({
			show: {
				effect: "slideDown",
				delay: 250
			}
		});

		$('#dataCheckin, #dataCheckin2').dataTable({
            lengthMenu: [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
            // dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
		     "oLanguage": {
			      "sLengthMenu": "Tampilkan _MENU_",
			      "sSearch": "Pencarian: ", 
			      "sZeroRecords": "Maaf, tidak ada data yang ditemukan",
			      "sInfo": "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
			      "sInfoEmpty": "Menampilkan 0 s/d 0 dari 0 data",
			      "sInfoFiltered": "(di filter dari _MAX_ total data)",
			      "oPaginate": {
			          "sFirst": "<<",
			          "sLast": ">>", 
			          "sPrevious": "<", 
			          "sNext": ">"
		       }
	      },
          "sPaginationType":"full_numbers",
          "bJQueryUI":true
        });   

	});
		
</script>
			