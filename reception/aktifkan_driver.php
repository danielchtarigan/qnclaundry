<?php 
include '../config.php';
session_start();

$sql = $con->query("SELECT * FROM user_driver WHERE status=true AND lokasiform='outlet' AND lokasi='$_SESSION[nama_outlet]'");

if(mysqli_num_rows($sql)>0) {
    $data = $sql->fetch_assoc();
    $ket = ($data['keterangan']=="kotor") ? "menjemput cucian kotor" : "mengantar cucian selesai (Packing)";
	echo '
		<div id="data-data-popup">
			<div id="info3">
		        <strong>Warning!</strong> '.$data['name'].' akan '.$ket.' Outlet '.$data['lokasi'].'
		        <br>
				<p>Nota yang belum di SPK bisa discan, <br> Tolong input semua cucian kotor !</p>
				<br>
				<p><i>Tertanda,</i></p>
				<p><u>Office</u></p>
			</div>	
		</div>
	';
}


?>

