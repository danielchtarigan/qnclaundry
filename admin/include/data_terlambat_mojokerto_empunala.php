




<script type="text/javascript">
	$(document).ready(function(){		

		function cek(){
			var jenis = $("#jenis").val();
		};

		$('.chekboxes').change(function(){
	    	$('.act').prop('checked', $(this).prop('checked'));
	    });

	    $(".act, .chekboxes").change(function(){
	    	var n = $(".act:checked").length;
	    	if(n>0) {
	    		$('#cek').removeClass('hide');
	    		$('#n').html(n);
	    	} 
	    	else {
	    		$('#cek').addClass('hide');
	    		$('#n').html("");
	    	}

		    
	    });

	    $('.chekboxesp').change(function(){
	    	$('.actp').prop('checked', $(this).prop('checked'));
	    });

	    $(".actp, .chekboxesp").change(function(){
	    	var n = $(".actp:checked").length;
	    	if(n>0) {
	    		$('#cek2').removeClass('hide');
	    		$('#n2').html(n);
	    	} 
	    	else {
	    		$('#cek2').addClass('hide');
	    		$('#n2').html("");
	    	}

		    
	    });
		    
	
	})
</script>

	

	<div class="table-responsive" style="margin-top: 25px">
		<legend align="center" ><marquee behavior=alternate  width="800">Kiloan Belum di Packing dan Belum Kembali</marquee></legend>

		<div style="margin-bottom: 20px">
			<button id="cek" type="button" class="btn btn-white btn-xs hide" style="background-color: white" title="Trash">
				<i class="fa fa-trash-o fa-2x" aria-hidden="true" style="color: red"></i>
			</button>
			<span id="n"></span>
		</div>

		<table class="table table-striped" style="font-size: 11px" id="datatdp">
			<thead>
				<tr>
					<th><input align="center" type="checkbox" value="All" class="chekboxes" name=""> Pilih</th>
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

				$sql = $con-> query("SELECT tgl_input, spk, no_nota, jenis,nama_customer,total_bayar,tgl_cuci,tgl_setrika,tgl_packing,timediff('$jam',tgl_input) as waktu, op_cuci, user_setrika, user_packing, tgl_spk, rcp_spk FROM reception WHERE jenis='k' AND nama_outlet='mojokerto' AND  kembali=false AND tgl_so='0000-00-00 00:00:00' AND rijeck=false AND packing=false AND cara_bayar<>'Void' AND cara_bayar<>'Reject' ORDER by tgl_input DESC");
				while($data = $sql-> fetch_array()){
					$waktus = explode(":",$data['waktu']); 

					?>
					<tr>
						<td style="vertical-align: middle; text-align: center"><input class="act" type="checkbox" name="id[]" value="<?= $data['id'] ?>"></td>
						<td style="vertical-align: middle"><?= $data['tgl_input'] ?></td>
						<td style="vertical-align: middle;"><a href="#" style="color: black" title="Click to view" class="data-order" data-toggle="modal" data-target="#rincian_order" id="<?php echo $data['no_nota'];?>"><?= $data['no_nota'];?></a></td>
						<td class="hide"><?= $data['spk'] ?></td>
						<td style="vertical-align: middle"><?= $data['nama_customer'] ?></td>
						<td style="vertical-align: middle"><?= number_format($data['total_bayar']) ?></td>
						<td style="vertical-align: middle">
							<?php 
							$cuci = ($data['tgl_spk']<>"0000-00-00 00:00:00") ? '<div class="tooltips">Selesai<span  class="tooltiptext"">SPK : '.$data['rcp_spk'].'<br>'.$data['tgl_spk'].'</span>' : "Belum";
							echo $cuci;

							?>
							</div>
						</td>
						<td style="vertical-align: middle">
							<?php 
							$cuci = ($data['tgl_cuci']<>"0000-00-00 00:00:00") ? '<div class="tooltips">Selesai<span  class="tooltiptext"">Cuci : '.$data['op_cuci'].'<br>'.$data['tgl_cuci'].'</span>' : 'Belum';
							echo $cuci;

							?>
							</div>
						</td>
						<td style="vertical-align: middle">
							<?php 
							$cuci = ($data['tgl_setrika']<>"0000-00-00 00:00:00") ? '<div class="tooltips">Selesai<span  class="tooltiptext"">Setrika : '.$data['user_setrika'].'<br>'.$data['tgl_setrika'].'</span>' : "Belum";
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

	<div class="table-responsive" style="margin-top: 25px; border-top: 2px solid black">
		<legend align="center" style="margin-top: 25px"><marquee behavior=alternate  width="800">Potongan Belum di Packing dan Belum Kembali</marquee></legend>

		<div style="margin-bottom: 20px">
			<button id="cek2" type="button" class="btn btn-white btn-xs hide" style="background-color: white" title="Trash">
				<i class="fa fa-trash-o fa-2x" aria-hidden="true" style="color: red"></i>
			</button>
			<span id="n2"></span>
		</div>

		<table class="table table-striped" style="font-size: 11px" id="datatdppotongan">
			<thead>
				<tr>
					<th><input align="center" type="checkbox" value="All" class="chekboxesp" name=""> Pilih</th>
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

				$sql = $con-> query("SELECT tgl_input, spk, no_nota, jenis,nama_customer,total_bayar,tgl_cuci,tgl_setrika,tgl_packing,timediff('$jam',tgl_input) as waktu, op_cuci, user_setrika, user_packing, tgl_spk, rcp_spk FROM reception WHERE jenis='p' AND nama_outlet='mojokerto' AND kembali=false AND tgl_so='0000-00-00 00:00:00' AND rijeck=false AND packing=false AND cara_bayar<>'Void' AND cara_bayar<>'Reject' ORDER by tgl_input DESC");
				while($data = $sql-> fetch_array()){
					$waktus = explode(":",$data['waktu']); 

					?>
					<tr>
						<td style="vertical-align: middle; text-align: center"><input class="actp" type="checkbox" name="id[]" value="<?= $data['id'] ?>"></td>
						<td style="vertical-align: middle"><?= $data['tgl_input'] ?></td>
						<td style="vertical-align: middle;"><a href="#" style="color: black" title="Click to view" class="data-order" data-toggle="modal" data-target="#rincian_order" id="<?php echo $data['no_nota'];?>"><?= $data['no_nota'];?></a></td>
						<td class="hide"><?= $data['spk'] ?></td>
						<td style="vertical-align: middle"><?= $data['nama_customer'] ?></td>
						<td style="vertical-align: middle"><?= number_format($data['total_bayar']) ?></td>
						<td style="vertical-align: middle">
							<?php 
							$cuci = ($data['tgl_spk']<>"0000-00-00 00:00:00") ? '<div class="tooltips">Selesai<span  class="tooltiptext"">SPK : '.$data['rcp_spk'].'<br>'.$data['tgl_spk'].'</span>' : "Belum";
							echo $cuci;

							?>
							</div>
						</td>
						<td style="vertical-align: middle">
							<?php 
							$cuci = ($data['tgl_cuci']<>"0000-00-00 00:00:00") ? '<div class="tooltips">Selesai<span  class="tooltiptext"">Cuci : '.$data['op_cuci'].'<br>'.$data['tgl_cuci'].'</span>' : 'Belum';
							echo $cuci;

							?>
							</div>
						</td>
						<td style="vertical-align: middle">
							<?php 
							$cuci = ($data['tgl_setrika']<>"0000-00-00 00:00:00") ? '<div class="tooltips">Selesai<span  class="tooltiptext"">Setrika : '.$data['user_setrika'].'<br>'.$data['tgl_setrika'].'</span>' : "Belum";
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
	
	



