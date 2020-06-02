<?php 


// function reception_order($tgl,$outlet,$reception){
// 	global $con;
// 	$query = mysqli_query($con, "SELECT nama_reception FROM reception WHERE tgl_lunas LIKE '%$tgl%' AND rcp_lunas='$reception' AND nama_outlet='$outlet' AND cara_bayar<>'Void'");
// 	$row = mysqli_fetch_row($query);
// 	return $row[0];
// }

// function tanggal_order($tgl,$outlet,$reception){
// 	global $con;
// 	$query = mysqli_query($con, "SELECT DATE_FORMAT(tgl_input, '%Y-%m-%d') AS tanggal FROM reception WHERE tgl_lunas LIKE '%$tgl%' AND rcp_lunas='$reception' AND nama_outlet='$outlet' AND cara_bayar<>'Void'");
// 	$row = mysqli_fetch_row($query);
// 	return $row[0];
// }

// function reception_order2($tgl,$outlet,$reception){
// 	global $con;
// 	$query = mysqli_query($con, "SELECT rcp_lunas FROM reception WHERE tgl_lunas LIKE '%$tgl%' AND rcp_lunas='$reception' AND nama_outlet='$outlet' AND cara_bayar<>'Void'");
// 	$row = mysqli_fetch_row($query);
// 	return $row[0];
// }

// function tanggal_order2($tgl,$outlet,$reception){
// 	global $con;
// 	$query = mysqli_query($con, "SELECT DATE_FORMAT(tgl_lunas, '%Y-%m-%d') AS tanggal_lunas FROM reception WHERE tgl_lunas LIKE '%$tgl%' AND rcp_lunas='$reception' AND nama_outlet='$outlet' AND cara_bayar<>'Void'");
// 	$row = mysqli_fetch_row($query);
// 	return $row[0];
// }

function order_kiloan($tgl,$outlet,$reception){
	global $con;
	$query = mysqli_query($con, "SELECT COALESCE(SUM(total_bayar),0) AS total FROM reception WHERE tgl_input LIKE '%$tgl%' AND nama_outlet='$outlet' AND nama_reception='$reception' AND jenis='k' AND cara_bayar<>'Void'");
	$row = mysqli_fetch_row($query);
	return $row[0];
}

function order_potongan($tgl,$outlet,$reception){
	global $con;
	$query = mysqli_query($con, "SELECT COALESCE(SUM(total_bayar),0) AS total FROM reception WHERE tgl_input LIKE '%$tgl%' AND nama_outlet='$outlet' AND nama_reception='$reception' AND jenis='p' AND cara_bayar<>'Void'");
	$row = mysqli_fetch_row($query);
	return $row[0];
}

function order_lunas_now($tgl,$outlet,$reception,$rcp_lunas,$tgl_lunas){
	global $con;
	$query = mysqli_query($con, "SELECT COALESCE(SUM(total_bayar),0) AS total FROM reception WHERE tgl_input LIKE '%$tgl%' AND tgl_lunas LIKE '%$tgl_lunas%' AND nama_outlet='$outlet' AND nama_reception='$reception' AND rcp_lunas='$rcp_lunas' AND lunas=true AND cara_bayar<>'Void'");
	$row = mysqli_fetch_row($query);
	return $row[0];	
}

// function order_lunas_later($tgl,$outlet,$reception){
// 	global $con;
// 	$query = mysqli_query($con, "SELECT COALESCE(SUM(total_bayar),0) AS total FROM reception WHERE tgl_input LIKE '%$tgl%' AND tgl_lunas LIKE '%$tgl%' AND nama_outlet='$outlet' AND nama_reception<>'$reception' AND rcp_lunas='$reception' AND lunas=true AND cara_bayar<>'Void'");
// 	$row = mysqli_fetch_row($query);
// 	return $row[0];
// }

// function order_lunas_later2($tgl,$outlet,$reception){
// 	global $con;
// 	$query = mysqli_query($con, "SELECT COALESCE(SUM(total_bayar),0) AS total FROM reception WHERE tgl_input NOT LIKE '%$tgl%' AND tgl_lunas LIKE '%$tgl%' AND nama_outlet='$outlet' AND nama_reception='$reception' AND rcp_lunas='$reception' AND lunas=true AND cara_bayar<>'Void'");
// 	$row = mysqli_fetch_row($query);
// 	return $row[0];
// }

// function order_lunas_later3($tgl,$outlet,$reception){
// 	global $con;
// 	$query = mysqli_query($con, "SELECT COALESCE(SUM(total_bayar),0) AS total FROM reception WHERE tgl_input NOT LIKE '%$tgl%' AND tgl_lunas LIKE '%$tgl%' AND nama_outlet='$outlet' AND nama_reception<>'$reception' AND rcp_lunas='$reception' AND lunas=true AND cara_bayar<>'Void'");
// 	$row = mysqli_fetch_row($query);
// 	return $row[0];
// }

