<?php


$target = array('operator'=>65, 'packer'=>75, 'setrika_potongan'=>60, 'setrika_kiloan'=>50);
$gaji = array('operator'=>2000000, 'packer'=>2000000, 'setrika'=>1000000);
$poinStandar = array('operator'=>1100,'packer'=>950,'setrika'=>800);
$poinBonus = array('operator'=>1800,'packer'=>1500,'setrika'=>800);

function daftar_user() {
  global $con;
  $sql = mysqli_query($con,"SELECT DISTINCT name, level FROM user WHERE level='operator' OR level='packer' OR level='setrika' AND aktif='Ya' ORDER BY name ASC");
  return $sql;
}

function daftar_user_corp() {
  global $con;
  $sql = mysqli_query($con,"SELECT id, name FROM corp_user WHERE level='operator' AND aktif='Ya' ORDER BY name ASC");
  return $sql;
}
function poin_cuci($user,$startDate,$endDate) {
  global $con;
  $sql = mysqli_query($con,"SELECT COALESCE(SUM(poin),0) AS jumlah_poin FROM (SELECT IF(jenis='p',jumlah,0.5) AS poin FROM reception WHERE op_cuci='$user' AND DATE_FORMAT(tgl_cuci, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate') T1");
  $data = mysqli_fetch_row($sql);
  return round($data[0],2);
}

