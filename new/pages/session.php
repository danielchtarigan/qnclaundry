<?php 
include '../config.php';
session_start();

$branches = explode("-", $_POST['branch']);
$branchId = $branches[0];
$branch = $branches[1];

$outlets = explode("-", $_POST['outlet']);
$outletId = $outlets[0];
$outlet = $outlets[1];

$query = mysqli_query($con, "SELECT * FROM user WHERE name='$_POST[username]' AND aktif='Ya'");
$data = mysqli_fetch_assoc($query);

$_SESSION['id'] = $data['user_id'];
$_SESSION['level'] = $data['level'];
$_SESSION['user_id'] = $data['name'];
$_SESSION['outlet']= $outlet;
$_SESSION['outlet_id']= $outletId;
$_SESSION['cabang'] = $branch;
$_SESSION['branch_id'] = $branchId;
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