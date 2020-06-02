<?php 
include 'config.php';
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
 

$notif = $_GET['notif'];
$idcs = $_GET['idcs'];

$inst = $con->query("UPDATE notifikasi_customer SET pilihan_notif='$notif' WHERE id_customer='$idcs'");

if($inst){
	echo "Notifikasi berubah";

	if(!empty($_GET['email'])){

		$validemail = strpos($_GET['email'], "@");

		if(!empty($validemail)){
			?>
			<script type="text/javascript">
				alert("Notifikasi cucian akan disimpan di inbox atau spam email Anda");
				window.location = "";
			</script>

			<?php

			$inst = $con->query("UPDATE customer SET email='$_GET[email]' WHERE id='$idcs'");
		}
		else {
			?>
			<script type="text/javascript">
				alert("Email salah");
			</script>

			<?php
		}	

		
	}
}


?>

