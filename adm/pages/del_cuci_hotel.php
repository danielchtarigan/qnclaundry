<?php
include "../configurasi/koneksi.php";
if (isset($_POST['id'])) {
	
	
	$mysqli->query("delete from cuci_hotel where id= '".$_POST['id']."'");

}
?>