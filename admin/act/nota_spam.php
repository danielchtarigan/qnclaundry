<?php 
include '../../config.php';

foreach (explode(" ", $_POST['nota']) as $key => $value) {
	$con->query("UPDATE reception SET status_order='spam' WHERE no_nota='$value'");	
}





?>