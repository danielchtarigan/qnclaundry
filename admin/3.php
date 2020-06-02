<?php
include '../config.php';

	
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$nama_customer = isset($_POST['nama_customer']) ? mysqli_real_escape_string($_POST['nama_customer']) : '';
	$no_nota = isset($_POST['no_nota']) ? mysqli_real_escape_string($_POST['no_nota']) : '';
	
	$offset = ($page-1)*$rows;
	
	$result = array();
	
	$where = "nama_customer like '$nama_customer%' and no_nota like '$no_nota%'";
	$rs = mysqli_query($con,"select count(*) from reception where " . $where);
	$row = mysqli_fetch_row($rs);
	$result["total"] = $row[0];
	
	$rs = mysqli_query($con,"select * from reception where " . $where . " limit $offset,$rows");
	
	$items = array();
	while($row = mysqli_fetch_array($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;
	
	echo json_encode($result);
?>