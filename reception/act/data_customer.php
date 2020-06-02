<?php 

include '../../config.php';

if(isset($_POST['submit'])){
	$idcs = $_POST['idcs'];
	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$telpon = $_POST['telp'];
	$email = $_POST['email'];

	$updQuery = $con->query("UPDATE customer SET nama_customer='$nama', alamat='$alamat', no_telp='$telpon', email='$email' WHERE id='$idcs'");

	if(!empty($updQuery)){
		?>
		<script type="text/javascript">
			location.href = "../?id=<?= $idcs ?>";
		</script>

		<?php
	}
}

?>