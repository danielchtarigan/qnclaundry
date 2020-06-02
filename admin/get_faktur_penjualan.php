<?php












	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$no_faktur = isset($_POST['no_faktur']) ? $_POST['no_faktur'] : '';
	
	$offset = ($page-1)*$rows;
	$result = array();

	include '../config.php';
	$where = "no_faktur like '%$no_faktur%'";
	$rs = mysqli_query($con,"select count(*) from faktur_penjualan where " . $where . "");
	$row = mysqli_fetch_row($rs);
	$result["total"] = $row[0];
	$rs = mysqli_query($con,"select * from faktur_penjualan  where " . $where . "  limit $offset,$rows");
	
	$items = array();
	while($row = mysqli_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;

	echo json_encode($result);

?>