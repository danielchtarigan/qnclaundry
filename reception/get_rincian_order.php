<?php

include '../config.php';
	
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$no_nota = $_POST['no_nota'] ;
	$id_customer = $_POST['id_customer'];
	$offset = ($page-1)*$rows;
	
	$result = array();
	

	$where = "id_customer = '$id_customer' and no_nota='$no_nota'";
	
	$rs = mysqli_query($con,"select count(*) from detail_penjualan where " . $where);
	$row = mysqli_fetch_row($rs);
	$result["total"] = $row[0];
	
	$rs = mysqli_query($con,"select * from detail_penjualan where " . $where . " limit $offset,$rows");
	
	$items = array();
	while($row = mysqli_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;
	
	echo json_encode($result);
?>
