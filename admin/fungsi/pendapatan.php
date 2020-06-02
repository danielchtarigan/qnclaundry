<?php 

function laundry_kiloan($tgl,$outlet,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(total_bayar),0) AS total FROM reception WHERE nama_outlet='$outlet' AND nama_reception='$reception' AND tgl_input LIKE '%$tgl%' AND jenis='k' AND cara_bayar<>'Void'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function laundry_potongan($tgl,$outlet,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(total_bayar),0) AS total FROM reception WHERE nama_outlet='$outlet' AND nama_reception='$reception' AND tgl_input LIKE '%$tgl%' AND jenis='p' AND cara_bayar<>'Void'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

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

function order_sudah_lunas($tgl,$outlet,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(total_bayar),0) AS total FROM reception WHERE nama_outlet='$outlet' AND nama_reception='$reception' AND tgl_input LIKE '%$tgl%' AND tgl_lunas<>'0000-00-00 00:00:00' AND lunas=true AND cara_bayar<>'Void'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

// function order_belum_lunas($tgl,$outlet,$reception){
// 	global $con;
// 	$sql = mysqli_query($con, "SELECT COALESCE(SUM(total_bayar),0) AS total FROM reception WHERE nama_outlet='$outlet' AND nama_reception='$reception' AND tgl_input LIKE '%$tgl%' AND lunas=false");
// 	$row = mysqli_fetch_row($sql);
// 	return $row[0];
// }

function cash_order($tgl,$outlet,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) AS total FROM cara_bayar WHERE tgl_order='$tgl' AND outlet_order='$outlet' AND rcp_order='$reception' AND (cara_bayar='cash' OR cara_bayar='Cash') ");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function bri_order($tgl,$outlet,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) AS total FROM cara_bayar WHERE tgl_order='$tgl' AND outlet_order='$outlet' AND rcp_order='$reception' AND cara_bayar='BRI'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function bni_order($tgl,$outlet,$reception){
	global $con;
