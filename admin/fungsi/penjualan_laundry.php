<?php 
function jumlah($userId,$tgl,$produk){
	global $con;
	$sql = $con->query("SELECT COALESCE(SUM(jumlah),0) FROM penjualan_kasir WHERE kasir='$userId' AND tgl_transaksi LIKE '%$tgl%' AND penjualan='$produk' ");
	$data = $sql->fetch_array();
	return $data[0];
}

function jumlah_bayar($userId,$tgl,$cash){
	global $con;
	$sql = $con->query("SELECT COALESCE(SUM(jumlah),0) FROM penjualan_kasir WHERE kasir='$userId' AND tgl_transaksi LIKE '%$tgl%' AND cara_bayar='$cash' ");
	$data = $sql->fetch_array();
	return $data[0];
}


?>