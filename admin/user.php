<?php
include "../config.php";
session_start();
include 'auth.php';

$cek_user = mysqli_query($con, "SELECT name FROM user WHERE level='admin' AND jenis='superAdmin'");
$usercek = mysqli_fetch_row($cek_user);
if($usercek[0]!=$_SESSION['user_id']){?>
    <script type="text/javascript">
    	alert("Hanya Akun Tertentu yang bisa akses menu ini!!!");
    	location.href = "index.php";
    </script><?php
}

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
		<title>Tambah User</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta charset="utf-8">

		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link href="css/style.css" rel="stylesheet">

		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.form.js"></script>
		<link href="../font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	</head>

<body>

	<section class="">

		<h2><center>Tambah User</center></h2>
		<hr />

		<div class="col-md-offset-1 col-md-10 col-md-offset-1">

			<b>User</b>
			<!-- Pesan jika telah melakukan aksi -->
			<?php if ( isset( $_SESSION['info'] ) ) { ?>

				<div style="width:320px;background:#eee;border-left:5px solid #46b8da;padding:10px;">
					Berhasil <?php echo $_SESSION['info'] ?> Data
				</div>

			<?php unset( $_SESSION['info'] ); } ?>
			<button class="btn btn-xs pull-right" data-id='0' data-toggle="modal" data-target="#tambah-data">+ Tambah Data</button> <br /><br />

			<table class="table table-bordered">
				<tr>
					<th>user id</th>
					<th>Nama</th>					
					<th>level</th>
					<th>cabang</th>
					<th style="text-align:center">Aksi</th>
					<th style="text-align:center">Aktif</th>
					<th>Akses tambahan</th>
					<th style="text-align: center">Izin Akses</th>
				</tr>

				<?php $sql = $con->query("SELECT * FROM user"); ?>

					<?php while ( $r = $sql->fetch_assoc() ) { ?>

						<tr>
							<td><?php echo $r['user_id'] ?></td>
							<td><?php echo $r['name'] ?></td>
							<td style="text-align:center"><?php echo $r['level'] ?></td>
							<td style="text-align:center"><?php echo $r['cabang'] ?></td>
							<td style="text-align:center;width:160px">

								<a  class="btn btn-xs btn-warning" href="javascript:;"
									data-user_id="<?php echo $r['user_id'] ?>"
									data-name="<?php echo $r['name'] ?>"
									data-level="<?php echo $r['level'] ?>"
									data-password="<?php echo $r['password'] ?>"
									data-jenis="<?php echo $r['jenis'] ?>"
									data-cabang="<?php echo $r['cabang'] ?>"
									data-toggle="modal" data-target="#edit-data">

									<i class="fa fa-pencil"></i> Sunting

								</a>

								<a class="btn btn-xs btn-danger" href="javascript:;" data-user_id="<?php echo $r['user_id'] ?>" data-toggle="modal" data-target="#modal-konfirmasi"><i class="fa fa-trash"></i> Hapus</a>
							</td>
							<td style="text-align:center;width:160px">
								<a class="btn btn-xs btn-danger" href="ubahaktif.php?aktif=<?php echo $r['aktif'] ?>&user=<?php echo $r['user_id'] ?>" data-user_id="<?php echo $r['user_id'] ?>" ><i class="fa fa-trash"></i> <?php echo $r['aktif'] ?></a>
							</td>
							<td style="text-align:center;width:160px">
								<?php echo $r['izinkan']; if($r['izinkan']<>NULL) echo '<a href="act/akses_user.php?akses=Remove&id='.$r['user_id'].'"><i class="fa fa-times" aria-hidden="true"></i></a>'; else echo '' ?> 
							</td>
							<td style="text-align:center;width:160px">
								<?php if($r['level']=='packer' || $r['level']=='operator') echo '<a href="act/akses_user.php?akses=setrika&id='.$r['user_id'].'"><button>Setrika</button></a>'; else echo ''; ?>															
							</td>
						</tr>

				<?php } ?>

			</table>



		</div>

	</section>



	<!-- Modal tambah data -->
	<div id="tambah-data" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<form id="form-tambah" method="post" action="engine.php?p=tambah">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Tambah Data</h4>
					</div>

					<div class="modal-body">

						  <fieldset>


						    <div class="form-group">
						      <label for="nama">Nama</label>
						      <input type="text" name="name" class="form-control" placeholder="Masukkan Nama">
						    </div>

						    <div class="form-group">
						      <label for="password">Password</label>
						      <input type="text" name="password" class="form-control" placeholder="Masukkan password">
						    </div>
						    
						    <div class="form-group">
						      <label for="cabang">Cabang</label>
						      <input type="text" name="cabang" class="form-control" placeholder="Masukkan cabang">
						    </div>

						    <div class="form-group">
						      <label for="level">Level</label>
						      <select id="level-tambah" name="level" class="form-control">
						        <option value="">Pilih Level</option>
						        <option value="admin">admin</option>
						        <option value="reception">reception</option>
     						    <option value="operator">operator</option>
						        <option value="packer">packer</option>
 								<option value="setrika">setrika</option>
 								<option value="delivery">delivery</option>
						      </select>
						    </div>

								<div class="form-group" id="jenis-tambah" style="display:none">
									<div><label for="Jenis">Jenis</label></div>
									<input type="radio" name="jenis" value="kiloan" class="jenis-setrika"><span class="jenis-setrika"> Kiloan </span></input>
									<input type="radio" name="jenis" value="potongan" class="jenis-setrika"><span class="jenis-setrika"> Potongan </span></input>
									<input type="checkbox" name="jenis" value="dispatcher" class="jenis-reception"><span class="jenis-reception"> Dispatcher</span></div>
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

				<form id="form-edit" method="post" action="engine.php?p=update">


					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Edit Data</h4>
					</div>

					<div class="modal-body">

						  <fieldset>

						    <div class="form-group">
						      <label for="user_id">user_id</label>
						      <input type="text" name="user_id" id="user_id" class="form-control" placeholder="Masukkan user_id">
						    </div>

						    <div class="form-group">
						      <label for="nama">Nama</label>
						      <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan Nama">
						    </div>

						    <div class="form-group">
						      <label for="password">Password</label>
						      <input type="text" id="password" name="password" class="form-control" placeholder="Masukkan password">
						    </div>
						    
						    <div class="form-group">
						      <label for="cabang">Cabang</label>
						      <input type="text" id="cabang" name="cabang" class="form-control" placeholder="Masukkan cabang">
						    </div>

						    <div class="form-group">
						      <label for="level">Level</label>
						      <select id="level" name="level" class="form-control">
						       <option value="">Pilih Level</option>
						        <option value="admin">admin</option>
						        <option value="reception">reception</option>
     						    <option value="operator">operator</option>
						        <option value="packer">packer</option>
										<option value="setrika">setrika</option>
						      </select>
						    </div>

								<div class="form-group" id="jenis" style="display:none">
									<div><label for="Jenis">Jenis</label></div>
									<input type="radio" name="jenis" value="kiloan" id="kiloan" class="jenis-setrika"><span class="jenis-setrika"> Kiloan </span></input>
									<input type="radio" name="jenis" value="potongan" id="potongan" class="jenis-setrika"><span class="jenis-setrika"> Potongan</span></input>
									<input type="checkbox" name="jenis" value="dispatcher" id="dispatcher" class="jenis-reception"><span class="jenis-reception"> Dispatcher</span></div>
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
			var user_id = div.data('user_id')

			var modal = $(this)

			// Mengisi atribut href pada tombol ya yang kita berikan id hapus-true pada modal.
			modal.find('#hapus-true').attr("href","engine.php?p=hapus&user_id="+user_id);

		});

		$('#level-tambah').change(function() {
			if (this.value == 'setrika' || this.value == 'operator') {
				$('.jenis-setrika').show();
				$('.jenis-reception').hide();
				$('#jenis-tambah').show();
			} else if (this.value == 'reception') {
				$('.jenis-setrika').hide();
				$('.jenis-reception').show();
				$('#jenis-tambah').show();
			} else {
				$('#jenis-tambah').hide();
				$('#jenis-tambah').attr('value','');
			}
		});


		// Untuk sunting
		$('#edit-data').on('show.bs.modal', function (event) {
			var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan


			var user_id 	= div.data('user_id');
			var name 	    = div.data('name');
			var level 	    = div.data('level');
			var password 	= div.data('password');
			var jenis       = div.data('jenis');
			var cabang      = div.data('cabang');
			var modal 	    = $(this)

			// Isi nilai pada field

			modal.find('#user_id').attr("value",user_id);
			modal.find('#name').attr("value",name);
			modal.find('#level').attr("value",level);
			modal.find('#password').attr("value",password);
			modal.find('#cabang').attr("value",cabang);

			if (level=='setrika' || level=='operator') {
				$('#jenis').show();
				$('.jenis-setrika').show();
				$('.jenis-reception').hide();
				if (jenis=='kiloan') $('#kiloan').prop('checked',true);
				else if (jenis=='potongan') $('#potongan').prop('checked',true);
			} else if (level=='reception') {
				$('#jenis').show();
				$('.jenis-setrika').hide();
				$('.jenis-reception').show();
				if (jenis=='dispatcher') $('#dispatcher').prop('checked',true);
				else $('#dispatcher').prop('checked',false);
			} else {
				$('#jenis').hide();
				$('#jenis').attr('value','');
			}

			// Membuat combobox terpilih berdasarkan jenis kelamin yg tersimpan saat pengeditan
			modal.find('#level option').each(function(){
				  if ($(this).val() == level )
				    $(this).attr("selected","selected");
			});


			$('#level').change(function() {
				if (this.value=='setrika' || this.value=='operator') {
					$('.jenis-setrika').show();
					$('.jenis-reception').hide();
					$('#jenis').show();
				} else if (this.value=='reception') {
					$('.jenis-setrika').hide();
					$('.jenis-reception').show();
					$('#jenis').show();
				} else {
					$('#jenis').hide();
					$('#jenis').attr('value','');
				}
			});

		});

	});

</script>

</body>
</html>
