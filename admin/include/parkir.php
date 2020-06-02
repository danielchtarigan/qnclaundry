	
		<h2><center>STATUS PARKIR OUTLET</center></h2>
		<hr />
			<!-- Pesan jika telah melakukan aksi -->
			
			<table class="table table-striped table-bordered table-hover">
				<tr>
				<th style="text-align:center">No</th>
					<th style="text-align:center">Nama Outlet</th>
					<th style="text-align:center">Status Free Parking</th>
				</tr>

				<?php $sql = $con->query("SELECT * FROM parkir natural join outlet");
				$no=1;
				while ( $r = $sql->fetch_assoc() ) { ?>

						<tr>
						<td style="text-align:center;"><?php echo $no++; ?></td>
							<td style="text-align:center;"><?php echo $r['nama_outlet'] ?></td>
							<td style="text-align:center;"><a class="btn btn-xs <?php if($r['status']==1) echo 'btn-success'; else echo 'btn-warning';?>" href="?menu=change&aktif=<?php echo $r['status'] ?>&park=<?php echo $r['id_park'] ?>"> 
							<?php 
							if($r['status']==1) echo 'Aktif'; else echo 'Tidak Aktif'; ?></a>
							</td>
							
						</tr>

				<?php } ?>

			</table>



