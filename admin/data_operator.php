     <?php
     include 'header2.php';
     include '../config.php';
 
	
     function set_progress($val=0){

	$data = "<div class='progress-container' style='display:none'>
			
				<div class='progress'>
					  <div class='progress-bar progress-bar-info progress-bar-striped active' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width: ". $val. "%'>
					  </div>
				</div>

			</div>";

	return $data;

}
?>
     
     <script type="text/javascript">
$(document).ready(function() {
   	oTable = $('#cuci').dataTable({
    	"bJQueryUI" : true,
		"sPaginationType" : "full_numbers",
		"iDisplayLength": 10,
        "bFilter": true,
        "aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
     })
     	
     
	});
	</script>
 
      <div class="jumbotron">
       <div class="container">
      	
      	
  		<fieldset><legend align="center" ><marquee behavior=alternate  width="250"><strong>Data Cuci</strong></marquee></legend> 
  		<?php if ( isset( $_SESSION['info'] ) ) { ?>
				<div style="width:320px;background:#eee;border-left:5px solid #46b8da;padding:10px;"> 
					Berhasil <?php echo $_SESSION['info'] ?> Data
				</div>
		<?php unset( $_SESSION['info'] ); } ?>
  		<table cellpadding="0" cellspacing="0" border="0" class="display" id="cuci">
				<thead>
				<tr>
					<th>Tgl cuci</th>
					<th>No nota</th>
					<th>operator</th>
					<th style="text-align:center">Aksi</th>
				</tr>
				</thead>
				<tbody>
				<?php
				$user_query = mysqli_query($con,"select * from cuci ")or die(mysqli_error());
				while($r = mysqli_fetch_array($user_query)){
													?>
						 <tr>
							<td><?php echo $r['tgl_cuci'] ?></td>
							<td><?php echo $r['no_nota'] ?></td>
							<td><?php echo $r['op_cuci'] ?></td>
							<td style="text-align:center;width:160px">

								<a  class="btn btn-sm btn-success" href="javascript:;"
									data-id="<?php echo $r['id'] ?>"
									data-tgl_cuci="<?php echo $r['tgl_cuci'] ?>"
									data-no_nota="<?php echo $r['no_nota'] ?>"
									data-op_cuci="<?php echo $r['op_cuci'] ?>"
									data-toggle="modal" data-target="#edit-data-cuci">
									<i class="fa fa-pencil"></i> Edit</a>
								<a class="btn btn-sm btn-danger" href="javascript:;" data-id="<?php echo $r['id'] ?>" data-toggle="modal" data-target="#modal-konfirmasi"><i class="fa fa-trash"></i> Hapus</a>
							</td>
						</tr>

				<?php } ?>
</tbody>	
</table>
</fieldset>



</div>
</div>


       






	<!-- Modal edit data -->
	<div id="edit-data-cuci" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<form id="form-data" method="post" action="operasional_engine.php?p=edit_cuci">
				<input type="hidden" name="id" id="id">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Edit Data Cuci</h4>
					</div>

					<div class="modal-body">

						  <fieldset>

						    <div class="form-group">
						      <label for="tgl_input">Tgl Cuci</label>
						      <input type="text" disabled="true" name="tgl_cuci" id="tgl_cuci" class="form-control" placeholder="">
						    </div>

						    <div class="form-group">
						      <label for="no_nota">no nota</label>
						      <input type="text" id="no_nota" name="no_nota" class="form-control" placeholder="Masukkan Nama">
						    </div>

						    <div class="form-group">
						      <label for="op_cuci">operator cuci</label></label>
						      <select disabled="true" id="op_cuci" name="op_cuci" class="form-control">
						        <option value="">Pilih Operator</option>
						        <option value="ati">ati</option>
						        <option value="nelaoperator">nelaoperator</option>
						        <option value="kasma">kasma</option>
						        
     						    
						      </select>
						    </div>


						   

						  </fieldset>

						<?php echo set_progress(); ?>

					</div>

					<div class="modal-footer">
						<button class="btn btn-info btn-submit"><i class="fa fa-save"></i> Simpan</button>
						<button class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
					</div>

				</form>

			</div>
		</div>
	</div>
	
	<!-- modal konfirmasi-->
	<div id="modal-konfirmasi" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Konfirmasi</h4>
				</div>

				<div class="modal-body" style="background:#d9534f;color:#fff">
					Apakah Anda yakin ingin menghapus data ini?
				</div>

				<div class="modal-footer">
					<a href="javascript:;" class="btn btn-danger" id="hapus-true">Ya</a>
					<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
				</div>

			</div>
		</div>
	</div>
	
	
	
	
	
	
	<!-- Modal peringatan jika field belum terisi sempurna -->
	<div id="modal-peringatan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm modal-warning">
			<div class="modal-content">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="title">Peringatan</h4>
				</div>

				<div class="modal-body" style="background: #d9534f; color: #fff;">
					<div id="pesan-required-field"></div>
				</div>

				<div class="modal-footer">

					<center><button type="button" class="btn btn-default" data-dismiss="modal">OK</button></center>

				</div>

			</div>
		</div>
	</div>

