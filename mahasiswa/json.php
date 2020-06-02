<?php
include '../config.php';

$nohp = $_GET['nohp'];
$query = mysqli_query($con, "select * from customer where no_telp='$nohp'");
$customer = mysqli_fetch_array($query);
$data = array(
            'nama'      =>  $customer['nama_customer'],
            'alamat'    =>  $customer['alamat'],
            'idkey'		=>	$customer['id'],
            'email'		=>	$customer['email'],
            );
 echo json_encode($data);
?>