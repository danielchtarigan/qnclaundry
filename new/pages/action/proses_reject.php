<?php 
include '../../config.php';

if($_POST['proses']=="1"){
	$con-> query("UPDATE reception SET rijeck='2' WHERE no_nota='$_POST[nota]'");
}




?>