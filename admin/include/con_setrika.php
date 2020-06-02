	
		<h2><center>CONTROL WORKSHOP SETRIKA</center></h2>
		<hr />
			
			<table class="table table-striped table-bordered table-hover">
				<tr>
				<th style="text-align:center">No</th>
					<th style="text-align:center">Nama Outlet</th>
					<th style="text-align:center">Workshop Setrika</th>
					<th style="text-align:center">Aksi</th>
				</tr>

				<?php $sql = $con->query("SELECT * FROM control");
				$no=1;
				while ( $r = $sql->fetch_assoc() ) { ?>

						<tr>
						<td style="text-align:center;"><?php echo $no++; ?></td>
							<td style="text-align:center;"><?php echo $r['nama_outlet'] ?></td>
							<td style="text-align:center;"><?php echo $r['ws_setrika'] ?></td>
							<td style="text-align:center;"><a class="btn btn-xs btn-primary" href="?menu=change2&outlet=<?php echo $r['nama_outlet'] ?>&ws=<?php echo $r['ws_setrika'] ?>"> 
							Ganti Workshop
							</a>
							</td>
							
						</tr>

				<?php } ?>

			</table>



