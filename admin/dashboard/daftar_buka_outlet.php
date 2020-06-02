

<div align="center">
	<h3 align="center"><button class="btn btn-block btn-display-outlet">Tabel Buka Outlet Hari ini</button></h3>
</div>

<div class="table-responsive tabel-outlet" style="display: none" align="center">
	<table class="table table-striped table-condensed table-bordered table-hover" style="width: 600px;">
		<thead>
			<tr>
				<th>Nama Outlet</th>
				<th>Jam Buka</th>
				<th>Jam Tutup</th>
				<th>Resepsionis Terakhir</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$sql = $con->query("SELECT * FROM outlet WHERE Kota='Makassar' AND nama_outlet<>'Cendrawasih' AND nama_outlet<>'Trans Studio Mall' AND nama_outlet<>'Graha Pena' AND nama_outlet<>'Daya Grand Square' ");
			while($data = $sql->fetch_array()){
				?>
				<tr>
					<td><?= $data['nama_outlet'] ?></td>
					<td style="text-align: center">
						<?php 
						$loginFirst = mysqli_fetch_array(mysqli_query($con, "SELECT HOUR(tgl_log), MINUTE(tgl_log) FROM log_rcp WHERE id_outlet='$data[nama_outlet]' AND tgl_log LIKE '$dateNow%' ORDER BY tgl_log ASC"));
						$jam = sprintf("%02u:%02s",$loginFirst[0],$loginFirst[1]);
						echo ($jam=="00:00") ? "-" : $jam ;
						?>
					</td>
					<td style="text-align: center">
						<?php 
						$loginFirst = mysqli_fetch_array(mysqli_query($con, "SELECT HOUR(tanggal), MINUTE(tanggal) FROM tutup_kasir WHERE outlet='$data[nama_outlet]' AND tanggal LIKE '$dateNow%' ORDER BY tanggal ASC"));
						$jam = sprintf("%02u:%02s",$loginFirst[0],$loginFirst[1]);
						echo ($jam=="00:00") ? "-" : $jam ;
						?>
					</td>
					<td>
						<?php 
						$rcpAkhir = mysqli_fetch_array(mysqli_query($con, "SELECT id_user FROM log_rcp WHERE id_outlet='$data[nama_outlet]' AND tgl_log LIKE '$dateNow%' ORDER BY tgl_log DESC"))[0];
						echo $rcpAkhir;
						?>
					</td>
				</tr>

				<?php

			}
			?>
		</tbody>
	</table>
</div>
	