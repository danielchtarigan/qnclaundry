<?php 
function bonus_spk($nama,$startDate,$endDate){
	global $con;
	$query = mysqli_query($con, "SELECT SUM(total_bayar+diskon) AS spk FROM reception WHERE rcp_spk='$nama' AND DATE_FORMAT(tgl_spk, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = mysqli_fetch_row($query);
	return $data[0];
}

function bonus_spk_baru($nama,$startDate,$endDate){
    global $con;
	$query = mysqli_query($con, "SELECT SUM(total_bayar+diskon) AS total FROM reception WHERE rcp_spk='$nama' AND tgl_spk<>'0000-00-00 00:00:00' AND tgl_kembali<>'0000-00-00 00:00:00' AND DATEDIFF(tgl_kembali, tgl_input) <=2 AND DATE_FORMAT(tgl_spk, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = mysqli_fetch_row($query);
	return $data[0];
}

function bonus_spk_baru2($nama,$startDate,$endDate){
    global $con;
	$query = mysqli_query($con, "SELECT SUM(total_bayar+diskon) AS total FROM reception WHERE rcp_spk='$nama' AND tgl_spk<>'0000-00-00 00:00:00' AND tgl_kembali<>'0000-00-00 00:00:00' AND DATEDIFF(tgl_kembali, tgl_input) >2 AND DATE_FORMAT(tgl_spk, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = mysqli_fetch_row($query);
	return $data[0];
}

function bonus_spk_kiloan($nama,$startDate,$endDate){
    global $con;
	$query = mysqli_query($con, "SELECT (SUM(total_bayar+diskon)*0.04) AS total FROM reception WHERE rcp_spk='$nama' AND tgl_spk<>'0000-00-00 00:00:00' AND tgl_kembali<>'0000-00-00 00:00:00' AND DATEDIFF(tgl_kembali, tgl_input) <=2 AND jenis='k' AND DATE_FORMAT(tgl_spk, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = mysqli_fetch_row($query);
	return $data[0];
}

function bonus_spk_kiloan2($nama,$startDate,$endDate){
    global $con;
	$query = mysqli_query($con, "SELECT (SUM(total_bayar+diskon)*0.03) AS total FROM reception WHERE rcp_spk='$nama' AND tgl_spk<>'0000-00-00 00:00:00' AND tgl_kembali<>'0000-00-00 00:00:00' AND DATEDIFF(tgl_kembali, tgl_input) >2 AND jenis='k' AND DATE_FORMAT(tgl_spk, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = mysqli_fetch_row($query);
	return $data[0];
}

function bonus_spk_potongan1($nama,$startDate,$endDate){
    global $con;
	$query = mysqli_query($con, "SELECT (SUM(detail_penjualan.harga*detail_penjualan.jumlah)*0.02) AS total FROM ((reception INNER JOIN detail_penjualan ON reception.no_nota=detail_penjualan.no_nota) INNER JOIN item_spk ON detail_penjualan.item=item_spk.nama_item) WHERE (item_spk.kategory='4' OR item_spk.kategory='5' OR item_spk.kategory='6') AND reception.rcp_spk='$nama' AND reception.tgl_spk<>'0000-00-00 00:00:00' AND reception.tgl_kembali<>'0000-00-00 00:00:00' AND reception.jenis='p' AND DATEDIFF(reception.tgl_kembali, tgl_input) <=2 AND DATE_FORMAT(reception.tgl_spk, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' ");
	$data = mysqli_fetch_row($query);
	return $data[0];
}

function bonus_spk_potongan2($nama,$startDate,$endDate){
    global $con;
	$query = mysqli_query($con, "SELECT (SUM(detail_penjualan.harga*detail_penjualan.jumlah)*0.02) AS total FROM ((reception INNER JOIN detail_penjualan ON reception.no_nota=detail_penjualan.no_nota) INNER JOIN item_spk ON detail_penjualan.item=item_spk.nama_item) WHERE (item_spk.kategory='4' OR item_spk.kategory='5' OR item_spk.kategory='6') AND reception.rcp_spk='$nama' AND reception.tgl_spk<>'0000-00-00 00:00:00' AND reception.tgl_kembali<>'0000-00-00 00:00:00' AND reception.jenis='p' AND DATEDIFF(reception.tgl_kembali, tgl_input) >2 AND DATE_FORMAT(reception.tgl_spk, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' ");
	$data = mysqli_fetch_row($query);
	return $data[0];
}

function bonus_spk_potongan3($nama,$startDate,$endDate){
    global $con;
	$query = mysqli_query($con, "SELECT (SUM(detail_penjualan.harga*detail_penjualan.jumlah)*0.07) AS total FROM ((reception INNER JOIN detail_penjualan ON reception.no_nota=detail_penjualan.no_nota) INNER JOIN item_spk ON detail_penjualan.item=item_spk.nama_item) WHERE (item_spk.kategory='7' OR item_spk.kategory='8' OR item_spk.kategory='9') AND reception.rcp_spk='$nama' AND reception.tgl_spk<>'0000-00-00 00:00:00' AND reception.tgl_kembali<>'0000-00-00 00:00:00' AND reception.jenis='p' AND DATEDIFF(reception.tgl_kembali, tgl_input) <=2 AND DATE_FORMAT(reception.tgl_spk, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' ");
	$data = mysqli_fetch_row($query);
	return $data[0];
}

function bonus_spk_potongan4($nama,$startDate,$endDate){
    global $con;
	$query = mysqli_query($con, "SELECT (SUM(detail_penjualan.harga*detail_penjualan.jumlah)*0.06) AS total FROM ((reception INNER JOIN detail_penjualan ON reception.no_nota=detail_penjualan.no_nota) INNER JOIN item_spk ON detail_penjualan.item=item_spk.nama_item) WHERE (item_spk.kategory='7' OR item_spk.kategory='8' OR item_spk.kategory='9') AND reception.rcp_spk='$nama' AND reception.tgl_spk<>'0000-00-00 00:00:00' AND reception.tgl_kembali<>'0000-00-00 00:00:00' AND reception.jenis='p' AND DATEDIFF(reception.tgl_kembali, tgl_input) >2 AND DATE_FORMAT(reception.tgl_spk, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' ");
	$data = mysqli_fetch_row($query);
	return $data[0];
}

function potongan_reject($nama,$startDate,$endDate){
	global $con;
	$query = mysqli_query($con, "SELECT SUM((a.total_bayar+a.diskon)*0.08) AS reject FROM reception AS a INNER JOIN rijeck AS b ON a.no_nota=b.no_nota WHERE a.rcp_spk='$nama' AND DATE_FORMAT(b.tgl_rijeck, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = mysqli_fetch_row($query);
	return $data[0];
}

function bonus_reject($nama,$startDate,$endDate){
	global $con;
	$query = mysqli_query($con, "SELECT SUM((a.total_bayar+a.diskon)*0.08) AS spkedit FROM reception AS a INNER JOIN rijeck AS b ON a.no_nota=b.no_nota WHERE a.rcp_spk_edit='$nama' AND DATE_FORMAT(a.tgl_spk_edit, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' ");
	$data = mysqli_fetch_row($query);
	return $data[0];
}

function quality_audit($nama,$startDate,$endDate){
	global $con;
	$query = mysqli_query($con, "SELECT COALESCE(COUNT(nama_customer)*5000,0) AS customer FROM quality_audit WHERE user_input='$nama' AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = mysqli_fetch_row($query);
	return $data[0];
}

function membership($nama,$startDate,$endDate){
	global $con;
	$query = mysqli_query($con, "SELECT COALESCE(COUNT(DISTINCT id_customer)*20000,0) AS member FROM faktur_penjualan WHERE jenis_transaksi='membership' AND rcp='$nama' AND DATE_FORMAT(tgl_transaksi, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' ");
	$data = mysqli_fetch_row($query);
	return $data[0];
}

function langganan($nama,$startDate,$endDate){
	global $con;
	$query = mysqli_query($con, "SELECT SUM(b.total*0.1) AS total FROM langganan AS a INNER JOIN faktur_penjualan AS b ON a.id_customer=b.id_customer WHERE a.tgl_join BETWEEN '$startDate' AND '$endDate' AND b.rcp='$nama' AND b.jenis_transaksi='deposit' AND DATE_FORMAT(b.tgl_transaksi, '%Y-%m-%d')=a.tgl_join ");
	$data = mysqli_fetch_row($query);
	return $data[0];
}

function login($nama,$startDate,$endDate){
	global $con;
	$query = mysqli_query($con, "SELECT COALESCE(COUNT(DISTINCT DATE_FORMAT(tgl_log, '%Y-%m-%d')),0) AS hari FROM log_rcp WHERE id_user='$nama' AND DATE_FORMAT(tgl_log, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = mysqli_fetch_row($query);
	return $data[0];
}

function login2($nama,$startDate,$endDate){
	global $con;
	$query = mysqli_query($con, "SELECT COALESCE(COUNT(DISTINCT DATE_FORMAT(tgl_log, '%Y-%m-%d')),0) AS hari FROM log_rcp WHERE id_user='$nama' AND id_outlet<>'support' AND DATE_FORMAT(tgl_log, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = mysqli_fetch_row($query);
	return $data[0];
}

function outlet_login($nama,$startDate,$endDate){
	global $con;
	$query = mysqli_query($con, "SELECT DISTINCT id_outlet FROM log_rcp WHERE DATE_FORMAT(tgl_log, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' AND id_user='$nama'");
	$data = mysqli_fetch_row($query);
	return $data[0];
}

function stock_opname($nama,$startDate,$endDate){
	global $con;
	$query = mysqli_query($con, "SELECT COALESCE(COUNT(DISTINCT DATE_FORMAT(tgl_so, '%Y-%m-%d')),0) AS so FROM detail_so WHERE rcp_so='$nama' AND outlet<>'support' AND  DATE_FORMAT(tgl_so, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = mysqli_fetch_row($query);
	return $data[0];
}

function tutup_kasir($nama,$startDate,$endDate){
	global $con;
	$query = mysqli_query($con, "SELECT COALESCE(COUNT(DISTINCT DATE_FORMAT(tgl_so, '%Y-%m-%d')),0) AS so FROM reception WHERE rcp_so='$nama' AND  DATE_FORMAT(tgl_so, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = mysqli_fetch_row($query);
	return $data[0];
}

function kpi_reception($nama,$type,$jenis,$startDate,$endDate){
	if($type=='A') $data['gp'] = 1000000; else if($type=='Peluncur') $data['gp'] = 800000; else $data['gp'] = 1250000;
	if($nama=='anita') $data['gp'] = $data['gp']+400000; else $data['gp'] = $data['gp'];
	if($jenis=='dispatcher' AND $nama!='fita-rcp'){
	    $data['bonus_spk'] = bonus_spk($nama,$startDate,$endDate)*0.05;
	    $data['bonus_spk_baru'] = bonus_spk_baru($nama,$startDate,$endDate)*0.05+bonus_spk_baru2($nama,$startDate,$endDate)*0.04;
	}  else{
	    $data['bonus_spk'] = bonus_spk($nama,$startDate,$endDate)*0.04;
	    $data['bonus_spk_baru'] = bonus_spk_baru($nama,$startDate,$endDate)*0.04+bonus_spk_baru2($nama,$startDate,$endDate)*0.03;
	}
    $data['bonus_spk_kiloan'] = bonus_spk_kiloan($nama,$startDate,$endDate)+bonus_spk_kiloan2($nama,$startDate,$endDate);
	$data['bonus_spk_potongan'] = bonus_spk_potongan1($nama,$startDate,$endDate)+bonus_spk_potongan2($nama,$startDate,$endDate)+bonus_spk_potongan3($nama,$startDate,$endDate)+bonus_spk_potongan4($nama,$startDate,$endDate);
	$data['spk_potongan_2'] = bonus_spk_potongan1($nama,$startDate,$endDate)+bonus_spk_potongan2($nama,$startDate,$endDate);
	$data['spk_potongan_7'] = bonus_spk_potongan3($nama,$startDate,$endDate)+bonus_spk_potongan4($nama,$startDate,$endDate);
	$data['total_bonus_spk'] = $data['bonus_spk_kiloan']+$data['bonus_spk_potongan'];

	$data['reject'] = bonus_reject($nama,$startDate,$endDate)-potongan_reject($nama,$startDate,$endDate);
	$data['quality_audit'] = quality_audit($nama,$startDate,$endDate);
	$data['membership'] = membership($nama,$startDate,$endDate);
	$data['langganan'] = langganan($nama,$startDate,$endDate);
	$data['login_outlet'] = outlet_login($nama,$startDate,$endDate);
	$data['tidak_tutup_kasir'] = (tutup_kasir($nama,$startDate,$endDate)-login($nama,$startDate,$endDate))*25000*0;
	if($data['login_outlet']!='support') $data['tidak_so'] = (stock_opname($nama,$startDate,$endDate)-login2($nama,$startDate,$endDate))*5000; else $data['tidak_so'] = 0;
	if($type=='A') $data['bonus_kpi'] = $data['total_bonus_spk']+$data['reject']+$data['quality_audit']+$data['membership']+$data['langganan']+$data['tidak_tutup_kasir']+$data['tidak_so']; else $data['bonus_kpi'] = $data['reject']+$data['quality_audit']+$data['membership']+$data['langganan']+$data['tidak_tutup_kasir']+$data['tidak_so'];

	return $data;
	
}

?>