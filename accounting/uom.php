<?php 
include 'config.php';

$sql = $con->query("SELECT * FROM satuan_bb WHERE satuan LIKE '%$_GET[term]%' ");
while($row = $sql->fetch_assoc()){
	$data[] = $row['satuan'];
}

echo json_encode($data);

?>