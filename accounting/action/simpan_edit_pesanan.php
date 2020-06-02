<?php 
include '../config.php';

if(isset($_POST['simpan'])){
	$query = mysqli_query($con, "UPDATE pemesanan SET nama_supplier='$_POST[nama_supplier]', nama_item='$_POST[nama_item]', harga='$_POST[harga]', quantity='$_POST[quantity]', satuan='$_POST[satuan]' WHERE no_nota='$_POST[no_nota]' ");
	?>

	<script type="text/javascript">
		location.href="../index.php?menu=Laporan_pemesanan";
	</script>
	<?php
}
else if(isset($_POST['hapus'])){
	$query = mysqli_query($con, "DELETE FROM pemesanan WHERE no_nota='$_POST[id]'");
	?>

	<script type="text/javascript">
		location.href="index.php?menu=Laporan_pemesanan";
	</script>
	<?php
}

	