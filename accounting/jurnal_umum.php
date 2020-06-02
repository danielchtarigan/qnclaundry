<?php 
function debet(){
	global $con;
	$sql = mysqli_query($con, "SELECT SUM(nominal) AS jumlah FROM jurnal_u WHERE balance='d' AND status='0'");
	$data = mysqli_fetch_row($sql);
	return $data[0];
}

function kredit(){
	global $con;
	$sql = mysqli_query($con, "SELECT SUM(nominal) AS jumlah FROM jurnal_u WHERE balance='k' AND status='0'");
	$data = mysqli_fetch_row($sql);
	return $data[0];
}


?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Jurnal Umum</h3>
	</div>
	<div class="panel-body">
		
		<button class="btn btn-md btn-primary btn-tambah" data-toggle="modal" data-target=".t">Tambah Baru</button>
		<div class="" style="color: green">Balance : <?= 'Rp '. number_format(debet()-kredit()); ?> </div>

		<div>
			<table class="table table-bordered table-condensed">
				<thead>
					<tr>
						<th>Tanggal</th>
						<th>Nama Akun</th>
						<th>Sub Akun</th>
						<th>Nama Item</th>
						<th>Nominal</th>
						<th>Balance</th>
						<th width="13%">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php  
					$sql = mysqli_query($con, "SELECT * FROM jurnal_u ORDER BY id DESC");
					while($data = mysqli_fetch_assoc($sql)){
						$ka = substr($data['kode_item'],0,7);
						$ksa = substr($data['kode_item'],0,10);
						
						?>
						<tr>
							<td><?= $data['tgl_input'] ?></td>
							<td>
								<?php 
								$sql2 = mysqli_query($con, "SELECT nama_akun FROM nama_akun WHERE kode_nama_akun='$ka'");
								$data2=mysqli_fetch_row($sql2);
								echo $data2[0];
								?>
							</td>
							<td>
								<?php 
								$sql3 = mysqli_query($con, "SELECT nama_sub_akun FROM sub_akun WHERE kode_sub_akun='$ksa'");
								$data3=mysqli_fetch_row($sql3);
								echo $data3[0];
								?>
							</td>
							<td><?= $data['nama_item'] ?></td>
							<td align="right"><?= 'Rp '.number_format($data['nominal']) ?></td>
							<td><?php if($data['balance']=='d') echo "Debit"; else echo "Kredit"; ?></td>
							<td>
								<a href="" class="btn btn-warning btn-sm">Ubah</a>
								<a href="" class="btn btn-danger btn-sm">Hapus</a>
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

<div class="modal fade t">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="panel panel-default">
				<div class="panel-body">
					<legend align="center">Transaksi Baru</legend>
					<div  id="pes"></div>
					<div class="" align="center">
						<form class="form-horizontal">
								<div class="col-md-6"> 
									<div class="form-group">
										<select class="form-control" id="nakun">
											<option value="0">--Pilih Akun--</option>
											<?php 
											$sql = mysqli_query($con, "SELECT * FROM nama_akun");
											while($data = mysqli_fetch_assoc($sql)){
												echo '<option value="'.$data['kode_nama_akun'].'">'.$data['kode_nama_akun']. ' | '.$data['nama_akun'].'</option>';
											}

											?>
										</select>
									</div>
									<div class="form-group">
										<select class="form-control" id="sbakun">
											<option value="">--Pilih Sub Akun--</option>		
										</select>
									</div>

									<div class="form-group">
										<select class="form-control" id="nitem">
											<option value="">--Nama Item--</option>				
										</select>
									</div>
								</div>
								
								<div class="col-md-6 hidden" id="ex">
									<div class="form-group">
										<select class="form-control" id="balance">
											<option value="">--Pilih Balance--</option>
											<option value="d">Debet</option>
											<option value="k">Kredit</option>
										</select>
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon">Rp</span>
											<input class="form-control" type="number" id="nominal" name="" placeholder="">
										</div>
									</div>
									<div class="form-group">
										<input style="color:green; font-weight: bold" class="btn btn-default btn-md btn-block btn-kirim" type="submit" name="" placeholder="" value="Submit">
									</div>
								</div>
									
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>


<script type="text/javascript">
	$('#nakun').change(function(){
		var nakun = $('#nakun').val();	
		$('#sbakun').load('pilih_sub_akun.php?kode=sa&id='+nakun);			
	})	

	$('#sbakun').change(function(){
		var sb = $('#sbakun').val();	
		$('#nitem').load('pilih_sub_akun.php?kode=nt&id='+sb);		
	});

	$('#nitem').change(function(){
		var item = $('#nitem').val();
		if(item!='') {
			$('#ex').removeClass('hidden');
		} else {
			$('#ex').addClass('hidden');
		}
	})

	$('.btn-kirim').on('click', function(e){
		e.preventDefault();
		var ki = $('#nitem').val();
		var nominal = $('#nominal').val();
		var balance = $('#balance').val();
		$.ajax({
			url 	: 'action/simpan_jurnal_u.php',
			data 	: 'ki='+ki+'&nominal='+nominal+'&balance='+balance,
			success : function(data){
				$('#pes').html(data);
				window.location="";
			}
		})
	})		

		
</script>