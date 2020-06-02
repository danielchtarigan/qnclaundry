<?php 
include '../../config.php';

if($_GET['parfum']=="undefined"){
	$parf = "normal";	
} else{
	$parf = $_GET['parfum'];
}


if(isset($_GET['potongan'])){
	mysqli_query($con, "UPDATE order_potongan_tmp SET parfum='$parf' WHERE no_nota='$_GET[nota]'");
}
else if(isset($_GET['kiloan'])) {
	mysqli_query($con, "UPDATE order_tmp SET parfum='$parf' WHERE no_nota='$_GET[nota]'");
}

?>