function pendapatan_member($tgl,$outlet,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(total),0) AS total FROM faktur_penjualan WHERE jenis_transaksi='membership' AND nama_outlet='$outlet' AND rcp='$reception' AND tgl_transaksi LIKE '%$tgl%'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function pendapatan_deposit($tgl,$outlet,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(total),0) AS total FROM faktur_penjualan WHERE jenis_transaksi='deposit' AND nama_outlet='$outlet' AND rcp='$reception' AND tgl_transaksi LIKE '%$tgl%'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function cash_order($tgl,$outlet,$reception,$rcp_lunas,$tgl_lunas){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(a.jumlah),0) AS total FROM cara_bayar AS a INNER JOIN (SELECT DISTINCT no_faktur AS no_faktur FROM reception WHERE tgl_input LIKE '%$tgl%' AND tgl_lunas LIKE '%$tgl_lunas%' AND nama_outlet='$outlet' AND nama_reception='$reception' AND rcp_lunas='$rcp_lunas' AND lunas=true AND cara_bayar<>'Void') AS b ON a.no_faktur=b.no_faktur WHERE a.cara_bayar='cash'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function bri_order($tgl,$outlet,$reception,$rcp_lunas,$tgl_lunas){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(a.jumlah),0) AS total FROM cara_bayar AS a INNER JOIN (SELECT DISTINCT no_faktur AS no_faktur FROM reception WHERE tgl_input LIKE '%$tgl%' AND tgl_lunas LIKE '%$tgl_lunas%' AND nama_outlet='$outlet' AND nama_reception='$reception' AND rcp_lunas='$rcp_lunas' AND lunas=true AND cara_bayar<>'Void') AS b ON a.no_faktur=b.no_faktur WHERE a.cara_bayar='BRI'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function bni_order($tgl,$outlet,$reception,$rcp_lunas,$tgl_lunas){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(a.jumlah),0) AS total FROM cara_bayar AS a INNER JOIN (SELECT DISTINCT no_faktur AS no_faktur FROM reception WHERE tgl_input LIKE '%$tgl%' AND tgl_lunas LIKE '%$tgl_lunas%' AND nama_outlet='$outlet' AND nama_reception='$reception' AND rcp_lunas='$rcp_lunas' AND lunas=true AND cara_bayar<>'Void') AS b ON a.no_faktur=b.no_faktur WHERE a.cara_bayar='BNI'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function mandiri_order($tgl,$outlet,$reception,$rcp_lunas,$tgl_lunas){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(a.jumlah),0) AS total FROM cara_bayar AS a INNER JOIN (SELECT DISTINCT no_faktur AS no_faktur FROM reception WHERE tgl_input LIKE '%$tgl%' AND tgl_lunas LIKE '%$tgl_lunas%' AND nama_outlet='$outlet' AND nama_reception='$reception' AND rcp_lunas='$rcp_lunas' AND lunas=true AND cara_bayar<>'Void') AS b ON a.no_faktur=b.no_faktur WHERE (a.cara_bayar='MANDIRI' OR a.cara_bayar='Mandiri')");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function bca_order($tgl,$outlet,$reception,$rcp_lunas,$tgl_lunas){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(a.jumlah),0) AS total FROM cara_bayar AS a INNER JOIN (SELECT DISTINCT no_faktur AS no_faktur FROM reception WHERE tgl_input LIKE '%$tgl%' AND tgl_lunas LIKE '%$tgl_lunas%' AND nama_outlet='$outlet' AND nama_reception='$reception' AND rcp_lunas='$rcp_lunas' AND lunas=true AND cara_bayar<>'Void') AS b ON a.no_faktur=b.no_faktur WHERE a.cara_bayar='BCA'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function cashback_order($tgl,$outlet,$reception,$rcp_lunas,$tgl_lunas){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(a.jumlah),0) AS total FROM cara_bayar AS a INNER JOIN (SELECT DISTINCT no_faktur AS no_faktur FROM reception WHERE tgl_input LIKE '%$tgl%' AND tgl_lunas LIKE '%$tgl_lunas%' AND nama_outlet='$outlet' AND nama_reception='$reception' AND rcp_lunas='$rcp_lunas' AND lunas=true AND cara_bayar<>'Void') AS b ON a.no_faktur=b.no_faktur WHERE a.cara_bayar='Cashback'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

// function cash_order2($tgl,$outlet,$reception){
// 	global $con;
// 	$sql = mysqli_query($con, "SELECT COALESCE(SUM(a.jumlah),0) AS total FROM cara_bayar AS a INNER JOIN (SELECT DISTINCT no_faktur AS no_faktur FROM reception WHERE tgl_input LIKE '%$tgl%' AND tgl_lunas LIKE '%$tgl%' AND nama_outlet='$outlet' AND nama_reception<>'$reception' AND rcp_lunas='$reception') AS b ON a.no_faktur=b.no_faktur WHERE a.cara_bayar='cash'");
// 	$row = mysqli_fetch_row($sql);
// 	return $row[0];
// }

// function bri_order2($tgl,$outlet,$reception){
// 	global $con;
// 	$sql = mysqli_query($con, "SELECT COALESCE(SUM(a.jumlah),0) AS total FROM cara_bayar AS a INNER JOIN (SELECT DISTINCT no_faktur AS no_faktur FROM reception WHERE tgl_input LIKE '%$tgl%' AND tgl_lunas LIKE '%$tgl%' AND nama_outlet='$outlet' AND nama_reception<>'$reception' AND rcp_lunas='$reception') AS b ON a.no_faktur=b.no_faktur WHERE a.cara_bayar='BRI'");
// 	$row = mysqli_fetch_row($sql);
// 	return $row[0];
// }

