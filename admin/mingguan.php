<?php
include '../config.php';
date_default_timezone_set('Asia/Makassar');
$date = date('Y-m-d');

$strmg = strtotime($date);
$strmg = date('Y-m-d', $strmg);
$thn = date('Y', strtotime($strmg));
$bln =date('m', strtotime($strmg));
$tgl = date('d', strtotime($strmg));
if(idate('W', mktime(0, 0, 0, $bln, $tgl, $thn)) < 10){
	$thnmg = $thn.'0'.idate('W', mktime(0, 0, 0, $bln, $tgl, $thn));
}else{
 	$thnmg = $thn.idate('W', mktime(0, 0, 0, $bln, $tgl, $thn));
}

$strmg2 = strtotime('-1 week', strtotime($date));
$strmg2 = date('Y-m-d', $strmg2);
$thn2 = date('Y', strtotime($strmg2));
$bln2 =date('m', strtotime($strmg2));
$tgl2 = date('d', strtotime($strmg2));
if(idate('W', mktime(0, 0, 0, $bln2, $tgl2, $thn2)) < 10){
	$thnmg2 = $thn2.'0'.idate('W', mktime(0, 0, 0, $bln2, $tgl2, $thn2));
}else{
 	$thnmg2= $thn2.idate('W', mktime(0, 0, 0, $bln2, $tgl2, $thn2));
}

$strmg3 = strtotime('-2 week', strtotime($date));
$strmg3 = date('Y-m-d', $strmg3);
$thn3 = date('Y', strtotime($strmg3));
$bln3 =date('m', strtotime($strmg3));
$tgl3 = date('d', strtotime($strmg3));
if(idate('W', mktime(0, 0, 0, $bln3, $tgl3, $thn3)) < 10){
	$thnmg3 = $thn3.'0'.idate('W', mktime(0, 0, 0, $bln3, $tgl3, $thn3));
}else{
	$thnmg3 = $thn3.idate('W', mktime(0, 0, 0, $bln3, $tgl3, $thn3));
}

$strmg4 = strtotime('-3 week', strtotime($date));
$strmg4 = date('Y-m-d', $strmg4);
$thn4 = date('Y', strtotime($strmg4));
$bln4 =date('m', strtotime($strmg4));
$tgl4 = date('d', strtotime($strmg4));
if(idate('W', mktime(0, 0, 0, $bln4, $tgl4, $thn4)) < 10){
	$thnmg4 = $thn4.'0'.idate('W', mktime(0, 0, 0, $bln4, $tgl4, $thn4));
}else{
	$thnmg4 = $thn4.idate('W', mktime(0, 0, 0, $bln4, $tgl4, $thn4));
}

$strmg5 = strtotime('-4 week', strtotime($date));
$strmg5 = date('Y-m-d', $strmg5);
$thn5 = date('Y', strtotime($strmg5));
$bln5 =date('m', strtotime($strmg5));
$tgl5 = date('d', strtotime($strmg5));
if(idate('W', mktime(0, 0, 0, $bln5, $tgl5, $thn5)) < 10){
	$thnmg5 = $thn5.'0'.idate('W', mktime(0, 0, 0, $bln5, $tgl5, $thn5));
}else{
 	$thnmg5 = $thn5.idate('W', mktime(0, 0, 0, $bln5, $tgl5, $thn5));
}

//Toddopuli

$qtdp = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = YEARWEEK(NOW())) and nama_outlet='Toddopuli' and cara_bayar <> 'kuota'  ");
$tdp = $qtdp->fetch_assoc();
$tdl = $tdp['omset'];
$mg = $tdp['thnminggu'];

$qtdp2 = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = '$thnmg2') and nama_outlet='Toddopuli' and cara_bayar <> 'kuota' ");
$tdp2 = $qtdp2->fetch_assoc();
$tdl2 = $tdp2['omset'];
$mg2 = $tdp2['thnminggu'];

$qtdp3 = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = '$thnmg3') and nama_outlet='Toddopuli' and cara_bayar <> 'kuota'  ");
$tdp3 = $qtdp3->fetch_assoc();
$tdl3 = $tdp3['omset'];
$mg3 = $tdp3['thnminggu'];