<script>
	// Fungsi untuk pengiriman form baca dokumentasinya di https://github.com/malsup/form/
	function set_ajax(identifier){
		
		var options = {
			beforeSend: function() {

				$(".progress-container").show();
				$(".btn-submit").attr("disabled",""); // Membuat button submit jadi tidak bisa terklik
			 
			},
			uploadProgress: function(event, position, total, percentComplete) {

				$(".progress-bar").attr('style','width'+percentComplete+'%');

			},
			success:function(data, textStatus, jqXHR,ui) {

				if ( data.trim() == "Sukses" ) {

					$(".progress-bar").attr('style','width:100%');
					setTimeout(function(){ location.reload() }, 2000);

				} else {

					$(".progress-container").hide();
					$("#pesan-required-field").html(data);
					$("#modal-peringatan").modal('show');
					$(".btn-submit").removeAttr('disabled','');
				}

			},
			error: function(jqXHR, textStatus, errorThrown){

				$(".progress-container").hide();
				$("#pesan-required-field").html('Gagal Memproses data<br/> textStatus='+textStatus+', errorThrown='+errorThrown);
				$("#modal-peringatan").modal('show');
			}
		 
		};
		 
		// kirim form dengan opsi yang telah dibuat diatas
		$("#"+identifier).ajaxForm(options);
	}

	$(function(){
		// Untuk pengiriman form sunting
		set_ajax('edit-data-cuci');
		
		
		

		// Hapus
		$('#modal-konfirmasi').on('show.bs.modal', function (event) {
			var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

			// Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus
			var id = div.data('id') 

			var modal = $(this)

			// Mengisi atribut href pada tombol ya yang kita berikan id hapus-true pada modal.
			modal.find('#hapus-true').attr("href","operasional_engine.php?p=hapus_cuci&id="+id); 

		});
		
		
		


		// Untuk sunting
			$('#edit-data-cuci').on('show.bs.modal', function (event) {
			var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

			
			var id 			= div.data('id');
			var tgl_cuci 	= div.data('tgl_cuci');
			var no_nota 	= div.data('no_nota');
			var op_cuci    = div.data('op_cuci');
			
			

			var modal 	= $(this)

			// Isi nilai pada field
		
			modal.find('#id').attr("value",id);
			modal.find('#tgl_cuci').attr("value",tgl_cuci);
			modal.find('#no_nota').attr("value",no_nota);
			modal.find('#op_cuci').attr("value",op_cuci);
			

			// Membuat combobox terpilih berdasarkan jenis kelamin yg tersimpan saat pengeditan
			modal.find('#op_cuci option').each(function(){
				  if ($(this).val() == op_cuci )
				    $(this).attr("selected","selected");
					});
			
			});
			
			
			
	});
	

</script>
	