// function bni_order2($tgl,$outlet,$reception){
// 	global $con;
// 	$sql = mysqli_query($con, "SELECT COALESCE(SUM(a.jumlah),0) AS total FROM cara_bayar AS a INNER JOIN (SELECT DISTINCT no_faktur AS no_faktur FROM reception WHERE tgl_input LIKE '%$tgl%' AND tgl_lunas LIKE '%$tgl%' AND nama_outlet='$outlet' AND nama_reception<>'$reception' AND rcp_lunas='$reception') AS b ON a.no_faktur=b.no_faktur WHERE a.cara_bayar='BNI'");
// 	$row = mysqli_fetch_row($sql);
// 	return $row[0];
// }

// function mandiri_order2($tgl,$outlet,$reception){
// 	global $con;
// 	$sql = mysqli_query($con, "SELECT COALESCE(SUM(a.jumlah),0) AS total FROM cara_bayar AS a INNER JOIN (SELECT DISTINCT no_faktur AS no_faktur FROM reception WHERE tgl_input LIKE '%$tgl%' AND tgl_lunas LIKE '%$tgl%' AND nama_outlet='$outlet' AND nama_reception<>'$reception' AND rcp_lunas='$reception') AS b ON a.no_faktur=b.no_faktur WHERE (a.cara_bayar='MANDIRI' OR a.cara_bayar='Mandiri')");
// 	$row = mysqli_fetch_row($sql);
// 	return $row[0];
// }

// function bca_order2($tgl,$outlet,$reception){
// 	global $con;
// 	$sql = mysqli_query($con, "SELECT COALESCE(SUM(a.jumlah),0) AS total FROM cara_bayar AS a INNER JOIN (SELECT DISTINCT no_faktur AS no_faktur FROM reception WHERE tgl_input LIKE '%$tgl%' AND tgl_lunas LIKE '%$tgl%' AND nama_outlet='$outlet' AND nama_reception<>'$reception' AND rcp_lunas='$reception') AS b ON a.no_faktur=b.no_faktur WHERE a.cara_bayar='BCA'");
// 	$row = mysqli_fetch_row($sql);
// 	return $row[0];
// }

// function cashback_order2($tgl,$outlet,$reception){
// 	global $con;
// 	$sql = mysqli_query($con, "SELECT COALESCE(SUM(a.jumlah),0) AS total FROM cara_bayar AS a INNER JOIN (SELECT DISTINCT no_faktur AS no_faktur FROM reception WHERE tgl_input LIKE '%$tgl%' AND tgl_lunas LIKE '%$tgl%' AND nama_outlet='$outlet' AND nama_reception<>'$reception' AND rcp_lunas='$reception') AS b ON a.no_faktur=b.no_faktur WHERE a.cara_bayar='Cashback'");
// 	$row = mysqli_fetch_row($sql);
// 	return $row[0];
// }

// function cash_order3($tgl,$outlet,$reception){
// 	global $con;
// 	$sql = mysqli_query($con, "SELECT COALESCE(SUM(a.jumlah),0) AS total FROM cara_bayar AS a INNER JOIN (SELECT DISTINCT no_faktur AS no_faktur FROM reception WHERE tgl_input NOT LIKE '%$tgl%' AND tgl_lunas LIKE '%$tgl%' AND nama_outlet='$outlet' AND nama_reception='$reception' AND rcp_lunas='$reception') AS b ON a.no_faktur=b.no_faktur WHERE a.cara_bayar='cash'");
// 	$row = mysqli_fetch_row($sql);
// 	return $row[0];
// }

// function bri_order3($tgl,$outlet,$reception){
// 	global $con;
// 	$sql = mysqli_query($con, "SELECT COALESCE(SUM(a.jumlah),0) AS total FROM cara_bayar AS a INNER JOIN (SELECT DISTINCT no_faktur AS no_faktur FROM reception WHERE tgl_input NOT LIKE '%$tgl%' AND tgl_lunas LIKE '%$tgl%' AND nama_outlet='$outlet' AND nama_reception='$reception' AND rcp_lunas='$reception') AS b ON a.no_faktur=b.no_faktur WHERE a.cara_bayar='BRI'");
// 	$row = mysqli_fetch_row($sql);
// 	return $row[0];
// }

// function bni_order3($tgl,$outlet,$reception){
// 	global $con;
// 	$sql = mysqli_query($con, "SELECT COALESCE(SUM(a.jumlah),0) AS total FROM cara_bayar AS a INNER JOIN (SELECT DISTINCT no_faktur AS no_faktur FROM reception WHERE tgl_input NOT LIKE '%$tgl%' AND tgl_lunas LIKE '%$tgl%' AND nama_outlet='$outlet' AND nama_reception='$reception' AND rcp_lunas='$reception') AS b ON a.no_faktur=b.no_faktur WHERE a.cara_bayar='BNI'");
// 	$row = mysqli_fetch_row($sql);
// 	return $row[0];
// }

