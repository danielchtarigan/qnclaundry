<?php
if($_POST['itemklp']) {
	$id 		= $_POST['provinsi'];
	$query 		= "select * from `kota` where `idprovinsi` = ".$id;
	$results 	= mysql_query( $query);
	$total 		= mysql_num_rows($results);
	
	if ($total >0) {
		while ($rows = mysql_fetch_assoc($results)) {
			echo '<option value="'.$rows['idkota'].'">'.$rows['nama_kota'].'</option>';
		}
	} else {
		echo '<option value="" selected="selected">Data kota belum diisi diprovinsi Ini</option>';
	}
}
?>
