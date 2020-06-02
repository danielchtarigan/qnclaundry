<?php 



?>

<div>
	<h3>Deposit SubAgen</h3>
	<table class="table table-condensed table-bordered table-striped">
		<thead>
			<tr>
				<th>Tanggal Deposit</th>
				<th>Nama Subagen</th>
				<th>Jumlah</th>
				<th>Bonus Deposit</th>
				<th>ACC</th>
				<th>Admin</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$sql = mysqli_query($con, "SELECT * FROM deposit_subagen ORDER BY id DESC");
			while($data=mysqli_fetch_array($sql)) {
				?>
				<tr>
					<td><?= $data['tanggal'] ?></td>
					<td><?= $data['nama_subagen'] ?></td>
					<td><?= rupiah($data['jumlah']) ?></td>
					<td><?= rupiah($data['bonus']) ?></td>
					<td><?php if($data['acc']<>0) echo 'Ok'; else echo '<a href="act/acc_deposit_subagen.php?id='.$data['id'].'" class="btn btn-xs btn-success">True</a>';
						?>
						
					</td>
					<td><?php if($data['admin']=='') echo $_SESSION['user_id']; else echo $data['admin'] ?></td>
				</tr>
				<?php
			}

			?>
			
		</tbody>
	</table>
</div>