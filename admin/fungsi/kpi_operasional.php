<?php  

function mata_uang($angka){
	$jadi = number_format($angka,0);
	return $jadi;
}

function user_name(){
	global $con;
	$query = mysqli_query($con, "SELECT DISTINCT name,level,jenis,user_id,type FROM user WHERE (level='operator' OR level='setrika' OR level='packer') AND aktif='Ya' ORDER BY name ASC");
	return($query);
}

function extra_operasional(){
	global $con, $id;
	$query = mysqli_query($con, "SELECT * FROM extra_operasional WHERE id_user='$id'");
	$row = mysqli_fetch_array($query);
	return $row;
}

function poin_cuci_kiloan($user,$startDate,$endDate){
	global $con;
	$query = mysqli_query($con, "SELECT COALESCE(COUNT(*)*0.5,0) AS poin FROM reception WHERE op_cuci='$user' AND jenis='k' AND DATE_FORMAT(tgl_cuci, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
	$data = mysqli_fetch_row($query);
	return round($data[0],2);
}

function poin_cuci_potongan($user,$startDate,$endDate){
  global $con;
  $query = mysqli_query($con,"SELECT COALESCE(SUM(jumlah),0) AS poin FROM reception WHERE op_cuci='$user' AND jenis='p' AND DATE_FORMAT(tgl_cuci, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
  $data = mysqli_fetch_row($query);
  return round($data[0],2);
}

function poin_pengering($user,$startDate,$endDate){
  global $con;
  $query = mysqli_query($con,"SELECT COALESCE(COUNT(*)*0.5,0) AS jumlah_poin FROM reception WHERE op_pengering='$user' AND jenis='k' AND DATE_FORMAT(tgl_pengering, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
  $data = mysqli_fetch_row($query);
  return round($data[0],2);
}

function poin_setrika_kiloan($user,$startDate,$endDate){
  global $con;
  $query = mysqli_query($con, "SELECT COALESCE(SUM(b.berat),0) as poin FROM reception AS a INNER JOIN detail_penjualan AS b ON a.no_nota=b.no_nota WHERE a.user_setrika='$user' AND (DATE_FORMAT(a.tgl_setrika, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate') AND a.jenis='k' ");
  $data = mysqli_fetch_row($query);
  return round($data[0],2);
}

function poin_setrika_potongan($user,$startDate,$endDate){
  global $con;
  $query = mysqli_query($con, "SELECT COALESCE(SUM(b.jumlah)*0.5,0) as poin FROM reception AS a INNER JOIN detail_penjualan AS b ON a.no_nota=b.no_nota WHERE a.user_setrika='$user' AND (DATE_FORMAT(a.tgl_setrika, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate') AND a.jenis='p' AND b.item NOT LIKE 'Gordyn%' AND b.item NOT LIKE 'Voucher%' AND b.item NOT LIKE '%Express%' ");
  $data = mysqli_fetch_row($query);
  return round($data[0],2);
}

function poin_setrika_gordyn($user,$startDate,$endDate){
  global $con;
  $query = mysqli_query($con, "SELECT COALESCE(SUM(b.jumlah),0) as poin FROM reception AS a INNER JOIN detail_penjualan AS b ON a.no_nota=b.no_nota WHERE a.user_setrika='$user' AND (DATE_FORMAT(a.tgl_setrika, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate') AND a.jenis='p' AND b.item LIKE 'Gordyn%'");
  $data = mysqli_fetch_row($query);
  return round($data[0],2);
}

function poin_packing_kiloan($user,$startDate,$endDate){
	global $con;
	$query = mysqli_query($con, "SELECT COALESCE(COUNT(*),0) as poin FROM reception WHERE user_packing='$user' AND jenis='k' AND (DATE_FORMAT(tgl_packing, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate')");
	$data = mysqli_fetch_row($query);
	return round($data[0],2);
}

function poin_packing_potongan($user,$startDate,$endDate){
	global $con;
	$query = mysqli_query($con, "SELECT COALeSCE(SUM(jumlah)*0.5,0) as poin FROM reception WHERE user_packing='$user' AND jenis='p' AND (DATE_FORMAT(tgl_packing, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate')");
	$data = mysqli_fetch_row($query);
	return round($data[0],2);
}

function cuci_kiloan_express($user,$startDate,$endDate){
	global $con;
	$query = mysqli_query($con, "SELECT COALESCE(COUNT(*),0) as bonus, op_cuci FROM reception WHERE op_cuci='$user' AND express<>'0' AND jenis='k' AND (DATE_FORMAT(tgl_cuci, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate') AND DATEDIFF(tgl_cuci, tgl_spk)<='1' ");
	$data = mysqli_fetch_row($query);
	return round($data[0],2);
}

function cuci_kiloan_priority($user,$startDate,$endDate){
	global $con;
	$query = mysqli_query($con, "SELECT COALESCE(COUNT(*)*0.5,0) as bonus, op_cuci FROM reception WHERE op_cuci='$user' AND priority='1' AND express='0' AND jenis='k' AND (DATE_FORMAT(tgl_cuci, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate') AND DATEDIFF(tgl_cuci, tgl_spk)<='1'");
	$data = mysqli_fetch_row($query);
	return round($data[0],2);
}

function setrika_express($user,$startDate,$endDate){
	global $con;
	$query = mysqli_query($con, "SELECT COALESCE(COUNT(*),0) as bonus, user_setrika FROM reception WHERE user_setrika='$user' AND express<>'0' AND (DATE_FORMAT(tgl_setrika, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate') ");
	$data = mysqli_fetch_row($query);
	return round($data[0],2);
}

function packing_express($user,$startDate,$endDate){
	global $con;
	$query = mysqli_query($con, "SELECT COALESCE(COUNT(*),0) as bonus, user_packing FROM reception WHERE user_packing='$user' AND express<>'0' AND (DATE_FORMAT(tgl_packing, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate') ");
	$data = mysqli_fetch_row($query);
	return round($data[0],2);
}

function omset_potongan($startDate,$endDate){
	global $con;
	$query = mysqli_query($con, "SELECT SUM(total_bayar) AS total FROM reception WHERE jenis='p' AND (cara_bayar<>'Void' AND cara_bayar<>'Reject') AND nama_outlet<>'mojokerto' AND workshop='Toddopuli' AND potong_bonus='0' AND DATE_FORMAT(tgl_input, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
	$data = mysqli_fetch_row($query);
	return round($data[0],2);
}

function omset_potongan2($startDate,$endDate){
	global $con;
	$query = mysqli_query($con, "SELECT (SUM(total_bayar)*0.5) AS total FROM reception WHERE jenis='p' AND (cara_bayar<>'Void' AND cara_bayar<>'Reject') AND nama_outlet<>'mojokerto' AND workshop='Toddopuli' AND potong_bonus='50' AND DATE_FORMAT(tgl_input, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
	$data = mysqli_fetch_row($query);
	return round($data[0],2);
}

function jumlah_kerja_operator_potongan(){
	global $con;
	$query = mysqli_query($con, "SELECT SUM(a.hadir) AS jum FROM extra_operasional AS a INNER JOIN user AS b ON a.id_user=b.user_id WHERE b.level='operator' AND b.jenis='potongan'");
	$data = mysqli_fetch_row($query);
	return round($data[0],2);
}

// function jumlah_kerja_setrika_potongan(){
// 	global $con;
// 	$query = mysqli_query($con, "SELECT SUM(a.hadir) AS jum FROM extra_operasional AS a INNER JOIN user AS b ON a.id_user=b.user_id WHERE b.level='setrika' AND b.jenis='potongan'");
// 	$data = mysqli_fetch_row($query);
// 	return round($data[0],2);
// }

function bonus_setrika_potongan($user,$startDate,$endDate){
    global $con;
	$query = mysqli_query($con, "SELECT SUM(total_bayar+diskon) AS total FROM reception WHERE jenis='p' AND user_setrika='$user' AND potong_bonus='0' AND (DATE_FORMAT(tgl_setrika, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate')");
	$data = mysqli_fetch_row($query);
	return round($data[0],2);
}

function bonus_setrika_potongan2($user,$startDate,$endDate){
    global $con;
	$query = mysqli_query($con, "SELECT (SUM(total_bayar+diskon)*0.5) AS total FROM reception WHERE jenis='p' AND user_setrika='$user' AND potong_bonus='50' AND (DATE_FORMAT(tgl_setrika, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate')");
	$data = mysqli_fetch_row($query);
	return round($data[0],2);
}

function cucian_telat($user,$startDate,$endDate){
	global $con;
	$query = mysqli_query($con, "SELECT COUNT(*) FROM denda_cucian_telat WHERE operator='$user' AND DATE_FORMAT(tgl_denda, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
	$data = mysqli_fetch_row($query);
	return round($data[0],2);	
}

function operator($user,$tipe,$startDate,$endDate){

	if($tipe=='C'){
	    $data['target'] = 0;
	    $data['standard'] = 800;
	} 
	else {
	    $data['target'] = 65;
	    $data['standard'] = 1100;
	}
	 
	
	$data['cuci_kiloan'] = poin_cuci_kiloan($user,$startDate,$endDate);
	$data['kering_kiloan'] = poin_pengering($user,$startDate,$endDate);
	$data['cuci_potongan'] = poin_cuci_potongan($user,$startDate,$endDate);
	$data['express_opr'] = cuci_kiloan_express($user,$startDate,$endDate);
	$data['priority_opr'] = cuci_kiloan_priority($user,$startDate,$endDate);
	$data['pencapaian_operator'] = $data['cuci_kiloan']+$data['kering_kiloan']+$data['cuci_potongan']+$data['express_opr']+$data['priority_opr'];

	return $data;
}

function setrika($user,$startDate,$endDate){
	global $jenis;
	if($jenis=='potongan'){
		$data['target'] = 0;
	} else{
		$data['target'] = 0;
	}
	if($user=='afni packer' OR $user=='afni-opr' OR $user=='sarah setrika') $data['target'] = 0; else $data['target'] = $data['target'];
	$data['standard'] = 800;
	
	return $data;
}

function packer($user,$tipe,$startDate,$endDate){
	
	if($tipe=='C'){
	    $data['target'] = 0;
	    $data['standard'] = 800;
	} 
	else {
	    $data['target'] = 75;
	    $data['standard'] = 950;
	}
	$data['packing_kiloan'] = poin_packing_kiloan($user,$startDate,$endDate);
	$data['packing_potongan'] = poin_packing_potongan($user,$startDate,$endDate);
	$data['express_pck'] = packing_express($user,$startDate,$endDate);
	$data['pencapaian_packing'] = $data['packing_kiloan']+$data['packing_potongan']+$data['express_pck'];

	return $data;		
}

function laporan_pencapaian_operasional($user,$posisi,$tipe,$startDate,$endDate){
	global $level;
	if($level=='operator'){
		$data = operator($user,$tipe,$startDate,$endDate);
	} else if($level=='setrika'){
		$data = setrika($user,$startDate,$endDate);
	} else if($level=='packer'){
		$data = packer($user,$tipe,$startDate,$endDate);
	}
	$data['setrika'] = poin_setrika_kiloan($user,$startDate,$endDate)+poin_setrika_potongan($user,$startDate,$endDate)+poin_setrika_gordyn($user,$startDate,$endDate);
	$data['express_str'] = setrika_express($user,$startDate,$endDate);
	$data['hari_kerja'] = extra_operasional()['hadir'];
	$data['masuk_malam'] = extra_operasional()['masuk_malam'];
	$data['kasus_operasional'] = extra_operasional()['kasus_nota'];
	$data['poin_minimal'] = $data['hari_kerja']*$data['target'];

	$data['pencapaian_setrika'] = $data['setrika']+$data['express_str'];
	if(array_key_exists('pencapaian_operator', $data)) $data['pencapaian_operator'] = $data['pencapaian_operator']; else $data['pencapaian_operator'] = 0;
	if(array_key_exists('pencapaian_packing', $data)) $data['pencapaian_packing'] = $data['pencapaian_packing']; else $data['pencapaian_packing'] = 0;	
	if($data['masuk_malam']!=0) $data['insentif_malam'] = ($data['pencapaian_operator']+$data['pencapaian_setrika']+$data['pencapaian_packing'])/$data['hari_kerja']/2*$data['masuk_malam']; else $data['insentif_malam'] = 0;

	$data['bagi_brosur'] = extra_operasional()['poin_brosur'];
	$data['cucian_telat'] = cucian_telat($user,$startDate,$endDate);
	$data['pencapaian_bonus'] = ($data['insentif_malam']+$data['bagi_brosur'])*$data['standard'];
	$data['denda_potongan'] = ($data['cucian_telat']+$data['kasus_operasional'])*$data['standard'];

	if($posisi=='Operator Potongan'){
		$data['bonus_omset_potongan'] = ((omset_potongan($startDate,$endDate)+omset_potongan2($startDate,$endDate))*0.04)*$data['hari_kerja']/jumlah_kerja_operator_potongan();
		$data['total_capai'] = $data['bonus_omset_potongan'];
		$data['nominal_target'] = 0;
	} else if($posisi=='Setrika Potongan'){
		$data['bonus_omset_potongan'] = (bonus_setrika_potongan($user,$startDate,$endDate)+bonus_setrika_potongan2($user,$startDate,$endDate))*0.01;
		$data['total_capai'] = $data['bonus_omset_potongan'];
		$data['nominal_target'] = 0;
	} else{
		$data['bonus_omset_potongan'] = 0;
		$data['total_capai'] = $data['pencapaian_operator']*$data['standard']+$data['pencapaian_setrika']*800+$data['pencapaian_packing']*$data['standard']+$data['pencapaian_bonus'];
		$data['nominal_target'] = $data['poin_minimal']*$data['standard'];
	}

	$data['grand_total'] = $data['total_capai']-$data['nominal_target']-$data['denda_potongan'];

	return $data;
}

?>