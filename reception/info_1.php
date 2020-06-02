
<?php 
include '../config.php';
session_start();

// if($_SESSION['level']!='admin' || $_SESSION['level']!='reception') {
//     header('location: ../index.php');
// }

date_default_timezone_set('Asia/Makassar');
if(isset($_POST['submit'])){
	$startDate = $_POST['start'];
	$endDate   = $_POST['end'];

} 


?>

<legend>
<h3>Homecleaning</h3>
<div class="row">
	<form act="" method="POST">
		<div class="form-group">
			<div class="col-md-4">
				<input type="text" name="start" id="tanggal1" class="form-control" autocomplete="off" placeholder="Mulai dari ...">
			</div>
			<div class="col-md-4">
				<input type="text" name="end" id="tanggal2" class="form-control" autocomplete="off" placeholder="Sampai dengan ...">
			</div>		
		</div>
		<input class="btn btn-success" type="submit" name="submit" placeholder="" value="Submit">
		</div>
	</form>
</div>
<br>
</legend>
	
<div class="table-responsive">
	<table class="table table-bordered table-condensed" id="tableHomecleaning" style="font-size: 11px">
		<thead>
			<tr>
			    <th>Tanggal</th>
			    <th>Nama Customer</th>
			    <th>Nomor Telepon</th>
			    <th>Item</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$query = mysqli_query($con, "SELECT *FROM reception AS a INNER JOIN detail_penjualan AS b ON a.no_nota=b.no_nota WHERE DATE_FORMAT(a.tgl_input, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate' AND a.nama_outlet<>'mojokerto' AND a.cara_bayar<>'Void' AND a.cara_bayar<>'Reject' AND a.jenis='p' AND (b.item LIKE '%Sepatu%' OR b.item LIKE '%Gordyn%') ");
			while($data = mysqli_fetch_array($query)){
			?>
			<tr>
			    <td><?php echo $data['tgl_input'] ?></td>
			    <td><?php echo $data['nama_customer'] ?></td>
			    <?php
			    $customer = mysqli_query($con, "SELECT no_telp FROM customer WHERE id='$data[id_customer]' ");
			    $rcust = mysqli_fetch_row($customer)[0];
			    echo '<td>'.$rcust.'</td>';
			    ?>
				<td><?php echo $data['item'].' '.$data['keterangan'] ?></td>
			</tr>
			<?php
			}
			?>
		</tbody>
	</table>
</div>
	