$qtdp4 = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = '$thnmg4') and nama_outlet='Toddopuli' and cara_bayar <> 'kuota'  ");
$tdp4 = $qtdp4->fetch_assoc();
$tdl4 = $tdp4['omset'];
$mg4 = $tdp4['thnminggu'];

$qtdp5 = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = '$thnmg5') and nama_outlet='Toddopuli' and cara_bayar <> 'kuota' ");
$tdp5 = $qtdp5->fetch_assoc();
$tdl5 = $tdp5['omset'];
$mg5 = $tdp5['thnminggu'];

//Landak

$qldk = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = YEARWEEK(NOW())) and nama_outlet='Landak' and cara_bayar <> 'kuota'  ");
$ldk = $qldk->fetch_assoc();
$ld = $ldk['omset'];
$mgld = $ldk['thnminggu'];

$qldk2 = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = '$thnmg2') and nama_outlet='Landak' and cara_bayar <> 'kuota'  ");
$ldk2 = $qldk2->fetch_assoc();
$ld2 = $ldk2['omset'];
$mgld2 = $ldk2['thnminggu'];

$qldk3 = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = '$thnmg3') and nama_outlet='Landak' and cara_bayar <> 'kuota'  ");
$ldk3 = $qldk3->fetch_assoc();
$ld3 = $ldk3['omset'];
$mgld3 = $ldk3['thnminggu'];

$qldk4 = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = '$thnmg4') and nama_outlet='Landak' and cara_bayar <> 'kuota'   ");
$ldk4 = $qldk4->fetch_assoc();
$ld4 = $ldk4['omset'];
$mgld4 = $ldk4['thnminggu'];

$qldk5 = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = '$thnmg5') and nama_outlet='Landak' and cara_bayar <> 'kuota'  ");
$ldk5 = $qldk5->fetch_assoc();
$ld5 = $ldk5['omset'];
$mgld5 = $ldk5['thnminggu'];

//Baruga

$qbbg = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = YEARWEEK(NOW())) and nama_outlet='Baruga' and cara_bayar <> 'kuota'  ");
$bbg = $qbbg->fetch_assoc();
$bg = $bbg['omset'];
$mgbg = $bbg['thnminggu'];

$qbbg2 = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = '$thnmg2') and nama_outlet='Baruga' and cara_bayar <> 'kuota'  ");
$bbg2 = $qbbg2->fetch_assoc();
$bg2 = $bbg2['omset'];
$mgbg2 = $bbg2['thnminggu'];

$qbbg3 = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = '$thnmg3') and nama_outlet='Baruga' and cara_bayar <> 'kuota'  ");
$bbg3 = $qbbg3->fetch_assoc();
$bg3 = $bbg3['omset'];
$mgbg3 = $bbg3['thnminggu'];

$qbbg4 = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = '$thnmg4') and nama_outlet='Baruga' and cara_bayar <> 'kuota'  ");
$bbg4 = $qbbg4->fetch_assoc();
$bg4 = $bbg4['omset'];
$mgbg4 = $bbg4['thnminggu'];

$qbbg5 = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = '$thnmg5') and nama_outlet='Baruga' and cara_bayar <> 'kuota'  ");
$bbg5 = $qbbg5->fetch_assoc();
$bg5 = $bbg5['omset'];
$mgbg5 = $bbg5['thnminggu'];


//Boulevard

$qblv = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = YEARWEEK(NOW())) and nama_outlet='Boulevard' and cara_bayar <> 'kuota'  ");
$blv = $qblv->fetch_assoc();
$bv = $blv['omset'];
$mgbv = $blv['thnminggu'];

$qblv2 = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = '$thnmg2') and nama_outlet='Boulevard' and cara_bayar <> 'kuota'  ");
$blv2 = $qblv2->fetch_assoc();
$bv2 = $blv2['omset'];
$mgbv2 = $blv2['thnminggu'];

$qblv3 = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = '$thnmg3') and nama_outlet='Boulevard' and cara_bayar <> 'kuota'  ");
$blv3 = $qblv3->fetch_assoc();
$bv3 = $blv3['omset'];
$mgbv3 = $blv3['thnminggu'];

