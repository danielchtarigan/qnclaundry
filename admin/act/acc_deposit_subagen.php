<?php 
session_start();
include '../../config.php';

mysqli_query($con, "UPDATE deposit_subagen SET acc='1',admin='$_SESSION[user_id]' WHERE id='$_GET[id]' ");


$sql = mysqli_query($con, "SELECT * FROM deposit_subagen WHERE id='$_GET[id]'");
$data = mysqli_fetch_array($sql);

$nom = $data['jumlah'];
$bonus = $data['bonus'];
$tgl_deposit = $data['tanggal'];
$subagen = $data['nama_subagen'];


//cek subagen
$cek = mysqli_query($con, "SELECT saldo,bonus FROM saldo_subagen WHERE subagen='$subagen'");

if(mysqli_num_rows($cek)>0) {
	$ds = mysqli_fetch_row($cek);

	$upsaldo = $ds[0]+$nom;
	$upbonus = $bonus+$ds[1];
	$s = mysqli_query($con, "UPDATE saldo_subagen SET saldo='$upsaldo',tanggal_deposit='$tgl_deposit',bonus='$upbonus',acc='0'");
} else {
	$s = mysqli_query($con, "INSERT INTO saldo_subagen (id,subagen,saldo,tanggal_deposit,bonus) VALUES ('','$subagen','$nom','$tgl_deposit','$bonus')");
}


?>

<script type="text/javascript">
	window.location = "../index.php?menu=deposit_subagen";
</script>