<?php 
include 'config.php';

$query = "SELECT SUM(berat) AS berat FROM reception WHERE packing=false and kembali=false and setrika=false and tgl_so='0000-00-00 00:00:00' and jenis='k' and rijeck=false  and nama_outlet<>'mojokerto' ORDER BY tgl_input";
$data = mysqli_query($con, $query);
$jumlah = mysqli_fetch_row($data)[0];

$orangSetrika = round($jumlah/50).' Orang';
$orangOpr = 'Belum dihitung';

	$to  = 'amma.akki1708@gmail.com' . ', '; // note the comma
	$to .= 'aruldyan14@gmail.com';

	// subject
	$subject = 'WIP: ';
	$message = '<html><body>';
	$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
	$message .= "<tr><td><strong>Normal Setrika:</strong> </td><td>" . strip_tags($orangSetrika) . "</td></tr>";
	$message .= "<tr><td><strong>Normal Operator:</strong> </td><td>" . strip_tags($orangOpr) . "</td></tr>";

	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	// Additional headers
	$headers .= 'to :'.$to.'' . "\r\n";
	$headers .= 'From: WIP <admin@qnclaundry.com>' . "\r\n";
	$headers .= 'Cc: quicknclean@gmail.com' . "\r\n";


	// Mail it
	mail($to, $subject, $message, $headers);
