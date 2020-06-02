<?php
include "../config.php";
session_start();
// Fungsi untuk menampilkan progress bar
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
<!DOCTYPE html>
<html>
	<head>
		
		<title>Data Customer</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta charset="utf-8">

		<link href="css/bootstrap.min.css" rel="stylesheet">	
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link href="css/style.css" rel="stylesheet">	
		<link rel="stylesheet" type="text/css" href="../lib/css/jquery.dataTables.css" />
		<link rel="stylesheet" type="text/css" href="../lib/css/jquery.dataTables_themeroller.css" />
		<link rel="stylesheet" type="text/css" href="../lib/css/jquery.dataTables.css">
		<link rel="stylesheet" type="text/css" href="../lib/css/jquery-ui.css">
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.form.js"></script>
		
<script type="text/javascript">
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#example tfoot th').each( function () {
        var title = $('#example thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#example').DataTable();
     
    // Apply the filter
    $("#example tfoot input").on( 'keyup change', function () {
        table
            .column( $(this).parent().index()+':visible' )
            .search( this.value )
            .draw();
    } );
} );

		
	</script>



		<style>
			tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
		</style>

	</head>

<body>
	<section class="container">
	
	

		<h2><center>Data Reception</center><a href="index.php"> back </a></h2>
		<hr />
				<div class="col-md-offset-1 col-md-10 col-md-offset-1">

			<b>User</b>
			<!-- Pesan jika telah melakukan aksi -->
			<?php if ( isset( $_SESSION['info'] ) ) { ?>
				<div style="width:320px;background:#eee;border-left:5px solid #46b8da;padding:10px;"> 
					Berhasil <?php echo $_SESSION['info'] ?> Data
				</div>
			<?php unset( $_SESSION['info'] ); } ?>
			
			
				<button class="btn btn-xs pull-right" data-id='0' data-toggle="modal" data-target="#tambah-data"> <i class="icon-plus"></i>+ Tambah Data</button> <br /><br />
			
			<table id="example" class="display">
				<thead>
				<tr>
					<th>tgl_input</th>
					<th>no_nota</th>
					<th>cuci</th>
					<th>pengering</th>
					<th>setrika</th>
					<th>packing</th>
					<th>kembali</th>
					<th style="text-align:center">Aksi</th>
				</tr>
				</thead>
				<tfoot>
            <tr>
                <th>tgl_input</th>
					<th>no_nota</th>
					<th>cuci</th>
					<th>pengering</th>
					<th>setrika</th>
					<th>packing</th>
					<th>kembali</th>
					<th style="text-align:center">Aksi</th>
            </tr>
        </tfoot>
				
				
				
				<tbody>
				<?php $sql = $con->query("SELECT * FROM reception "); ?>

					<?php while ( $r = $sql->fetch_assoc() ) { ?>

						<tr>
						
							<td><?php echo $r['tgl_input'] ?></td>
							<td><?php echo $r['no_nota'] ?></td>
							<td><?php echo $r['cuci'] ?></td>
							<td><?php echo $r['pengering'] ?></td>
							<td><?php echo $r['setrika'] ?></td>
							<td><?php echo $r['packing'] ?></td>
							<td><?php echo $r['kembali'] ?></td>
							
							<td style="text-align:center;width:160px">

								<a  class="btn btn-xs btn-warning" href="javascript:;"
									data-id="<?php echo $r['id'] ?>"
									data-tgl_input="<?php echo $r['tgl_input'] ?>"
									data-no_nota="<?php echo $r['no_nota'] ?>"
									data-cuci="<?php echo $r['cuci'] ?>"
									data-pengering="<?php echo $r['pengering'] ?>"
									data-setrika="<?php echo $r['setrika'] ?>"
									data-packing="<?php echo $r['packing'] ?>"
									data-kembali="<?php echo $r['kembali'] ?>"
									data-toggle="modal" data-target="#edit-data">

									<i class="fa fa-pencil"></i> Sunting

								</a>
								<a class="btn btn-xs btn-danger" href="javascript:;" data-id="<?php echo $r['id'] ?>" data-toggle="modal" data-target="#modal-konfirmasi"><i class="fa fa-trash"></i> Hapus</a>
							</td>
						</tr>

				<?php } ?>
