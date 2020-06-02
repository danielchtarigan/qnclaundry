<?php 

include '../../config.php';


$telp = $_GET['telp'];
$message = "Nomor telp benar, silahkan lanjutkan!";

$query = mysqli_query($con, "SELECT * FROM customer WHERE no_telp='$telp'");
if(mysqli_num_rows($query)>0) {
	echo 0;
}
else {
	echo 1;
}




?>

