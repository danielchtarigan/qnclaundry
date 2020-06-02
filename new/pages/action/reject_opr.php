<?php 
include '../../config.php';
include '../zonawaktu.php';

$cs = $con->query("SELECT nama_customer FROM reception WHERE no_nota='$_GET[nota]' ");
$dcs = $cs-> fetch_array()[0];

$rj = $con-> query("UPDATE reception SET rijeck='1' WHERE no_nota='$_GET[nota]' ");

$rj .= $con-> query("INSERT INTO rijeck (no_nota,nama_customer,alasan,tgl_rijeck,user_rijeck) VALUES ('$_GET[nota]','$dcs','$_GET[ket]','$nowDate','$_SESSION[user_id]') ");

if($rj){
	echo "Nota Reject akan diteruskan ke reception";
}

?>


