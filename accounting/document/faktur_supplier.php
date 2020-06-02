
<?php 
include '../config.php';

date_default_timezone_set('Asia/Makassar');
$tgl = date('d M Y');

$hari = date('l');

switch($hari){
	case "Monday" : $day = "Senin"; break;
	case "Tuesday" :  $day ="Selasa"; break;
	case "Wednesday" : $day = "Rabu"; break;
	case "Thursday" : $day = "Kamis"; break;
	case "Friday" : $day = "Jumat"; break;
	case "Saturday" : $day = "Sabtu"; break;
	case "Sunday" : $day = "Minggu"; break;
	default :  $day = "-";
}

$date = $day.', '.$tgl;

function rupiah($angka){
	$data = "Rp ".number_format($angka,0,',','.');
	return $data;
}

$query = mysqli_query($con, "SELECT *FROM pemesanan WHERE nama_supplier='$_GET[supplier]' AND DATE_FORMAT(tanggal_pesan, '%Y/%m/%d') BETWEEN '$_GET[start]' AND '$_GET[end]'");
$row = mysqli_fetch_array($query);
?>



			<div align="center"><strong><span style="font-size:11pt;">FAKTUR PEMBAYARAN</span></strong></div>
			<br>
			<div align="center">
				<span>PT CEPAT DAN BERSIH INDONESIA</span><br>
				<span>Jl. Toddopuli Raya No.10 A</span><br>
				<span>0411-444180</span><br>
				<span>Makassar - Sulawesi Selatan</span><br>
			</div>
			<br>
				<div align="left">
					<table style="font-size:9pt">
						<tr>							
							<td>Tanggal</td>
							<td>&nbsp; :&nbsp; &nbsp; </td>
							<td><?php echo $date ?></td>
						</tr>
						<tr>
							<td>Nama Supplier</td>
							<td>&nbsp; :&nbsp; &nbsp; </td>
							<td><?php echo $row['nama_supplier'] ?></td>
						</tr>
						<tr>
							<td>Nomor</td>
							<td>&nbsp; :&nbsp; &nbsp; </td>
							<td>......</td>
						</tr>
					</table>
				</div>
			<br>
			<div>
				<table class="table table-bordered" style="font-size: 9pt">
					<thead>
						<tr>
							<th>Tanggal Order</th>
							<th>No. Order</th>
							<th>Nama Barang</th>
							<th>Qty</th>
							<th>Harga</th>
							<th>Jumlah</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$query = mysqli_query($con, "SELECT *FROM pemesanan WHERE nama_supplier='$_GET[supplier]' AND lunas=true AND DATE_FORMAT(tanggal_pesan, '%Y/%m/%d') BETWEEN '$_GET[start]' AND '$_GET[end]'");
						while($data = mysqli_fetch_array($query)){ ?>
						<tr>
							<td><?php echo date('d F Y', strtotime($data['tanggal_pesan'])) ?></td>
							<td><?php echo $data['no_nota'] ?></td>
							<td><?php echo $data['nama_item'] ?></td>
							<td><?php echo $data['quantity'] ?></td>
							<td><?php echo rupiah($data['harga']) ?></td>
							<td><?php echo rupiah($data['quantity']*$data['harga']) ?></td>
						</tr>

						<?php }
						?>
						<tr>
							<td colspan="5" align="right" style="font-weight: bold">Total</td>
							<td>
								<?php 
								$query = mysqli_query($con, "SELECT SUM(harga*quantity) AS total FROM pemesanan WHERE nama_supplier='$_GET[supplier]' AND lunas=true AND DATE_FORMAT(tanggal_pesan, '%Y/%m/%d') BETWEEN '$_GET[start]' AND '$_GET[end]'");
								$data = mysqli_fetch_row($query);
								echo rupiah($data[0]);
								?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>