$qblv4 = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = '$thnmg4') and nama_outlet='Boulevard' and cara_bayar <> 'kuota'  ");
$blv4 = $qblv4->fetch_assoc();
$bv4 = $blv4['omset'];
$mgbv4 = $blv4['thnminggu'];

$qblv5 = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = '$thnmg5') and nama_outlet='Boulevard' and cara_bayar <> 'kuota'  ");
$blv5 = $qblv5->fetch_assoc();
$bv5 = $blv5['omset'];
$mgbv5 = $blv5['thnminggu'];


//Graha Pena

$qgpn = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = YEARWEEK(NOW())) and nama_outlet='Graha Pena' and cara_bayar <> 'kuota'  ");
$gpn = $qgpn->fetch_assoc();
$gp = $gpn['omset'];
$mggp = $gpn['thnminggu'];

$qgpn2 = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = '$thnmg2') and nama_outlet='Graha Pena' and cara_bayar <> 'kuota'  ");
$gpn2 = $qgpn2->fetch_assoc();
$gp2 = $gpn2['omset'];
$mggp2 = $gpn2['thnminggu'];

$qgpn3 = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = '$thnmg3') and nama_outlet='Graha Pena' and cara_bayar <> 'kuota'  ");
$gpn3 = $qgpn3->fetch_assoc();
$gp3 = $gpn3['omset'];
$mggp3 = $gpn3['thnminggu'];

$qgpn4 = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = '$thnmg4') and nama_outlet='Graha Pena' and cara_bayar <> 'kuota'  ");
$gpn4 = $qgpn4->fetch_assoc();
$gp4 = $gpn4['omset'];
$mggp4 = $gpn4['thnminggu'];

$qgpn5 = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = '$thnmg5') and nama_outlet='Graha Pena' and cara_bayar <> 'kuota'  ");
$gpn5= $qgpn5->fetch_assoc();
$gp5= $gpn5['omset'];
$mggp5 = $gpn5['thnminggu'];

//TSM

$qtsm = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = YEARWEEK(NOW())) and nama_outlet='Trans Studio Mall' and cara_bayar <> 'kuota'  ");
$tsm = $qtsm->fetch_assoc();
$ts = $tsm['omset'];
$mgts = $tsm['thnminggu'];

$qtsm2 = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = '$thnmg2') and nama_outlet='Trans Studio Mall' and cara_bayar <> 'kuota'  ");
$tsm2 = $qtsm2->fetch_assoc();
$ts2 = $tsm2['omset'];
$mgts2 = $tsm2['thnminggu'];

$qtsm3 = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = '$thnmg3') and nama_outlet='Trans Studio Mall' and cara_bayar <> 'kuota'  ");
$tsm3 = $qtsm3->fetch_assoc();
$ts3 = $tsm3['omset'];
$mgts3 = $tsm3['thnminggu'];

$qtsm4 = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = '$thnmg4') and nama_outlet='Trans Studio Mall' and cara_bayar <> 'kuota'  ");
$tsm4 = $qtsm4->fetch_assoc();
$ts4 = $tsm4['omset'];
$mgts4 = $tsm4['thnminggu'];

$qtsm5 = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = '$thnmg5') and nama_outlet='Trans Studio Mall' and cara_bayar <> 'kuota'  ");
$tsm5 = $qtsm5->fetch_assoc();
$ts5 = $tsm5['omset'];
$mgts5 = $tsm5['thnminggu'];

//BTP

$qbtp = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = YEARWEEK(NOW())) and nama_outlet='BTP' and cara_bayar <> 'kuota'  ");
$btp = $qbtp->fetch_assoc();
$bp = $btp['omset'];
$mgbp = $btp['thnminggu'];

$qbtp2 = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = '$thnmg2') and nama_outlet='BTP' and cara_bayar <> 'kuota'  ");
$btp2 = $qbtp2->fetch_assoc();
$bp2 = $btp2['omset'];
$mgbp2 = $btp2['thnminggu'];

