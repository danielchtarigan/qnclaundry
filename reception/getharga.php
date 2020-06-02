<?php
if($_POST['item_spk']) {
	$id 		= $_POST['item_spk'];
	$query 		= "select * from `kota` where `id` = ".$id;
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
