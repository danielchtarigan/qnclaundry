<?php 
include 'config.php';


$query = mysqli_query($con, "SELECT *FROM tutup_shift_operator ORDER BY tanggal DESC LIMIT 1");
$row = mysqli_fetch_array($query);

$mesinCuciKecil = $row['mesin_cuci_kecil'];
$mesinCuciBesar = $row['mesin_cuci_besar'];
$mesinKeringKecil = $row['mesin_kering_kecil'];
$mesinKeringBesar = $row['mesin_kering_besar'];

$shiftOpr = 3;

$query = "SELECT SUM(berat) AS berat FROM reception WHERE packing=false and kembali=false and setrika=false and tgl_so='0000-00-00 00:00:00' and jenis='k' and rijeck=false  and nama_outlet<>'mojokerto' ORDER BY tgl_input";
$data = mysqli_query($con, $query);
$jumlah = mysqli_fetch_row($data)[0];
$jumSetrika = round($jumlah).' Kg';

$orangSetrika = round($jumlah/50).' Orang';

$kurangTiga = mysqli_query($con, "SELECT * FROM reception WHERE berat<=3 AND cuci=false AND pengering=false AND setrika=false AND packing=false AND kembali=false AND jenis='k' AND rijeck=false AND nama_outlet<>'mojokerto'");
$countKurangTiga = mysqli_num_rows($kurangTiga);
$countKurangTiga = $countKurangTiga+100;

$lebihTiga = mysqli_query($con, "SELECT * FROM reception WHERE berat>3 AND cuci=false AND pengering=false AND setrika=false AND packing=false AND kembali=false AND jenis='k' AND rijeck=false AND nama_outlet<>'mojokerto'");
$countLebihTiga = mysqli_num_rows($lebihTiga);
$countLebihTiga = $countLebihTiga+80;

$countNota = ($countKurangTiga+$countLebihTiga).' Nota';

$ket = ' <font style="font-size: 6px; color: #FF0000;">(*Max '.$mesinCuciKecil.', sisa nota diproses di Mesin Cuci besar)</font>';
$ket2 = ' <font style="font-size: 6px; color: #FF0000;">(*Max '.$mesinKeringKecil.', sisa nota diproses di Mesin Pengering besar)</font>';

$ketOver = ' <font style="font-size: 6px; color: #FF0000;">(*Norm '.($mesinCuciKecil+$mesinCuciBesar).', Telah melebihi kapasitas)</font>';
$ketOver2 = ' <font style="font-size: 6px; color: #FF0000;">(*Norm '.($mesinKeringKecil+$mesinKeringBesar).', Telah melebihi kapasitas)</font>';

if($countKurangTiga<=134){
	$butuhmesinCuciKecil = round($countKurangTiga/10/$shiftOpr);
	$butuhmesinCuciBesar = round($countLebihTiga/8/$shiftOpr);
} else {
	$butuhmesinCuciKecil = round(134/10/$shiftOpr). $ket;
	$butuhmesinCuciBesar = round(($countLebihTiga+$countKurangTiga-134)/8/$shiftOpr);
}

if($countKurangTiga<=74){
	$butuhmesinPengeringKecil = round($countKurangTiga/10/$shiftOpr);
	$butuhmesinPengeringBesar = round($countLebihTiga/8/$shiftOpr);
} else {
	$butuhmesinPengeringKecil = round(74/10/$shiftOpr). $ket2;
	$butuhmesinPengeringBesar = round(($countLebihTiga+$countKurangTiga-74)/8/$shiftOpr);
}

if(round($butuhmesinCuciKecil+$butuhmesinCuciBesar)>($mesinCuciKecil+$mesinCuciBesar)) $butuhMesinCuci = round($butuhmesinCuciKecil+$butuhmesinCuciBesar). $ketOver; else $butuhMesinCuci = round($butuhmesinCuciKecil+$butuhmesinCuciBesar);

if(round($butuhmesinPengeringKecil+$butuhmesinPengeringBesar)>($mesinKeringKecil+$mesinKeringBesar)) $butuhMesinPengering = round($butuhmesinPengeringKecil+$butuhmesinPengeringBesar). $ketOver2; else $butuhMesinPengering = round($butuhmesinPengeringKecil+$butuhmesinPengeringBesar);

if($countNota>230) $outsource = ($countNota-230).' Nota'; else $outsource = 0;



	$to  = 'amma.akki1708@gmail.com' . ', '; // note the comma
	$to .= 'aruldyan14@gmail.com';

	// subject
	$subject = 'Antrian Cucian Kiloan ';
	$message = '<html><body>';
	$message .= '<table style="border-style: ridge; font-size: 10px" cellpadding="5">';
	$message .= '<tr><td><strong>Antrian Cuci</strong></td><td><strong>:</strong></td><td><strong>'.strip_tags($countNota).'</strong></td></tr>';
	$message .= '<tr><td>&nbsp; &nbsp;Cucian <= 3Kg</td><td>:</td><td>'.strip_tags($countKurangTiga).'</td></tr>';
	$message .= '<tr><td>&nbsp; &nbsp;Cucian > 3Kg</td><td>:</td><td>'.strip_tags($countLebihTiga).'</td></tr>';
	$message .= '<tr><td><strong>Mesin Cuci Dibutuhkan</strong></td><td><strong>:</strong></td><td><strong>'.$butuhMesinCuci.'</strong></td></tr>';
	$message .= '<tr><td><strong>Mesin Pengering Dibutuhkan</strong></td><td><strong>:</strong></td><td><strong>'.$butuhMesinPengering.'</strong></td></tr>';
	$message .= '<tr><td><strong>Butuh Outsource</strong></td><td><strong>:</strong></td><td><strong>'.strip_tags($outsource).'</strong></td></tr>';
	$message .= '</table><br>';
	$message .= '<table style="margin-top: 1px; border-style: ridge;" cellpadding="10">';
	$message .= '<tr><td><strong>Antrian Setrika</strong></td><td><strong>:</strong></td><td><strong>'.strip_tags($jumSetrika).'</strong></td></tr>';
	$message .= '<tr><td><strong>Butuh Tenaga</strong></td><td><strong>:</strong></td><td><strong>'. strip_tags($orangSetrika).'</strong></td></tr>';
	$message .= '</table>';

	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// Additional headers
	$headers .= 'to :'.$to. "\r\n";
	$headers .= 'From: WIP <admin@qnclaundry.com>' . "\r\n";
	$headers .= 'Cc: quicknclean.indonesia@gmail.com' . "\r\n";		


	// Mail it
	mail($to, $subject, $message, $headers);
