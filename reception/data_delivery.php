<html>
<head>

	<?php

	date_default_timezone_set('Asia/Makassar');
	$jam=date("Y-m-d H:i:s");
	include "header.php";
	include "../config.php";

	if ($_SESSION['jenis']=='dispatcher' || $_SESSION['level']=='admin') $dispatcher = true; else $dispatcher = false;
	?>
</head>
<body>
	<div style="margin: 0 auto; width:100%;text-align:center">
	<a href="../delivery.php" class="btn btn-success btn-lg center-block" style="width:250px; display: inline-block">+ Tambah Data Delivery</a>
	<?php 
	if ($_SESSION['jenis']=='dispatcher')
	echo 
	'<a href="samedaydelivery.php" class="btn btn-success btn-lg center-block" style="width:300px; display: inline-block">+ Tambah Same-Day Delivery</a>';
	else echo '';
	?>
	
	</div>
	<div class="container" style="width:1250px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin-top:25px; margin-bottom:25px; color:#000000;">
		<script type="text/javascript">
		$(document).ready(function(){
			$('#antar').dataTable({
				"order": [[ 0,"asc" ]],
				"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
				dom: 'T<"clear">lfrtip',
				tableTools: {
					"sSwfPath": "swf/copy_csv_xls_pdf.swf",
					"aButtons": [
						{
							"sExtends": "copy",
							"mColumns": [0,1,2,3,4,5,6,7,8,9],
							"oSelectorOpts": { filter: "applied", order: "current" }
						},
						{
							'sExtends': 'xls',
							"mColumns": [0,1,2,3,4,5,6,7,8,9],
							"oSelectorOpts": { filter: 'applied', order: 'current' }
						},

						{
							'sExtends': 'print',
							"mColumns": [0,1,2,3,4,5,6,7,8,9],
							"oSelectorOpts": { filter: 'applied', order: 'current' }
						}

					]
				},
				"columnDefs": [
					{
						"targets": [0],
						"visible": true,
						"searchable": true,"width":"5%",
					},
				],
				"bAutoWidth": false,
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				"iDisplayLength": 50,"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
				"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
					if (aData[8] == 0) {
						$('td', nRow).css('background-color', '#ffec00').css('color', 'black').css('font-weight', 'bold');
					} else if(aData[8] >= 1){
						$('td', nRow).css('background-color', 'red').css('color', 'white').css('font-weight', 'bold');
					}
				}
			});

		$('#jemput').dataTable({
			"order": [[ 0,"asc" ]],
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
			dom: 'T<"clear">lfrtip',
			tableTools: {
				"sSwfPath": "swf/copy_csv_xls_pdf.swf",
				"aButtons": [
					{
						"sExtends": "copy",
						"mColumns": [0,1,2,3,4,5,6,7,8],
						"oSelectorOpts": { filter: "applied", order: "current" }
					},
					{
						'sExtends': 'xls',
						"mColumns": [0,1,2,3,4,5,6,7,8],
						"oSelectorOpts": { filter: 'applied', order: 'current' }
					},

					{
						'sExtends': 'print',
						"mColumns": [0,1,2,3,4,5,6,7,8],
						"oSelectorOpts": { filter: 'applied', order: 'current' }
					}

				]
			},
			"columnDefs": [
				{
					"targets": [0],
					"visible": true,
					"searchable": true,"width":"5%",
				},
			],
			"bAutoWidth": false,
			"bJQueryUI" : true,
			"sPaginationType" : "full_numbers",
			"iDisplayLength": 50,"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
			"fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
				if (aData[7] == 0) {
					$('td', nRow).css('background-color', '#ffec00').css('color', 'black').css('font-weight', 'bold');
				} else if(aData[7] >= 1){
					$('td', nRow).css('background-color', 'red').css('color', 'white').css('font-weight', 'bold');
				}
			}
		});

		$('#edit-delivery').html($('#select-delivery').html());
	});
	$(document).on("click", ".assign-btn", function() {
		var id = $(this).parent().parent().data('id');
		$('#assign-id').val(id);
	});
	$(document).on("click", ".edit-btn", function() {
		var td = $(this).parent();
		var siblings = td.siblings();
		var tr = td.parent();
		$('#edit-id').val(tr.data('id'));
		$('#edit-tgl-permintaan').val($(siblings[0]).text());
		$('#no-faktur-form-group').show();
		$('#edit-no-faktur').prop('required',true);
		$('#edit-no-faktur').val($(siblings[1]).text());
		$('#edit-nama-customer').val($(siblings[2]).text());
		$('#edit-no-telp').val($(siblings[3]).text());
		$('#edit-alamat').val($(siblings[4]).text());
		$('#edit-catatan').val($(siblings[5]).text());
		var delivery = $(siblings[6]).html();
		if (delivery.indexOf('button')<0) $('#edit-delivery').val(delivery);
		$('#edit-waktu option[value="' + $(siblings[7]).text() + '"]').attr('selected','selected');
		$('#edit-status option[value="' + $(siblings[9]).text() + '"]').attr('selected','selected');
	});
	$(document).on("click", ".edit-jemput-btn", function() {
		var td = $(this).parent();
		var siblings = td.siblings();
		var tr = td.parent();
		$('#edit-id').val(tr.data('id'));
		$('#edit-tgl-permintaan').val($(siblings[0]).text());
		$('#no-faktur-form-group').hide();
		$('#edit-no-faktur').prop('required',false);
		$('#edit-nama-customer').val($(siblings[1]).text());
		$('#edit-no-telp').val($(siblings[2]).text());
		$('#edit-alamat').val($(siblings[3]).text());
		$('#edit-catatan').val($(siblings[4]).text());
		var delivery = $(siblings[5]).html();
		if (delivery.indexOf('button')<0) $('#edit-delivery').val(delivery);
		$('#edit-waktu option[value="' + $(siblings[6]).text() + '"]').attr('selected','selected');
		$('#edit-status option[value="' + $(siblings[8]).text() + '"]').attr('selected','selected');
	});
	$(document).on("click",".faktur-link",function() {
		var nofaktur = $(this).text();
		$('#no-faktur-info').html(nofaktur);
		$.get("act/get_info_faktur.php", {faktur: nofaktur} )
		  .done(function(response) {
  			$('#faktur-tbody').html(response);
		  });
	});
	</script>

		<fieldset>
			<legend align="center" ><marquee behavior=alternate  width="800"><strong>Tabel Antar</strong></marquee></legend>
			<table id="antar" class="display" style="font-size:12px">
				<thead>
					<tr>
						<th>Jadwal Delivery</th>
						<th>No. Faktur</th>
						<th>Nama</th>
						<th>No. Telp</th>
						<th>Alamat</th>
						<th>Catatan</th>
						<th>Delivery</th>
						<th>Waktu</th>
						<th>Selisih Hari</th>
						<th>Status</th>
						<th>Gateway</th>
						<?php if ($dispatcher) { ?>
						<th>Edit</th>
						<th>Delete</th>
						<?php } ?>
					</tr>
				</thead>
				<tbody>
					<?php
					$query = "SELECT id,DATE_FORMAT(tgl_permintaan,'%d/%m/%Y') AS tgl_permintaan, no_faktur, nama_customer, no_telp, alamat, catatan, nama_pengantar, waktu_permintaan, DATEDIFF(NOW(),tgl_permintaan) AS selisih, status, gateway FROM delivery WHERE jenis_permintaan='Antar' AND no_faktur IS NOT NULL AND status <> 'Sukses' ORDER BY selisih DESC";
					$tampil = mysqli_query($con, $query);
					while($data = mysqli_fetch_array($tampil)){?>
						<tr data-id="<?php echo $data['id'] ?>">
							<td><?php echo $data['tgl_permintaan']; ?></td>
							<td><a href="#" data-toggle="modal" data-target="#faktur-modal" style="color:#99c2e4" class="faktur-link"><?php echo $data['no_faktur']; ?></a></td>
							<td><?php echo $data['nama_customer']; ?></td>
							<td><?php echo $data['no_telp']; ?></td>
							<td><?php echo $data['alamat']; ?></td>
							<td><?php echo $data['catatan']; ?></td>
							<td><?php if ($data['nama_pengantar']!='' && $data['nama_pengantar']!=null) echo $data['nama_pengantar']; else if ($data['selisih']>=-1 && $dispatcher) echo '<button type="button" class="btn btn-primary assign-btn" data-toggle="modal" data-target="#assign-modal">Assign</button>'; ?></td>
							<td><?php echo $data['waktu_permintaan']; ?></td>
							<td><?php echo $data['selisih']; ?></td>
							<td><?php echo $data['status']; ?></td>
							<td><?php echo $data['gateway']; ?></td>
							<?php if ($dispatcher) { ?>
							<td><button type="button" class="btn btn-primary edit-btn" data-toggle="modal" data-target="#edit-modal">Edit</button></td>
							<td><a class="btn btn-danger delete-btn" data-toggle="modal" href="act/delete_saved_delivery.php?id=<?= $data['id']?>" onclick="return confirm('Apakah Anda yakin ingin menghapus order delivery ini? Data yang telah dihapus tidak dapat dikembalikan')">Delete</a></td>
							<?php } ?>
						</tr>
						<?php }?>
					</tbody>
				</table>
			</fieldset>

			<fieldset>
				<legend align="center" ><marquee behavior=alternate  width="800"><strong>Tabel Jemput</strong></marquee></legend>
				<table id="jemput" class="display" style="font-size:12px">
					<thead>
						<tr>
							<th>Jadwal Delivery</th>
							<th>Nama</th>
							<th>No. Telp</th>
							<th>Alamat</th>
							<th>Catatan</th>
							<th>Delivery</th>
							<th>Waktu</th>
							<th>Selisih Hari</th>
							<th>Status</th>
							<?php if ($dispatcher) { ?>
							<th>Edit</th>
							<th>Delete</th>
							<?php } ?>
						</tr>
					</thead>
					<tbody>
						<?php
						$query = "SELECT id,no_faktur,DATE_FORMAT(tgl_permintaan,'%d/%m/%Y') AS tgl_permintaan, nama_customer, no_telp, alamat, catatan, nama_pengantar, waktu_permintaan, DATEDIFF(NOW(),tgl_permintaan) AS selisih, status FROM delivery WHERE jenis_permintaan='Jemput' AND status<>'Sukses' ORDER BY selisih DESC";
						$tampil = mysqli_query($con, $query);
						while($data = mysqli_fetch_array($tampil)){?>
							<tr data-id="<?php echo $data['id']?>">
								<td><?php echo $data['tgl_permintaan']; ?></td>
								<td><?php echo $data['nama_customer']; ?></td>
								<td><?php echo $data['no_telp']; ?></td>
								<td><?php echo $data['alamat']; ?></td>
								<td><?php echo $data['catatan']; ?></td>
								<td><?php if ($data['nama_pengantar']!='' && $data['nama_pengantar']!=null) echo $data['nama_pengantar']; else if ($data['selisih']>=-1 && $dispatcher) echo '<button type="button" class="btn btn-primary assign-btn" data-toggle="modal" data-target="#assign-modal">Assign</button>'; ?></td>
								<td><?php echo $data['waktu_permintaan']; ?></td>
								<td><?php echo $data['selisih']; ?></td>
								<td><?php echo $data['status']; ?></td>
								<?php if ($dispatcher) { ?>
								<td><button type="button" class="btn btn-primary edit-jemput-btn" data-toggle="modal" data-target="#edit-modal">Edit</button></td>
								<td><a class="btn btn-danger delete-btn" href="act/delete_saved_delivery.php?id=<?= $data['id']?>" onclick="return confirm('Apakah Anda yakin ingin menghapus order delivery ini? Data yang telah dihapus tidak dapat dikembalikan')">Delete</a></td>
								<?php } ?>
							</tr>
							<?php }?>
						</tbody>
					</table>
				</fieldset>

		</div>


	<div class="modal fade" id="assign-modal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	    	<div class="modal-header">
		        <h5 class="modal-title">Assign Delivery</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -21px">
          			<span aria-hidden="true">&times;</span>
        		</button>

		    </div>
      		<div class="modal-body">
				<form method="post" action="act/edit_delivery.php">
		      		<input type="hidden" name="id" id="assign-id">
					<div class="form-group">
						<select class="form-control" name="delivery" id="select-delivery">
							<option value=""></option>
							<?php $qdelivery = mysqli_query($con,"SELECT name FROM user WHERE level='delivery' AND aktif='Ya' AND (type<>'subagen' or type is NULL) ");
							while ($data = mysqli_fetch_array($qdelivery)) { ?>
							<option value="<?= $data['name'] ?>"><?= $data['name'] ?></option>
							<?php } ?>
						</select>
					</div>
			        <input type="submit" class="btn btn-success" value="Pilih"/>
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
				</form>
	      	</div>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="faktur-modal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	    	<div class="modal-header">
		        <h5 class="modal-title">Informasi No. Faktur - <b><span id="no-faktur-info"></span></b></h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -21px">
          			<span aria-hidden="true">&times;</span>
        		</button>
		    </div>
      		<div class="modal-body">
      		<table class="table table-striped table-bordered">
      			<thead>
	      			<tr>
	      				<th>No Nota</th>
    	  				<th>Status</th>
	  				</tr>
    	  		</thead>
    	  		<tbody id="faktur-tbody">
    	  			
    	  		</tbody>
      		</table>
      		</div>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="edit-modal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	    	<div class="modal-header">
		        <h5 class="modal-title">Edit Data Delivery</span></h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -21px">
          			<span aria-hidden="true">&times;</span>
        		</button>
		    </div>
      		<div class="modal-body">
      		<form method="post" action="act/edit_delivery.php">
      			<input type="hidden" name="id" id="edit-id">
      			<div class="form-group">
					<label class="control-label col-xs-12" for="tgl_permintaan">
						Jadwal Delivery
					</label>
					<input type="text" autocomplete="off" class="form-control" name="tgl_permintaan" id="edit-tgl-permintaan" required/>
				</div>
				<div class="form-group" id="no-faktur-form-group">
					<label class="control-label col-xs-12" for="no_faktur">
						No. Faktur
					</label>
					<input type="text" autocomplete="off" class="form-control" name="no_faktur" id="edit-no-faktur" required/>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-12" for="nama_customer">
						Nama Customer
					</label>
					<input type="text" autocomplete="off" class="form-control" name="nama_customer" id="edit-nama-customer" required/>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-12" for="no_telp">
						No. Telepon
					</label>
					<input type="text" autocomplete="off" class="form-control" name="no_telp" id="edit-no-telp" required/>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-12" for="alamat">
						Alamat
					</label>
					<textarea class="form-control" rows="3" name="alamat" id="edit-alamat" required></textarea>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-12" for="catatan">
						Catatan
					</label>
					<textarea class="form-control" rows="3" name="catatan" id="edit-catatan"></textarea>
          		</div>
          		<div class="form-group">
          			<label class="control-label col-xs-12" for="nama_pengantar">
          				Delivery
          			</label>
					<select class="form-control" name="nama_pengantar" id="edit-delivery">
					</select>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-12" for="waktu_permintaan">Waktu</label>
					<select class="form-control" name="waktu_permintaan" id="edit-waktu">
						<option value="Bebas">Bebas</option>
						<option value="Pagi">Pagi (09.00 - 12.00)</option>
						<option value="Siang">Siang (12.00 - 15.00)</option>
						<option value="Sore">Sore (15.00 - 18.00)</option>
						<option value="Malam">Malam (18.00 - 21.00)</option>
					</select>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-12" for="status">Status</label>
					<select class="form-control" name="status" id="edit-status">
						<option value="Open">Open</option>
						<option value="Taken">Taken</option>
						<option value="Sukses">Sukses</option>
						<option value="Gagal">Gagal</option>
					</select>
				</div>
				<input type="submit" class="btn btn-success" value="Simpan"/>
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
		    </form>
      		</div>
	    </div>
	  </div>
	</div>
		
	</body>
</html>
