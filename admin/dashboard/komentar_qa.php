	<div class="container">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Nama</th>
					<th>Kritik dan saran</th>
					<th>Waktu</th>
					<th>Jumlah</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<?php 
					$qa = mysqli_query($con, "select *from quality_audit order by tgl_input DESC LIMIT 10");
					while($hasilqa = mysqli_fetch_array($qa)){?>
						<td><?php echo $hasilqa['nama_customer'] ?></td>
						<td><?php echo $hasilqa['ket'] ?></td>
						<td><?php if($hasilqa['waktu']=='ya' or $hasilqa['waktu']=='Ya') echo "OK"; else echo "Telat"; ?></td>
						<td><?php if($hasilqa['jumlah']=='ya' or $hasilqa['jumlah']=='Ya') echo "OK"; else echo "Tidak"; ?></td>		
				</tr>
					<?php
					}
					?>		
			</tbody>
		</table>
	</div>