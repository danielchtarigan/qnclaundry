<?php 
include '../config.php';
session_start();

$query = mysqli_query($con, "SELECT * FROM user WHERE name='$_POST[username]' AND aktif='Ya'");
$data = mysqli_fetch_assoc($query);


$sql = mysqli_query($con, "SELECT cabang FROM cabang WHERE id='$_POST[cabang]'");
$cabang = mysqli_fetch_row($sql)[0];

$_SESSION['id'] = $data['user_id'];
$_SESSION['level'] = $data['level'];
$_SESSION['user_id'] = $data['name'];
$_SESSION['outlet']= $_POST['outlet'];
$_SESSION['cabang'] = $cabang;
$_SESSION['my_user_agent'] = md5($_SERVER['HTTP_USER_AGENT']);


if($_SESSION['level']=="admin2")
{
	echo "admin";
}

else 
{
	echo "pages";
}
	



?>