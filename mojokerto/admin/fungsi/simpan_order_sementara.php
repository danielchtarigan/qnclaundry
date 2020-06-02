<?php
include '../../../config.php';
date_default_timezone_set('Asia/Makassar');
$jam=date("Y-m-d H:i:s");
    
    $jumlah=$_GET['jumlah'];
    $no_nota=$_GET['no_nota'];
    $jenis_item=$_GET['jenis_item'];
    $total=$_GET['total'];
     $id_cs=$_GET['id_cs'];
      $harga=$_GET['harga'];
    
  
$tambah=mysqli_query($con,"insert into detail_penjualan (tgl_transaksi,item,no_nota,total,id_customer,jumlah,harga) VALUES('$jam','$jenis_item','$no_nota','$total','$id_cs','$jumlah','$harga')");
    
    if($tambah)
    {
    	  echo "sukses";
      
    }else
    {
        echo "ERROR";
    }
?>