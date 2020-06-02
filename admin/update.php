<?php
include "header2.php";
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
   		
     var payTable=	$('#semua').dataTable({
    	"bJQueryUI" : true,
		"sPaginationType" : "full_numbers",
		"iDisplayLength": 10,
        "bFilter": true,
        "aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
     }).yadcf([
	    {
	    	column_number : 2,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },
	   
	    {column_number : 4},
	    {column_number : 5},
	    {column_number : 6},
	    {column_number : 7},
	     {column_number : 8},
	      {column_number : 9}
	    
	    ]);
     
     
     
     	
  	$('input[value="Check All"]').click(function() { // a button with Check All as its value
    $(':checkbox').prop('checked', true); // all checkboxes, you can narrow with a better selector
});
     
     
  
  
});

	</script>
<div class="container-fluid">


<fieldset><legend align="center" ><marquee behavior=alternate  width="250"><strong>Update Semua</strong></marquee></legend> 
<?php if ( isset( $_SESSION['info'] ) ) { ?>
				<div style="width:320px;background:#eee;border-left:5px solid #46b8da;padding:10px;"> 
					Berhasil <?php echo $_SESSION['info'] ?> Data
				</div>
			<?php unset( $_SESSION['info'] ); } ?>
<form action="update_operasional.php" method="post">

			<div align="center">
			<input name="cuci" class="btn btn-lg btn-danger" type="submit" id="cuci" value="Update Cuci">
			<input name="pengering" class="btn btn-lg btn-primary" type="submit" id="pengering" value="Update Pengering">
			<input name="setrika" class="btn btn-lg btn-success" type="submit" id="setrika" value="Update Setrika">
			<input name="packing" class="btn btn-lg btn-warning" type="submit" id="packing" value="Update Packing">
			<input name="kembali" class="btn btn-lg btn-info" type="submit" id="kembali" value="Update Kembali">
			<input name="semuanya" class="btn btn-lg btn-success" type="submit" id="semuanya" value="Update semuanya">
			<input name="delete" class="btn btn-lg btn-danger" type="submit" id="delete" value="Hapus">
			
			</div><br>
  									<table cellpadding="0" cellspacing="0" border="0" class="display" id="semua">
													
										<thead>
										  <tr>
												<th>Select All<input type="checkbox" value="Check All" id="cb" name="select_invoice" /></th>
												<th>id</th>
												<th>tgl masuk</th>
												<th>no_nota</th>
												<th>outlet</th>
												<th>cuci</th>
												<th>pengering</th>
												<th>setrika</th>
												<th>packing</th>
												<th>kembali</th>
												<th style="text-align:center">Aksi</th>
												
										   </tr>
										</thead>
										<tbody>
<?php
$user_query = mysqli_query($con,"select * from reception")or die(mysql_error());
while($row = mysqli_fetch_array($user_query)){
$id = $row['id'];
if($row['cuci']==1){
$cuci = "ok";}
else {$cuci ="-";}
if($row['pengering']==1){
$pengering = "ok";}
else {$pengering ="-";}
if($row['setrika']==1){
$setrika = "ok";}
else {$setrika ="-";}
if($row['packing']==1){
$packing = "ok";}
else {$packing ="-";}
if($row['kembali']==1){
$kembali = "ok";}
else {$kembali ="-";}
			
													?>
									
												<tr>
												<td width="30">
												<input id="optionsCheckbox" class="uniform_on" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
												</td>
												<td><?php echo $row['id']; ?></td>
												<td><?php echo $row['tgl_input']; ?></td>
												<td><?php echo $row['no_nota']; ?></td>
												<td><?php echo $row['nama_outlet']; ?></td>
												<td><?php echo $cuci; ?></td>
												<td><?php echo $pengering; ?></td>
												<td><?php echo $setrika; ?></td>
												<td><?php echo $packing; ?></td>
												<td><?php echo $kembali; ?></td>
												<td style="text-align:center;width:160px">

								<a  class="btn btn-xs btn-warning" href="javascript:;"
									data-id="<?php echo $row['id'] ?>"
									
									data-no_nota="<?php echo $row['no_nota'] ?>"
									data-nama_outlet="<?php echo $row['nama_outlet'] ?>"
									data-toggle="modal" data-target="#edit-data">
									<i class="fa fa-pencil"></i> Edit</a>
								</td>
												
												</tr>
												<?php } ?>
										</tbody>
																		
									</table>
									
									</form>
</fieldset>
</div>
<!-- Modal edit data -->
	<div id="edit-data" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<form id="form-data" method="post" action="update_engine.php?p=update">
				<input type="hidden" name="id" id="id">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Edit Data</h4>
					</div>

					<div class="modal-body">

						  <fieldset>
 <div class="form-group">
						      <label for="no_nota">no_nota</label>
						      <input type="text" id="no_nota" name="no_nota" class="form-control" placeholder="Masukkan Nama">
						    </div>

						    <div class="form-group">
						      <label for="outlet">outlet</label></label>
						      <select id="nama_outlet" name="nama_outlet" class="form-control">
						         <option value="">Pilih Oultet</option>
						        <option value="Toddopuli">Toddopuli</option>
						        <option value="Landak">Landak</option>
						        <option value="Baruga">Baruga</option>
						        <option value="Cendrawasih">Cendrawasih</option>
     						    
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
		set_ajax('edit-data');

		// Hapus
		$('#modal-konfirmasi').on('show.bs.modal', function (event) {
			var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

			// Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus
			var id = div.data('id') 

			var modal = $(this)

			// Mengisi atribut href pada tombol ya yang kita berikan id hapus-true pada modal.
			modal.find('#hapus-true').attr("href","update_operasional.php?p=hapus&id="+id); 

		});


		// Untuk sunting
		$('#edit-data').on('show.bs.modal', function (event) {
			var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

			
			var id 			= div.data('id');
		
			var no_nota 	= div.data('no_nota');
			var nama_outlet 		= div.data('nama_outlet');
			var modal 	= $(this)

			// Isi nilai pada field
		
			modal.find('#id').attr("value",id);
			modal.find('#no_nota').attr("value",no_nota);
			modal.find('#nama_outlet').attr("value",nama_outlet);

			// Membuat combobox terpilih berdasarkan jenis kelamin yg tersimpan saat pengeditan
			modal.find('#nama_outlet option').each(function(){
				  if ($(this).val() == nama_outlet )
				    $(this).attr("selected","selected");
			});
		});

	});
	

</script>
	

	