// function mandiri_order3($tgl,$outlet,$reception){
// 	global $con;
// 	$sql = mysqli_query($con, "SELECT COALESCE(SUM(a.jumlah),0) AS total FROM cara_bayar AS a INNER JOIN (SELECT DISTINCT no_faktur AS no_faktur FROM reception WHERE tgl_input NOT LIKE '%$tgl%' AND tgl_lunas LIKE '%$tgl%' AND nama_outlet='$outlet' AND nama_reception='$reception' AND rcp_lunas='$reception') AS b ON a.no_faktur=b.no_faktur WHERE (a.cara_bayar='MANDIRI' OR a.cara_bayar='Mandiri')");
// 	$row = mysqli_fetch_row($sql);
// 	return $row[0];
// }

// function bca_order3($tgl,$outlet,$reception){
// 	global $con;
// 	$sql = mysqli_query($con, "SELECT COALESCE(SUM(a.jumlah),0) AS total FROM cara_bayar AS a INNER JOIN (SELECT DISTINCT no_faktur AS no_faktur FROM reception WHERE tgl_input NOT LIKE '%$tgl%' AND tgl_lunas LIKE '%$tgl%' AND nama_outlet='$outlet' AND nama_reception='$reception' AND rcp_lunas='$reception') AS b ON a.no_faktur=b.no_faktur WHERE a.cara_bayar='BCA'");
// 	$row = mysqli_fetch_row($sql);
// 	return $row[0];
// }

// function cashback_order3($tgl,$outlet,$reception){
// 	global $con;
// 	$sql = mysqli_query($con, "SELECT COALESCE(SUM(a.jumlah),0) AS total FROM cara_bayar AS a INNER JOIN (SELECT DISTINCT no_faktur AS no_faktur FROM reception WHERE tgl_input NOT LIKE '%$tgl%' AND tgl_lunas LIKE '%$tgl%' AND nama_outlet='$outlet' AND nama_reception='$reception' AND rcp_lunas='$reception') AS b ON a.no_faktur=b.no_faktur WHERE a.cara_bayar='Cashback'");
// 	$row = mysqli_fetch_row($sql);
// 	return $row[0];
// }

// function cash_order4($tgl,$outlet,$reception){
// 	global $con;
// 	$sql = mysqli_query($con, "SELECT COALESCE(SUM(a.jumlah),0) AS total FROM cara_bayar AS a INNER JOIN (SELECT DISTINCT no_faktur AS no_faktur FROM reception WHERE tgl_input NOT LIKE '%$tgl%' AND tgl_lunas LIKE '%$tgl%' AND nama_outlet='$outlet' AND nama_reception<>'$reception' AND rcp_lunas='$reception') AS b ON a.no_faktur=b.no_faktur WHERE a.cara_bayar='cash'");
// 	$row = mysqli_fetch_row($sql);
// 	return $row[0];
// }

// function bri_order4($tgl,$outlet,$reception){
// 	global $con;
// 	$sql = mysqli_query($con, "SELECT COALESCE(SUM(a.jumlah),0) AS total FROM cara_bayar AS a INNER JOIN (SELECT DISTINCT no_faktur AS no_faktur FROM reception WHERE tgl_input NOT LIKE '%$tgl%' AND tgl_lunas LIKE '%$tgl%' AND nama_outlet='$outlet' AND nama_reception<>'$reception' AND rcp_lunas='$reception') AS b ON a.no_faktur=b.no_faktur WHERE a.cara_bayar='BRI'");
// 	$row = mysqli_fetch_row($sql);
// 	return $row[0];
// }

// function bni_order4($tgl,$outlet,$reception){
// 	global $con;
// 	$sql = mysqli_query($con, "SELECT COALESCE(SUM(a.jumlah),0) AS total FROM cara_bayar AS a INNER JOIN (SELECT DISTINCT no_faktur AS no_faktur FROM reception WHERE tgl_input NOT LIKE '%$tgl%' AND tgl_lunas LIKE '%$tgl%' AND nama_outlet='$outlet' AND nama_reception<>'$reception' AND rcp_lunas='$reception') AS b ON a.no_faktur=b.no_faktur WHERE a.cara_bayar='BNI'");
// 	$row = mysqli_fetch_row($sql);
// 	return $row[0];
// }

// function mandiri_order4($tgl,$outlet,$reception){
// 	global $con;
// 	$sql = mysqli_query($con, "SELECT COALESCE(SUM(a.jumlah),0) AS total FROM cara_bayar AS a INNER JOIN (SELECT DISTINCT no_faktur AS no_faktur FROM reception WHERE tgl_input NOT LIKE '%$tgl%' AND tgl_lunas LIKE '%$tgl%' AND nama_outlet='$outlet' AND nama_reception<>'$reception' AND rcp_lunas='$reception') AS b ON a.no_faktur=b.no_faktur WHERE (a.cara_bayar='MANDIRI' OR a.cara_bayar='Mandiri')");
// 	$row = mysqli_fetch_row($sql);
// 	return $row[0];
// }

