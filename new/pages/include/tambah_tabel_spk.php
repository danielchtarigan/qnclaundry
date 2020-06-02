<?php 
include '../../config.php';

$query = mysqli_query($con, "SELECT * FROM detail_spk WHERE no_nota='$_GET[nota]' ORDER BY id DESC");
while($data = mysqli_fetch_array($query)) {
	?>
	<tr id="d">
		<td style="text-align: center; width: 2%"><button class="btn btn-white btn-minier btn-danger no-border btn-hapus" href="#" title="Hapus" id="<?= $data['id'] ?>"><i class="ace-icon glyphicon glyphicon-trash"></i></button></td>
		<td><?php echo $data['jenis_item'] ?></td>
		<td style="text-align: center"><?php echo $data['jumlah'] ?></td>
		
	</tr>

	<?php
} 
?>


