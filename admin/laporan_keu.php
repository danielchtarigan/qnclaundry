<?php 
include '../config.php';
date_default_timezone_set('Asia/Makassar');

include 'cari2.php';

if(isset($_POST['submit'])){
	$startDate = $_POST['start'];
	$endDate   = $_POST['end'];

	$pastStartDate = date('Y-m-d', strtotime('-3 months', strtotime($startDate)));
	$pastEndDate = date('Y-m-d', strtotime('-1 months', strtotime($endDate)));
} else{
	$startDate = date('Y-m', strtotime('-1 months', strtotime(date('Y-m-d')))).'-26';
	$endDate   = date('Y-m').'-25';
}
?>

<table border="1">
	<thead>
		<tr>
			<th>Tanggal Lunas</th>
			<th>Cara Bayar</th>
			<th>Nomor Faktur</th>
			<th>Nomor Nota</th>
			<th>Nama Customer</th>
			<th>Harga</th>
			<th>Tanggal Masuk</th>
			<th>Outlet</th>
			<th>Resepsionis</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$query = mysqli_query($con, "SELECT DATE_FORMAT(tgl_lunas, '%Y-%m-%d') AS tanggal, no_faktur, nama_customer, total_bayar, cara_bayar, tgl_input, no_nota, nama_outlet, nama_reception FROM reception WHERE lunas=true AND cara_bayar<>'Void' AND cara_bayar<>'kuota' AND DATE_FORMAT(tgl_lunas, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' ORDER BY tanggal ASC");
		while($data = mysqli_fetch_array($query)){?>
		<tr>
			<td><?php echo $data['tanggal']; ?></td>
			<td><?php echo $data['cara_bayar'] ?></td>
			<td><?php echo $data['no_faktur'] ?></td>
			<td><?php echo $data['no_nota'] ?></td>
			<td><?php echo $data['nama_customer'] ?></td>
			<td><?php echo $data['total_bayar'] ?></td>
			<td><?php echo $data['tgl_input'] ?></td>
			<td><?php echo $data['nama_outlet'] ?></td>
			<td><?php echo $data['nama_reception'] ?></td>
		</tr>
		<?php
		}

		?>
	</tbody>
</table>