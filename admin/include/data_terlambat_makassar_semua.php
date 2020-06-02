




<script type="text/javascript">
	$(document).ready(function(){		

		function cek(){
			var jenis = $("#jenis").val();
		};

		$('.chekboxes').change(function(){
	    	$('.act').prop('checked', $(this).prop('checked'));
	    });

	    $(".act, .chekboxes").change(function(){
	    	var n = $(".act:checked");
	    	var nilai = "";

	    	for(i=0;i<n.length;i++){
	    		nilai += n[i].value+" ";
	    	}

	    	$('#nota').val(nilai);

	    	if(n.length>0) {
	    		$('#cek').removeClass('hide');
	    		$('#n').html(n.length);
	    	} 
	    	else {
	    		$('#cek').addClass('hide');
	    		$('#n').html("");
	    	}
		    
	    });

	    $('#cek').on('click', function(){
	    	var nota = $('#nota').val();
	    	$.ajax({
	    		url 	: 'act/nota_spam.php',
	    		data 	: 'nota='+nota,
	    		method 	: 'POST',
	    		success : function(data){
	    			window.location="";
	    		}
	    	})

	    });

	    $('.chekboxesp').change(function(){
	    	$('.actp').prop('checked', $(this).prop('checked'));
	    });

	    $(".actp, .chekboxesp").change(function(){
	    	var n = $(".actp:checked");
	    	var nilai = "";
	    	for(i=0;i<n.length;i++){
	    		nilai += n[i].value+" ";
	    	}

	    	$('#notap').val(nilai);

	    	if(n.length>0) {
	    		$('#cek2').removeClass('hide');
	    		$('#n2').html(n.length);
	    	} 
	    	else {
	    		$('#cek2').addClass('hide');
	    		$('#n2').html("");
	    	}
		    
	    });

	    $('#cek2').on('click', function(){
	    	var nota = $('#notap').val();
	    	$.ajax({
	    		url 	: 'act/nota_spam.php',
	    		data 	: 'nota='+nota,
	    		method 	: 'POST',
	    		success : function(data){
	    			window.location="";
	    		}
	    	})

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
			<textarea class="hide" id="nota"></textarea>
		</div>

		<table class="table table-striped" style="font-size: 11px" id="dataall">
			<thead>
				<tr>
					<th><input align="center" type="checkbox" value="All" class="chekboxes" name=""> Pilih</th>
					<th>Tanggal Input</th>
					<th>No Order</th>
					<th class="hide"></th>
					<th>Nama Customer</th>
					<th>Total</th>
					<th>Checkin</th>
					<th>Cuci</th>
					<th>Setrika</th>
					<th>Time</th>
					<th class="hide"></th>
				</tr>
			</thead>

			<tbody>
				<?php 

				$sql = $con-> query("SELECT a.tgl_input, a.spk, a.no_nota, a.jenis,a.nama_customer,a.total_bayar,a.tgl_cuci,a.tgl_setrika,a.tgl_packing,timediff('$jam',a.tgl_input) as waktu,a.tgl_workshop,a.op_workshop, a.op_cuci, a.user_setrika, a.user_packing, a.tgl_spk, rcp_spk FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND a.jenis='k' AND a.kembali=false AND a.ambil=false AND a.tgl_so='0000-00-00 00:00:00' AND a.rijeck=false AND a.packing=false AND a.cara_bayar<>'Void' AND a.cara_bayar<>'Reject' AND status_order='' AND b.Kota='Makassar' ORDER by a.tgl_input DESC");
				while($data = $sql-> fetch_array()){
					$waktus = explode(":",$data['waktu']); 

					?>
					<tr>
						<td style="vertical-align: middle; text-align: center"><input class="act" type="checkbox" name="id[]" value="<?= $data['no_nota'] ?>"></td>
						<td style="vertical-align: middle"><?= $data['tgl_input'] ?></td>
						<td style="vertical-align: middle;"><a href="#" style="color: black" title="Click to view" class="data-order" data-toggle="modal" data-target="#rincian_order" id="<?php echo $data['no_nota'];?>"><?= $data['no_nota'];?></a></td>
						<td class="hide"><?= $data['spk'] ?></td>
						<td style="vertical-align: middle"><?= $data['nama_customer'] ?></td>
						<td style="vertical-align: middle"><?= number_format($data['total_bayar']) ?></td>
						<td style="vertical-align: middle">
							<?php 
							$cuci = ($data['tgl_workshop']<>"0000-00-00 00:00:00") ? '<div class="tooltips">Selesai<span  class="tooltiptext"">OP : '.$data['op_workshop'].'<br>'.$data['tgl_workshop'].'</span>' : "Belum";
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
			<textarea class="hide" id="notap"></textarea>
		</div>

		<table class="table table-striped" style="font-size: 11px" id="dataallpotongan">
			<thead>
				<tr>
					<th><input align="center" type="checkbox" value="All" class="chekboxesp" name=""> Pilih</th>
					<th>Tanggal Input</th>
					<th>No Order</th>
					<th class="hide"></th>
					<th>Nama Customer</th>
					<th>Total</th>
					<th>Checkin</th>
					<th>Cuci</th>
					<th>Setrika</th>
					<th>Time</th>
					<th class="hide"></th>
				</tr>
			</thead>

			<tbody>
				<?php 

				$sql = $con-> query("SELECT a.tgl_input, a.spk, a.no_nota, a.jenis,a.nama_customer,a.total_bayar,a.tgl_cuci,a.tgl_setrika,a.tgl_packing,timediff('$jam',a.tgl_input) as waktu,a.tgl_workshop,a.op_workshop, a.op_cuci, a.user_setrika, a.user_packing, a.tgl_spk, rcp_spk, a.ambil FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND a.jenis='p' AND a.kembali=false AND a.ambil=false AND a.tgl_so='0000-00-00 00:00:00' AND a.rijeck=false AND a.packing=false AND a.cara_bayar<>'Void' AND a.cara_bayar<>'Reject' AND b.Kota='Makassar' AND status_order='' ORDER by a.tgl_input DESC");
				while($data = $sql-> fetch_array()){
					$waktus = explode(":",$data['waktu']); 

					?>
					<tr>
						<td style="vertical-align: middle; text-align: center"><input class="actp" type="checkbox" name="id[]" value="<?= $data['no_nota'] ?>"></td>
						<td style="vertical-align: middle"><?= $data['tgl_input'] ?></td>
						<td style="vertical-align: middle;"><a href="#" style="color: black" title="Click to view" class="data-order" data-toggle="modal" data-target="#rincian_order" id="<?php echo $data['no_nota'];?>"><?= $data['no_nota'];?></a></td>
						<td class="hide"><?= $data['spk'] ?></td>
						<td style="vertical-align: middle"><?= $data['nama_customer'] ?></td>
						<td style="vertical-align: middle"><?= number_format($data['total_bayar']) ?></td>
						<td style="vertical-align: middle">
							<?php 
							$cuci = ($data['tgl_workshop']<>"0000-00-00 00:00:00") ? '<div class="tooltips">Selesai<span  class="tooltiptext"">OP : '.$data['op_workshop'].'<br>'.$data['tgl_workshop'].'</span>' : "Belum";
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
	
	



