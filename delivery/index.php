<?php
session_start();
include 'auth.php';
include '../config.php';
include '../cek_session.php';
if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $redirect);
    exit();
}

$user_id = $_SESSION['user_id'];

function uang($angka){
	$d = "Rp ".number_format($angka,2,',','.');
	return $d;
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <title>Halaman Delivery</title>
	    <link href="../accounting/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	    <link href="../css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
	    <link href="../css/sb-admin-2.css" rel="stylesheet">
	    <link href="../font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="css/sidenav.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="../new/pages/assets/css/jquery-ui.min.css" />
	    <style>
	    	.modal-dialog {
			    margin-top:15%;
			}
			.proses-gagal {
				color: red;
				font-weight: bold;
			}
	    </style>
	    <style type="text/css">
			.border-info {
				border: 1px solid #ddd;
				border-radius: 5px;
				padding: 15px;
				padding-left: 30px;
				padding-right: 30px;
				background: #fff;
			}

			.btn-app {
				border: 3px solid #ddd;
				width: 100%;
			}
		</style>
	</head>
	<body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="index.php" class="navbar-brand navbar-center" >QnC Laundry
                    	<?php if($_SESSION['subagen']<>'') echo $_SESSION['subagen'] ?></a>
                    <a href="#" class="navbar-brand navbar-button" onclick="openNav(true);">&#9776;</a>
                </div>
            </div>
        </nav>
		<div class="container" style="margin-top:25px;margin-bottom:25px">
			<div id="mySidenav" class="nav nav-tabs sidenav">
				<a data-toggle="tab" href="#home" class="">Beranda</a>
				<?php 
				if($_SESSION['subagen']<>'') {

				} else {
					?>
					<a data-toggle="tab" href="#taken-antar">Taken (Antar)</a>
					<a data-toggle="tab" href="#taken-jemput">Taken (Jemput)</a>
					<a data-toggle="tab" href="#open-antar">Open (Antar)</a>
					<a data-toggle="tab" href="#open-jemput">Open (Jemput)</a>
					<?php
				}

				?>
				<a href="riwayat" class="">Riwayat</a>
					
				<a href="../logout.php">Logout</a>
			</div>

			<div class="tab-content main" onclick="openNav(false);">
				<div id="home" class="tab-pane fade in active">
					<div class="text-center">						
						<!-- <div class="alert alert-warning" role="alert">
							<b style="color: red"> Sedang Dikerjakan.., Order delivery nanti akan dibuat langsung di HP!!</b>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							  <span aria-hidden="true">&times;</span>
							</button>
						</div>
						<br> -->
						<?php 
						if($_SESSION['subagen']<>'') {							
							$sql = mysqli_query($con, "SELECT * FROM saldo_subagen WHERE subagen='$_SESSION[subagen]' ");
							$s = mysqli_fetch_assoc($sql);
							$saldo = $s['saldo']+$s['bonus'];
							?>
							<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
							  <div class="panel panel-default">
							    <div class="panel-heading" role="tab" id="headingOne">
							      <h4 class="panel-title">
							        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="font-size: 18px">
							          <b>Saldo Anda = <?= uang($saldo) ?></b>
							        </a>
							      </h4>
							    </div>
							    <div id="collapseOne" class="panel-collapse collapse out" role="tabpanel" aria-labelledby="headingOne">
							      <div class="panel-body">
							        <b>Saldo Utama : </b><?= uang($s['saldo']) ?><br>
							        <b>Saldo Bonus : </b><?= uang($s['bonus']) ?>
							      </div>
							    </div>
							  </div>
							</div>
							
							<button type="button" class="btn btn-default btn-lg btn-app btn-deposit" data-toggle="modal" data-target=".deposit">
							  <span class="glyphicon glyphicon-credit-card" aria-hidden="true"> <h3><strong>Deposit</strong></h3></span>
							</button>
							<?php
						}
						else {
							include 'saldo_delivery.php';
							$user_id = $_SESSION['user_id'];
							$data = saldo_delivery($user_id);

							// if($user_id=="Rian") {
							// 	echo '<div class="alert alert-warning" role="alert">
							// 			<b style="color: red"> Bpk. Ryan hari ini ke kantor yah... pukul 17:20</b>
							// 			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							// 			  <span aria-hidden="true">&times;</span>
							// 			</button>
							// 		</div>
							// 		<br>';
							// }
							
							?>
							<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
							  <div class="panel panel-success">
							    <div class="panel-heading" role="tab" id="headingOne">
							      <h4 class="panel-title">
							        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="font-size: 18px">
							          <b>Saldo Anda = <?= uang($data['saldo']) ?></b>
							        </a>
							      </h4>
							    </div>
							    <div id="collapseOne" class="panel-collapse collapse out" role="tabpanel" aria-labelledby="headingOne">
							      <div class="panel-body">
							        
							        <b>Charge Antar : </b><?= uang($data['charge_delivery']) ?><br><br>
							        <b>Info : </b> <i style="font-size: 8pt">Per tanggal 31 Desember 2018, semua order laundry di aplikasi ini, akan masuk sebagai saldo resepsionis yang sedang jaga pada outlet pilihan tempat cucian akan diproses, jadi langsung saja setor uangnya ke resepsionis yang sedang jaga tanpa penarikan saldo lagi</i>

							      </div>
							    </div>
							  </div>
							</div>
							<?php
						}
						?>
							
						<button type="button" class="btn btn-default btn-lg btn-trx btn-app">
						  <span class="glyphicon glyphicon-shopping-cart g" aria-hidden="true"> <h3><strong>Transaksi</strong></h3></span>
						</button>
					</div>
					<br>
					
					<form class="text-center hidden" id="cari_key">
						<span class="input-group">
							<input class="form-control" type="text" id="key" name="" placeholder="Cari Nomor Telpon di sini....">
							<span class="input-group-btn">
								<button class="btn btn-cari">Cari</button>
							</span>
						</span>							
					</form>
					<br>

					<div class="" id="data-customer">						
					</div>

					<?php 
					if(isset($_GET['idtrx']))  {
						include 'transaksi.php';
					}
					?>

				</div>

				<div id="taken-antar" class="tab-pane fade in">
					<h2 class="text-center">Pesanan Taken (Antar)</h2>
					<p class="text-center">Daftar pesanan pengantaran yang sudah diambil oleh Anda</p>
					<hr>
					<table class="table table-striped">
					<tbody>
						<?php
						$query = "SELECT id,DATE_FORMAT(tgl_permintaan,'%d/%m/%Y') AS tgl_permintaan, no_faktur, nama_customer, id_customer, no_telp, alamat, catatan, waktu_permintaan, alasan, DATEDIFF(NOW(),tgl_permintaan) AS selisih FROM delivery WHERE jenis_permintaan='Antar' AND nama_pengantar='$user_id' AND status!='Sukses' AND status!='Open' ORDER BY selisih DESC,id_customer ASC";
						$tampil = mysqli_query($con, $query);
						while($data = mysqli_fetch_array($tampil)){?>
							<tr><td>
								<div id="data-pesanan-<?php echo $data['id']?>">
								<?php 
									if($data['alasan'] != '') {
								?>
									<span class="proses-gagal">Pengantaran sebelumnya gagal</span><br>
									<b>Alasan:</b><?php echo $data['alasan']?><br><br>
								<?php
									}
								?>
								<b>Jadwal Delivery: </b><?php echo $data['tgl_permintaan']; ?><br>
								<b>No. Faktur: </b><?php echo $data['no_faktur']; ?><br>
								<b>Nama: </b><?php echo $data['nama_customer']; ?><br>
								<b>No. Telp: </b><?php echo $data['no_telp']; ?><br>
								<b>Alamat: </b><?php echo $data['alamat']; ?><br>
								<b>Catatan: </b><?php echo $data['catatan']; ?><br>
								<b>Waktu Antar: </b><?php echo $data['waktu_permintaan']; ?><br>
								</div>
								<br>
								<a href="form_sukses.php?id=<?=$data['id']?>" class="btn btn-success">Sukses</button>
								<a href="form_gagal.php?id=<?=$data['id']?>" class="btn btn-danger" style="float:right">Gagal</button>
							</td></tr>
							<?php }?>
						</tbody>
					</table>
				</div>
				<div id="taken-jemput" class="tab-pane fade in">
					<h2 class="text-center">Pesanan Taken (Jemput)</h2>
					<p class="text-center">Daftar pesanan pengantaran yang sudah diambil oleh Anda</p>
					<hr>
					<table class="table table-striped">
					<tbody>
						<?php
						$query = "SELECT id,DATE_FORMAT(tgl_permintaan,'%d/%m/%Y') AS tgl_permintaan, nama_customer, id_customer, no_telp, alamat, catatan, waktu_permintaan, alasan, DATEDIFF(NOW(),tgl_permintaan) AS selisih FROM delivery WHERE jenis_permintaan='Jemput' AND nama_pengantar='$user_id' AND status!='Sukses' AND status!='Open' ORDER BY selisih DESC,id_customer ASC";
						$tampil = mysqli_query($con, $query);
						while($data = mysqli_fetch_array($tampil)){?>
							<tr><td>
								<div id="data-pesanan-<?php echo $data['id']?>">
								<?php 
									if($data['alasan'] != '') {
								?>
									<span class="proses-gagal">Penjemputan sebelumnya gagal</span><br>
									<b>Alasan:</b><?php echo $data['alasan']?><br><br>
								<?php
									}
								?>
								<b>Jadwal Delivery: </b><?php echo $data['tgl_permintaan']; ?><br>
								<b>Nama: </b><?php echo $data['nama_customer']; ?><br>
								<b>No. Telp: </b><?php echo $data['no_telp']; ?><br>
								<b>Alamat: </b><?php echo $data['alamat']; ?><br>
								<b>Catatan: </b><?php echo $data['catatan']; ?><br>
								<b>Waktu Antar: </b><?php echo $data['waktu_permintaan']; ?><br>
								</div>
								<br>
								<a href="form_sukses.php?id=<?=$data['id']?>" class="btn btn-success">Sukses</button>
								<a href="form_gagal.php?id=<?=$data['id']?>" class="btn btn-danger" style="float:right">Gagal</button>
							</td></tr>
							<?php }?>
						</tbody>
					</table>
				</div>

				<div id="open-antar" class="tab-pane fade in">
					<h2 class="text-center">Pesanan Open (Antar)</h2>
					<p class="text-center">Daftar pesanan pengantaran cucian yang dapat diambil (mulai H-1)</p>
					<hr>
					<table class="table table-striped">
					<tbody>
						<?php
						$query = "SELECT id,DATE_FORMAT(tgl_permintaan,'%d/%m/%Y') AS tgl_permintaan, no_faktur, nama_customer, id_customer, no_telp, alamat, catatan, waktu_permintaan, alasan, DATEDIFF(NOW(),tgl_permintaan) AS selisih FROM delivery WHERE jenis_permintaan='Antar' AND no_faktur IS NOT NULL AND status='Open' ORDER BY selisih DESC,id_customer ASC";
						$tampil = mysqli_query($con, $query);
						while($data = mysqli_fetch_array($tampil)){?>
							<tr><td>
								<div id="data-pesanan-<?php echo $data['id']?>">
								<?php 
									if($data['alasan'] != '') {
								?>
									<span class="proses-gagal">Pengantaran sebelumnya gagal</span><br>
									<b>Alasan:</b><?php echo $data['alasan']?><br><br>
								<?php
									}
								?>
								<b>Jadwal Delivery: </b><?php echo $data['tgl_permintaan']; ?><br>
								<b>No. Faktur: </b><?php echo $data['no_faktur']; ?><br>
								<b>Nama: </b><?php echo $data['nama_customer']; ?><br>
								<b>No. Telp: </b><?php echo $data['no_telp']; ?><br>
								<b>Alamat: </b><?php echo $data['alamat']; ?><br>
								<b>Catatan: </b><?php echo $data['catatan']; ?><br>
								<b>Waktu Antar: </b><?php echo $data['waktu_permintaan']; ?><br>
								</div>
								<br>
								<?php if ($data['selisih'] < -1) echo 'Pesanan dapat diambil mulai dari H-1';
								else echo '<button type="button" class="btn btn-primary ambil-btn" data-toggle="modal" data-target="#ambil-modal" data-id="'.$data['id'].'" data-jenis="antar">Ambil</button>' ?>
							</td></tr>
							<?php }?>
						</tbody>
					</table>
				</div>
				<div id="open-jemput" class="tab-pane fade in">
					<h2 class="text-center">Pesanan Open (Jemput)</h2>
					<p class="text-center">Daftar pesanan jemputan cucian yang dapat diambil (mulai H-1)</p>
					<hr>
					<table class="table table-striped">
					<tbody>
						<?php
						$query = "SELECT id,DATE_FORMAT(tgl_permintaan,'%d/%m/%Y') AS tgl_permintaan,nama_customer, id_customer, no_telp, alamat, catatan, waktu_permintaan, alasan, DATEDIFF(NOW(),tgl_permintaan) AS selisih FROM delivery WHERE jenis_permintaan='Jemput' AND status='Open' ORDER BY selisih DESC,id_customer ASC";
						$tampil = mysqli_query($con, $query);
						while($data = mysqli_fetch_array($tampil)){?>
							<tr><td>
								<div id="data-pesanan-<?php echo $data['id']?>">
								<?php 
									if($data['alasan'] != '') {
								?>
									<span class="proses-gagal">Penjemputan sebelumnya gagal</span><br>
									<b>Alasan:</b><?php echo $data['alasan']?><br><br>
								<?php
									}
								?>
								<b>Jadwal Delivery: </b><?php echo $data['tgl_permintaan']; ?><br>
								<b>Nama: </b><?php echo $data['nama_customer']; ?><br>
								<b>No. Telp: </b><?php echo $data['no_telp']; ?><br>
								<b>Alamat: </b><?php echo $data['alamat']; ?><br>
								<b>Catatan: </b><?php echo $data['catatan']; ?><br>
								<b>Waktu Antar: </b><?php echo $data['waktu_permintaan']; ?><br>
								</div>
								<br>
								<?php if ($data['selisih'] < -1) echo 'Pesanan dapat diambil mulai dari H-1';
								else echo '<button type="button" class="btn btn-primary ambil-btn" data-toggle="modal" data-target="#ambil-modal" data-id="'.$data['id'].'" data-jenis="jemput">Ambil</button>' ?>
							</td></tr>
							<?php }?>
						</tbody>
					</table>
				</div>
				<div class="modal fade" id="ambil-modal">
				  <div class="modal-dialog">
				    <div class="modal-content">
			      		<div class="modal-body">
			      			Apakah Anda yakin ingin mengambil pesanan ini?
			      			<br><br>
			      			<div id="data-ambil"></div>
			      			<br>
			      			<div class="text-center">
					        <button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Batal</button>
					        <a id="ambil-submit" class="btn btn-lg btn-success">Ambil</a>
					        </div>
				      	</div>
				    </div>
				  </div>
				</div>
				<div class="modal fade" id="myModal" role="dialog">
				    <div class="modal-dialog">
				    
				      <!-- Modal content-->
				      	<div class="modal-content">
					        <div class="modal-header">
					          <button type="button" class="close" data-dismiss="modal">&times;</button>
					          <h4 class="modal-title">Modal Header</h4>
					        </div>
					        <div class="modal-body">
					          <p>Some text in the modal.</p>
					        </div>
					        <div class="modal-footer">
					          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					        </div>
				      	</div>
				      
				   	</div>
                </div>

                <div class="modal fade deposit" id="modal-deposit">
				  <div class="modal-dialog">
				    <div class="modal-content">
				    	<div class="modal-heading">
				    		<h3 class="modal-title" align="center" style="margin-top: 15px">Form Deposit</h3>
				    	</div>
			      		<div class="modal-body">
	      					<select class="form-control" id="nominal-deposit" style="margin-bottom: 15px">
	      						<option value="200000">200.000</option>
	      						<option value="250000">250.000</option>
	      						<option value="500000">500.000</option>
	      						<option value="1000000">1.000.000</option>
	      						<option value="1500000">1.500.000</option>
	      						<option value="2000000">2.000.000</option>
	      						<option value="2500000">2.500.000</option>
	      						<option value="3000000">3.000.000</option>
	      						<option value="3500000">3.500.000</option>
	      						<option value="4000000">4.000.000</option>
	      						<option value="4500000">4.500.000</option>
	      						<option value="5000000">5.000.000</option>
	      						<option value="5500000">5.500.000</option>
	      					</select>
	      					<select class="form-control" id="cara_bayard" style="margin-bottom: 15px">
	      						<option value="">--Pilih Cara Bayar--</option>
	      						<option value="Cash">&nbsp; Cash</option>
	      						<option value="TBCA">&nbsp; Transfer BCA</option>
	      						<option value="TBNI">&nbsp; Transfer BNI</option>
	      						<option value="TBRI">&nbsp; Transfer BRI</option>
	      						<option value="TPermata">&nbsp; Transfer Permata</option>
	      					</select>
			      			<div id="pesan-deposit" style="margin-bottom: 15px; color: red"></div>
			      			<div class="text-center">
					        <button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Batal</button>
					        <a id="submit-deposit" class="btn btn-lg btn-success">Simpan</a>
					        </div>
				      	</div>
				    </div>
				  </div>
				</div>
            </div>
		</div>

		<script src="../js/jquery-1.11.0.js"></script>
	    <script src="../js/bootstrap.min.js"></script>
        <script src='js/sidenav.js'></script>
		<script src="../new/pages/assets/js/jquery-ui.min.js"></script>
		<script type="text/javascript">
			$(document).on("click", ".ambil-btn", function() {
				var id = $(this).data('id');
				var jenis = $(this).data('jenis');
				var data = $('#data-pesanan-'+id).html();
				$('#data-ambil').html(data);
				$('#ambil-submit').attr('href','ambil.php?id='+id+'&jenis='+jenis);
			});
			var url = document.location.toString();
			if (url.match('#')) {
				$('.nav-tabs a[href]').removeClass('active');
				$('.nav-tabs a[href="#' + url.split('#')[1] + '"]').addClass('active');
			    $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
			} else {
				$('.nav-tabs a[href="#home"]').tab('show');
			}

			$('.btn-trx').on('click', function(){
				$('#cari_key').removeClass('hidden');
				$('.btn-deposit').addClass('hidden');
			})
			$('.btn-cari').on('click', function(e){
				e.preventDefault();
				var key = $('#key').val();
				$.ajax({
					url 	: 'customer.php',
					data 	: 'key='+key,
					success : function (data) {
						$('#data-customer').html(data);
						$('#cari_key').addClass('hidden');
					}
				})
			});

			$('#submit-deposit').on('click', function(){
				var nominal = $('#nominal-deposit').val();
				var cara_bayar = $('#cara_bayard').val();
				if(cara_bayar=="") {
					$('#pesan-deposit').html(" Cara bayar belum dipilih..");
				} else {
					$.ajax({
						url 	: 'act_deposit.php',
						data 	: 'nominal='+nominal+'&carabayar='+cara_bayar,
						success : function (data) {
							$('#pesan-deposit').html(data);
							window.location = "";
						}
					})
				}
					
			})

		</script>
	</body>
</html>