// function bca_order4($tgl,$outlet,$reception){
// 	global $con;
// 	$sql = mysqli_query($con, "SELECT COALESCE(SUM(a.jumlah),0) AS total FROM cara_bayar AS a INNER JOIN (SELECT DISTINCT no_faktur AS no_faktur FROM reception WHERE tgl_input NOT LIKE '%$tgl%' AND tgl_lunas LIKE '%$tgl%' AND nama_outlet='$outlet' AND nama_reception<>'$reception' AND rcp_lunas='$reception') AS b ON a.no_faktur=b.no_faktur WHERE a.cara_bayar='BCA'");
// 	$row = mysqli_fetch_row($sql);
// 	return $row[0];
// }

// function cashback_order4($tgl,$outlet,$reception){
// 	global $con;
// 	$sql = mysqli_query($con, "SELECT COALESCE(SUM(a.jumlah),0) AS total FROM cara_bayar AS a INNER JOIN (SELECT DISTINCT no_faktur AS no_faktur FROM reception WHERE tgl_input NOT LIKE '%$tgl%' AND tgl_lunas LIKE '%$tgl%' AND nama_outlet='$outlet' AND nama_reception<>'$reception' AND rcp_lunas='$reception') AS b ON a.no_faktur=b.no_faktur WHERE a.cara_bayar='Cashback'");
// 	$row = mysqli_fetch_row($sql);
// 	return $row[0];
// }

function cash_langganan($tgl_lunas,$outlet,$rcp_lunas){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(total),0) AS jumlah FROM faktur_penjualan WHERE cara_bayar='cash' AND tgl_transaksi LIKE '%$tgl_lunas%' AND (jenis_transaksi='deposit' OR jenis_transaksi='membership') AND nama_outlet='$outlet' AND rcp='$rcp_lunas'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function bri_langganan($tgl_lunas,$outlet,$rcp_lunas){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(total),0) AS jumlah FROM faktur_penjualan WHERE (cara_bayar='edcbri' OR cara_bayar='BRI') AND tgl_transaksi LIKE '%$tgl_lunas%' AND (jenis_transaksi='deposit' OR jenis_transaksi='membership') AND nama_outlet='$outlet' AND rcp='$rcp_lunas'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function bni_langganan($tgl_lunas,$outlet,$rcp_lunas){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(total),0) AS jumlah FROM faktur_penjualan WHERE (cara_bayar='edcbni' OR cara_bayar='BNI') AND tgl_transaksi LIKE '%$tgl_lunas%' AND (jenis_transaksi='deposit' OR jenis_transaksi='membership') AND nama_outlet='$outlet' AND rcp='$rcp_lunas'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function mandiri_langganan($tgl_lunas,$outlet,$rcp_lunas){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(total),0) AS jumlah FROM faktur_penjualan WHERE (cara_bayar='edcmandiri' OR cara_bayar='Mandiri') AND tgl_transaksi LIKE '%$tgl_lunas%' AND (jenis_transaksi='deposit' OR jenis_transaksi='membership') AND nama_outlet='$outlet' AND rcp='$rcp_lunas'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function bca_langganan($tgl_lunas,$outlet,$rcp_lunas){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(total),0) AS jumlah FROM faktur_penjualan WHERE (cara_bayar='edcbca' OR cara_bayar='BCA') AND tgl_transaksi LIKE '%$tgl_lunas%' AND (jenis_transaksi='deposit' OR jenis_transaksi='membership') AND nama_outlet='$outlet' AND rcp='$rcp_lunas'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function setoran_bersih($tgl_lunas,$outlet,$rcp_lunas){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(setoran_bersih),0) AS total FROM tutup_kasir WHERE tanggal LIKE '%$tgl_lunas%' AND outlet='$outlet' AND reception='$rcp_lunas'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function edc_bri($tgl_lunas,$outlet,$rcp_lunas){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(edc_bri),0) AS total FROM tutup_kasir WHERE tanggal LIKE '%$tgl_lunas%' AND outlet='$outlet' AND reception='$rcp_lunas'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function edc_bni($tgl_lunas,$outlet,$rcp_lunas){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(edc_bni),0) AS total FROM tutup_kasir WHERE tanggal LIKE '%$tgl_lunas%' AND outlet='$outlet' AND reception='$rcp_lunas'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}
function edc_mandiri($tgl_lunas,$outlet,$rcp_lunas){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(edc_mandiri),0) AS total FROM tutup_kasir WHERE tanggal LIKE '%$tgl_lunas%' AND outlet='$outlet' AND reception='$rcp_lunas'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}
function edc_bca($tgl_lunas,$outlet,$rcp_lunas){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(edc_bca),0) AS total FROM tutup_kasir WHERE tanggal LIKE '%$tgl_lunas%' AND outlet='$outlet' AND reception='$rcp_lunas'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}


