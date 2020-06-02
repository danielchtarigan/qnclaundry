<?php
include "../../config.php";
session_start();
$ot=$_SESSION['nama_outlet'];

date_default_timezone_set('Asia/Makassar');
$tgl=date("Y-m-d H:i:s");

if (isset($_POST['masuk']));{	
	$nama=$_POST['nama_delivery'];	
	$sql=mysqli_query($con, "INSERT INTO log_delivery2 values('','$nama','$ot','$tgl','','','')");
	if($sql){	
	?>
	<script type="text/javascript">
	alert("Berhasil");
	location.href="../index.php?menu=log_delivery";
	</script>	
    <?php	
	}		
	else{
	?>    
	<script type="text/javascript">
	alert("Log Gagal, Ulangi");
	location.href="../index.php?menu=log_delivery";
	</script>
	
    <?php
	}    
}

?>