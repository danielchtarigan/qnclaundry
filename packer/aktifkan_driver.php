<?php 
include '../config.php';
session_start();

$sql = $con->query("SELECT * FROM user_driver WHERE status=true AND lokasiform='workshop' AND lokasi='$_SESSION[workshop]' AND keterangan='bersih'");

if(mysqli_num_rows($sql)>0) {
	echo '
		<div id="popup">
			<div id="info">
		        <h1>Form Driver</h1>
			</div>	
		</div>
	';
}


?>

