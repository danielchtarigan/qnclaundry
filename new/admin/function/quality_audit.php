<?php 



function sampel($startDate,$endDate){
	global $con;
	$sql = $con-> query("SELECT COALESCE(COUNT(*)) FROM quality_audit WHERE DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = $sql-> fetch_array();
	return $data[0];
}


function kebersihan($startDate,$endDate){
	global $con;
	$jumSampel = sampel($startDate,$endDate);
	$sql = $con-> query("SELECT (SUM(bersih)/$jumSampel) FROM quality_audit WHERE DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = $sql-> fetch_array();
	return round($data[0],2);
}

function kerapian($startDate,$endDate){
	global $con;
	$jumSampel = sampel($startDate,$endDate);
	$sql = $con-> query("SELECT (SUM(rapi)/$jumSampel) FROM quality_audit WHERE DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = $sql-> fetch_array();
	return round($data[0],2);
}

function keharuman($startDate,$endDate){
	global $con;
	$jumSampel = sampel($startDate,$endDate);
	$sql = $con-> query("SELECT (SUM(harum)/$jumSampel) FROM quality_audit WHERE DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
	$data = $sql-> fetch_array();
	return round($data[0],2);
}

?>