function verifikasi_lain($tgl,$rcp_lunas){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) AS total FROM setoran_bank_sebenarnya WHERE tanggal LIKE '%$tgl%' AND nama='$rcp_lunas' AND nama_bank='Lain-Lain'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function verifikasi_apotik($tgl,$rcp_lunas){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) AS total FROM setoran_bank_sebenarnya WHERE tanggal LIKE '%$tgl%' AND nama='$rcp_lunas' AND nama_bank='Apotik'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function verifikasi_bri($tgl,$rcp_lunas){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) AS total FROM setoran_bank_sebenarnya WHERE tanggal LIKE '%$tgl%' AND nama='$rcp_lunas' AND nama_bank='BRI'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function verifikasi_bni($tgl,$rcp_lunas){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) AS total FROM setoran_bank_sebenarnya WHERE tanggal LIKE '%$tgl%' AND nama='$rcp_lunas' AND nama_bank='BNI'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function verifikasi_bca($tgl,$rcp_lunas){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) AS total FROM setoran_bank_sebenarnya WHERE tanggal LIKE '%$tgl%' AND nama='$rcp_lunas' AND nama_bank='BCA'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function verifikasi_permata($tgl,$rcp_lunas){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) AS total FROM setoran_bank_sebenarnya WHERE tanggal LIKE '%$tgl%' AND nama='$rcp_lunas' AND nama_bank='Permata'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}



function laporan_pendapatan($tgl,$outlet,$reception,$rcp_lunas,$tgl_lunas){				

	$row['cash_order'] = cash_order($tgl,$outlet,$reception,$rcp_lunas,$tgl_lunas);
	$row['bri_order'] = bri_order($tgl,$outlet,$reception,$rcp_lunas,$tgl_lunas);
	$row['bni_order'] = bni_order($tgl,$outlet,$reception,$rcp_lunas,$tgl_lunas);
	$row['mandiri_order'] = mandiri_order($tgl,$outlet,$reception,$rcp_lunas,$tgl_lunas);
	$row['bca_order'] = bca_order($tgl,$outlet,$reception,$rcp_lunas,$tgl_lunas);
	$row['cashback_order'] = cashback_order($tgl,$outlet,$reception,$rcp_lunas,$tgl_lunas);

	if($reception==$rcp_lunas){
		$row['tanggal'] = $tgl;
		$row['order_kiloan'] = order_kiloan($tgl,$outlet,$reception);
		$row['order_potongan'] = order_potongan($tgl,$outlet,$reception);
		$row['total_order'] = $row['order_kiloan']+$row['order_potongan'];
		$row['order_lunas'] = order_lunas_now($tgl,$outlet,$reception,$rcp_lunas,$tgl_lunas);
		$row['order_pending'] = $row['total_order']-$row['order_lunas'];
		$row['pendapatan_member'] = pendapatan_member($tgl,$outlet,$reception);
		$row['pendapatan_deposit'] = pendapatan_deposit($tgl,$outlet,$reception);
		$row['cash_lgn'] = cash_langganan($tgl_lunas,$outlet,$rcp_lunas);
		$row['bri_lgn'] = bri_langganan($tgl_lunas,$outlet,$rcp_lunas);
		$row['bni_lgn'] = bni_langganan($tgl_lunas,$outlet,$rcp_lunas);
		$row['mandiri_lgn'] = mandiri_langganan($tgl_lunas,$outlet,$rcp_lunas);
		$row['bca_lgn'] = bca_langganan($tgl_lunas,$outlet,$rcp_lunas);
		$row['bayar_cash'] = $row['cash_order']+$row['cash_lgn'];
		$row['bayar_bri'] = $row['bri_order']+$row['bri_lgn'];
		$row['bayar_bni'] = $row['bni_order']+$row['bni_lgn'];
		$row['bayar_mandiri'] = $row['mandiri_order']+$row['mandiri_lgn'];
		$row['bayar_bca'] = $row['bca_order']+$row['bca_lgn'];
		$row['bayar_cashback'] = $row['cashback_order'];	
		$row['bayar_kuota'] = ($row['order_lunas']+$row['pendapatan_member']+$row['pendapatan_deposit'])-($row['bayar_cash']+$row['bayar_bri']+$row['bayar_bni']+$row['bayar_mandiri']+$row['bayar_bca']+$row['bayar_cashback']);
	} else{
		$row['tanggal'] = $tgl_lunas;
		$row['order_kiloan'] = (order_kiloan($tgl,$outlet,$reception))*0;
		$row['order_potongan'] = (order_potongan($tgl,$outlet,$reception))*0;
		$row['total_order'] = $row['order_kiloan']+$row['order_potongan'];
		$row['order_pending'] = (order_lunas_now($tgl,$outlet,$reception,$rcp_lunas,$tgl_lunas))*-1;
		$row['order_lunas'] = ($row['total_order']-$row['order_pending'])*0;
		$row['pendapatan_member'] = (pendapatan_member($tgl,$outlet,$reception))*0;
		$row['pendapatan_deposit'] = (pendapatan_deposit($tgl,$outlet,$reception))*0;
		$row['cash_lgn'] = (cash_langganan($tgl_lunas,$outlet,$rcp_lunas))*0;
		$row['bri_lgn'] = (bri_langganan($tgl_lunas,$outlet,$rcp_lunas))*0;
		$row['bni_lgn'] = (bni_langganan($tgl_lunas,$outlet,$rcp_lunas))*0;
		$row['mandiri_lgn'] = (mandiri_langganan($tgl_lunas,$outlet,$rcp_lunas))*0;
		$row['bca_lgn'] = (bca_langganan($tgl_lunas,$outlet,$rcp_lunas))*0;
		$row['bayar_cash'] = $row['cash_order']+$row['cash_lgn'];
		$row['bayar_bri'] = $row['bri_order']+$row['bri_lgn'];
		$row['bayar_bni'] = $row['bni_order']+$row['bni_lgn'];
		$row['bayar_mandiri'] = $row['mandiri_order']+$row['mandiri_lgn'];
		$row['bayar_bca'] = $row['bca_order']+$row['bca_lgn'];
		$row['bayar_cashback'] = $row['cashback_order'];	
		$row['bayar_kuota'] = ($row['order_pending']*-1+$row['pendapatan_member']+$row['pendapatan_deposit'])-($row['bayar_cash']+$row['bayar_bri']+$row['bayar_bni']+$row['bayar_mandiri']+$row['bayar_bca']+$row['bayar_cashback']);
	}	
	


		$row['setoran_bersih'] = setoran_bersih($tgl_lunas,$outlet,$rcp_lunas);
		$row['edc_bri'] = edc_bri($tgl_lunas,$outlet,$rcp_lunas);
		$row['edc_bni'] = edc_bni($tgl_lunas,$outlet,$rcp_lunas);
		$row['edc_mandiri'] = edc_mandiri($tgl_lunas,$outlet,$rcp_lunas);
		$row['edc_bca'] = edc_bca($tgl_lunas,$outlet,$rcp_lunas);
		$row['total_edc'] = $row['edc_bri']+$row['edc_bni']+$row['edc_mandiri']+$row['edc_bca'];

		$row['lain'] = verifikasi_lain($tgl,$rcp_lunas);
		$row['apotik'] = verifikasi_apotik($tgl,$rcp_lunas);
		$row['bca'] = verifikasi_bca($tgl,$rcp_lunas);
		$row['permata'] = verifikasi_permata($tgl,$rcp_lunas);
		$row['bri'] = verifikasi_bri($tgl,$rcp_lunas);
		$row['bni'] = verifikasi_bni($tgl,$rcp_lunas);

	return $row;
}


