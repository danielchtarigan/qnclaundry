<?php 

function kas_delivery($user_id) {
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(total_bayar),0) AS total FROM reception WHERE cara_bayar='Cash' AND lunas=true AND nama_reception='$user_id'");
	$data = mysqli_fetch_row($sql);
	return $data[0];
}

function biaya_delivery($user_id) {
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(charge),0) AS total FROM delivery WHERE nama_pengantar='$user_id'");
	$data = mysqli_fetch_row($sql);
	return $data[0];
}

function setoran_delivery($user_id) {
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) AS total FROM setoran_delivery WHERE nama_delivery='$user_id'");
	$data = mysqli_fetch_row($sql);
	return $data[0];
}


function saldo_delivery($user_id) {
	$data['kas_order'] = kas_delivery($user_id);	
	$data['setoran_delivery'] = setoran_delivery($user_id);
	$data['charge_delivery'] = biaya_delivery($user_id)-$data['setoran_delivery'];	
	if($data['charge_delivery']<0){
		$data['kas_order'] = $data['kas_order']+$data['charge_delivery'];
		$data['charge_delivery'] = 0;
	}	
	$data['saldo'] = $data['kas_order']+$data['charge_delivery'];
	return $data;
}


?>