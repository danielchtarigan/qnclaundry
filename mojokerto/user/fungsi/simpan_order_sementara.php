<?php
include '../../../config.php';
date_default_timezone_set('Asia/Jakarta');
$jam=date("Y-m-d H:i:s");
    
    $jumlah=$_GET['jumlah'];
    $no_nota=$_GET['no_nota'];
    $jenis_item=$_GET['jenis_item'];
    $total=$_GET['total'];
    $id_cs=$_GET['id_cs'];
    $harga=$_GET['harga'];
    $berat      = $_GET['berat'];

  
$tambah     = mysqli_query($con,"insert into rincian_order_temp (tgl_transaksi,item,total,id_customer,jumlah,harga,berat) VALUES('$jam','$jenis_item','$total','$id_cs','$jumlah','$harga','$berat')");
    
    if($tambah)
    {
    	  echo "sukses";
      
    }else
    {
        echo "ERROR";
    }
?>