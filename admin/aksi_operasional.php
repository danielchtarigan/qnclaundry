<?php 
include '../config.php';

foreach ($_POST['id'] as $key => $val) {
	$id = (int) $_POST['id'][$key];
	$hadir = $_POST['hadir'][$key];
	$malam = $_POST['malam'][$key];
	$duabelas = $_POST['duabelas'][$key];
	$kasus = $_POST['kasus'][$key];

	$sukses = mysqli_query($con, "UPDATE extra_operasional SET hadir='$hadir', masuk_malam='$malam', duabelasjam='$duabelas', kasus_nota='$kasus' WHERE id='$id' ");
}
if($sukses){?>
	<script type="text/javascript">
		location.href="kerja_operasional.php";
	</script>
<?php 
	echo 'Berhasil!';
}

?>

