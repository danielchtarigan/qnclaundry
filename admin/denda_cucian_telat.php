<?php 
include '../config.php';
include 'head.php';

$date = date('Y/m/d');

if(isset($_POST['cari'])){
	$startDate = $_POST['tanggal1'];
	$endDate = $_POST['tanggal2'];
} else{
	$startDate = date('Y/m', strtotime('-1 months', strtotime($date))).'/26';
	$endDate = date('Y/m').'/25';
}



?>

<script type="text/javascript">
    $(function(){
        $("#tanggal1").datepicker({
            dateFormat:'yy/mm/dd',
        });

        $("#tanggal2").datepicker({
            dateFormat:'yy/mm/dd'
        });
    });
</script>

<div class="panel panel-default">
	<div class="panel-body">

	<h3>DENDA CUCIAN TELAT OPERASIONAL</h3>
		<p><label>Deskripsi :</label>&nbsp; Pemotongan 2 Poin jika jenis cucian Priority, Pemotongan 5 Poin jika jenis cucian Express</p><hr>

		<form method="POST">
			<input type="text" name="tanggal1" id="tanggal1" value="<?php echo $startDate ?>">
			SD
			<input type="text" name="tanggal2" id="tanggal2" value="<?php echo $endDate ?>">
			<button type="submit" class="btn btn-default btn-md" name="cari" value="Cari">Cari</button>
		</form><hr>

		<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped table-condensed">
				<thead>
					<tr>
						<th>Nama Crew</th>
						<th>Denda Cucian Telat</th>
					</tr>
				</thead>
				<tbody>
				<?php 
				$query = mysqli_query($con, "SELECT DISTINCT operator FROM denda_cucian_telat WHERE DATE_FORMAT(tgl_denda, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
				while($data = mysqli_fetch_array($query)){
				?>
					<tr>
						<td><?php echo $data['operator'] ?></td>
						<td>
							<?php 
							$query2 = mysqli_query($con, "SELECT COUNT(a.no_nota) AS denda FROM denda_cucian_telat AS a INNER JOIN reception AS b ON a.no_nota=b.no_nota WHERE a.operator='$data[operator]' AND b.express=0 AND b.priority=0 AND DATE_FORMAT(a.tgl_denda, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
							$data2 = mysqli_fetch_row($query2);

							$query3 = mysqli_query($con, "SELECT COUNT(a.no_nota*5) AS denda FROM denda_cucian_telat AS a INNER JOIN reception AS b ON a.no_nota=b.no_nota WHERE a.operator='$data[operator]' AND b.express<>0 AND DATE_FORMAT(a.tgl_denda, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
							$data3 = mysqli_fetch_row($query3);

							$query4 = mysqli_query($con, "SELECT COUNT(a.no_nota*2) AS denda FROM denda_cucian_telat AS a INNER JOIN reception AS b ON a.no_nota=b.no_nota WHERE a.operator='$data[operator]' AND b.priority<>0 AND DATE_FORMAT(a.tgl_denda, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
							$data4 = mysqli_fetch_row($query4);
							$denda = $data2[0]+$data3[0]+$data4[0];
							echo $denda.' Poin';
							?>
						</td>
					</tr>
				<?php } 
				$query = mysqli_query($con, "SELECT DISTINCT packer FROM denda_cucian_telat WHERE DATE_FORMAT(tgl_denda, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
				while($data = mysqli_fetch_array($query)){
				?>
					<tr>
						<td><?php echo $data['packer'] ?></td>
						<td>
							<?php 
							$query2 = mysqli_query($con, "SELECT COUNT(a.no_nota) AS denda FROM denda_cucian_telat AS a INNER JOIN reception AS b ON a.no_nota=b.no_nota WHERE a.packer='$data[packer]' AND b.express=0 AND b.priority=0 AND DATE_FORMAT(a.tgl_denda, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
							$data2 = mysqli_fetch_row($query2);

							$query3 = mysqli_query($con, "SELECT COUNT(a.no_nota*5) AS denda FROM denda_cucian_telat AS a INNER JOIN reception AS b ON a.no_nota=b.no_nota WHERE a.packer='$data[packer]' AND b.express<>0 AND DATE_FORMAT(a.tgl_denda, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
							$data3 = mysqli_fetch_row($query3);

							$query4 = mysqli_query($con, "SELECT COUNT(a.no_nota*2) AS denda FROM denda_cucian_telat AS a INNER JOIN reception AS b ON a.no_nota=b.no_nota WHERE a.packer='$data[packer]' AND b.priority<>0 AND DATE_FORMAT(a.tgl_denda, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
							$data4 = mysqli_fetch_row($query4);
							$denda = $data2[0]+$data3[0]+$data4[0];
							echo $denda.' Poin';
							?>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>