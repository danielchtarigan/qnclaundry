<?php 
session_start();
include '../auth.php';
include '../../config.php';
include '../../bar128.php';
$user_id = $_SESSION['user_id'];

date_default_timezone_set('Asia/Makassar');

$sql = mysqli_query($con, "SELECT * FROM faktur_penjualan a, customer b WHERE a.id_customer=b.id AND no_faktur='$_GET[id]' ");
$rData = mysqli_fetch_array($sql);
$tgl_faktur = date('Y-m-d', strtotime($rData['tgl_transaksi']));



?>
	

<style type="text/css">
	.panel {
		max-width: 210mm;
	  	margin-bottom: 20px;
	  	background-color: #fff;
	  	border: 1px solid transparent;
	  	border-radius: 4px;
	  	-webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
	  	box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
	}	
	.panel-heading {
	  	padding: 10px 10px;
	  	border-bottom: 1px solid transparent;
	  	border-top-left-radius: 3px;
	  	border-top-right-radius: 3px;
	  	padding-bottom: 2px;
	}

	.panel-struk {
	  	border-color: #ddd;
	}

	.panel-body {
	  	padding: 10px;
	  	clear: both
	}	

	.panel-struk > .panel-heading {
	  	border-bottom: 1px solid #ddd;	  	
	}
	.panel-struk > .panel-heading + .panel-collapse > .panel-body {
	  	border-top-color: #ddd;
	}
	.panel-struk > .panel-heading .badge {
	  	color: #f5f5f5;
	  	background-color: #333;
	}
	.panel-struk > .panel-footer + .panel-collapse > .panel-body {
	  	border-bottom-color: #ddd;
	}

	.panel-title {
	  	margin-top: 0;
	  	margin-bottom: 0;
	  	font-size: 16px;
	  	color: inherit;
	}
	.panel-title > a {
	  	color: inherit;
	}

	
	.kolom {
	  	position: relative;
	  	min-height: 1px;
	  	width: 33%;
	  	float: left;
	}

	table{
		font-size: 12px;
	}

	/*table td {
		padding-bottom: 5px;
	}*/

	div.b128{
	    border-left: 1px black solid;
		height: 20px;
	}	

	
</style>


<body onload="print()">
<div class="panel panel-struk">
	<div class="panel-heading">
		<div style="width: 33%; float: left">
			<img style="width: 80%" src="../../Logo 2017.png">			
		</div>
		<div style="width: 33%; float: left; text-align: center; font-size: 12px">
			<h3>Subagen <?php echo ucwords($user_id); ?></h3>
		</div>		
		<div style="width: 33%; text-align: right; font-size: 12px; float: left">
			<b>Lembar Untuk Customer</b> <br><br>
			<b>PT. CEPAT DAN BERSIH INDONESIA</b><br>			
			Jl. Toddopuli Raya No. 8A, Telp: 0411-444180
		</div>
		<div style="clear: left"></div>
			
	</div>
	<div class="panel-body">
		<div class="kolom">
			<table>
				<tr><td>Nama Customer</td><td>:</td><td><?= $rData['nama_customer'] ?></td></tr>
				<tr><td></td><td></td><td><?= $rData['alamat'] ?></td></tr>
				<tr><td>Telp/Hp</td><td>:</td><td><?= $rData['no_telp'] ?></td></tr>				
			</table>

			<table style="margin-top: 8px">
				<?php 
				$qitem = mysqli_query($con, "SELECT DISTINCT b.item, b.jumlah FROM reception a, detail_penjualan b WHERE a.id_customer=b.id_customer AND a.no_nota=b.no_nota AND a.no_faktur='$rData[no_faktur]' AND b.item NOT LIKE '%Express%' AND b.item NOT LIKE '%Voucher%' ");
				while($rItem = mysqli_fetch_array($qitem)){
					echo '<tr><td>'.$rItem['jumlah'].'</td><td>'.$rItem['item'].'</td></tr>';
				}
				?>
				
			</table>
			<p style="font-size: 12px">Syarat dan ketentuan komplain <br> Klik : www.qnclaundry.net/complaint </p>
		</div>
		<div class="kolom" style="text-align: center">
			<b align="">Barcode Order :</b><hr>
				<?php 
				$qrecept = mysqli_query($con, "SELECT * FROM reception WHERE no_faktur='$_GET[id]' ");
				while($rRecept = mysqli_fetch_array($qrecept)){
					echo '<div align="center" style="padding-bottom: 3px">'.bar128(stripslashes($rRecept['no_nota'])).'</div>';
				}
				?>
		</div>
		<div class="kolom" style="text-align: right;">
			<table align="right">
				<tr><td></td><td>Tanggal</td><td>:</td><td align="right"><?= date('d/m/Y') ?></td></tr>
				<tr><td></td><td>Pembayaran</td><td>:</td><td align="right"><?= $rData['cara_bayar'] ?></td></tr>
				<tr><td></td><td>No ID</td><td>:</td><td align="right"><?= $rData['id_customer'] ?></td></tr>
				<tr><td></td><td>No Faktur</td><td>: &nbsp; &nbsp; &nbsp; &nbsp;</td><td align="right"><?= $rData['no_faktur'] ?></td></tr>
				<?php 
				$qrecept = mysqli_query($con, "SELECT * FROM reception WHERE no_faktur='$_GET[id]' ");
				
				?>
				<tr><td style="padding-top: 10px; font-weight: bold; padding-bottom: -40px" colspan="2">Rincian Order</td><td style="padding-top: 10px; font-weight: bold; padding-bottom: -40px">:</td><td style="padding-top: 10px; font-weight: bold; padding-bottom: -40px"></td></tr>
					<?php 
					$total = 0;
					while($rRecept=mysqli_fetch_array($qrecept)){
						echo '<tr><td></td><td>'.$rRecept['no_nota'].'</td><td>:</td><td style="text-align: right">'.number_format($rRecept['total_bayar'],0,',','.').'</td>';
						$total += $rRecept['total_bayar'];

					}
					echo '<tr><td style="font-weight: bold; border-top: 1px dotted">Total</td><td style="border-top: 1px dotted">'.$rRecept['no_nota'].'</td><td style="border-top: 1px dotted">:</td><td style="text-align: right; border-top: 1px dotted">'.number_format($total,0,',','.').'</td>'; 
					?>
					</tr>
			</table>	
				
		</div>	
	</div>
	<div style="clear: left"></div>
</div>
</body>


