<?php 
include '../config.php';
date_default_timezone_set('Asia/Makassar');

$year = date('Y');

?>

<div>
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Nama Customer</th>
				<th>Alamat</th>
				<th>Nomor Telepon</th>
				<th>Sejak</th>
			</tr>
		</thead>
		<tbody>
			<?php  
			$query = mysqli_query($con, "SELECT DISTINCT a.id_customer AS id, b.nama_customer AS customer, b.alamat AS alamat, b.no_telp AS no_telp, b.tgl_input AS sejak FROM reception AS a LEFT JOIN customer AS b ON a.id_customer=b.id WHERE YEAR(a.tgl_input) = '$year' AND a.nama_outlet='Baruga'");
			while($data = mysqli_fetch_array($query)){ 
				?>
			<tr>
				<td><?php echo $data['id'] ?></td>
				<td><?php echo $data['customer'] ?></td>
				<td><?php echo $data['alamat'] ?></td>
				<td><?php echo $data['no_telp'] ?></td>
				<td><?php echo $data['sejak'] ?></td>
			</tr>
			<?php
				}	?>
		</tbody>
	</table>
</div>