// function laporan_lunas_later($tgl,$outlet,$reception,$rcp_lunas,$tgl_lunas){
// 	$row['order_kiloan'] = order_kiloan($tgl,$outlet,$reception);
// 	$row['order_potongan'] = order_potongan($tgl,$outlet,$reception);
// 	$row['total_order'] = $row['order_kiloan']+$row['order_potongan'];		

// 	$row['order_lunas'] = order_lunas_now($tgl,$outlet,$reception,$rcp_lunas,$tgl_lunas);
// 	$row['order_pending'] = $row['total_order']-$row['order_lunas'];


// 	$row['cash_lgn'] = cash_langganan($tgl,$outlet,$reception);
// 	$row['bri_lgn'] = bri_langganan($tgl,$outlet,$reception);
// 	$row['bni_lgn'] = bni_langganan($tgl,$outlet,$reception);
// 	$row['mandiri_lgn'] = mandiri_langganan($tgl,$outlet,$reception);
// 	$row['bca_lgn'] = bca_langganan($tgl,$outlet,$reception);

// 	if($reception==$row['rcp_order'] && $tgl==$row['tgl_order']){
// 		$row['order_lunas'] = 0;
// 		$row['order_pending'] = 0;
// 		$row['cash_order'] = 0;
// 		$row['bri_order'] = 0;
// 		$row['bni_order'] = 0;
// 		$row['mandiri_order'] = 0;
// 		$row['bca_order'] = 0;
// 		$row['cashback_order'] = 0;
// 		$row['setoran_bersih'] = 0;
// 		$row['edc_bri'] = 0;
// 		$row['edc_bni'] = 0;
// 		$row['edc_mandiri'] = 0;
// 		$row['edc_bca'] = 0;
// 		$row['total_edc'] = $row['edc_bri']+$row['edc_bni']+$row['edc_mandiri']+$row['edc_bca'];

// 		$row['lain'] = 0;
// 		$row['apotik'] = 0;
// 		$row['bca'] = 0;
// 		$row['permata'] = 0;
// 		$row['bri'] = 0;
// 		$row['bni'] = 0;
// 	} else if($reception!=$row['rcp_order'] && $tgl==$row['tgl_order']){
// 		$row['order_lunas'] = order_lunas_later($tgl,$outlet,$reception)*-1;
// 		$row['order_pending'] = 0;
// 		$row['cash_order'] = cash_order2($tgl,$outlet,$reception);
// 		$row['bri_order'] = bri_order2($tgl,$outlet,$reception);
// 		$row['bni_order'] = bni_order2($tgl,$outlet,$reception);
// 		$row['mandiri_order'] = mandiri_order2($tgl,$outlet,$reception);
// 		$row['bca_order'] = bca_order2($tgl,$outlet,$reception);
// 		$row['cashback_order'] = cashback_order2($tgl,$outlet,$reception);
// 		$row['setoran_bersih'] = setoran_bersih($tgl,$outlet,$reception);
// 		$row['edc_bri'] = edc_bri($tgl,$outlet,$reception);
// 		$row['edc_bni'] = edc_bni($tgl,$outlet,$reception);
// 		$row['edc_mandiri'] = edc_mandiri($tgl,$outlet,$reception);
// 		$row['edc_bca'] = edc_bca($tgl,$outlet,$reception);
// 		$row['total_edc'] = $row['edc_bri']+$row['edc_bni']+$row['edc_mandiri']+$row['edc_bca'];

