<?php

include "../config.php";
include "../PHPExcel.php";

date_default_timezone_set("Asia/Makassar");

$excelku = new PHPExcel();

// Buat Kolom judul tabel
$SI = $excelku->setActiveSheetIndex(0);
$SI->setCellValue('A1', '*Customer'); //Judul laporan
$SI->setCellValue('B1', 'Email');
$SI->setCellValue('C1', 'BillingAddress');
$SI->setCellValue('D1', 'ShippingAddress'); 
$SI->setCellValue('E1', '*InvoiceDate');
$SI->setCellValue('F1', '*DueDate');
$SI->setCellValue('G1', 'ShippingDate');
$SI->setCellValue('H1', 'ShipVia');
$SI->setCellValue('I1', 'TrackingNo');
$SI->setCellValue('J1', 'CustomerRefNo');
$SI->setCellValue('K1', '*InvoiceNumber');
$SI->setCellValue('L1', 'Message'); 
$SI->setCellValue('M1', 'Memo');
$SI->setCellValue('N1', '*ProductName');
$SI->setCellValue('O1', 'Description');
$SI->setCellValue('P1', '*Quantity');
$SI->setCellValue('Q1', 'Unit');
$SI->setCellValue('R1', '*UnitPrice');
$SI->setCellValue('S1', 'ProductDiscountRate(%)');
$SI->setCellValue('T1', 'InvoiceDiscountRate(%)');
$SI->setCellValue('U1', 'TaxName'); 
$SI->setCellValue('V1', 'TaxRate(%)');
$SI->setCellValue('W1', 'ShippingFee');
$SI->setCellValue('X1', '#paid?(yes/no)');
$SI->setCellValue('Y1', '#PaymentMethod');
$SI->setCellValue('Z1', '#PaidToAccountCode');
$SI->setCellValue('AA1', 'Tags (use ; to separate tags)');
$SI->setCellValue('AB1', 'WarehouseName');


// Mengambil data dari tabel
$strsql	= "SELECT * FROM penjualan_kasir WHERE DATE(tgl_transaksi) BETWEEN '$_GET[tgl]' AND '$_GET[tgl2]' ORDER BY tgl_transaksi ASC";
$res  = $con->query($strsql);
$baris  = 2; //Ini untuk dimulai baris datanya
$no     = 1;
	
while ($dataa = $res->fetch_assoc()) {
	$pelanggan = $dataa['kasir'];
	$tgl = date('Y-m-d', strtotime($dataa['tgl_transaksi']));
	$sql = mysqli_query($con, "SELECT id_outlet FROM log_rcp WHERE id_user='$pelanggan' AND DATE(tgl_log)='$tgl' ORDER BY tgl_log DESC LIMIT 0,1 ");
	$outlet = mysqli_fetch_row($sql)[0];

  $SI->setCellValue("A".$baris,$pelanggan); 
  $SI->setCellValue("N".$baris,$dataa['penjualan']); 
  $SI->setCellValue("E".$baris,date('d/m/Y', strtotime($dataa['tgl_transaksi']))); 
  $SI->setCellValue("F".$baris,date('d/m/Y', strtotime('+2 days', strtotime($dataa['tgl_transaksi']))));
  $SI->setCellValue("K".$baris,$dataa['no_penjualan_produk']); 
  $SI->setCellValue("P".$baris,"1"); 
  $SI->setCellValue("R".$baris,$dataa['jumlah']);  
  $SI->setCellValue("AA".$baris,"Outlet ".$outlet);  
  $baris++; //looping untuk barisnya
}


//Memberi nama sheet
$excelku->getActiveSheet()->setTitle('Penjualan Laundry');

$excelku->setActiveSheetIndex(0);

// untuk excel 2007 atau yang berekstensi .xlsx
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename=Penjualan Laundry.xlsx');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($excelku, 'Excel2007');
$objWriter->save('php://output');
exit;

?>