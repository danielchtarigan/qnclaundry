<?php
include '../config.php';
if (isset($_POST['cuci'])){
$id=$_POST['selector'];
$N = count($id);
			for($i=0; $i < $N; $i++){
	$result = mysqli_query($con,"UPDATE reception set cuci = '1' WHERE id='$id[$i]'");}
	header("location: update.php");
	exit;

}elseif (isset($_POST['setrika'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysqli_query($con,"UPDATE reception set setrika = '1' WHERE id='$id[$i]'");
}
header("location: update.php");
exit;
}elseif (isset($_POST['pengering'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysqli_query($con,"UPDATE reception set pengering = '1' WHERE id='$id[$i]'");
}
header("location: update.php");
exit;
}elseif (isset($_POST['packing'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysqli_query($con,"UPDATE reception set packing = '1' WHERE id='$id[$i]'");
}
header("location: update.php");
exit;
}elseif (isset($_POST['kembali'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysqli_query($con,"UPDATE reception set kembali = '1' WHERE id='$id[$i]'");
}
header("location: update.php");
exit;
}
elseif (isset($_POST['semuanya'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysqli_query($con,"UPDATE reception set cuci='1',pengering='1',setrika='1',packing='1',kembali = '1' WHERE id='$id[$i]'");
}
header("location: update.php");
exit;
}
elseif (isset($_POST['delete'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysqli_query($con,"delete from reception WHERE id='$id[$i]'");
}
header("location: update.php");
exit;
}elseif (isset($_POST['updatenota'])){
$id=$_POST['id'];
$no_nota=$_POST['no_nota'];
$nama_outlet=$_POST['outlet'];
{
	$result = mysqli_query($con,"update reception set no_nota='$no_nota',nama_outlet='$nama_outlet' WHERE id='$id'");
}
header("location: update.php");
exit;
}




?>