<?php 
include '../config.php';

$hapus = mysqli_query($con, "DELETE FROM pemesanan WHERE no_nota='$_POST[id]'");

if($hapus){ ?>
	<script type="text/javascript">
		alert("Pesanan berhasil dihapus");
		location.href="index.php?menu=Pemesanan";
	</script>		
	<?php
} 

?>