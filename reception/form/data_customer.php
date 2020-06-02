<?php 
$nama = $rcustomer1['nama_customer'];
$alamat = $rcustomer1['alamat'];
$telp = $rcustomer1['no_telp'];
?>

<label class="control-label" style="font-size: 18px">Ubah Data Customer</label>

<form class="form-horizontal" method="POST" action="act/data_customer.php">
	<input class="hidden" type="text" name="idcs" value="<?= $_GET['id'] ?>">
	<label class="control-label">Nama Customer</label>
	<input type="text" name="nama" class="form-control" readonly="" value="<?= $nama ?>">
	<label class="control-label">Email</label>
	<input type="email" id="email" name="email" class="form-control" value="" autocomplete="off">
	<label class="control-label">Telepon</label>
	<input type="text" id="telps" name="telp" class="form-control" value="<?= $telp ?>" autocomplete="off"><span id="d" style="color: red"></span><br>
	<label class="control-label">Alamat (Jl.)</label>
	<textarea class="form-control" name="alamat" rows="3"><?= $alamat ?></textarea><br>
	<div class="row">
		<input type="submit" name="submit" value="Simpan" class="btn btn-success" style="width: 20%">
		<a href="?id=<?= $_GET['id'] ?>"><input type="button" name="batal" value="Batal" class="btn btn-danger" style="width: 20%"></a>
	</div>	
</form>

<script type="text/javascript">
	$('#telps').keypress(function(e){
		var telp = $(this).val();     
        var panj = telp.length;
        var telpd = "<?= $rcustomer1['no_telp'] ?>";
        if(panj>11) {
            $("#d").text("Maksimal 12 Karakter").fadeIn('fast');
            $('#telps').val(telpd);
            return false;
        } 
        if(e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)) {
            $("#d").text("Isikan Angka");
            $('#telps').val(telpd);
            return false;
        } 
	})
</script>