// 		$row['lain'] = verifikasi_lain($tgl,$reception);
// 		$row['apotik'] = verifikasi_apotik($tgl,$reception);
// 		$row['bca'] = verifikasi_bca($tgl,$reception);
// 		$row['permata'] = verifikasi_permata($tgl,$reception);
// 		$row['bri'] = verifikasi_bri($tgl,$reception);
// 		$row['bni'] = verifikasi_bni($tgl,$reception);
// 	} else if($reception==$row['rcp_order'] && $tgl!=$row['tgl_order']){
// 		$row['order_lunas'] = order_lunas_later2($tgl,$outlet,$reception)*-1;
// 		$row['order_pending'] = 0;
// 		$row['cash_order'] = cash_order3($tgl,$outlet,$reception);
// 		$row['bri_order'] = bri_order3($tgl,$outlet,$reception);
// 		$row['bni_order'] = bni_order3($tgl,$outlet,$reception);
// 		$row['mandiri_order'] = mandiri_order3($tgl,$outlet,$reception);
// 		$row['bca_order'] = bca_order3($tgl,$outlet,$reception);
// 		$row['cashback_order'] = cashback_order3($tgl,$outlet,$reception);
// 		$row['setoran_bersih'] = 0;
// 		$row['edc_bri'] = 0;
// 		$row['edc_bni'] = 0;
// 		$row['edc_mandiri'] = 0;
// 		$row['edc_bca'] = 0;
// 		$row['total_edc'] = $row['edc_bri']+$row['edc_bni']+$row['edc_mandiri']+$row['edc_bca'];

// 		$row['lain'] = 0;
// 		$row['apotik'] = 0;
// 		$row['bca'] = 0;
// 		$row['permata'] = 0;
// 		$row['bri'] = 0;
// 		$row['bni'] = 0;
// 	} else if($reception!=$row['rcp_order'] && $tgl!=$row['tgl_order']){
// 		$row['order_lunas'] = order_lunas_later3($tgl,$outlet,$reception)*-1;
// 		$row['order_pending'] = 0;
// 		$row['cash_order'] = cash_order4($tgl,$outlet,$reception);
// 		$row['bri_order'] = bri_order4($tgl,$outlet,$reception);
// 		$row['bni_order'] = bni_order4($tgl,$outlet,$reception);
// 		$row['mandiri_order'] = mandiri_order4($tgl,$outlet,$reception);
// 		$row['bca_order'] = bca_order4($tgl,$outlet,$reception);
// 		$row['cashback_order'] = cashback_order4($tgl,$outlet,$reception);
// 		$row['setoran_bersih'] = setoran_bersih($tgl,$outlet,$reception);
// 		$row['edc_bri'] = edc_bri($tgl,$outlet,$reception);
// 		$row['edc_bni'] = edc_bni($tgl,$outlet,$reception);
// 		$row['edc_mandiri'] = edc_mandiri($tgl,$outlet,$reception);
// 		$row['edc_bca'] = edc_bca($tgl,$outlet,$reception);
// 		$row['total_edc'] = $row['edc_bri']+$row['edc_bni']+$row['edc_mandiri']+$row['edc_bca'];

// 		$row['lain'] = verifikasi_lain($tgl,$reception);
// 		$row['apotik'] = verifikasi_apotik($tgl,$reception);
// 		$row['bca'] = verifikasi_bca($tgl,$reception);
// 		$row['permata'] = verifikasi_permata($tgl,$reception);
// 		$row['bri'] = verifikasi_bri($tgl,$reception);
// 		$row['bni'] = verifikasi_bni($tgl,$reception);
// 	}

// 	$row['pendapatan_member'] = pendapatan_member($tgl,$outlet,$reception);
// 	$row['pendapatan_deposit'] = pendapatan_deposit($tgl,$outlet,$reception);

// 	$row['bayar_cash'] = $row['cash_order']+$row['cash_lgn'];
// 	$row['bayar_bri'] = $row['bri_order']+$row['bri_lgn'];
// 	$row['bayar_bni'] = $row['bni_order']+$row['bni_lgn'];
// 	$row['bayar_mandiri'] = $row['mandiri_order']+$row['mandiri_lgn'];
// 	$row['bayar_bca'] = $row['bca_order']+$row['bca_lgn'];
// 	$row['bayar_cashback'] = $row['cashback_order'];
// 	$row['bayar_kuota'] = ($row['order_lunas']*-1+$row['pendapatan_member']+$row['pendapatan_deposit'])-($row['bayar_cash']+$row['bayar_bri']+$row['bayar_bni']+$row['bayar_mandiri']+$row['bayar_bca']+$row['bayar_cashback']);
// 	return $row;
// }



?>