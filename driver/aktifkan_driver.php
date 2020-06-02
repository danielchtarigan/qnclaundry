
<?php 
include '../config.php';


$sql = $con->query("SELECT * FROM user_driver WHERE name='$_GET[driver]' AND status='0'");

if(mysqli_num_rows($sql)>0) {

	echo '1';

}


?>

