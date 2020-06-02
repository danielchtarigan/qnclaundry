<?php 
include '../../config.php';
date_default_timezone_set('Asia/Makassar');
$nowDate = date('Y-m-d H:i:s');


if(isset($_GET['express'])) {
	$express = $_GET['express'];
	$no_nota = $_GET['nota'];
	$idcst = $_GET['idcst'];
	$harga = $express*15000;
	$total = $harga;
	if($express<>"undefined") {
		if($express=='1') {
			$jex = "Express";
		} else if($express=='2') {
			$jex = "Double Express";
		} else if($express=='3') {
			$jex = "Super Express";
		}

		$sql = mysqli_query($con, "SELECT * FROM order_tmp WHERE no_nota='$no_nota'");
		if(mysqli_num_rows($sql)>0) {
			mysqli_query($con, "UPDATE order_tmp SET charge='$express' WHERE no_nota='$no_nota'");
		} else {
			mysqli_query($con, "UPDATE order_potongan_tmp SET charge='$express' WHERE no_nota='$no_nota'");
		}

		mysqli_query($con, "UPDATE reception SET express='$express' WHERE no_nota='$no_nota' AND id_customer='$idcst'");

		$sqle = mysqli_query($con, "SELECT * FROM detail_penjualan WHERE item LIKE '%Express%' AND no_nota='$no_nota'");
		if(mysqli_num_rows($sqle)>0) {
			mysqli_query($con, "UPDATE detail_penjualan SET tgl_transaksi='$nowDate',item='$jex',harga='$harga',total='$total' WHERE id_customer='$idcst' AND no_nota='$no_nota' AND item LIKE '%Express%' ");
		} else {
			mysqli_query($con, "INSERT INTO detail_penjualan (tgl_transaksi,item,harga,jumlah,total,no_nota,id_customer) VALUES ('$nowDate','$jex','$harga','1','$total','$no_nota','$idcst')");
		}
	}	
	
}

else if(isset($_GET['parfum'])) {
	$parfum = $_GET['parfum'];
	$no_nota = $_GET['nota'];
	// $idcst = $_GET['idcst'];
	// $harga = $express*15000;
	// $total = $harga;

	if($parfum<>"undefined") {
		$sql = mysqli_query($con, "SELECT * FROM order_tmp WHERE no_nota='$no_nota'");
		if(mysqli_num_rows($sql)>0) {
			mysqli_query($con, "UPDATE order_tmp SET parfum='$parfum' WHERE no_nota='$no_nota'");
		} else {
			mysqli_query($con, "UPDATE order_potongan_tmp SET parfum='$parfum' WHERE no_nota='$no_nota'");
		}
	}
	
}



?>