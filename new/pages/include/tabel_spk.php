<?php 
include '../../config.php';


if(isset($_GET['hapus'])) {
	mysqli_query($con, "DELETE FROM detail_spk WHERE id='$_GET[id]'");
} else {
	$jenis_item = $_GET['item'].' '.$_GET['ket'];
	mysqli_query($con, "INSERT INTO detail_spk (no_nota,jenis_item,jumlah) VALUES ('$_GET[nota]','$jenis_item','$_GET[jum]') ");

	
}
?>

<table class="table table-condensed table-bordered" style="margin-top: 15px">
	<thead>
		<tr>
			<th></th>
			<th>Jenis Item</th>
			<th width="2%">Jumlah</th>
		</tr>
	</thead>
	<tbody>
		<?php 
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
	</tbody>
</table>

<table>
	<?php 
	if(mysqli_num_rows($query)>0) {
		?>
		<tr>
			<td><button class="btn btn-sm btn-success btn-selesai"> Selesai</button></td>
		</tr>

		<?php
	}

	?>
</table>


<script type="text/javascript">
	$(".btn-hapus").click(function(){
		var id = $(this).attr('id');
		var nota = '<?php echo $_GET['nota'] ?>';
		$.ajax({
			url 		: 'include/tabel_spk.php',
			data 		: 'hapus=hapus&id='+id+'&nota='+nota,
			beforeSend  : function(){
					$("#d").html("<td colspan='3' style='text-align: center'>sedang menghapus...</td>");
				},
			success 	: function(data){
				$(".table-tambah").html(data);
				}
		})
	});

	$(".btn-selesai").click(function(){
		var nota = '<?php echo $_GET['nota'] ?>';
		$.ajax({
			url 	: 'action/simpan_spk.php',
			data 	: 'nota='+nota,				
			success : function(data){
				window.location="";
			}
		})
	})
</script>