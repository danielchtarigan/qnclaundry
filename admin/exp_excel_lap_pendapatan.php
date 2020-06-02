<?php

include "../config.php";
include "../PHPExcel.php";

date_default_timezone_set("Asia/Jakarta");

$excelku = new PHPExcel();

// Set properties
$excelku->getProperties()->setCreator("Danni Moring")
                         ->setLastModifiedBy("Danni Moring");

// Set lebar kolom
$excelku->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('C')->setWidth(20);

// Mergecell, menyatukan beberapa kolom
$excelku->getActiveSheet()->mergeCells('A1:D1');
$excelku->getActiveSheet()->mergeCells('A2:D2');
$excelku->getActiveSheet()->mergeCells('A3:A4');
$excelku->getActiveSheet()->mergeCells('B3:B4');
$excelku->getActiveSheet()->mergeCells('C3:C4');
$excelku->getActiveSheet()->mergeCells('D3:K3');
$excelku->getActiveSheet()->mergeCells('L3:P3');
$excelku->getActiveSheet()->mergeCells('Q3:U3');
$excelku->getActiveSheet()->mergeCells('V3:W3');

// Buat Kolom judul tabel
$SI = $excelku->setActiveSheetIndex(0);
$SI->setCellValue('A1', 'Pendapatan Resepsionis'); //Judul laporan
$SI->setCellValue('A3', 'Tanggal');
$SI->setCellValue('B3', 'Nomor');
$SI->setCellValue('C3', 'Resepsionis'); 
$SI->setCellValue('D3', 'Pendapatan Order');
$SI->setCellValue('D4', 'Cash');
$SI->setCellValue('E4', 'BNI');
$SI->setCellValue('F4', 'BRI');
$SI->setCellValue('G4', 'BCA');
$SI->setCellValue('H4', 'Mandiri');
$SI->setCellValue('I4', 'Kuota');
$SI->setCellValue('J4', 'Cashback');
$SI->setCellValue('K4', 'Piutang');
$SI->setCellValue('L3', 'Pendapatan Membership');
$SI->setCellValue('L4', 'Cash');
$SI->setCellValue('M4', 'BNI');
$SI->setCellValue('N4', 'BRI');
$SI->setCellValue('O4', 'BCA');
$SI->setCellValue('P4', 'Mandiri');
$SI->setCellValue('Q3', 'Pendapatan Deposit');
$SI->setCellValue('Q4', 'Cash');
$SI->setCellValue('R4', 'BNI');
$SI->setCellValue('S4', 'BRI');
$SI->setCellValue('T4', 'BCA');
$SI->setCellValue('U4', 'Mandiri');
$SI->setCellValue('V3', 'Pendapatan Delivery');
$SI->setCellValue('V4', 'Cash');
$SI->setCellValue('W4', 'BNI');

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
$excelku->getActiveSheet()->setSharedStyle($headerStylenya, "A3:W4");

// Mengambil data dari tabel
$strsql	= "SELECT * from tutup_shift ORDER BY tanggal_tutup ASC";
$res    = $con->query($strsql);
$baris  = 5; //Ini untuk dimulai baris datanya
$no     = 1;

while ($row = $res->fetch_assoc()) {
  $SI->setCellValue("A".$baris,$row['tanggal_tutup']); 
  $SI->setCellValue("B".$baris,$row['nomor']); 
  $SI->setCellValue("C".$baris,$row['dibuat_oleh']); 
  $SI->setCellValue("D".$baris,$row['rcp_cash']); 
  $SI->setCellValue("E".$baris,$row['rcp_bni']); 
  $SI->setCellValue("F".$baris,$row['rcp_bri']); 
  $SI->setCellValue("G".$baris,$row['rcp_bca']); 
  $SI->setCellValue("H".$baris,$row['rcp_mandiri']); 
  $SI->setCellValue("I".$baris,$row['rcp_kuota']); 
  $SI->setCellValue("J".$baris,$row['rcp_cashback']);  
  $SI->setCellValue("K".$baris,$row['rcp_piutang']); 
  $SI->setCellValue("L".$baris,$row['rcp_cash_membership']); 
  $SI->setCellValue("M".$baris,$row['rcp_bni_membership']); 
  $SI->setCellValue("N".$baris,$row['rcp_bri_membership']); 
  $SI->setCellValue("O".$baris,$row['rcp_bca_membership']); 
  $SI->setCellValue("P".$baris,$row['rcp_mandiri_deposit']);  
  $SI->setCellValue("Q".$baris,$row['rcp_cash_deposit']); 
  $SI->setCellValue("R".$baris,$row['rcp_bni_deposit']); 
  $SI->setCellValue("S".$baris,$row['rcp_bri_deposit']); 
  $SI->setCellValue("T".$baris,$row['rcp_bca_deposit']); 
  $SI->setCellValue("U".$baris,$row['rcp_mandiri_deposit']);   
  $SI->setCellValue("V".$baris,$row['delivery_cash']); 
  $SI->setCellValue("W".$baris,$row['delivery_kuota']);
  $baris++; //looping untuk barisnya
}
//Membuat garis di body tabel (isi data)
$excelku->getActiveSheet()->setSharedStyle($bodyStylenya, "A5:W$baris");

//Memberi nama sheet
$excelku->getActiveSheet()->setTitle('Pendapatan Reception');

$excelku->setActiveSheetIndex(0);

// untuk excel 2007 atau yang berekstensi .xlsx
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename=Pendapatan Resepsionis.xlsx');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($excelku, 'Excel2007');
$objWriter->save('php://output');
exit;

?>