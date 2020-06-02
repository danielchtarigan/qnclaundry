<?php 
include '../../config.php';
include '../code_order.php';

date_default_timezone_set('Asia/Makassar');
$nowDate = date('Y-m-d H:i:s');

$idcst = $_GET['idcst'];
$outlet = $_GET['outlet'];

$scab = "Delivery";

if($_GET['nota']<>''){
	$no_nota = $_GET['nota'];
} else {
	$no_nota = $no_order;
}

$customers = mysqli_query($con, "SELECT nama_customer FROM customer WHERE id='$idcst'");
$cust = mysqli_fetch_row($customers)[0];

if(isset($_GET['kiloan'])) {
	$item = $_GET['item'];
	$harga = $_GET['harga'];
	$berat = $_GET['berat'];
	$cabang = $scab;
	$total = $harga;

	$order_tmp = mysqli_query($con, "SELECT * FROM order_tmp WHERE id_customer='$_GET[idcst]' AND no_so='$no_so'");
	if(mysqli_num_rows($order_tmp)>0) {
		mysqli_query($con, "UPDATE order_tmp SET tgl='$nowDate',item='$item',harga='$harga',berat='$berat' WHERE id_customer='$idcst' AND no_so='$no_so'");

		mysqli_query($con, "UPDATE detail_penjualan SET tgl_transaksi='$nowDate',item='$item',harga='$harga',total='$total',berat='$berat' WHERE id_customer='$idcst' AND no_nota='$no_nota'");
	} else {
		mysqli_query($con, "INSERT INTO order_tmp (tgl,no_nota,no_so,id_customer,item,harga,jumlah,berat,cabang) VALUES ('$nowDate','$no_nota','$no_so','$idcst','$item','$harga','1','$berat','$scab') ");	

		mysqli_query($con, "INSERT INTO detail_penjualan (tgl_transaksi,item,harga,jumlah,total,no_nota,id_customer,berat) VALUES ('$nowDate','$item','$harga','1','$total','$no_nota','$idcst','$berat') ");

		mysqli_query($con, "INSERT INTO reception (tgl_input,nama_reception,id_customer,nama_customer,no_nota,no_so,cabang,nama_outlet,jenis,kategori_item,berat) VALUES ('$nowDate','$user','$idcst','$cust','$no_nota','$no_so','$scab','$outlet','k','K','$berat') ");	
	}

	
		

}

echo $no_nota;


?>