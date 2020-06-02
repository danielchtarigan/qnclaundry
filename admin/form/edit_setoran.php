<?php 
include '../../config.php';

if(isset($_GET['edit'])){
	$id = $_GET['id'];

	$query = mysqli_query($con, "SELECT *FROM setoran_bank_sebenarnya WHERE id='$id'");
	$data = mysqli_fetch_assoc($query);

 ?>
<div id="hasil1"></div>
<table class="table table-bordered">
	<tr>
		<input class="hidden" type="text" name="" id="id1" value="<?php echo $id ?>">
		<td><input class="form-control" type="text" name="" id="tanggal1" value="<?php echo $data['tanggal'] ?>"></td>
		<td style="width: 200px">
			<select class="form-control" id="penyetor1" name="penyetor1">
				<option><?php echo $data['nama'] ?></option>
				<?php 
				$query = mysqli_query($con, "SELECT name FROM user WHERE level='reception' AND aktif='Ya' AND cabang<>'mojokerto' ORDER BY name ASC");
				while($uname = mysqli_fetch_row($query)){
					echo '<option>'.$uname[0].'</option>';
				}
				?>
			</select>
			
		<td><input class="form-control" type="text" name="" id="jumlah1" value="<?php echo $data['jumlah'] ?>"></td>
		<td><input class="form-control" type="text" name="" id="bank1" value="<?php echo $data['nama_bank'] ?>"></td>
		<td><input class="form-control" type="text" id="ket1" value="<?php echo $data['ket'] ?>"></td>
		<td><button class="btn btn-xs btn-success" id="simpan">Simpan</button></td>
	</tr>
</table>
<?php 
} 
else if(isset($_GET['hapus'])){
	$id = $_GET['id'];
	$query = mysqli_query($con, "DELETE FROM setoran_bank_sebenarnya WHERE id='$id'"); 
	echo "<p style='color: red; text-align: center'>Data berhasil dihapus!!</p>"; ?>
	<script type="text/javascript">
		location.href = "laporan.php?form=Setoran";
	</script> <?php
}

?>

<script type="text/javascript">
	$('#simpan').click(function(){
		var edit = "edit";
		var id = $("#id1").val();
		var tgl = $("#tanggal1").val();
		var nama = $("#penyetor1").val();
		var jumlah = $("#jumlah1").val();
		var bank = $("#bank1").val();
		var ket = $("#ket1").val();
		$.ajax({
			url : "act/setoran_mut.php",
			type : "GET",
			data : {edit : edit, id : id, tgl : tgl, nama : nama, jumlah : jumlah, bank : bank, ket : ket},
			dataType : "html",
			success : function(data){
				$("#hasil1").html(data);	
			}
		})
	});

    $(function(){
        $("#tanggal1").datepicker({
            dateFormat:'yy-mm-dd',
            maxDate: 0,
        });
    });
</script>