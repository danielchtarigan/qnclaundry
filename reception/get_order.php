<?php

include '../config.php';
	
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$id_customer = $_POST['id_customer'];
	$offset = ($page-1)*$rows;
	
	$result = array();
	

	$where = "id_customer = '$id_customer' and lunas=false and cuci=false and packing=false and setrika=false";
	$rs = mysqli_query($con,"select count(*) from reception where " . $where);
	$row = mysqli_fetch_row($rs);
	$result["total"] = $row[0];
	
	$rs = mysqli_query($con,"select * from reception where " . $where . " limit $offset,$rows");
	
	$items = array();
	while($row = mysqli_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;
	
	echo json_encode($result);
?>
