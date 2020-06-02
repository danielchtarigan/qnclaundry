<?php 
include 'config.php';
include 'add_jurnal.php';

date_default_timezone_set('Asia/Makassar');
$startDate = "2019-04-08";
$endDate = "2019-04-11";

$sqlPenjualan = $con->query("SELECT * FROM penjualan_kasir WHERE DATE(tgl_transaksi) BETWEEN '$startDate' AND '$endDate' AND kasir<>'magang1'");
while($data = $sqlPenjualan->fetch_array()){
	
	$transactionDate = date('Y-m-d', strtotime($data['tgl_transaksi']));
	$transactionNo = $data['no_penjualan_produk'] ;
	$pelanggan = ucwords($data['kasir']) ;
	$dueDate = date('Y-m-d', strtotime('+2 days', strtotime($transactionDate)));
	$sumProduct = $data['jumlah'];
	$productName = ($data['penjualan']=="deposit") ? "Deposito Laundry" : ucwords($data['penjualan']);
	$customeId = $transactionNo;
	$gudang = "Makassar";
	$warehouseCode = "Gudang-1";

	switch ($data['cara_bayar']) {
		case 'cash': $akunBayar = "Penampungan Kas";
			break;
		case 'piutang': $akunBayar = "Penampungan Kas";
			break;
		case 'kuota': $akunBayar = "Pendapatan - Deposito Laundry";
			break;
		case 'cashback': $akunBayar = "Diskon Penjualan";
			break;
		default: $akunBayar = "Penampungan Non-Kas";			
			break;
	}


	$sql = mysqli_query($con, "SELECT id_outlet FROM log_rcp WHERE id_user='$pelanggan' AND DATE(tgl_log)='$transactionDate' ORDER BY tgl_log DESC LIMIT 0,1 ");
	$tags = "Outlet ".mysqli_fetch_row($sql)[0];

	add_sales_invoice($transactionDate,$transactionNo,$pelanggan,$dueDate,$sumProduct,$productName,$tags,$customeId,$gudang,$warehouseCode,$akunBayar);
}


	

?>