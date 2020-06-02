<?php 
include '../../config.php';
date_default_timezone_set('Asia/Makassar');
$date = date('Y-m-d');

foreach ($_POST['id'] as $key => $val) {
	$id = (int) $_POST['id'][$key];
	$hadir = $_POST['hadir'][$key];
	$malam = $_POST['malam'][$key];
	$pbrosur = $_POST['pbrosur'][$key];
	$kasus = $_POST['kasus'][$key];
	
	$sukses = mysqli_query($con, "UPDATE extra_operasional SET hadir='$hadir', masuk_malam='$malam', poin_brosur='$pbrosur', kasus_nota='$kasus', tgl_update='$date', verifikasi='0', user_verify='' WHERE id='$id' ");
}
if($sukses){?>
	<script type="text/javascript">
		location.href="../kerja_operasional.php";
	</script>
<?php 
	echo 'Berhasil!';
}

?>

