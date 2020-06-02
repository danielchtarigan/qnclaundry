<?php 
include '../../config.php';
session_start();

date_default_timezone_set('Asia/Makassar');
$nowDate = date('Y-m-d H:i:s');

$jumlah = $_POST['jumlah'];
$delivery = $_POST['delivery'];
$reception = $_SESSION['user_id'];

mysqli_query($con, "INSERT INTO setoran_delivery (tanggal,jumlah,nama_delivery,nama_reception,outlet) VALUES ('$nowDate','$jumlah','$delivery','$reception','$_SESSION[nama_outlet]') ");


?>

<script type="text/javascript">
	alert('Kas Anda bertambah <?= $jumlah ?>');
	location.href="../index.php";
</script>