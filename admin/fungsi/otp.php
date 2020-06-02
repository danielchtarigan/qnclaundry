<?php 
function jumlah_order($startDate,$endDate){
	global $con;
	$sql = $con-> query("SELECT COUNT(*) FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND b.Kota='Makassar' AND kategori_item<>'' AND cara_bayar<>'Reject' AND cara_bayar<>'Void' AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' ");
	$data = $sql-> fetch_array();
	return $data[0];
}

function spk($startDate,$endDate) {
	global $con;
	$sql = $con-> query("SELECT COUNT(*) FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND b.Kota='Makassar' AND kategori_item<>'' AND cara_bayar<>'Reject' AND cara_bayar<>'Void' AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' AND DATEDIFF(tgl_spk, tgl_input)<=0.5 ");
	$data = $sql-> fetch_array();
	return $data[0];
}

function jumlah_order_kiloan($startDate,$endDate){
	global $con;
	$sql = $con-> query("SELECT COUNT(*) FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND b.Kota='Makassar' AND kategori_item='K' AND cara_bayar<>'Reject' AND cara_bayar<>'Void' AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = $sql-> fetch_array();
	return $data[0];
}

function outlet_kiloan($startDate,$endDate){
	global $con;
	$sql = $con-> query("SELECT COUNT(*) FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND b.Kota='Makassar' AND kategori_item='K' AND cara_bayar<>'Reject' AND cara_bayar<>'Void' AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' AND DATEDIFF(tgl_kembali, tgl_input)<=2.5 ");
	$data = $sql-> fetch_array();
	return $data[0];
}

function jumlah_order_Cloth($startDate,$endDate){
	global $con;
	$sql = $con-> query("SELECT COUNT(*) FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND b.Kota='Makassar' AND kategori_item='P1' AND cara_bayar<>'Reject' AND cara_bayar<>'Void' AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = $sql-> fetch_array();
	return $data[0];
}

function outlet_Cloth($startDate,$endDate){
	global $con;
	$sql = $con-> query("SELECT COUNT(*) FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND b.Kota='Makassar' AND kategori_item='P1' AND cara_bayar<>'Reject' AND cara_bayar<>'Void' AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' AND DATEDIFF(tgl_kembali, tgl_input)<=3");
	$data = $sql-> fetch_array();
	return $data[0];
}

function jumlah_order_Doll($startDate,$endDate){
	global $con;
	$sql = $con-> query("SELECT COUNT(*) FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND b.Kota='Makassar' AND kategori_item='P2' AND cara_bayar<>'Reject' AND cara_bayar<>'Void' AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = $sql-> fetch_array();
	return $data[0];
}

function outlet_Doll($startDate,$endDate){
	global $con;
	$sql = $con-> query("SELECT COUNT(*) FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND b.Kota='Makassar' AND kategori_item='P2' AND cara_bayar<>'Reject' AND cara_bayar<>'Void' AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' AND DATEDIFF(tgl_kembali, tgl_input)<=6");
	$data = $sql-> fetch_array();
	return $data[0];
}

function jumlah_order_Gordyn($startDate,$endDate){
	global $con;
	$sql = $con-> query("SELECT COUNT(*) FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND b.Kota='Makassar' AND kategori_item='P3' AND cara_bayar<>'Reject' AND cara_bayar<>'Void' AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = $sql-> fetch_array();
	return $data[0];
}

function outlet_Gordyn($startDate,$endDate){
	global $con;
	$sql = $con-> query("SELECT COUNT(*) FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND b.Kota='Makassar' AND kategori_item='P3' AND cara_bayar<>'Reject' AND cara_bayar<>'Void' AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' AND DATEDIFF(tgl_kembali, tgl_input)<=4");
	$data = $sql-> fetch_array();
	return $data[0];
}


function jumlah_order_kiloan_work($startDate,$endDate,$workshop){
	global $con;
	$sql = $con-> query("SELECT COUNT(*) FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND b.Kota='Makassar' AND workshop='$workshop' AND kategori_item='K' AND cara_bayar<>'Reject' AND cara_bayar<>'Void' AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = $sql-> fetch_array();
	return $data[0];
}

function operasional_kiloan($startDate,$endDate,$workshop){
	global $con;
	$sql = $con-> query("SELECT COUNT(*) FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND b.Kota='Makassar' AND workshop='$workshop' AND kategori_item='K' AND cara_bayar<>'Reject' AND cara_bayar<>'Void' AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' AND DATEDIFF(tgl_packing, tgl_input)<=1.5 ");
	$data = $sql-> fetch_array();
	return $data[0];
}

function jumlah_order_cloth_work($startDate,$endDate,$workshop){
	global $con;
	$sql = $con-> query("SELECT COUNT(*) FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND b.Kota='Makassar' AND workshop='$workshop' AND kategori_item='P1' AND cara_bayar<>'Reject' AND cara_bayar<>'Void' AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = $sql-> fetch_array();
	return $data[0];
}

function operasional_cloth($startDate,$endDate,$workshop){
	global $con;
	$sql = $con-> query("SELECT COUNT(*) FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND b.Kota='Makassar' AND workshop='$workshop' AND kategori_item='P1' AND cara_bayar<>'Reject' AND cara_bayar<>'Void' AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' AND DATEDIFF(tgl_packing, tgl_input)<=2 ");
	$data = $sql-> fetch_array();
	return $data[0];
}

function jumlah_order_doll_work($startDate,$endDate,$workshop){
	global $con;
	$sql = $con-> query("SELECT COUNT(*) FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND b.Kota='Makassar' AND workshop='$workshop' AND kategori_item='P2' AND cara_bayar<>'Reject' AND cara_bayar<>'Void' AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = $sql-> fetch_array();
	return $data[0];
}

function operasional_doll($startDate,$endDate,$workshop){
	global $con;
	$sql = $con-> query("SELECT COUNT(*) FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND b.Kota='Makassar' AND workshop='$workshop' AND kategori_item='P2' AND cara_bayar<>'Reject' AND cara_bayar<>'Void' AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' AND DATEDIFF(tgl_packing, tgl_input)<=5 ");
	$data = $sql-> fetch_array();
	return $data[0];
}

function jumlah_order_gordyn_work($startDate,$endDate,$workshop){
	global $con;
	$sql = $con-> query("SELECT COUNT(*) FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND b.Kota='Makassar' AND workshop='$workshop' AND kategori_item='P3' AND cara_bayar<>'Reject' AND cara_bayar<>'Void' AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = $sql-> fetch_array();
	return $data[0];
}

function operasional_gordyn($startDate,$endDate,$workshop){
	global $con;
	$sql = $con-> query("SELECT COUNT(*) FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND b.Kota='Makassar' AND workshop='$workshop' AND kategori_item='P3' AND cara_bayar<>'Reject' AND cara_bayar<>'Void' AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' AND DATEDIFF(tgl_packing, tgl_input)<=4 ");
	$data = $sql-> fetch_array();
	return $data[0];
}

function kumpulan_otp($startDate,$endDate,$workshop){
	$data['otp_spk'] = spk($startDate,$endDate)/jumlah_order($startDate,$endDate);
	$data['otp_outlet1'] = outlet_kiloan($startDate,$endDate)/jumlah_order_kiloan($startDate,$endDate);
	$data['otp_outlet2'] = outlet_Cloth($startDate,$endDate)/jumlah_order_Cloth($startDate,$endDate);
	$data['otp_outlet3'] = outlet_Doll($startDate,$endDate)/jumlah_order_Doll($startDate,$endDate);
	$data['otp_outlet4'] = outlet_Gordyn($startDate,$endDate)/jumlah_order_Gordyn($startDate,$endDate);
	$data['otp_outlet'] = ($data['otp_outlet1']+$data['otp_outlet2']+$data['otp_outlet3']+$data['otp_outlet4'])/4;

	if(jumlah_order_cloth_work($startDate,$endDate,$workshop)==0){
		$orderClothWork = 1;
	}
	else {
		$orderClothWork = jumlah_order_cloth_work($startDate,$endDate,$workshop);
	}

	if(jumlah_order_doll_work($startDate,$endDate,$workshop)==0){
		$orderDollWork = 1;
	}
	else {
		$orderDollWork = jumlah_order_doll_work($startDate,$endDate,$workshop);
	}

	if(jumlah_order_gordyn_work($startDate,$endDate,$workshop)==0){
		$orderGordynWork = 1;
	}
	else {
		$orderGordynWork = jumlah_order_gordyn_work($startDate,$endDate,$workshop);
	}

	$data['otp_operasional1'] = operasional_kiloan($startDate,$endDate,$workshop)/jumlah_order_kiloan_work($startDate,$endDate,$workshop);
	$data['otp_operasional2'] = operasional_cloth($startDate,$endDate,$workshop)/$orderClothWork;
	$data['otp_operasional3'] = operasional_doll($startDate,$endDate,$workshop)/$orderDollWork;
	$data['otp_operasional4'] = operasional_gordyn($startDate,$endDate,$workshop)/$orderGordynWork;

	$data['otp_operasional'] = ($data['otp_operasional1']+$data['otp_operasional2']+$data['otp_operasional3']+$data['otp_operasional4'])/4;

	$data['jumlah_order'] = jumlah_order($startDate,$endDate);

	return $data;
}



?>