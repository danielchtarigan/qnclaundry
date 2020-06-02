<?php
include '../../config.php';
session_start();
$ot = $_SESSION['nama_outlet'];
$us = $_SESSION['user_id'];
$kota = "Makassar";
date_default_timezone_set('Asia/Makassar');
$jam1 = date("Y-m-d H:i:s");
$tgl = date("Y-m-d");
$tanggalkemarin = date('Y-m-d', strtotime('-1 day', strtotime($tgl)));

$kodevoucher = $_POST['kode'];
$idcs = $_POST['id'];
$jenis = $_POST['jenis'];

$ordertmp = ($jenis=="Potongan") ? "order_potongan_tmp" : "order_tmp";

$charjenis = ($jenis=="Potongan") ? "p" : "k";

$qtmp = mysqli_query($con, "SELECT * from $ordertmp where id_customer='$idcs' AND cabang<>'Delivery'");
$ntmp = mysqli_num_rows($qtmp);

if($ntmp>0){
	while ($rtmp = mysqli_fetch_array($qtmp)){
		$no_nota = $rtmp['no_nota'];
		$total = $rtmp['harga']*$rtmp['jumlah'];
		$berat = $rtmp['berat'];
		mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', '$rtmp[item]', '$rtmp[harga]', '$rtmp[jumlah]', '$total', '$rtmp[no_nota]', '$idcs', '$rtmp[berat]', '$rtmp[ket]')");
	}

	$rtmp = mysqli_fetch_array($qtmp);
	$hargacharge = $rtmp['charge']*15000;

	switch ($rtmp['charge']) {
		case '1': $ketcharge = "Express"; break;
		case '2': $ketcharge = "Double Express"; break;
		case '3': $ketcharge = "Super Express"; break;
	}

	if($ketcharge!=''){
		$qact = mysqli_query($con, "INSERT INTO detail_penjualan values ('', '$jam1', '$ketcharge', '$hargacharge', '1', '$hargacharge', '$rtmp[no_nota]', '$idcs', '$berat', '$rtmp[ket]')");
	}

	$omsbfr = mysqli_query($con, "SELECT SUM(a.total_bayar) as omsbefore FROM reception a, outlet b where a.nama_outlet=b.nama_outlet AND b.Kota='$kota' AND a.tgl_input like '%$tanggalkemarin%'");
	$ctrlprior = mysqli_query($con, "select omset_maks from control_priority");
	$rsltomset = mysqli_fetch_array($omsbfr);
	$rsltprior = mysqli_fetch_array($ctrlprior);
	$qpriority = mysqli_query($con, "SELECT COUNT(*) AS orders FROM reception WHERE (tgl_input >= now()-interval 3 month) AND id_customer='$idcs'");
    $prioritydata = mysqli_fetch_array($qpriority);
    if ($prioritydata['orders'] >= 9 && $rsltomset['omsbefore']>=$rsltprior['omset_maks']) $priority = 1; else $priority = 0;

    if($jenis=="Potongan"){
    	$kat_item = mysqli_fetch_array(mysqli_query($con, "SELECT kategori FROM item_harga WHERE nama_item='$rtmp[item]'"))[0];

    	if($kat_item=='p1' OR $kat_item=='p3'){
			$katItem = "P1";
		}
		else if($kat_item=='p2'){
			$katItem = "P2";
		}
		else if($kat_item=='p4' OR $kat_item=='p5'){
			$katItem = "P3";
		}
	}
	else if($jenis=="Kiloan") $katItem = "K";

		$qact = mysqli_query($con, "INSERT INTO reception(new_nota, nama_outlet,nama_reception,tgl_input,nama_customer,no_nota,jenis,express,no_so,id_customer,total_bayar,cabang,ket,berat,priority,kategori_item) values ('$xtmp[new_nota]', '$ot', '$us', '$jam1', '$nama_customer', '$xtmp[no_nota]', '$charjenis', '$xtmp[charge]', '$xtmp[no_so]', '$idcs', '0', '$xtmp[cabang]', '$xtmp[ket]', '$xtmp[berat]','$priority','$katItem')");

}

echo $idcs.' '.$jenis.' '.$kodevoucher;

?>
