<?php
include '../config.php';


	$startDate = '2017-07-29';
	$endDate   = '2017-08-12';

?>

<table border="1">
	<thead>
		<tr>
		    <th>Tanggal Masuk</th>
			<th>Tanggal Lunas</th>
			<th>Nomor Nota</th>
			<th>Berat</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$query = mysqli_query($con, "SELECT *FROM reception WHERE id_customer='16812' AND cara_bayar LIKE '%kuota%' AND DATE_FORMAT(tgl_lunas, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	while($data = mysqli_fetch_array($query)){ ?>
		<tr>
			<td><?php echo $data['tgl_input'] ?></td>
			<td><?php echo $data['tgl_lunas'] ?></td>
			<td><?php echo $data['no_nota'] ?></td>
			<td><?php echo $data['berat'] ?></td>
		</tr>
	<?php
	}
	?>
	</tbody>
</table>