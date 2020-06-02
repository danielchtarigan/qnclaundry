<?php 
include '../../config.php';

function jumlah_order($startDate,$endDate){
	global $con;
	$sql = $con-> query("SELECT COUNT(*) FROM reception WHERE DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' ");
	$data = $sql-> fetch_array();
	return $data[0];
}

function otp_spk($startDate,$endDate){
	global $con;
	$countOrder = jumlah_order($startDate,$endDate);
	$sql = $con-> query("SELECT (COUNT(*)/$countOrder)*100 FROM reception WHERE DATEDIFF(tgl_spk, tgl_input)<=0.56 AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = $sql-> fetch_array();
	return round($data[0],2);
}

function jumlah_order_kiloanD($startDate,$endDate){
	global $con;
	$sql = $con-> query("SELECT COUNT(*) FROM reception WHERE jenis='k' AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' ");
	$data = $sql-> fetch_array();
	return $data[0];
}

function jumlah_order_kiloan($startDate,$endDate,$workshop){
	global $con;
	$sql = $con-> query("SELECT COUNT(*) FROM reception WHERE workshop='$workshop' AND jenis='k' AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' ");
	$data = $sql-> fetch_array();
	return $data[0];
}

function otp_operasional_kiloan($startDate,$endDate,$workshop){
	global $con;
	$countOrderKiloan = jumlah_order_kiloan($startDate,$endDate,$workshop);
	$sql = $con-> query("SELECT (COUNT(*)/$countOrderKiloan)*100 FROM reception WHERE workshop='$workshop' AND jenis='k' AND DATEDIFF(tgl_packing, tgl_input)<=1.5 AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = $sql-> fetch_array();
	return $data[0];
}

function otp_outlet_kiloan($startDate,$endDate){
	global $con;
	$countOrderKiloan = jumlah_order_kiloanD($startDate,$endDate);
	$sql = $con-> query("SELECT (COUNT(*)/$countOrderKiloan)*100 FROM reception WHERE jenis='k' AND DATEDIFF(tgl_kembali, tgl_input)<=2 AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = $sql-> fetch_array();
	return $data[0];
}


//Order_potongan_tipe_A

function jumlah_order_potongan_kategoriAD($startDate,$endDate){
	global $con;
	$sql = $con-> query("SELECT COUNT(DISTINCT b.no_nota) FROM reception a INNER JOIN detail_penjualan b ON a.no_nota=b.no_nota INNER JOIN item_spk c ON b.item=c.nama_item WHERE (c.kategory='4' OR c.kategory='5' OR c.kategory='6') AND DATE_FORMAT(a.tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = $sql-> fetch_array();
	return $data[0];
}

function jumlah_order_potongan_kategoriA($startDate,$endDate, $workshop){
	global $con;
	$sql = $con-> query("SELECT COUNT(DISTINCT b.no_nota) FROM reception a INNER JOIN detail_penjualan b ON a.no_nota=b.no_nota INNER JOIN item_spk c ON b.item=c.nama_item WHERE a.workshop='$workshop' AND (c.kategory='4' OR c.kategory='5' OR c.kategory='6') AND DATE_FORMAT(a.tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = $sql-> fetch_array();
	return $data[0];
}

function otp_operasional_potongan_kategoriA($startDate,$endDate, $workshop){
	global $con;
	$countOrderPotA = jumlah_order_potongan_kategoriA($startDate,$endDate, $workshop);
	$sql = $con-> query("SELECT (COUNT(DISTINCT b.no_nota)/$countOrderPotA)*100 FROM reception a INNER JOIN detail_penjualan b ON a.no_nota=b.no_nota INNER JOIN item_spk c ON b.item=c.nama_item WHERE a.workshop='$workshop' AND (c.kategory='4' OR c.kategory='5' OR c.kategory='6') AND DATEDIFF(a.tgl_packing, a.tgl_input)<=1.5 AND DATE_FORMAT(a.tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = $sql-> fetch_array();
	return $data[0];
}

function otp_outlet_potongan_kategoriA($startDate,$endDate){
	global $con;
	$countOrderPotA = jumlah_order_potongan_kategoriAD($startDate,$endDate);
	$sql = $con-> query("SELECT (COUNT(DISTINCT b.no_nota)/$countOrderPotA)*100 FROM reception a INNER JOIN detail_penjualan b ON a.no_nota=b.no_nota INNER JOIN item_spk c ON b.item=c.nama_item WHERE (c.kategory='4' OR c.kategory='5' OR c.kategory='6') AND DATEDIFF(a.tgl_kembali, a.tgl_input)<=2.5 AND DATE_FORMAT(a.tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = $sql-> fetch_array();
	return $data[0];
}

//Order_potongan_tipe_B

function jumlah_order_potongan_kategoriBD($startDate,$endDate){
	global $con;
	$sql = $con-> query("SELECT COUNT(DISTINCT b.no_nota) FROM reception a INNER JOIN detail_penjualan b ON a.no_nota=b.no_nota INNER JOIN item_spk c ON b.item=c.nama_item WHERE c.kategory='7' AND DATE_FORMAT(a.tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = $sql-> fetch_array();
	return $data[0];
}

function jumlah_order_potongan_kategoriB($startDate,$endDate, $workshop){
	global $con;
	$sql = $con-> query("SELECT COUNT(DISTINCT b.no_nota) FROM reception a INNER JOIN detail_penjualan b ON a.no_nota=b.no_nota INNER JOIN item_spk c ON b.item=c.nama_item WHERE a.workshop='$workshop' AND c.kategory='7' AND DATE_FORMAT(a.tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = $sql-> fetch_array();
	return $data[0];
}

function otp_operasional_potongan_kategoriB($startDate,$endDate, $workshop){
	global $con;
	$countOrderPotB = jumlah_order_potongan_kategoriB($startDate,$endDate, $workshop);
	$sql = $con-> query("SELECT (COUNT(DISTINCT b.no_nota)/$countOrderPotB)*100 FROM reception a INNER JOIN detail_penjualan b ON a.no_nota=b.no_nota INNER JOIN item_spk c ON b.item=c.nama_item WHERE a.workshop='$workshop' AND c.kategory='7' AND DATEDIFF(a.tgl_packing, a.tgl_input)<=5 AND DATE_FORMAT(a.tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = $sql-> fetch_array();
	return $data[0];
}

function otp_outlet_potongan_kategoriB($startDate,$endDate){
	global $con;
	$countOrderPotB = jumlah_order_potongan_kategoriBD($startDate,$endDate);
	$sql = $con-> query("SELECT (COUNT(DISTINCT b.no_nota)/$countOrderPotB)*100 FROM reception a INNER JOIN detail_penjualan b ON a.no_nota=b.no_nota INNER JOIN item_spk c ON b.item=c.nama_item WHERE c.kategory='7' AND DATEDIFF(a.tgl_kembali, a.tgl_input)<=6 AND DATE_FORMAT(a.tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = $sql-> fetch_array();
	return $data[0];
}


//Order_potongan_tipe_C
function jumlah_order_potongan_kategoriCD($startDate,$endDate){
	global $con;
	$sql = $con-> query("SELECT COUNT(DISTINCT b.no_nota) FROM reception a INNER JOIN detail_penjualan b ON a.no_nota=b.no_nota INNER JOIN item_spk c ON b.item=c.nama_item WHERE (c.kategory='8' OR c.kategory='9') AND DATE_FORMAT(a.tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = $sql-> fetch_array();
	return $data[0];
}

function jumlah_order_potongan_kategoriC($startDate,$endDate, $workshop){
	global $con;
	$sql = $con-> query("SELECT COUNT(DISTINCT b.no_nota) FROM reception a INNER JOIN detail_penjualan b ON a.no_nota=b.no_nota INNER JOIN item_spk c ON b.item=c.nama_item WHERE a.workshop='$workshop' AND (c.kategory='8' OR c.kategory='9') AND DATE_FORMAT(a.tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = $sql-> fetch_array();
	return $data[0];
}

function otp_operasional_potongan_kategoriC($startDate,$endDate, $workshop){
	global $con;
	$countOrderPotC = otp_operasional_potongan_kategoriC($startDate,$endDate, $workshop);
	$sql = $con-> query("SELECT (COUNT(DISTINCT b.no_nota)/$countOrderPotC)*100 FROM reception a INNER JOIN detail_penjualan b ON a.no_nota=b.no_nota INNER JOIN item_spk c ON b.item=c.nama_item WHERE a.workshop='$workshop' AND (c.kategory='8' OR c.kategory='9') AND DATEDIFF(a.tgl_packing, a.tgl_input)<=3 AND DATE_FORMAT(a.tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = $sql-> fetch_array();
	return $data[0];
}

function otp_outlet_potongan_kategoriC($startDate,$endDate){
	global $con;
	$countOrderPotC = jumlah_order_potongan_kategoriCD($startDate,$endDate);
	$sql = $con-> query("SELECT (COUNT(DISTINCT b.no_nota)/$countOrderPotC)*100 FROM reception a INNER JOIN detail_penjualan b ON a.no_nota=b.no_nota INNER JOIN item_spk c ON b.item=c.nama_item WHERE (c.kategory='8' OR c.kategory='9') AND DATEDIFF(a.tgl_kembali, a.tgl_input)<=4 AND DATE_FORMAT(a.tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = $sql-> fetch_array();
	return $data[0];
}

function kumpulan_otp($startDate,$endDate,$workshop){
	$data['otp_spk'] = otp_spk($startDate,$endDate);

	$data['otp_outlet_kiloan'] = otp_outlet_kiloan($startDate,$endDate);
	$data['otp_outlet_potongan'] = otp_outlet_potongan_kategoriA($startDate,$endDate)+otp_outlet_potongan_kategoriB($startDate,$endDate)+otp_outlet_potongan_kategoriC($startDate,$endDate);
	$data['otp_outlet'] = round($data['otp_outlet_kiloan']+$data['otp_outlet_potongan'],2);

	$data['otp_operasional_kiloan'] = otp_operasional_kiloan($startDate,$endDate,$workshop);
	$data['otp_operasional_potongan_kategoriA'] = otp_operasional_potongan_kategoriA($startDate,$endDate,$workshop);
	$data['otp_operasional_potongan_kategoriB'] = otp_operasional_potongan_kategoriB($startDate,$endDate,$workshop);
	$data['otp_operasional_potongan_kategoriC'] = otp_operasional_potongan_kategoriC($startDate,$endDate,$workshop);
	$data['otp_operasional'] = round($data['otp_operasional_kiloan']+$data['otp_operasional_potongan_kategoriA']+$data['otp_operasional_potongan_kategoriB']+$data['otp_operasional_potongan_kategoriC'],2);
	
	
	return $data;
}

$startDate = '2018-10-23';
$endDate = '2018-10-31';

$workshop = 'Toddopuli';

$data = kumpulan_otp($startDate,$endDate,$workshop);

echo $data['otp_outlet'].'<br>'.$data['otp_operasional'].'<br>'.$data['otp_spk'];

?>