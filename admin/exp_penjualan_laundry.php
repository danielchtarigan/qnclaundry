<?php

include "../config.php";
include "../PHPExcel.php";

include 'fungsi/penjualan_laundry.php';

date_default_timezone_set("Asia/Makassar");

$excelku = new PHPExcel();


// Set lebar kolom
$excelku->getActiveSheet()->getColumnDimension('A')->setWidth(15);
$excelku->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$excelku->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$excelku->getActiveSheet()->getColumnDimension('D')->setWidth(15);
$excelku->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$excelku->getActiveSheet()->getColumnDimension('F')->setWidth(20);

// Mergecell, menyatukan beberapa kolom
$excelku->getActiveSheet()->mergeCells('A1:O1');
$excelku->getActiveSheet()->mergeCells('A2:O2');
$excelku->getActiveSheet()->mergeCells('A3:A4');
$excelku->getActiveSheet()->mergeCells('B3:B4');
$excelku->getActiveSheet()->mergeCells('C3:E3');
$excelku->getActiveSheet()->mergeCells('F3:F4');
$excelku->getActiveSheet()->mergeCells('G3:O3');

// Buat Kolom judul tabel
$SI = $excelku->setActiveSheetIndex(0);
$SI->setCellValue('A1', 'Penjualan Laundry'); //Judul laporan
$SI->setCellValue('A3', 'Daily Sales Date');
$SI->setCellValue('B3', 'Reception');
$SI->setCellValue('C3', 'Product'); 
$SI->setCellValue('C4', 'Laundry');
$SI->setCellValue('D4', 'Deposit');
$SI->setCellValue('E4', 'Membership');
$SI->setCellValue('F3', 'Sum Sales Product');
$SI->setCellValue('G3', 'Payment Method');
$SI->setCellValue('G4', 'Cash');
$SI->setCellValue('H4', 'BNI');
$SI->setCellValue('I4', 'BRI');
$SI->setCellValue('J4', 'BCA');
$SI->setCellValue('K4', 'Mandiri');
$SI->setCellValue('L4', 'OVO');
$SI->setCellValue('M4', 'Kuota');
$SI->setCellValue('N4', 'Cashback');
$SI->setCellValue('O4', 'piutang');

//Mengeset Syle nya
$headerStylenya = new PHPExcel_Style();
$bodyStylenya   = new PHPExcel_Style();

$headerStylenya->applyFromArray(
	array('fill' 	=> array(
		  'type'    => PHPExcel_Style_Fill::FILL_SOLID,
		  'color'   => array('argb' => 'FFEEEEEE')),
		  'alignment' => array(
          'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,),
		  'borders' => array('bottom'=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
						'right'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
						'left'	    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
						'top'	    => array('style' => PHPExcel_Style_Border::BORDER_THIN)
		  )
	));
	
$bodyStylenya->applyFromArray(
	array('fill' 	=> array(
		  'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
		  'color'	=> array('argb' => 'FFFFFFFF')),
		  'borders' => array(
						'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
						'right'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN),
						'left'	    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
						'top'	    => array('style' => PHPExcel_Style_Border::BORDER_THIN)
		  )
    ));

//Menggunakan HeaderStylenya
$excelku->getActiveSheet()->setSharedStyle($headerStylenya, "A3:O4");

// Mengambil data dari tabel
$strsql	= "SELECT DISTINCT kasir, tgl_transaksi FROM penjualan_kasir WHERE DATE(tgl_transaksi) BETWEEN '$_GET[tgl]' AND '$_GET[tgl2]' ORDER BY tgl_transaksi ASC";
$res  = $con->query($strsql);
$baris  = 5; //Ini untuk dimulai baris datanya
$no     = 1;

	
while ($dataa = $res->fetch_assoc()) {
	$userId = $dataa['kasir'];
	$tgl = date('Y-m-d', strtotime($dataa['tgl_transaksi']));
	$laundry = jumlah($userId,$tgl,'laundry');
	$deposit = jumlah($userId,$tgl,'deposit');
	$membership = jumlah($userId,$tgl,'membership');
	$total = $laundry+$membership+$deposit;

	$cash = jumlah_bayar($userId,$tgl,'cash');
	$bni = jumlah_bayar($userId,$tgl,'bni');
	$bri = jumlah_bayar($userId,$tgl,'bri');
	$bca = jumlah_bayar($userId,$tgl,'bca');
	$mandiri = jumlah_bayar($userId,$tgl,'mandiri');
	$ovo = jumlah_bayar($userId,$tgl,'ovo');
	$kuota = jumlah_bayar($userId,$tgl,'kuota');
	$cashback = jumlah_bayar($userId,$tgl,'cashback');
	$piutang = jumlah_bayar($userId,$tgl,'piutang');

  $SI->setCellValue("A".$baris,$tgl); 
  $SI->setCellValue("B".$baris,$userId); 
  $SI->setCellValue("C".$baris,$laundry); 
  $SI->setCellValue("D".$baris,$deposit); 
  $SI->setCellValue("E".$baris,$membership); 
  $SI->setCellValue("F".$baris,$total); 
  $SI->setCellValue("G".$baris,$cash); 
  $SI->setCellValue("H".$baris,$bni); 
  $SI->setCellValue("I".$baris,$bri); 
  $SI->setCellValue("J".$baris,$bca);  
  $SI->setCellValue("K".$baris,$mandiri); 
  $SI->setCellValue("L".$baris,$ovo); 
  $SI->setCellValue("M".$baris,$kuota); 
  $SI->setCellValue("N".$baris,$cashback); 
  $SI->setCellValue("O".$baris,$piutang); 
  $baris++; //looping untuk barisnya
}
//Membuat garis di body tabel (isi data)
$excelku->getActiveSheet()->setSharedStyle($bodyStylenya, "A5:O$baris");

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
exit;

?>