<?php 

include '../config.php';

$nowDate = $_GET['tgl'];
$sql = $con->query("SELECT DISTINCT(id_user) FROM log_rcp WHERE tgl_log LIKE '%$nowDate%' ORDER BY id_user ASC");
while($row = $sql->fetch_array()){

	$sql2 = $con->query("SELECT * FROM tutup_shift WHERE tanggal_tutup LIKE '%$nowDate%' AND dibuat_oleh='$row[0]'");
	$csql2 = mysqli_num_rows($sql2);	
	if($csql2==0) {
		$userId = $row[0];

		echo '<option>'.$userId.'</option>';
	}

}

?>