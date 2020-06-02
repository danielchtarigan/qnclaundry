<style type="text/css">
	th{
		text-align: center;
	}
</style>

<form method="POST" action="act/updata_tambah_kpi_rcp.php">
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-striped" style="text-align: right; font-size:12px">
					<thead>
						<tr>
							<th rowspan="2">ID</th>
							<th rowspan="2">Resepsionis</th>
							<th colspan="2">Izin (HARI)</th>							
							<th rowspan="2">Tanpa Keterangan (HARI)</th>
							<th rowspan="2">Akumulasi Terlambat (MENIT)</th>
							<th colspan="2">Lembur</th>	
							<th rowspan="2">Telat Menyetor</th>						
							<th rowspan="2">Komisi Kenaikan Omset (Rp)</th>
							<th rowspan="2">Tanggal_Update</th>			
						</tr>
						<tr>
							<th>Izin Normal</th>
							<th>Izin Mendadak</th>
							<th>Lembur 12 Jam (HARI)</th>
							<th>Lembur Reguler (JAM)</th>
						</tr>
					</thead>
					<tbody>
					<?php 

							
					$query = mysqli_query($con, "SELECT DISTINCT a.user_id AS user_id, b.id_user AS name FROM user AS a INNER JOIN log_rcp AS b ON a.name=b.id_user WHERE DATE_FORMAT(b.tgl_log, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' AND b.id_outlet<>'mojokerto' AND a.aktif='Ya' ORDER BY b.id_user ");
					while($data = mysqli_fetch_row($query)){
						$id = $data[0];
						$username = $data[1];
						

						$qtambah = mysqli_query($con, "SELECT *FROM extra_operasional WHERE id_user='$id' ");
						$datat = mysqli_fetch_array($qtambah);?>
						<tr>			
							<td><input style="font-size:12px" class="hidden" type="text" name="id[]" value="<?php echo $id ?>"><?php echo $id ?></td>
							<td><?php echo $username; ?></td>
							<td><input style="font-size:12px" class="form-control col-md-2" type="number" name="izinlebihduajam[]" value="<?php echo $datat['izin_lebih_dua_jam'] ?>" ></td>
							<td><input style="font-size:12px" class="form-control col-md-2" type="number" name="izinkurangduajam[]" value="<?php echo $datat['izin_kurang_dua_jam'] ?>"></td>
							<td><input style="font-size:12px" class="form-control col-md-2" type="number" name="absen[]" value="<?php echo $datat['absen'] ?>"></td>
							<td><input style="font-size:12px" class="form-control col-md-2" type="number" name="aktelat[]" value="<?php echo $datat['akumulasi_telat'] ?>"></td>
							<td><input style="font-size:12px" class="form-control col-md-2" type="number" name="duabelas[]" value="<?php echo $datat['duabelasjam'] ?>"></td>
							<td><input style="font-size:12px" class="form-control col-md-2" type="number" name="reguler[]" value="<?php echo $datat['lembur_reguler'] ?>"></td>		
							<td><input style="font-size:12px" class="form-control col-md-2" type="number" name="telatsetor[]" value="<?php echo $datat['telat_setor'] ?>"></td>
							<td><input style="font-size:12px" class="form-control col-md-2" type="number" name="komisiomset[]" value="<?php echo $datat['komisi_omset'] ?>"></td>
							<td><?php echo $datat['tgl_update'] ?></td>
						</tr>
					<?php
						}		
					?>
					</tbody>
				</table>
			</div>
	<button class="btn btn-md btn-primary" name="update">Updata Data</button>
</form>