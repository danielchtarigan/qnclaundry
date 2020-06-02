<?php
include "config.php";
session_start();
$us=$_SESSION['user_id'];
	$passbaru=md5($_POST['passbaru']);
	$passlama=md5($_POST['passlama']);
	$passbaru1=md5($_POST['passbaru1']);
	$hasil=mysqli_query($con,"UPDATE user SET password='$passbaru' WHERE name='$us' and password='$passlama'");
	if($hasil){
	 	
	 echo '<font color="green">Sukses Ganti Password</font>';
	 	}
	else {
	 echo '<font color="red">Gagal</font>';
	 }

?>