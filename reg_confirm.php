<?php 
include 'config.php';



$sql = $con->query("SELECT * FROM user WHERE email='$_GET[email]' AND token='$_GET[token]'");
$count = $sql->num_rows;
if($count>0) {
	$set = $con->query("UPDATE user SET aktif='Ya', token='' WHERE email='$_GET[email]' AND token='$_GET[token]'");
	if($set) {
		echo "Your account has activated! Please login!";
        
		header('location: login.php?activated');
		exit();
	}

} else {
	echo "Your account not found yet!";
}




?>