function poin_cuci_potongan($user,$startDate,$endDate) {
  global $con;
  $sql = mysqli_query($con,"SELECT COALESCE(SUM(jumlah),0) AS jumlah_poin FROM reception WHERE op_cuci='$user' AND jenis='p' AND DATE_FORMAT(tgl_cuci, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
  $data = mysqli_fetch_row($sql);
  return round($data[0],2);
}

function poin_cuci_kiloan($user,$startDate,$endDate) {
  global $con;
  $sql = mysqli_query($con,"SELECT COUNT(*)*0.5 AS jumlah_poin FROM reception WHERE op_cuci='$user' AND jenis='k' AND DATE_FORMAT(tgl_cuci, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
  $data = mysqli_fetch_row($sql);
  return round($data[0],2);
}

function poin_pengering($user,$startDate,$endDate) {
  global $con;
  $sql = mysqli_query($con,"SELECT COUNT(*)*0.5 AS jumlah_poin FROM reception WHERE op_pengering='$user' AND jenis='k' AND DATE_FORMAT(tgl_pengering, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
  $data = mysqli_fetch_row($sql);
  return round($data[0],2);
}

function poin_setrika($user,$startDate,$endDate) {
  global $con;
  $sql = mysqli_query($con,"SELECT COALESCE(SUM(poin),0) AS jumlah_poin FROM (SELECT IF(jenis='p',jumlah/2,berat) AS poin FROM reception WHERE user_setrika='$user' AND DATE_FORMAT(tgl_setrika, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate') T1");
  $data = mysqli_fetch_row($sql);
  return round($data[0],2);
}

function poin_setrika_potongan($user,$startDate,$endDate) {
  global $con;
  $sql = mysqli_query($con,"SELECT SUM(jumlah*0.5) AS poin FROM reception WHERE user_setrika='$user' AND jenis='p' AND DATE_FORMAT(tgl_setrika, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
  $data = mysqli_fetch_row($sql);
  return round($data[0],2);
}

function poin_setrika_kiloan($user,$startDate,$endDate) {
  global $con;
  $sql = mysqli_query($con,"SELECT COALESCE(SUM(berat),0) AS poin FROM reception WHERE user_setrika='$user' AND jenis='k' AND DATE_FORMAT(tgl_setrika, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
  $data = mysqli_fetch_row($sql);
  return round($data[0],2);
}

function poin_packing($user,$startDate,$endDate) {
  global $con;
  $sql = mysqli_query($con,"SELECT COALESCE(SUM(poin),0) AS jumlah_poin FROM (SELECT IF (jenis='p',jumlah*0.5,1) AS poin FROM reception WHERE user_packing='$user' AND DATE_FORMAT(tgl_packing, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate') T1");
  $data = mysqli_fetch_row($sql);
  return round($data[0],2);
}

function poin_packing_potongan($user,$startDate,$endDate) {
  global $con;
  $sql = mysqli_query($con,"SELECT COALESCE(SUM(jumlah*0.5),0) AS jumlah_poin FROM reception WHERE user_packing='$user' AND jenis='p' AND DATE_FORMAT(tgl_packing, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
  $data = mysqli_fetch_row($sql);
  return round($data[0],2);
}

function poin_packing_kiloan($user,$startDate,$endDate) {
  global $con;
  $sql = mysqli_query($con,"SELECT COUNT(*) AS jumlah_poin FROM reception WHERE user_packing='$user' AND jenis='k' AND DATE_FORMAT(tgl_packing, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
  $data = mysqli_fetch_row($sql);
  return round($data[0],2);
}

function poin_cuci_corp($userId,$startDate,$endDate) {
  global $con;
  $sql = mysqli_query($con,"SELECT COALESCE(SUM(total_item*0.05),0) AS jumlah_poin FROM corp_washing_list WHERE creator_id='$userId' AND DATE_FORMAT(created, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
  $data = mysqli_fetch_row($sql);
  return round($data[0],2);
}

function poin_packing_corp($userId,$startDate,$endDate) {
  global $con;
  $sql = mysqli_query($con,"SELECT COALESCE(SUM(total_item*0.05),0) AS jumlah_poin FROM corp_packing_list WHERE creator_id='$userId' AND DATE_FORMAT(created, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
  $data = mysqli_fetch_row($sql);
  return round($data[0],2);
}

function jumlah_hari_kerja($user,$startDate,$endDate) {
  global $con;
  $sql = mysqli_query($con,"SELECT COUNT(*) FROM (
    SELECT DATE_FORMAT(tgl_cuci, '%Y/%m/%d') AS tanggal FROM reception WHERE op_cuci='$user' AND DATE_FORMAT(tgl_cuci, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'
    UNION SELECT DATE_FORMAT(tgl_pengering, '%Y/%m/%d') AS tanggal FROM reception WHERE op_pengering='$user' AND DATE_FORMAT(tgl_pengering, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'
    UNION SELECT DATE_FORMAT(tgl_setrika, '%Y/%m/%d') AS tanggal FROM reception WHERE user_setrika='$user' AND DATE_FORMAT(tgl_setrika, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'
    UNION SELECT DATE_FORMAT(tgl_packing, '%Y/%m/%d') AS tanggal FROM reception WHERE user_packing='$user' AND DATE_FORMAT(tgl_packing, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'
  ) T1");
  $data = mysqli_fetch_row($sql);
  return round($data[0],2);
}

function jumlah_hari_kerja_corp($userId,$startDate,$endDate) {
  global $con;
  $sql = mysqli_query($con,"SELECT COUNT(*) FROM (
    SELECT DATE_FORMAT(created, '%Y/%m/%d') AS tanggal FROM corp_washing_list WHERE creator_id='$userId' AND DATE_FORMAT(created, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'
    UNION SELECT DATE_FORMAT(created, '%Y/%m/%d') AS tanggal FROM corp_packing_list WHERE creator_id='$userId' AND DATE_FORMAT(created, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'
  ) T1");
  $data = mysqli_fetch_row($sql);
  return round($data[0],2);
}

function laporan_operator($user,$startDate,$endDate) {
  global $target, $gaji;
  $data['jabatan'] = 'Operator';
  $data['target_harian'] = $target['operator'];
  $data['cuci_kiloan'] = poin_cuci_kiloan($user,$startDate,$endDate);
  $data['cuci_potongan'] = poin_cuci_potongan($user,$startDate,$endDate);
  $data['pengering'] = poin_pengering($user,$startDate,$endDate);
  $data['setrika'] = poin_setrika($user,$startDate,$endDate);
  $data['total_poin'] = $data['cuci_kiloan'] + $data['cuci_potongan'] + $data['pengering'] + $data['setrika'];
  $data['qa'] = qa_operator($user,$startDate,$endDate);
  $data['gaji_standar'] = $gaji['operator'];
  return $data;
}

function laporan_packer($user,$startDate,$endDate) {
  global $target, $gaji;
  $data['jabatan'] = 'Packer';
  $data['target_harian'] = $target['packer'];
  $data['setrika'] = poin_setrika($user,$startDate,$endDate);
  $data['packing_potongan'] = poin_packing_potongan($user,$startDate,$endDate);
  $data['packing_kiloan'] = poin_packing_kiloan($user,$startDate,$endDate);
  $data['total_poin'] = $data['packing_potongan'] + $data['packing_kiloan'] + $data['setrika'];
  $data['qa'] = qa_packer($user,$startDate,$endDate);
  $data['gaji_standar'] = $gaji['packer'];
  return $data;
}

function laporan_setrika($user,$startDate,$endDate) {
  global $con,$target,$gaji;
  $sql = mysqli_query($con,"SELECT jenis FROM user WHERE name='$user' AND level='setrika'");
  $jenis = mysqli_fetch_row($sql)[0];
  if ($jenis=='potongan') {
    $data['jabatan'] = 'Setrika Potongan';
    $data['target_harian'] = $target['setrika_potongan'];
  } else {
    $data['jabatan'] = 'Setrika Kiloan';
    $data['target_harian'] = $target['setrika_kiloan'];
  }
  $data['gaji_standar'] = $gaji['setrika'];
  $data['setrika'] = poin_setrika($user,$startDate,$endDate);
  $data['total_poin'] = $data['setrika'];
  $data['qa'] = qa_setrika($user,$startDate,$endDate);
  return $data;
}

function laporan_corp($userId,$startDate,$endDate) {
  global $target,$gaji,$poinStandar,$poinBonus;
  $data['jabatan'] = 'Operator Corporate';
  $data['target_harian'] = $target['operator'];
  $data['cuci_corp'] = poin_cuci_corp($userId,$startDate,$endDate);
  $data['packing_corp'] = poin_packing_corp($userId,$startDate,$endDate);
  $data['jumlah_hari_kerja'] = jumlah_hari_kerja_corp($userId,$startDate,$endDate);
  $data['target_bulanan'] = $data['target_harian']*$data['jumlah_hari_kerja'];
  $data['total_poin'] = $data['cuci_corp']+$data['packing_corp'];
  $data['gaji_standar'] = $gaji['operator'];
  $data['selisih_poin'] = $data['total_poin']-$data['target_bulanan'];
  $data['gaji_bruto'] = ($data['jumlah_hari_kerja']/25)*$data['gaji_standar'];
  if ($data['selisih_poin']>=0) $data['gaji_bonus'] = $data['selisih_poin']*$poinBonus['operator'];
  else $data['gaji_bonus'] = $data['selisih_poin']*$poinStandar['operator'];
  $data['gaji_bersih'] = $data['gaji_bruto']+$data['gaji_bonus'];
  $data['qa'] = '-';
  return $data;
}

function laporan_pegawai($user,$jabatan,$startDate,$endDate) {
  global $poinStandar,$poinBonus;
  if ($jabatan=='operator') {
    $data = laporan_operator($user,$startDate,$endDate);
  } else if ($jabatan=='packer') {
    $data = laporan_packer($user,$startDate,$endDate);
  } else if ($jabatan=='setrika') {
    $data = laporan_setrika($user,$startDate,$endDate);
  }
  $data['jumlah_hari_kerja'] = jumlah_hari_kerja($user,$startDate,$endDate);
  $data['target_bulanan'] = $data['jumlah_hari_kerja']*$data['target_harian'];
  $data['gaji_bruto'] = ($data['jumlah_hari_kerja']/25)*$data['gaji_standar'];
  $data['selisih_poin'] = $data['total_poin']-$data['target_bulanan'];
  if ($data['selisih_poin']>=0) $data['gaji_bonus'] = $data['selisih_poin']*$poinBonus[$jabatan];
  else $data['gaji_bonus'] = $data['selisih_poin']*$poinStandar[$jabatan];
  $data['gaji_bersih'] = $data['gaji_bruto'] + $data['gaji_bonus'];
  return $data;
}

function progres_pegawai_corp($username) {
  global $con, $target;
  $sql = mysqli_query($con,"SELECT id FROM corp_user WHERE username='$username'");
  $userId = mysqli_fetch_row($sql)[0];

  $curDate = date("Y/m/d");
  $curDay = date("d");
  $curMonth = date("m");
  $curYear = date("Y");
  if ($curDay<26) {
    $startDate = date("Y/m/d", mktime(0,0,0,$curMonth-1,26,$curYear));
    $endDate = date("Y/m/d", mktime(0,0,0,$curMonth,25,$curYear));
  } else {
    $startDate = date("Y/m/d", mktime(0,0,0,$curMonth,26,$curYear));
    $endDate = date("Y/m/d", mktime(0,0,0,$curMonth+1,25,$curYear));
  }
  $startDateLastMonth = date("Y/m/d", strtotime('-1 month',strtotime($startDate)));
  $endDateLastMonth = date("Y/m/d", strtotime('-1 month',strtotime($endDate)));

  $data['jumlah_hari_kerja'] = jumlah_hari_kerja_corp($userId,$startDate,$endDate);
  $data['jumlah_hari_kerja_bulan_lalu'] = jumlah_hari_kerja_corp($userId,$startDateLastMonth,$endDateLastMonth);
  $data['target_harian'] = $target['operator'];
  $data['target_bulan_ini'] = $data['jumlah_hari_kerja']*$data['target_harian'];
  $data['target_bulan_lalu'] = $data['jumlah_hari_kerja_bulan_lalu']*$data['target_harian'];
  $data['poin_bulan_ini'] = poin_cuci_corp($userId,$startDate,$endDate)+poin_packing_corp($userId,$startDate,$endDate);
  $data['poin_bulan_lalu'] = poin_cuci_corp($userId,$startDateLastMonth,$endDateLastMonth)+poin_packing_corp($userId,$startDateLastMonth,$endDateLastMonth);
  $data['poin_harian'] = poin_cuci_corp($userId,$curDate,$curDate)+poin_packing_corp($userId,$curDate,$curDate);
  return $data;
}

function progres_pegawai($user,$jabatan) {
  $curDay = date("d");
  $curMonth = date("m");
  $curYear = date("Y");
  if ($curDay<26) {
    $startDate = date("Y/m/d", mktime(0,0,0,$curMonth-1,26,$curYear));
    $endDate = date("Y/m/d", mktime(0,0,0,$curMonth,25,$curYear));
  } else {
    $startDate = date("Y/m/d", mktime(0,0,0,$curMonth,26,$curYear));
    $endDate = date("Y/m/d", mktime(0,0,0,$curMonth+1,25,$curYear));
  }
  $startDateLastMonth = date("Y/m/d", strtotime('-1 month',strtotime($startDate)));
  $endDateLastMonth = date("Y/m/d", strtotime('-1 month',strtotime($endDate)));
  if ($jabatan=='operator') {
    $data = progres_operator($user,$startDate,$endDate,$startDateLastMonth,$endDateLastMonth);
  } else if ($jabatan=='packer') {
    $data = progres_packer($user,$startDate,$endDate,$startDateLastMonth,$endDateLastMonth);
  } else if ($jabatan=='setrika') {
    $data = progres_setrika($user,$startDate,$endDate,$startDateLastMonth,$endDateLastMonth);
  }
  $data['jumlah_hari_kerja'] = jumlah_hari_kerja($user,$startDate,$endDate);
  $data['target_bulan_ini'] = $data['target_harian']*$data['jumlah_hari_kerja'];
  $data['jumlah_hari_kerja_bulan_lalu'] = jumlah_hari_kerja($user,$startDateLastMonth,$endDateLastMonth);
  $data['target_bulan_lalu'] = $data['target_harian']*$data['jumlah_hari_kerja_bulan_lalu'];
  $data['otp_bulan_ini'] = count_otp($startDate,$endDate);
  $data['otp_bulan_lalu'] = count_otp($startDateLastMonth,$endDateLastMonth);
  return $data;
}

function progres_operator($user,$startDate,$endDate,$startDateLastMonth,$endDateLastMonth) {
  global $target;
  $curDate = date("Y/m/d");
  $data['poin_harian'] = poin_cuci($user,$curDate,$curDate)+poin_pengering($user,$curDate,$curDate);
  $data['poin_bulan_ini'] = poin_cuci($user,$startDate,$endDate)+poin_pengering($user,$startDate,$endDate);
  $data['poin_bulan_lalu'] = poin_cuci($user,$startDateLastMonth,$endDateLastMonth)+poin_pengering($user,$startDateLastMonth,$endDateLastMonth);
  $data['qa_bulan_ini'] = qa_operator($user,$startDate,$endDate);
  $data['qa_bulan_lalu'] = qa_operator($user,$startDateLastMonth,$endDateLastMonth);
  $data['target_harian'] = $target['operator'];
  return $data;
}

function progres_packer($user,$startDate,$endDate,$startDateLastMonth,$endDateLastMonth) {
  global $target;
  $curDate = date("Y/m/d");
  $data['poin_harian'] = poin_packing($user,$curDate,$curDate);
  $data['poin_bulan_ini'] = poin_packing($user,$startDate,$endDate);
  $data['poin_bulan_lalu'] = poin_packing($user,$startDateLastMonth,$endDateLastMonth);
  $data['qa_bulan_ini'] = qa_packer($user,$startDate,$endDate);
  $data['qa_bulan_lalu'] = qa_packer($user,$startDateLastMonth,$endDateLastMonth);
  $data['target_harian'] = $target['packer'];
  return $data;
}

function progres_setrika($user,$startDate,$endDate,$startDateLastMonth,$endDateLastMonth) {
  global $con,$target;
  $curDate = date("Y/m/d");
  $sql = mysqli_query($con,"SELECT jenis FROM user WHERE name='$user'");
  $jenis = mysqli_fetch_row($sql)[0];
  if ($jenis=='kiloan') {
    $data['target_harian'] = $target['setrika_kiloan'];
  } else {
    $data['target_harian'] = $target['setrika_potongan'];
  }
  $data['poin_bulan_ini'] = poin_setrika($user,$startDate,$endDate);
  $data['poin_bulan_lalu'] = poin_setrika($user,$startDateLastMonth,$endDateLastMonth);
  $data['poin_harian'] = poin_setrika($user,$curDate,$curDate);
  return $data;
}

function qa_operator($user,$startDate,$endDate) {
  global $con;
  $qasql = mysqli_query($con, "select avg(bersih) as avg_bersih, count(bersih) as c_bersih, sum(bersih) as t_bersih from quality_audit a, reception b where a.no_nota=b.no_nota and DATE_FORMAT(a.tgl_input, '%Y/%m/%d') between '$startDate' and '$endDate' and b.op_cuci='$user'");
  $qa = mysqli_fetch_row($qasql);
  return round($qa[0],2);
}
function qa_packer($user,$startDate,$endDate) {
  global $con;
  $qasql = mysqli_query($con, "select avg(harum) as avg_harum from quality_audit a, reception b where a.no_nota=b.no_nota and DATE_FORMAT(a.tgl_input, '%Y/%m/%d') between '$startDate' and '$endDate' and b.user_packing='$user'");
  $qa = mysqli_fetch_row($qasql);
  return round($qa[0],2);
}
function qa_setrika($user,$startDate,$endDate) {
  global $con;
  $qasql = mysqli_query($con, "select avg(rapi) as avg_bersih from quality_audit a, reception b where a.no_nota=b.no_nota and DATE_FORMAT(a.tgl_input, '%Y/%m/%d') between '$startDate' and '$endDate' and b.user_setrika='$user'");
  $qa = mysqli_fetch_row($qasql);
  return round($qa[0],2);
}

function count_otp($startDate,$endDate) {
  global $con;
  $sql = mysqli_query($con,"SELECT COUNT(*) AS total, SUM(DATEDIFF(DATE_FORMAT(tgl_packing,'%Y/%m/%d'),DATE_FORMAT(tgl_input,'%Y/%m/%d'))>=2) AS otp FROM reception WHERE DATE_FORMAT(tgl_input,'%Y/%m/%d') BETWEEN '$startDate' AND '$endDate'");
  $data = mysqli_fetch_assoc($sql);
  if ($data['total']>0) {
    $persenotp = ($data['otp']/$data['total'])*100;
    return round($persenotp,2);
  } else return 0;
}
?>
