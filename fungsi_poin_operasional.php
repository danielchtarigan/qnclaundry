<?php

$target = array('operator'=>65, 'packer'=>75, 'setrika_potongan'=>60, 'setrika_kiloan'=>50);
$gaji = array('operator'=>2000000, 'packer'=>2000000, 'setrika'=>1000000);
$poinStandar = array('operator'=>1100,'packer'=>950,'setrika'=>800);

function extra_operasional($user){
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

function poin_cuci_corp($user,$startDate,$endDate) {
  global $con;
  $query = mysqli_query($con,"SELECT COALESCE(SUM(total_item*0.05),0) AS jumlah_poin FROM corp_washing_list WHERE creator_id='$user' AND DATE_FORMAT(created, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
  $data = mysqli_fetch_row($query);
  return round($data[0],2);
}

function poin_packing_corp($user,$startDate,$endDate) {
  global $con;
  $query = mysqli_query($con,"SELECT COALESCE(SUM(total_item*0.05),0) AS jumlah_poin FROM corp_packing_list WHERE creator_id='$user' AND DATE_FORMAT(created, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
  $data = mysqli_fetch_row($query);
  return round($data[0],2);
}

function cuci_kiloan_express($user,$startDate,$endDate){
	global $con;
	$query = mysqli_query($con, "SELECT COALESCE(COUNT(*),0) as bonus, op_cuci FROM reception WHERE op_cuci='$user' AND express<>'0' AND jenis='k' AND (DATE_FORMAT(tgl_cuci, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate') ");
	$data = mysqli_fetch_row($query);
	return round($data[0],2);
}

function cuci_kiloan_priority($user,$startDate,$endDate){
	global $con;
	$query = mysqli_query($con, "SELECT COALESCE(COUNT(*)*0.5,0) as bonus, op_cuci FROM reception WHERE op_cuci='$user' AND priority='1' AND express='0' AND jenis='k' AND (DATE_FORMAT(tgl_cuci, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate') ");
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
	$query = mysqli_query($con, "SELECT SUM(total_bayar) AS total FROM reception WHERE jenis='p' AND cara_bayar<>'Void' AND DATE_FORMAT(tgl_input, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
	$data = mysqli_fetch_row($query);
	return round($data[0],2);
}

function jumlah_kerja_operator_potongan(){
	global $con;
	$query = mysqli_query($con, "SELECT SUM(a.hadir) AS jum FROM extra_operasional AS a INNER JOIN user AS b ON a.id_user=b.user_id WHERE b.level='operator' AND b.jenis='potongan'");
	$data = mysqli_fetch_row($query);
	return round($data[0],2);
}

function jumlah_kerja_setrika_potongan(){
	global $con;
	$query = mysqli_query($con, "SELECT SUM(a.hadir) AS jum FROM extra_operasional AS a INNER JOIN user AS b ON a.id_user=b.user_id WHERE b.level='setrika' AND b.jenis='potongan'");
	$data = mysqli_fetch_row($query);
	return round($data[0],2);
}

function cucian_telat($user,$startDate,$endDate){
	global $con;
	$query = mysqli_query($con, "SELECT COUNT(*) FROM denda_cucian_telat WHERE operator='$user' AND DATE_FORMAT(tgl_denda, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
	$data = mysqli_fetch_row($query);
	return round($data[0],2);	
}

function operator($user,$jenis,$startDate,$endDate){
	global $gaji,$target,$poinStandar;
	if($jenis == 'potongan'){
		$j = 'Potongan';
	} else if($jenis=='kiloan'){
		$j = 'Kiloan';
	}  
	$data['posisi'] = 'Operator';
	$data['jabatan'] = 'Operator '.$j;
	if($user=='afni packer' OR $user=='afni-opr' OR $user=='Risma setrika' OR $user=='sarah setrika') $data['target'] = 0; else $data['target'] = $target['operator'];
	$data['cuci_kiloan'] = poin_cuci_kiloan($user,$startDate,$endDate);
	$data['poin_pengering'] = poin_pengering($user,$startDate,$endDate);
	$data['cuci_potongan'] = poin_cuci_potongan($user,$startDate,$endDate);
	$data['setrika'] = poin_setrika_kiloan($user,$startDate,$endDate)+poin_setrika_potongan($user,$startDate,$endDate)+poin_setrika_gordyn($user,$startDate,$endDate);
	$data['poin_express'] = cuci_kiloan_express($user,$startDate,$endDate)+setrika_express($user,$startDate,$endDate);
	$data['poin_priority'] = cuci_kiloan_priority($user,$startDate,$endDate);
	$data['poin_normal'] = $data['cuci_kiloan']+$data['poin_pengering']+$data['cuci_potongan']+$data['setrika'];
	$data['poin_express_priority'] = $data['poin_express']+$data['poin_priority'];
	$data['pencapaian_rupiah'] = ($data['cuci_kiloan']+$data['poin_pengering']+$data['cuci_potongan']+cuci_kiloan_express($user,$startDate,$endDate)+$data['poin_priority'])*$poinStandar['operator']+($data['setrika']+setrika_express($user,$startDate,$endDate))*$poinStandar['setrika'];
	$data['poin_standar'] = $poinStandar['operator'];
	return $data;
}

function packer($user,$jenis,$startDate,$endDate){
	global $gaji,$target,$poinStandar;
	if($jenis == 'potongan') $j = 'Potongan'; else if($jenis=='kiloan') $j = 'Kiloan'; else $j = '';	
	$data['posisi'] = 'Packer';
	$data['jabatan'] = 'Packer '.$j;	
	if($user=='afni packer' OR $user=='afni-opr' OR $user=='Risma setrika' OR $user=='sarah setrika') $data['target'] = 0; else $data['target'] = $target['packer'];
	$data['packing_kiloan'] = poin_packing_kiloan($user,$startDate,$endDate);
	$data['packing_potongan'] = poin_packing_potongan($user,$startDate,$endDate);
	$data['setrika'] = poin_setrika_kiloan($user,$startDate,$endDate)+poin_setrika_potongan($user,$startDate,$endDate)+poin_setrika_gordyn($user,$startDate,$endDate);
	$data['poin_express'] = packing_express($user,$startDate,$endDate)+setrika_express($user,$startDate,$endDate);
	$data['poin_normal'] = $data['packing_kiloan']+$data['packing_potongan']+$data['setrika'];
	$data['poin_express_priority'] = $data['poin_express'];
	$data['pencapaian_rupiah'] = ($data['packing_kiloan']+$data['packing_potongan']+packing_express($user,$startDate,$endDate))*$poinStandar['packer']+($data['setrika']+setrika_express($user,$startDate,$endDate))*$poinStandar['packer'];
	$data['poin_standar'] = $poinStandar['packer'];
	return $data;

}

function setrika($user,$jenis,$startDate,$endDate){
	global $gaji,$target,$poinStandar;
	if($jenis == 'potongan') $j = 'Potongan'; else if($jenis=='kiloan') $j = 'Kiloan'; else $j = '';  
	$data['posisi'] = 'Setrika';
	$data['jabatan'] = 'Setrika '.$j;			
	if($j=='Potongan') $data['target'] = $target['setrika_potongan']; else if($j=='Kiloan') $data['target'] = $target['setrika_kiloan'];	
	if($user=='afni packer' OR $user=='afni-opr' OR $user=='Risma setrika' OR $user=='sarah setrika'){
		$data['target'] = 0; 
	}	
	$data['setrika'] = poin_setrika_kiloan($user,$startDate,$endDate)+poin_setrika_potongan($user,$startDate,$endDate)+poin_setrika_gordyn($user,$startDate,$endDate);
	$data['poin_express'] = setrika_express($user,$startDate,$endDate);
	$data['poin_normal'] = $data['setrika'];
	$data['poin_express_priority'] = $data['poin_express'];
	$data['pencapaian_rupiah'] = ($data['setrika']+$data['poin_express_priority'])*$poinStandar['setrika'];
	$data['poin_standar'] = $poinStandar['setrika'];
	return $data;

}

function result_poin($user,$posisi,$jenis,$startDate,$endDate){
	if ($posisi=='operator') {
    $data = operator($user,$jenis,$startDate,$endDate);    
  } else if ($posisi=='packer') {
    $data = packer($user,$jenis,$startDate,$endDate);
  } else if ($posisi=='setrika') {
    $data = setrika($user,$jenis,$startDate,$endDate);
  }
  	$data['hotel'] = 0;
  	$data['hadir'] = extra_operasional($user)['hadir'];
  	$data['masuk_malam'] = extra_operasional($user)['masuk_malam'];  	

  	$data['poin_minimal'] = $data['hadir']*$data['target'];
  	$data['insentif_malam'] = $data['poin_normal']/$data['hadir']/2*$data['masuk_malam'];
	
	$data['bagi_brosur'] = extra_operasional($user)['poin_brosur'];
	$data['pencapaian_poin_normal'] = $data['poin_normal'];
	$data['pencapaian_poin_bonus'] = $data['insentif_malam']+$data['bagi_brosur']+$data['poin_express_priority'];
	$data['pencapaian_bonus_rupiah'] = ($data['insentif_malam']+$data['bagi_brosur'])*$data['poin_standar'];
	$data['total_pencapaian_poin'] = $data['pencapaian_poin_normal']+$data['pencapaian_poin_bonus'];
	$data['cucian_telat'] = cucian_telat($user,$startDate,$endDate);
	$data['kasus_operasional'] = extra_operasional($user)['kasus_nota'];
	$data['total_denda_operasional'] = $data['cucian_telat']+$data['kasus_operasional'];
	$data['pencapaian_akhir'] = $data['total_pencapaian_poin']-$data['total_denda_operasional'];
	$data['total_rupiah_denda'] = $data['total_denda_operasional']*$data['poin_standar'];
	$data['rata_harian'] = $data['pencapaian_akhir']/$data['hadir'];
	$data['kekurangan_poin_perbulan'] = ($data['rata_harian']-$data['target'])*$data['hadir'];

	if($user=='afni packer' OR $user=='afni-opr' OR $user=='Risma setrika' OR $user=='sarah setrika') {
  		$data['poin_minimal'] =0;
		$data['insentif_malam'] = 0;
		$data['rata_harian'] = 0;
		$data['kekurangan_poin_perbulan'] = 0;
  	}

	if($data['jabatan']=='Operator Potongan') {
		$data['bonus_omset_potongan'] = (omset_potongan($startDate,$endDate)*0.04)*$data['hadir']/jumlah_kerja_operator_potongan();
		$data['pencapaian_dihitung'] =  ($data['bonus_omset_potongan']/1100)-$data['total_denda_operasional'];
		$data['total_bonus'] = $data['bonus_omset_potongan'];
	} else if($data['jabatan']=='Setrika Potongan') {
		$data['bonus_omset_potongan'] = (omset_potongan($startDate,$endDate)*0.02)*$data['hadir']/jumlah_kerja_setrika_potongan();
		$data['pencapaian_dihitung'] =  ($data['bonus_omset_potongan']/800)-$data['total_denda_operasional'];
		$data['total_bonus'] = $data['bonus_omset_potongan'];
	} else{
		$data['bonus_omset_potongan'] = 0;
		$data['total_bonus'] = ($data['pencapaian_rupiah']+$data['pencapaian_bonus_rupiah'])-$data['poin_minimal']*$data['poin_standar'];
	}

	$data['total_potongan'] = $data['total_rupiah_denda'];
	$data['grand_total'] = $data['total_bonus']-$data['total_potongan'];
	return $data;
}

?>