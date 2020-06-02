<?php 
include '../../config.php';
include '../zonawaktu.php';

if($_GET['hanger']=="undefined"){
	$hanger = "0";	
} else{
	$hanger = $_GET['hanger'];
}

$date = date('Y-m-d', strtotime(($nowDate)));

$hangers = $_GET['hangers'];
$p_hangers = $_GET['p_hangers'];

$harga_hg = $hangers*2500;
$harga_phg = $p_hangers*2000;

//mengecek hanger atau plastik hanger di detail_penjualan
$query = mysqli_query($con, "SELECT * FROM detail_penjualan WHERE no_nota='$_GET[nota]' AND tgl_transaksi LIKE '%$date%' AND (item LIKE 'Hanger' OR item LIKE 'Plastik Hanger')");

if(mysqli_num_rows($query)>0){
	mysqli_query($con, "UPDATE detail_penjualan SET harga='2500',jumlah='$hangers',total='$harga_hg' WHERE no_nota='$_GET[nota]' AND item LIKE 'Hanger' AND id_customer='$_GET[id]'");
	mysqli_query($con, "UPDATE detail_penjualan SET harga='2000',jumlah='$p_hangers',total='$harga_phg' WHERE no_nota='$_GET[nota]' AND item LIKE 'Plastik Hanger' AND id_customer='$_GET[id]'");

} else {
	mysqli_query($con, "INSERT INTO detail_penjualan (tgl_transaksi,item,harga,jumlah,total,no_nota,id_customer) VALUES ('$nowDate','Hanger','2500','$hangers','$harga_hg','$_GET[nota]','$_GET[id]') ");

	mysqli_query($con, "INSERT INTO detail_penjualan (tgl_transaksi,item,harga,jumlah,total,no_nota,id_customer) VALUES ('$nowDate','Plastik Hanger','2000','$p_hangers','$harga_phg','$_GET[nota]','$_GET[id]') ");
}

if(isset($_GET['potongan'])){
	
	mysqli_query($con, "UPDATE order_potongan_tmp SET hanger_own='$hanger',hanger='$hangers',hanger_plastic='$p_hangers' WHERE no_nota='$_GET[nota]'");
		
}
else if(isset($_GET['kiloan'])){
	mysqli_query($con, "UPDATE order_tmp SET hanger_own='$hanger',hanger='$hangers',hanger_plastic='$p_hangers' WHERE no_nota='$_GET[nota]'");
}


mysqli_query($con, "DELETE FROM detail_penjualan WHERE no_nota='$_GET[nota]' AND jumlah='0' AND (item LIKE 'Hanger' OR item LIKE 'Plastik Hanger') ")


?>