$qbtp3 = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = '$thnmg3') and nama_outlet='BTP' and cara_bayar <> 'kuota'  ");
$btp3 = $qbtp3->fetch_assoc();
$bp3 = $btp3['omset'];
$mgbp3 = $btp3['thnminggu'];

$qbtp4 = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = '$thnmg4') and nama_outlet='BTP' and cara_bayar <> 'kuota'  ");
$btp4 = $qbtp4->fetch_assoc();
$bp4 = $btp4['omset'];
$mgbp4 = $btp4['thnminggu'];

$qbtp5 = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = '$thnmg5') and nama_outlet='BTP' and cara_bayar <> 'kuota'  ");
$btp5 = $qbtp5->fetch_assoc();
$bp5 = $btp5['omset'];
$mgbp5 = $btp5['thnminggu'];

//DAYA

$qdya = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = YEARWEEK(NOW())) and nama_outlet='DAYA' and cara_bayar <> 'kuota'  ");
$dya = $qdya->fetch_assoc();
$dy = $dya['omset'];
$mgdy = $dya['thnminggu'];

$qdya2 = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = '$thnmg2') and nama_outlet='DAYA' and cara_bayar <> 'kuota'  ");
$dya2 = $qdya2->fetch_assoc();
$dy2 = $dya2['omset'];
$mgdy2 = $dya2['thnminggu'];

$qdya3 = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = '$thnmg3') and nama_outlet='DAYA' and cara_bayar <> 'kuota'  ");
$dya3 = $qdya3->fetch_assoc();
$dy3 = $dya3['omset'];
$mgdy3 = $dya3['thnminggu'];

$qdya4 = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = '$thnmg4') and nama_outlet='DAYA' and cara_bayar <> 'kuota'  ");
$dya4 = $qdya4->fetch_assoc();
$dy4 = $dya4['omset'];
$mgdy4 = $dya4['thnminggu'];

$qdya5 = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = '$thnmg5') and nama_outlet='DAYA' and cara_bayar <> 'kuota'  ");
$dya5 = $qdya5->fetch_assoc();
$dy5 = $dya5['omset'];
$mgdy5 = $dya5['thnminggu'];

//Support

$qspt = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = YEARWEEK(NOW())) and nama_outlet='support' and cara_bayar <> 'kuota'  ");
$spt = $qspt->fetch_assoc();
$sp = $spt['omset'];
$mgsp = $spt['thnminggu'];

$qspt2 = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = '$thnmg2') and nama_outlet='support' and cara_bayar <> 'kuota'  ");
$spt2 = $qspt2->fetch_assoc();
$sp2 = $spt2['omset'];
$mgsp2 = $spt2['thnminggu'];

$qspt3 = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = '$thnmg3') and nama_outlet='support' and cara_bayar <> 'kuota'  ");
$spt3 = $qspt3->fetch_assoc();
$sp3 = $spt3['omset'];
$mgsp3 = $spt3['thnminggu'];

$qspt4 = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = '$thnmg4') and nama_outlet='support' and cara_bayar <> 'kuota'  ");
$spt4 = $qspt4->fetch_assoc();
$sp4 = $spt4['omset'];
$mgsp4 = $spt4['thnminggu'];

$qspt5 = $con->query("select YEARWEEK(tgl_transaksi) as thnminggu, sum(total) as omset from faktur_penjualan where (YEARWEEK(tgl_transaksi) = '$thnmg5') and nama_outlet='support' and cara_bayar <> 'kuota'  ");
$spt5 = $qspt5->fetch_assoc();
$sp5 = $spt5['omset'];
$mgsp5 = $spt5['thnminggu'];

//All
$all = $tdl+$ld+$bg+$bv+$gp+$ts+$bp+$dy+$sp;
$all2 = $tdl2+$ld2+$bg2+$bv2+$gp2+$ts2+$bp2+$dy2+$sp2;
$all3 = $tdl3+$ld3+$bg3+$bv3+$gp3+$ts3+$bp3+$dy3+$sp3;
$all4 = $tdl4+$ld4+$bg4+$bv4+$gp4+$ts4+$bp4+$dy4+$sp4;
$all5 = $tdl5+$ld5+$bg5+$bv5+$gp5+$ts5+$bp5+$dy5+$sp5;
?>
