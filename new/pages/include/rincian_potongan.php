<table class="table table-condensed table-striped table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama Item</th>
			<th>Harga Satuan</th>
			<th>Jumlah</th>
			<th>Keterangan</th>
		</tr>
	</thead>
	<tbody id="data_potongan">
		<?php 
		include '../../config.php';
		$no = 1;
		$query = mysqli_query($con, "SELECT *FROM order_potongan_tmp WHERE id_customer='$_GET[id]' AND new_nota=''");
		if(mysqli_num_rows($query)>0){
			while($result = mysqli_fetch_assoc($query)){		
			?>
			<tr>
				<td class="hidden" id="no_nota"><?php echo $result['no_nota'] ?></td>
				<td align="center"><?php echo $no ?></td>
				<td><?php echo $result['item'] ?></td>
				<td><?php echo $result['harga'] ?></td>
				<td align="center"><?php echo $result['jumlah'] ?></td>
				<td><?php echo $result['ket'] ?></td>
			</tr>
			<?php
			$no++;
			}				
		} else {
		?>
		<tr>
			<td colspan="5" align="center">..Data tidak ada..</td>
		</tr>
		<?php } ?>
	</tbody>
</table>

