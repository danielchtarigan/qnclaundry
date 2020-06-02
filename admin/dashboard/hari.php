<?php 

date_default_timezone_set('Asia/Makassar');
$date = date('Y-m-d');
$day = date('l');
$month = date('M');

$day1 = date('w Y-m-d');
$day2 = date('w Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));
$day3 = date('w Y-m-d', strtotime('-2 day', strtotime(date('Y-m-d'))));
$day4 = date('w Y-m-d', strtotime('-3 day', strtotime(date('Y-m-d'))));
$day5 = date('w Y-m-d', strtotime('-4 day', strtotime(date('Y-m-d'))));
$day6 = date('w Y-m-d', strtotime('-5 day', strtotime(date('Y-m-d'))));
$day7 = date('w Y-m-d', strtotime('-6 day', strtotime(date('Y-m-d'))));
$day8 = date('w Y-m-d', strtotime('-7 day', strtotime(date('Y-m-d'))));

$days1 = date('D');
$days2 = date('D', strtotime('-1 day', strtotime(date('Y-m-d'))));
$days3 = date('D', strtotime('-2 day', strtotime(date('Y-m-d'))));
$days4 = date('D', strtotime('-3 day', strtotime(date('Y-m-d'))));
$days5 = date('D', strtotime('-4 day', strtotime(date('Y-m-d'))));
$days6 = date('D', strtotime('-5 day', strtotime(date('Y-m-d'))));
$days7 = date('D', strtotime('-6 day', strtotime(date('Y-m-d'))));
$days8 = date('D', strtotime('-7 day', strtotime(date('Y-m-d'))));

$outlet1 = "Toddopuli";
$outlet2 = "Landak";
$outlet3 = "Baruga";
$outlet4 = "Boulevard";
$outlet5 = "DAYA";
$outlet6 = "BTP";
$outlet7 = "Graha Pena";
$outlet8 = "Batua";
$outlet9 = "Sungai Saddang";
$outlet10 = "Royal Apartment"; 
$outlet11 = "Antang";
$outlet12 = "Hertasning 1";
$outlet13 = "Hertasning 2";
$outlet14 = "support";




switch ($day){
	case "Sunday" : $hari = "Minggu"; break;
	case "Monday" : $hari = "Senin"; break;
	case "Tuesday" : $hari = "Selasa"; break;
	case "Wednesday" : $hari = "Rabu"; break;
	case "Thursday" : $hari = "Kamis"; break;
	case "Friday" : $hari = "Jumat"; break;
	case "Saturday" : $hari = "Sabtu"; break;
}

switch ($month){
	case "Jan" : $bulan = "Januari"; break;
	case "Feb" : $bulan = "Februari"; break;
	case "Mar" : $bulan = "Maret"; break;
	case "Apr" : $bulan = "April"; break;
	case "Mei" : $bulan = "Mei"; break;
	case "Jun" : $bulan = "Juni"; break;
	case "Jul" : $bulan = "Juli"; break;
	case "Aug" : $bulan = "Agustus"; break;
	case "Sep" : $bulan = "September"; break;
	case "Okt" : $bulan = "Oktober"; break;
	case "Nov" : $bulan = "November"; break;
	case "Des" : $bulan = "Desember"; break;
}


function pembayaran_outlet($day1,$outlet1){
	global $con;
	$query = mysqli_query($con, "select sum(total) as toddopuli from faktur_penjualan where date_format(tgl_transaksi, '%w %Y-%m-%d')='$day1' and cara_bayar<>'kuota' AND cara_bayar<>'Void' AND cara_bayar<>'Reject' and nama_outlet='$outlet1'");
	$data = mysqli_fetch_row($query);
	return $data[0];
}

function pengeluaran_outlet($day1,$outlet1){
	global $con;
	$query = mysqli_query($con, "select sum(pengeluaran) as keluar from tutup_kasir where DATE_FORMAT(tanggal, '%w %Y-%m-%d')='$day1' and outlet='$outlet1'");
	$data = mysqli_fetch_row($query);
	return $data[0];
}

function cashback_outlet($day1,$outlet1){
	global $con;
	$query = mysqli_query($con, "select sum(jumlah) as toddopuli from cara_bayar where date_format(tanggal_input, '%w %Y-%m-%d')='$day1' and cara_bayar='cashback' and outlet='$outlet1'");
	$data = mysqli_fetch_row($query);
	return $data[0];
}

function hasil($day1,$outlet1){
	$data = pembayaran_outlet($day1,$outlet1)-cashback_outlet($day1,$outlet1)-pengeluaran_outlet($day1,$outlet1);
	return $data;
}




?>