
<?php 
include '../config.php';
session_start();

if($_SESSION['level']!='admin') {
    header('location: ../index.php');
}

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

require 'cari2.php';
?>
<table border="1">
	<thead>
		<tr>
		    <th>ID CS</th>
		    <th>Nama Customer</th>
		    <th>No Telp</th>
			<th>Nomor Nota</th>
			<th>Nama Outlet</th>
			<th>Item</th>
			<th>Berat</th>
			<th>Jumlah</th>
			<th>Harga</th>
			<th>Tgl Masuk</th>
			<th>Tgl Check In</th>
			<th>Tgl Cuci</th>
			<th>Cuci</th>
			<th>Tgl Kering</th>
			<th>Kering</th>
			<th>Tgl Setrika</th>
			<th>Setrika</th>
			<th>Tgl Packing</th>
			<th>Packer</th>
			<th>Kode Promo</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$query = mysqli_query($con, "SELECT *FROM reception AS a INNER JOIN detail_penjualan AS b ON a.no_nota=b.no_nota WHERE DATE_FORMAT(a.tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' AND a.nama_outlet<>'mojokerto' AND a.cara_bayar<>'Void' AND a.cara_bayar<>'Reject' ");
		while($data = mysqli_fetch_array($query)){
		?>
		<tr>
		    <td><?php echo $data['id_customer'] ?></td>
		    <td><?php echo $data['nama_customer'] ?></td>
		    <?php
		    $customer = mysqli_query($con, "SELECT no_telp FROM customer WHERE id='$data[id_customer]' ");
		    $rcust = mysqli_fetch_row($customer)[0];
		    echo '<td>'.$rcust.'</td>';
		    ?>
			<td><?php echo $data['no_nota'] ?></td>
			<td><?php echo $data['nama_outlet'] ?></td>
			<td><?php echo $data['item'].' '.$data['keterangan'] ?></td>
			<td><?php echo $data['berat'] ?></td>
			<td><?php echo $data['jumlah'] ?></td>
			<td><?php echo $data['harga']*$data['jumlah'] ?></td>
			<td><?php echo $data['tgl_input'] ?></td>
			<td><?php echo $data['tgl_workshop'] ?></td>
			<td><?php echo $data['tgl_cuci'] ?></td>
			<td><?php echo $data['op_cuci'] ?></td>
			<td><?php echo $data['tgl_pengering'] ?></td>
			<td><?php echo $data['op_pengering'] ?></td>
			<td><?php echo $data['tgl_setrika'] ?></td>
			<td><?php echo $data['user_setrika'] ?></td>			
			<td><?php echo $data['tgl_packing'] ?></td>
			<td><?php echo $data['user_packing'] ?></td>
			<td><?php echo $data['voucher'] ?></td>
		</tr>
		<?php
		}
		?>
	</tbody>
</table>


