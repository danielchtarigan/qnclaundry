<?php
include '../../config.php';
session_start();

if (isset($_POST['pulang'])){
date_default_timezone_set('Asia/Makassar');
$tgl = date("Y-m-d");
$tgl2 = date("Y-m-d H:i:s");
$nama=$_POST['nama_delivery'];
$antar=$_POST['antar'];
$jemput=$_POST['jemput'];
$ot = $_SESSION['nama_outlet'];

$query = mysqli_query($con,"update log_delivery2 set pulang='$tgl2',antar='$antar',jemput='$jemput' where DATE_FORMAT(masuk, '%Y-%m-%d')='$tgl' and nama_delivery='$nama'");
  if ($query){
	?>
	<script type="text/javascript">
	alert("Berhasil");
	location.href="../index.php?menu=log_delivery";
	</script>	
    <?php	
	}	
}
?>