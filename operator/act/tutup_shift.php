<?php 
include '../../config.php';
session_start();
date_default_timezone_set('Asia/Makassar');
$date = date('Y-m-d H:i:s');

if(isset($_POST['kirim'])){

	mysqli_query($con, "INSERT INTO tutup_shift_operator VALUES ('','$date','$_SESSION[user_id]','$_POST[mesin_cuci_kecil]','$_POST[mesin_cuci_besar]','$_POST[mesin_pengering_kecil]','$_POST[mesin_pengering_besar]','$_POST[ket]')");

	?>
	<script type="text/javascript">
		location.href="../index.php?menu=tutupShift";
	</script>
	<?php		
}
?>