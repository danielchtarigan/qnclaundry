<?php 
include '../../config.php';
include 'zonawaktu.php';

$simpan = mysqli_query($con, "INSERT INTO order_potongan_tmp (tgl,no_nota,id_customer,item,harga,jumlah,ket) VALUES ('$nowDate','$_GET[no_nota]','$_GET[id]','$_GET[item]','$_GET[harga]','$_GET[jumlah]','$_GET[ket]')");



?>