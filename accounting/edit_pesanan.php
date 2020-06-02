<?php 
include 'config.php';

if(isset($_POST['edit'])){
	$no_order = $_POST['id'];

	$query = mysqli_query($con, "SELECT * FROM pemesanan WHERE no_nota='$no_order'");
	$data = mysqli_fetch_assoc($query);


	?>

	<div>
		<form class="form-horizontal" method="POST" action="action/simpan_edit_pesanan.php">
			<input class="hidden" type="text" name="no_nota" value="<?php echo $no_order ?>">
			<div class="form-group">
				<label for="supplier" class="col-md-4 control-label">Nama Supplier</label>
				<div class="col-md-6">
					<select type="text" class="form-control" name="nama_supplier">
						<option><?php echo $data['nama_supplier'] ?></option>
						<?php 					
						$suppliers = mysqli_query($con, "SELECT *FROM supplier");
						while($supplier = mysqli_fetch_row($suppliers)){
							echo '<option>'.$supplier[1].'</option>';
						} 
						?>
					</select>
				</div>						
			</div>

			<div class="form-group">
				<label for="item" class="col-md-4 control-label">Nama Item</label>
				<div class="col-md-6">
					<select class="form-control" name="nama_item">
						<option><?php echo $data['nama_item'] ?></option>
						<?php 					
						$suppliers = mysqli_query($con, "SELECT *FROM item_bahan_baku");
						while($supplier = mysqli_fetch_row($suppliers)){
							echo '<option>'.$supplier[1].'</option>';
						} 
						?>
					</select>
				</div>
			</div>	

			<div class="form-group">
				<label class="col-md-4 control-label">Harga</label>
				<div class="col-md-6">
					<div class="input-group">
						<div class="input-group-addon">Rp</div>
						<input class="form-control" type="number" name="harga" value="<?php echo $data['harga'] ?>">
					</div>				
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-4 control-label">Quantity</label>
				<div class="col-md-6">
					<div class="input-group my-group">
						<input class="form-control" type="number" name="quantity" value="<?php echo $data['quantity'] ?>">
						<select class="form-control" name="satuan">
							<option><?php echo $data['satuan'] ?></option>
							<option>Pcs</option>
							<option>Gln</option>
							<option>Ltr</option>
							<option>Kg</option>
							<option>Blk</option>
							<option>Lbr</option>
						</select>	
					</div>
						
				</div>
			</div>

			<div class="pull-center">
				<input class="btn btn-md btn-success btn-block" type="submit" name="simpan" value="Simpan Perubahan">
			</div>
		</form>
	</div>
<?php 
}
else if(isset($_POST['hapus'])){
	$no_order = $_POST['id'];

	$query = mysqli_query($con, "SELECT * FROM penerimaan_bahan_baku WHERE no_pesanan='$no_order'");
	$cek = mysqli_num_rows($query);
	$pesan = ($cek>0) ? "Pesanan ini sudah diterima, jadi tidak dapat dihapus" : 'Yakin dihapus? <br><button class="btn btn-xs btn-danger remove-order" id="'.$no_order.'">Ya</button>';
	echo $pesan;
}


	

?>
<style type="text/css">
.my-group .form-control{
    width:50%;
}
</style>

<script type="text/javascript">
	$(document).ready(function(){
		$('.remove-order').click(function(){
			var hapus = "hapus";
		    var id = $(this).attr("id");
			$.ajax({
				type 	: 'post',
			    url 	: 'action/simpan_edit_pesanan.php',
			    data 	:  'hapus=' + hapus + '&id='+ id,
			    success : function(data){
			    $('.data-edit').html(data);//menampilkan data ke dalam modal
			    }
			})
		});
	})
</script>