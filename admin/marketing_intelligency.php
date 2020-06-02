<?php 
include '../config.php';

date_default_timezone_set('Asia/Makassar');
$bulan = date('Y-m');

if(isset($_POST['cari'])){
	$bulan = $_POST['tahun'].'-'.$_POST['bulan'];
} else{
	$bulan = date('Y-m');
}


?>
<div style="height: 50px; color: green; font-size: 14px">
	<form action="" method="POST">
		<label>Pencarian Bulanan</label>
		<select name="bulan">
			<option>Bulan</option>
			<option value="01">Januari</option>
			<option value="02">Februari</option>
			<option value="03">Maret</option>
			<option value="04">April</option>
			<option value="05">Mei</option>
			<option value="06">Juni</option>
			<option value="07">Juli</option>
			<option value="08">Agustus</option>
			<option value="09">September</option>
			<option value="10">Oktober</option>
			<option value="11">November</option>
			<option value="12">Desember</option>
		</select>
		<select name="tahun">
			<option>Tahun</option>
			<?php 
			$t = 6;
			for ($a=0; $a <= $t ; $a++) { 
				$tahun = date('Y')-6+$a;
				echo $tahun.'<br>';
			?>
			
			<option value="<?php echo $tahun ?>"><?php echo $tahun ?></option><?php } ?>
		</select>	
		<input type="submit" name="cari" value="Search">
	</form>
</div><br>

<?php echo date('F Y', strtotime($bulan)); ?>
<div>
	<table border="1">
		<thead>
			<tr>
				<th>Cust ID</th>
				<th>Nama Customer</th>
				<th>Outlet</th>
				<th>Frekuensi Kunjungan</th>
				<th>Kontribusi Omset</th>
			</tr>			
		</thead>
		<tbody>
			<?php 
			$query = mysqli_query($con, "SELECT DISTINCT id_customer, nama_customer FROM reception WHERE DATE_FORMAT(tgl_input, '%Y-%m')='$bulan'");
			while($row = mysqli_fetch_array($query)){
				$idcst = $row['id_customer'];
				$outlet = mysqli_query($con, "SELECT nama_outlet FROM reception WHERE id_customer='$idcst' ORDER BY tgl_input ASC LIMIT 1 ");
				$ot = mysqli_fetch_row($outlet)[0];
				?>
				<tr>
					<td><?php echo $idcst; ?></td>
					<td><?php echo $row['nama_customer'] ?></td>
					<td><?php echo $ot ?></td>
					<td>
						<?php 
						$kunjungan = mysqli_query($con, "SELECT COUNT(DISTINCT DATE_FORMAT(tgl_input, '%Y-%m-%d')) AS jumlah FROM reception WHERE DATE_FORMAT(tgl_input, '%Y-%m')='$bulan' AND id_customer='$idcst'");
						$frek = mysqli_fetch_row($kunjungan)[0];
						echo $frek;
						?>
					</td>
					<td>
						<?php 
						$kontribusi = mysqli_query($con, "SELECT COALESCE(SUM(total_bayar),0) AS jumlah FROM reception WHERE DATE_FORMAT(tgl_input, '%Y-%m')='$bulan' AND id_customer='$idcst'");
						$omset = mysqli_fetch_row($kontribusi)[0];
						echo $omset;
						?>
					</td>
				</tr>
				<?php
			}

			?>
		</tbody>
	</table>
</div>