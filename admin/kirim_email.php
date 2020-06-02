<?php
include '../config.php';
date_default_timezone_set('Asia/Makassar');
$jam=date("Y-m-d H:i:s");
$tgl     = $_POST['tgl'];
	$date    = new DateTime($tgl);
	$newDate = $date->format('Y-m-d');

	$tgl2    = $_POST['tgl2'];
	$date2   = new DateTime($tgl2);
	$newDate2= $date2->format('Y-m-d');
$to  = 'setyawanrooney@gmail.com' . ', '; // note the comma
$to .= 'quicknclean.indonesia@gmail.com';

$query = "SELECT a.nama_outlet,DATE_FORMAT(a.tgl_input, '%Y-%m-%d') as tgl_input,sum(a.total_bayar) as jumlah,a.nama_reception FROM reception a left join tutup_kasir b ON (a.nama_reception=b.reception and DATE_FORMAT(a.tgl_input, '%Y-%m-%d')= DATE_FORMAT(b.tanggal, '%Y-%m-%d'))  where b.reception is null and (DATE_FORMAT(a.tgl_input, '%Y-%m-%d') between '$newDate' and '$newDate2')  group by a.nama_reception,a.nama_outlet,DATE_FORMAT(a.tgl_input, '%Y%m%d') ORDER BY a.tgl_input ASC" ;
$tampil = mysqli_query($con, $query);
while($data = mysqli_fetch_array($tampil)){
	 $data11[]=$data['nama_reception'];
	  $data2[]=$data['tgl_input'];
	
}
 $implode = implode(",",$data11);
 $implode2 = implode(",",$data2);
 
$message = '<html><body>';
$message .= "Tidak Tutup Kasir". strip_tags($tgl) . " s/d ".strip_tags($tgl2);
$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
$message .= "<tr><td><strong>Tanggal:</strong> </td><td>" . strip_tags($implode2) . "</td></tr>";
$message .= "<tr><td><strong>rcp:</strong> </td><td>" . strip_tags($implode) . "</td></tr>";


// subject
$subject = 'Tidak Tutup Kasir : ';



// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'to :'.$to.'' . "\r\n";
$headers .= 'From:Tidak Tutup Kasir <admin@qnclaundry.com>' . "\r\n";
$headers .= 'Cc: admin@qnclaundry.com' . "\r\n";
$headers .= 'Bcc: admin@qnclaundry.com' . "\r\n";

// Mail it
mail($to, $subject, $message, $headers);
	
?>