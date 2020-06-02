
<?php

$no_nota = $_GET['no_nota'];
$total = $_GET['total'];
$id_cs = $_GET['id_cs'];

date_default_timezone_set('Asia/Makassar');
	$jam=date("Y-m-d H:i:s");
	
include '../config.php';

	
$br=mysqli_query($con, "insert into rincian_faktur_temp (no_nota,jumlah,id_customer) values ('$no_nota','$total','$id_cs')");
   
    
    if($br){
        echo "sukses";
    }else{
        echo "ERROR";
    }
?>