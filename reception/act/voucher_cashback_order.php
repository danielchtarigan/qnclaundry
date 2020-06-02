<?php 
// include '../../config.php';

// date_default_timezone_set('Asia/Makassar');

// $nowDate = date('Y-m-d');
// $endDate = date('Y-m-d', strtotime('+6 days', strtotime($nowDate)));

// $idcs = $id_cs;
// $no_nota = $no_nota;

// if($ot!='Trans Studio Mall' AND $ot!='Royal Apartment' AND $ot!='support') {

// 	$sql = $con->query("SELECT * FROM voucher_cashback_order WHERE no_nota='$no_nota'");
// 	$countSql = mysqli_num_rows($sql);

// 	$sql2 = mysqli_query($con, "SELECT * FROM voucher_cashback_order ORDER BY id DESC LIMIT 1");
	
// 	$countSql2 = mysqli_num_rows($sql2);
// 	$rowSql = mysqli_fetch_array($sql2);

// 	$oldKode = $rowSql['kode_voucher'];	
// 	$oldKode1 = ($countSql2>0) ? (int)substr($oldKode, 5, 3) : 0;
// 	$urutKode = $oldKode1+1;
// 	$kodeBaru = 'CASHB'.sprintf('%03s',$urutKode).rand(10,100);
	
	
// 	if($countSql==0) {

// 		mysqli_query($con, "INSERT INTO voucher_cashback_order (id_customer,no_nota,outlet,kode_voucher,mulai,akhir) VALUES ('$idcs','$no_nota','All','$kodeBaru','$nowDate','$endDate')");
// 	} else {

// 		mysqli_query($con, "UPDATE voucher_cashback_order SET id_customer='$idcs',kode_voucher='$kodeBaru',mulai='$nowDate',akhir='$endDate' WHERE no_nota='$no_nota'");
// 	}
// }

	



?>