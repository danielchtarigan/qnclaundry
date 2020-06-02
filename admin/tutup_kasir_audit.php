<?php 
include '../config.php';
include 'cari2.php';
date_default_timezone_set('Asia/Makassar');

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

<div>
	<table border="1">
		<thead>
			<th>Tanggal Pemasukan</th>
			<th>Reception</th>
			<th>Outlet</th>
			<th>Cash Bersih</th>
			<th>Pengeluaran</th>
			<th>Untuk</th>
			<th>Nota Void</th>
			<th>EDC_BRI</th>
			<th>EDC_BNI</th>
			<th>EDC_Mandiri</th>
			<th>EDC_BCA</th>
		</thead>
		<tbody>
			<?php 
			$query = mysqli_query($con, "SELECT DATE_FORMAT(tanggal, '%Y-%m-%d') AS tanggal, untuk, nota_void, reception, outlet, setoran_bersih, pengeluaran, edc_bri, edc_bni, edc_mandiri, edc_bca FROM tutup_kasir WHERE DATE_FORMAT(tanggal, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
			while($data = mysqli_fetch_array($query)){?>

			<tr>
				<td><?php echo $data['tanggal'] ?></td>
				<td><?php echo $data['reception'] ?></td>
				<td><?php echo $data['outlet'] ?></td>
				<td><?php echo $data['setoran_bersih'] ?></td>
				<td><?php echo $data['pengeluaran'] ?></td>
				<td><?php echo $data['untuk'] ?></td>
				<td><?php echo $data['nota_void'] ?></td>
				<td><?php echo $data['edc_bri'] ?></td>
				<td><?php echo $data['edc_bni'] ?></td>
				<td><?php echo $data['edc_mandiri'] ?></td>
				<td><?php echo $data['edc_bca'] ?></td>
			</tr>
			<?php
			}

			?>
		</tbody>
	</table>
</div>