<?php 
include '../config.php';
session_start();

$sql = $con->query("SELECT * FROM user_driver WHERE status=true AND lokasiform='outlet' AND lokasi='$_SESSION[nama_outlet]'");

if(mysqli_num_rows($sql)>0) {
    $data = $sql->fetch_assoc();
    $ket = ($data['keterangan']=="kotor") ? "menjemput cucian yang sudah dishortir (SPK)" : "mengantar cucian selesai (Packing)";
	echo '
		<div id="data-data-popup">
			<div id="info3">
		        <strong>Warning!</strong> '.$data['name'].' akan '.$ket.'
		        <br>
		        <p style="font-size: 12px">Persilahkan untuk menscan semua nota dan jangan ada yang terlewat!</p>
			</div>	
		</div>
	';
}


?>

