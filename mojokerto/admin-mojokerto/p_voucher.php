<?php
include '../config.php';

if (isset($_POST['d15'])){
$awal=$_POST['awal'];
$akhir=$_POST['akhir'];
$pad       = 4;
for($i = $awal; $i <= $akhir; $i++)
{
$i = str_pad($i, $pad, "0", STR_PAD_LEFT);	
echo "d15$i<br>";
mysqli_query($con,"insert into voucher_lucky (no_voucher,jenis_voucher,disk) values ('d15$i','ld','0.15')");

}
exit;

}elseif (isset($_POST['d25'])){
$awal=$_POST['awal'];
$akhir=$_POST['akhir'];
$pad       = 4;
for($i = $awal; $i <= $akhir; $i++)

{
	$i = str_pad($i, $pad, "0", STR_PAD_LEFT);	
	echo "d25$i<br>";
mysqli_query($con,"insert into voucher_lucky (no_voucher,jenis_voucher,disk) values ('d25$i','ld','0.25')");

}
exit;
}elseif (isset($_POST['d35'])){
$awal=$_POST['awal'];
$akhir=$_POST['akhir'];
$pad       = 4;
for($i = $awal; $i <= $akhir; $i++)
{
	$i = str_pad($i, $pad, "0", STR_PAD_LEFT);	
echo "d35$i<br>";
mysqli_query($con,"insert into voucher_lucky (no_voucher,jenis_voucher,disk) values ('d35$i','ld','0.35')");

}
exit;
}

?>