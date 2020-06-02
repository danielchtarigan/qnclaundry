<?php 

include '../config.php';

$lokasi = $_POST['lokasi'];

switch ($lokasi) {
	case 'outlet':
		$sql = $con->query("SELECT nama_outlet, id_outlet FROM outlet WHERE Kota='Makassar' AND id_outlet<>'12' AND id_outlet<>'20' ORDER BY nama_outlet ASC");
		while($res = $sql->fetch_array()){
			echo '<option value="'.$res[0].'">'.$res[0].'</option>';
		}
		break;
	
	default:
		echo '<option value="Toddopuli">Toddopuli</option>';
		echo '<option value="Daya">Antang</option>';
		break;
}


