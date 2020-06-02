<?php
include '../../config.php';
session_start();
date_default_timezone_set('Asia/Makassar');
$tgl = date("Y-m-d");	 
$jam = date("h:i:s");	 
$ot = $_SESSION['nama_outlet'];
$uang = $_GET['uang'];
$meteran = $_GET['meteran'];
	
$qrincian6 = mysqli_query($con,"insert into bukakasir values ('', '$tgl', '$jam', '$ot', '$_SESSION[id]', '$uang', '$meteran')");
?>
<script type="text/javascript">
 location.href="http://localhost/qnc_new/reception/";
</script>