</tbody>	</table>

			

		</div>

	</section>



	<!-- Modal tambah data -->
	<div id="tambah-data" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<form id="form-data" method="post" action="customer_engine.php?p=tambah">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Tambah Data</h4>
					</div>

					<div class="modal-body">

						  <fieldset>

						    <div class="form-group">
						      <label for="nama_customer">Nama Customer</label>
						      <input type="text" name="nama_customer" class="form-control" placeholder="Masukkan nama_customer">
						    </div>

						    <div class="form-group">
						      <label for="alamat">alamat</label>
						      <input type="text" name="alamat" class="form-control" placeholder="Masukkan Alamat">
						    </div>

						    <div class="form-group">
						      <label for="Notelp">No Telp</label>
						      <input type="text" name="no_telp" class="form-control" placeholder="Masukkan no_telp">
						    </div>

						    <div class="form-group">
						      <label for="zona">Zona</label>
						      <select name="zona" class="form-control">
						        <option value="">Pilih Zona</option>
						        <option value="1">1</option>
						        <option value="2">2</option>
     						    <option value="3">3</option>
						        <option value="4">4</option>

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

	<!-- Modal edit data -->
	<div id="edit-data" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<form id="form-data" method="post" action="reception_engine.php?p=update">
				<input type="hidden" name="id" id="id">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Edit Data</h4>
					</div>

					<div class="modal-body">

						  <fieldset>

						    <div class="form-group">
						      <label for="tgl_input">tgl_input</label>
						      <input type="text" name="tgl_input" id="tgl_input" class="form-control" placeholder="Masukkan tgl_input">
						    </div>

						    <div class="form-group">
						      <label for="no_nota">no_nota</label>
						      <input type="text" id="no_nota" name="no_nota" class="form-control" placeholder="Masukkan Nama">
						    </div>

						    <div class="form-group">
						      <label for="cuci">cuci</label></label>
						      <select id="cuci" name="cuci" class="form-control">
						         <option value="">Pilih pengering</option>
						        <option value="0">belum</option>
						        <option value="1">sudah</option>
     						    
						      </select>
						    </div>

						    <div class="form-group">
						      <label for="pengering">pengering</label>
						      <select id="pengering" name="pengering" class="form-control">
						         <option value="">Pilih pengering</option>
						        <option value="0">belum</option>
						        <option value="1">sudah</option>
     						    
						      </select>
						    </div>
						    <div class="form-group">
						      <label for="setrika">setrika</label></label>
						      <select id="setrika" name="setrika" class="form-control">
						         <option value="">Pilih pengering</option>
						        <option value="0">belum</option>
						        <option value="1">sudah</option>
     						    
						      </select>
						    </div>

						    <div class="form-group">
						      <label for="packing">pakcing</label>
						      <select id="packing" name="packing" class="form-control">
						         <option value="">Pilih pengering</option>
						        <option value="0">belum</option>
						        <option value="1">sudah</option>
     						    
						      </select>
						    </div><div class="form-group">
						      <label for="kembali">kembali</label></label>
						      <select id="kembali" name="kembali" class="form-control">
						         <option value="">Pilih pengering</option>
						        <option value="0">belum</option>
						        <option value="1">sudah</option>
     						    
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

		// Untuk pengiriman form tambah
		set_ajax('tambah-data');

		// Untuk pengiriman form sunting
		set_ajax('edit-data');

		// Hapus
		$('#modal-konfirmasi').on('show.bs.modal', function (event) {
			var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

			// Untuk mengambil nilai dari data-id="" yang telah kita tempatkan pada link hapus
			var id = div.data('id') 

			var modal = $(this)

			// Mengisi atribut href pada tombol ya yang kita berikan id hapus-true pada modal.
			modal.find('#hapus-true').attr("href","reception_engine.php?p=hapus&id="+id); 

		});


		// Untuk sunting
		$('#edit-data').on('show.bs.modal', function (event) {
			var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan

			
			var id 	= div.data('id');
			var tgl_input 	= div.data('tgl_input');
			var no_nota 	= div.data('no_nota');
			var cuci 	= div.data('cuci');
			var pengering 	= div.data('pengering');
			var setrika 	= div.data('setrika');
			var packing 	= div.data('packing');
			var kembali 	= div.data('kembali');
			
			

			var modal 	= $(this)

			// Isi nilai pada field
		
			modal.find('#id').attr("value",id);
			modal.find('#tgl_input').attr("value",tgl_input);
			modal.find('#pengering').attr("value",pengering);
			modal.find('#no_nota').attr("value",no_nota);
			modal.find('#cuci').attr("value",cuci);
			modal.find('#setrika').attr("value",setrika);
			modal.find('#packing').attr("value",packing);
			modal.find('#kembali').attr("value",kembali);
			

			// Membuat combobox terpilih berdasarkan jenis kelamin yg tersimpan saat pengeditan
			modal.find('#pengering option').each(function(){
				  if ($(this).val() == pengering )
				    $(this).attr("selected","selected");
			});
			modal.find('#cuci option').each(function(){
				  if ($(this).val() == cuci )
				    $(this).attr("selected","selected");
			});
			modal.find('#setrika option').each(function(){
				  if ($(this).val() == setrika )
				    $(this).attr("selected","selected");
			});
			modal.find('#packing option').each(function(){
				  if ($(this).val() == packing )
				    $(this).attr("selected","selected");
			});
			modal.find('#kembali option').each(function(){
				  if ($(this).val() == kembali )
				    $(this).attr("selected","selected");
			});

		});

	});

</script>
<script type="text/javascript" language="javascript" src="../lib/js/jquery.dataTables.min.js"></script>
   <script type="text/javascript" language="javascript" src="../lib/js/jquery-ui.js"></script>



</body>
</html>