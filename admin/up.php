<?php
include '../config.php';
if (isset($_POST['delete'])){
$id=$_POST['selector'];
$N = count($id);
for($i=0; $i < $N; $i++)
{
	$result = mysqli_query($con,"UPDATE reception set cuci = '1', pengering = '1', setrika = '1', packing = '1',kembali = '1' WHERE id='$id[$i]'");
}
header("location: 2.php");
}
?>