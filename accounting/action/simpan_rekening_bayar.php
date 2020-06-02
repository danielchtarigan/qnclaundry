<?php 
include '../config.php';

$id = $_POST['id'];
$text = $_POST['text'];
$nama_colom = $_POST['nama_colom'];

$sql = $con->query("UPDATE daftar_pembayaran SET $nama_colom='$text' WHERE id='$id'");

$select = $con->query("SELECT * FROM daftar_pembayaran WHERE id='$id'");
$result = $select->fetch_assoc();

$sql .= $con->query("UPDATE supplier SET $nama_colom='$text' WHERE nama_supplier='$result[nama_supplier]'");


?>