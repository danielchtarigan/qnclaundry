<?php 

$startDate = date('Y-m', strtotime('-1 months', strtotime(date('Y-m-d')))).'-26';
$endDate = date('Y-m').'-25';



?>

<div>
	<h4 align="center"><strong>Berikut Pencapaian KPI Anda Periode <?php echo date('d M Y', strtotime($startDate)).' - '.date('d M Y', strtotime($endDate)); ?></strong></h4>
	<div>
		<table class="table table-bordered table-condensed" style="font : 9pt arial">
			<thead>
				<tr>
					<th style="text-align: center">SPK Kiloan</th>
					<th style="text-align: center">SPK Potongan 2%</th>
					<th style="text-align: center">SPK Potongan 7%</th>
					<th style="text-align: center">Langganan Baru</th>
					<th style="text-align: center">Membership</th>
					<th style="text-align: center">Reject Operator</th>
					<th style="text-align: center">Tidak SO</th>
					<th style="text-align: center">Tidak TK</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				include '../admin/fungsi/kpi_reception.php';
				$query = mysqli_query($con, "SELECT jenis,type FROM user WHERE name='$_SESSION[user_id]'");
				$row = mysqli_fetch_array($query);

				$data = kpi_reception($_SESSION['user_id'],$row['type'],$row['jenis'],$startDate,$endDate);
				echo '<tr>';
				echo '<td align="right">'.rupiah($data['bonus_spk_kiloan']).'</td>';
				echo '<td align="right">'.rupiah($data['spk_potongan_2']).'</td>';
				echo '<td align="right">'.rupiah($data['spk_potongan_7']).'</td>';
				echo '<td align="right">'.rupiah($data['langganan']).'</td>';
				echo '<td align="right">'.rupiah($data['membership']).'</td>';
				echo '<td align="right">'.rupiah($data['reject']).'</td>';
				echo '<td align="right">'.rupiah($data['tidak_so']).'</td>';
				echo '<td align="right">'.rupiah($data['tidak_tutup_kasir']).'</td>';
				echo '<tr>';

				?>
			</tbody>
		</table>
	</div>
</div>

