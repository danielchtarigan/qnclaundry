<?php
include '../config.php';
include 'head.php';
date_default_timezone_set('Asia/Makassar');
$date = date('Y-m-d');
$newdate = strtotime ( '-30 day' , strtotime ( $date ) ) ;
$newdate = date ( 'Y-m-d' , $newdate );
$newdate2 = strtotime ( '-40 day' , strtotime ( $date ) ) ;
$newdate2 = date ( 'Y-m-d' , $newdate2 );

$tanggalb = date('d', (strtotime('+7 day', strtotime($date))));
$bulanb = date('m', (strtotime('+7 day', strtotime($date))));
$tahunb = date('y', (strtotime('+7 day', strtotime($date))));

$listbulanb = array(
		'01' => 'Januari',
		'02' => 'Februari',
		'03' => 'Maret',
		'04' => 'April',
		'05' => 'Mei',
		'06' => 'Juni',
		'07' => 'Juli',
		'08' => 'Agustus',
		'09' => 'September',
		'10' => 'Oktober',
		'11' => 'November',
		'12' => 'Desember'
	);

?>


<div class="col-lg-12 col-md-offset-0">
	<div class="panel panel-default">
		<div class="panel-body">
		  <p>Menu ini sudah dipindahkan ke <a href="https://telmart.qnclaundry.com/">www.telmart.qnclaundry.com</a> -> Control -> Tipe C</p>  
        
</div>




	
