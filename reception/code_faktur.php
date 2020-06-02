<?php


$sql = mysqli_query($con, "SELECT kode FROM outlet WHERE nama_outlet='$ot'");
$res = mysqli_fetch_array($sql);

$char = "F".$res['kode'];



   
?>