$sql = mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) AS total FROM cara_bayar WHERE tgl_order='$tgl' AND outlet_order='$outlet' AND rcp_order='$reception' AND cara_bayar='BNI'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function mandiri_order($tgl,$outlet,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) AS total FROM cara_bayar WHERE tgl_order='$tgl' AND outlet_order='$outlet' AND rcp_order='$reception' AND cara_bayar='Mandiri'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function bca_order($tgl,$outlet,$reception){
	global $con;
$sql = mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) AS total FROM cara_bayar WHERE tgl_order='$tgl' AND outlet_order='$outlet' AND rcp_order='$reception' AND cara_bayar='BCA'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function cashback_order($tgl,$outlet,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) AS total FROM cara_bayar WHERE tgl_order='$tgl' AND outlet_order='$outlet' AND rcp_order='$reception' AND cara_bayar='Cashback'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function cash_langganan($tgl,$outlet,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(total),0) AS jumlah FROM faktur_penjualan WHERE cara_bayar='cash' AND tgl_transaksi LIKE '%$tgl%' AND (jenis_transaksi='deposit' OR jenis_transaksi='membership') AND nama_outlet='$outlet' AND rcp='$reception'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function bri_langganan($tgl,$outlet,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(total),0) AS jumlah FROM faktur_penjualan WHERE (cara_bayar='edcbri' OR cara_bayar='BRI') AND tgl_transaksi LIKE '%$tgl%' AND (jenis_transaksi='deposit' OR jenis_transaksi='membership') AND nama_outlet='$outlet' AND rcp='$reception'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function bni_langganan($tgl,$outlet,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(total),0) AS jumlah FROM faktur_penjualan WHERE (cara_bayar='edcbni' OR cara_bayar='BNI') AND tgl_transaksi LIKE '%$tgl%' AND (jenis_transaksi='deposit' OR jenis_transaksi='membership') AND nama_outlet='$outlet' AND rcp='$reception'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function mandiri_langganan($tgl,$outlet,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(total),0) AS jumlah FROM faktur_penjualan WHERE (cara_bayar='edcmandiri' OR cara_bayar='Mandiri') AND tgl_transaksi LIKE '%$tgl%' AND (jenis_transaksi='deposit' OR jenis_transaksi='membership') AND nama_outlet='$outlet' AND rcp='$reception'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function bca_langganan($tgl,$outlet,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(total),0) AS jumlah FROM faktur_penjualan WHERE (cara_bayar='edcbca' OR cara_bayar='BCA') AND tgl_transaksi LIKE '%$tgl%' AND (jenis_transaksi='deposit' OR jenis_transaksi='membership') AND nama_outlet='$outlet' AND rcp='$reception'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function pengeluaran($tgl,$outlet,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(pengeluaran),0) AS jumlah FROM tutup_kasir WHERE tanggal LIKE '%$tgl%' AND outlet='$outlet' AND reception='$reception'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function setoran_bersih($tgl,$outlet,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(setoran_bersih),0) AS total FROM tutup_kasir WHERE tanggal LIKE '%$tgl%' AND outlet='$outlet' AND reception='$reception'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function edc_bri($tgl,$outlet,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(edc_bri),0) AS total FROM tutup_kasir WHERE tanggal LIKE '%$tgl%' AND outlet='$outlet' AND reception='$reception'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function edc_bni($tgl,$outlet,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(edc_bni),0) AS total FROM tutup_kasir WHERE tanggal LIKE '%$tgl%' AND outlet='$outlet' AND reception='$reception'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}
function edc_mandiri($tgl,$outlet,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(edc_mandiri),0) AS total FROM tutup_kasir WHERE tanggal LIKE '%$tgl%' AND outlet='$outlet' AND reception='$reception'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}
function edc_bca($tgl,$outlet,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(edc_bca),0) AS total FROM tutup_kasir WHERE tanggal LIKE '%$tgl%' AND outlet='$outlet' AND reception='$reception'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function verifikasi_lain($tgl,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) AS total FROM setoran_bank_sebenarnya WHERE tanggal LIKE '%$tgl%' AND nama='$reception' AND nama_bank='Lain-Lain'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function verifikasi_apotik($tgl,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) AS total FROM setoran_bank_sebenarnya WHERE tanggal LIKE '%$tgl%' AND nama='$reception' AND nama_bank='Apotik'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function verifikasi_bri($tgl,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) AS total FROM setoran_bank_sebenarnya WHERE tanggal LIKE '%$tgl%' AND nama='$reception' AND nama_bank='BRI'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function verifikasi_bni($tgl,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) AS total FROM setoran_bank_sebenarnya WHERE tanggal LIKE '%$tgl%' AND nama='$reception' AND nama_bank='BNI'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function verifikasi_bca($tgl,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) AS total FROM setoran_bank_sebenarnya WHERE tanggal LIKE '%$tgl%' AND nama='$reception' AND nama_bank='BCA'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function verifikasi_permata($tgl,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) AS total FROM setoran_bank_sebenarnya WHERE tanggal LIKE '%$tgl%' AND nama='$reception' AND nama_bank='Permata'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function laporan_pendapatan($tgl,$outlet,$reception){
	global $con;
	$row['laundry_kiloan'] = laundry_kiloan($tgl,$outlet,$reception);
	$row['laundry_potongan'] = laundry_potongan($tgl,$outlet,$reception);
	$row['total_laundry_order'] = $row['laundry_kiloan']+$row['laundry_potongan'];
	$row['pendapatan_member'] = pendapatan_member($tgl,$outlet,$reception);
	$row['pendapatan_deposit'] = pendapatan_deposit($tgl,$outlet,$reception);
	$row['order_sudah_lunas'] = order_sudah_lunas($tgl,$outlet,$reception);
	$row['order_belum_lunas'] = $row['total_laundry_order']-$row['order_sudah_lunas'];

	$row['cash_order'] = cash_order($tgl,$outlet,$reception);
	$row['bri_order'] = bri_order($tgl,$outlet,$reception);
	$row['bni_order'] = bni_order($tgl,$outlet,$reception);
	$row['mandiri_order'] = mandiri_order($tgl,$outlet,$reception);
	$row['bca_order'] = bca_order($tgl,$outlet,$reception);
	$row['cashback_order'] = cashback_order($tgl,$outlet,$reception);

	$row['cash_lgn'] = cash_langganan($tgl,$outlet,$reception);
	$row['bri_lgn'] = bri_langganan($tgl,$outlet,$reception);
	$row['bni_lgn'] = bni_langganan($tgl,$outlet,$reception);
	$row['mandiri_lgn'] = mandiri_langganan($tgl,$outlet,$reception);
	$row['bca_lgn'] = bca_langganan($tgl,$outlet,$reception);
	$row['pengeluaran'] = pengeluaran($tgl,$outlet,$reception);

	$row['bayar_cash'] = $row['cash_order']+$row['cash_lgn'];
	$row['bayar_bri'] = $row['bri_order']+$row['bri_lgn'];
	$row['bayar_bni'] = $row['bni_order']+$row['bni_lgn'];
	$row['bayar_mandiri'] = $row['mandiri_order']+$row['mandiri_lgn'];
	$row['bayar_bca'] = $row['bca_order']+$row['bca_lgn'];
	$row['bayar_cashback'] = $row['cashback_order'];
	$row['bayar_kuota'] = ($row['order_sudah_lunas']+$row['pendapatan_member']+$row['pendapatan_deposit'])-($row['bayar_cash']+$row['bayar_bri']+$row['bayar_bni']+$row['bayar_mandiri']+$row['bayar_bca']+$row['bayar_cashback']);

	$row['setoran_bersih'] = setoran_bersih($tgl,$outlet,$reception);
	$row['edc_bri'] = edc_bri($tgl,$outlet,$reception);
	$row['edc_bni'] = edc_bni($tgl,$outlet,$reception);
	$row['edc_mandiri'] = edc_mandiri($tgl,$outlet,$reception);
	$row['edc_bca'] = edc_bca($tgl,$outlet,$reception);
	$row['total_edc'] = $row['edc_bri']+$row['edc_bni']+$row['edc_mandiri']+$row['edc_bca'];

	$row['lain'] = verifikasi_lain($tgl,$reception);
	$row['apotik'] = verifikasi_apotik($tgl,$reception);
	$row['bca'] = verifikasi_bca($tgl,$reception);
	$row['bri'] = verifikasi_bri($tgl,$reception);
	$row['bni'] = verifikasi_bni($tgl,$reception);
	$row['permata'] = verifikasi_permata($tgl,$reception);

	return $row;
}

