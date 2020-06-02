<?php 
$rcp1 = $_SESSION['user_id'];


$datep1 = '2017-04-01';
$datep2 = date('Y-m-d');

$piutang = mysqli_query($con,"select *from reception WHERE lunas='0' and (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$datep1' and '$datep2') and nama_reception='$rcp1' and (cabang='Delivery' or cabang='') ")or die(mysql_error());
	if(mysqli_num_rows($piutang)){
		echo '<center><a style="color:#fff; font-weight:bold; background-color:#fb121e" href="order_piutang.php">Anda memiliki Daftar order yang belum dilunasi, silahkan klik untuk melihatnya!</a></center>';
	}
?>