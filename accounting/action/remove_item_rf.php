<?php 
include '../config.php';


$cek_po = $con->query("SELECT * FROM purchase_order_data WHERE submit='0' AND id='$_POST[id]'");
if(mysqli_num_rows($cek_po)>0){
	$con->query("DELETE FROM purchase_order_data WHERE id='$_POST[id]'");
	echo "Item sukses dihapus!";
}
else {
	echo "Item tidak bisa dihapus karena PO sudah dibuat!";
}

?>