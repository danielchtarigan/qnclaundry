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
<div class="panel panel-default">
	<div class="panel-body">
		<h3>Bonus SPK Terbaru</h3>
		<p><label>Deskripsi :</label>&nbsp; Bonus SPK Tidak Dihitung sebelum diinput kembali workshop, Jika telat bonus SPK tinggal 3%</p><hr>

		<form method="POST">
			<input type="text" name="tanggal1" id="tanggal1" value="<?php echo $startDate ?>">
			SD
			<input type="text" name="tanggal2" id="tanggal2" value="<?php echo $endDate ?>">
			<button type="submit" class="btn btn-default btn-md" name="cari" value="Cari">Cari</button>
		</form><hr>

		<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover table-condensed">
				<thead>
					<tr>
						<th>Nama Reception</th>
						<th>Bonus SPK Bukan Deskripsi</th>
						<th>Bonus SPK Deskripsi 1</th>
						<th>Bonus SPK Deskripsi 2</th>
					</tr>
				</thead>
				<tbody>	
					<?php 
					    include 'fungsi/kpi_reception.php';
						$query = mysqli_query($con, "SELECT * FROM user WHERE level='reception' AND aktif='Ya' AND cabang='makassar'");
			            while($row = mysqli_fetch_array($query)){
						$nama = $row['name'];
        				$type = $row['type'];
        				$jenis = $row['izinkan'];
        				$data = kpi_reception($nama,$type,$jenis,$startDate,$endDate);
					?>	
					<tr>		
						<td><?php echo $userRcp ?></td>
						<td>
						<?php 							
				// 		$query = mysqli_query($con, "SELECT SUM(total_bayar+diskon) AS total FROM reception WHERE rcp_spk='$userRcp' AND spk=1 AND tgl_spk<>'0000-00-00 00:00:00' AND DATE_FORMAT(tgl_spk, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
				// 		$data = mysqli_fetch_row($query);
				// 		echo rupiah($data[0]*0.04);
				        echo $data['bonus_spk'];
							?>
						</td>
						<td>
						<?php
				// 		$query = mysqli_query($con, "SELECT SUM(total_bayar+diskon) AS total FROM reception WHERE rcp_spk='$userRcp' AND spk=1 AND tgl_spk<>'0000-00-00 00:00:00' AND kembali=1 AND tgl_kembali<>'0000-00-00 00:00:00' AND DATEDIFF(tgl_kembali, tgl_input) <=2 AND DATE_FORMAT(tgl_spk, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
				// 		$data = mysqli_fetch_row($query);

				// 		$query2 = mysqli_query($con, "SELECT SUM(total_bayar+diskon) AS total FROM reception WHERE rcp_spk='$userRcp' AND spk=1 AND tgl_spk<>'0000-00-00 00:00:00' AND kembali=1 AND tgl_kembali<>'0000-00-00 00:00:00' AND DATEDIFF(tgl_kembali, tgl_input) >2 AND DATE_FORMAT(tgl_spk, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
				// 		$data2 = mysqli_fetch_row($query2);
				// 		$bonus = $data[0]*0.04+$data2[0]*0.03;

				// 		echo rupiah($bonus);
				        echo $data['bonus_spk_baru'];
						?>
						
						</td>
						<td><?= $data['total_bonus_spk'] ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

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





