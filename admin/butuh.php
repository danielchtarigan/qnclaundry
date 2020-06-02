<?php 
include '../config.php';


$start = '2017-12-23';
$end = '2017-12-30';

?>

<h3>Order Customer</h3>
<table>
	<thead>
		<tr>
			<th>Tanggal</th>
			<th>ID CST</th>
			<th>Nama Customer</th>
			<th>Alamat</th>
			<th>No Telp</th>
			<th>No Faktur</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$sql = mysqli_query($con, "SELECT b.id AS idcst, a.no_faktur AS faktur, a.tgl_input AS tgl, b.nama_customer AS customer, b.alamat AS alamat, b.no_telp AS telp FROM reception AS a, customer AS b WHERE a.id_customer=b.id AND DATE_FORMAT(a.tgl_input, '%Y-%m-%d') BETWEEN '$start' AND '$end'");
		while($data = mysqli_fetch_assoc($sql)) {
			?>
			<tr>
				<td><?php echo $data['tgl'] ?></td>
				<td><?php echo $data['idcst'] ?></td>
				<td><?php echo $data['customer'] ?></td>
				<td><?php echo $data['alamat'] ?></td>
				<td><?php echo $data['telp'] ?></td>
				<td><?php echo $data['faktur'] ?></td>
			</tr>

			<?php
		}
		?>
	</tbody>
</table>