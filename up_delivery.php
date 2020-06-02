<?php 
include 'config.php';
$sql = $con->query("SELECT * FROM delivery WHERE jenis_permintaan='Antar' AND status='Sukses' AND DATE(tgl_input) BETWEEN '2019-02-02' AND '2019-02-06' Order BY tgl_input ASC");
echo mysqli_num_rows($sql);
while($data = $sql->fetch_array()){
	$nota = $data['no_faktur'];
	$tglAmbil = $data['tgl_ok'];
	$delivery = $data['nama_pengantar'];
	
	

	mysqli_query($con, "UPDATE reception SET ambil='1', tgl_ambil='$tglAmbil', reception_ambil='$delivery' WHERE no_faktur='$nota' ");
}


?>