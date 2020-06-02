<?php
include "../config.php";
if (isset($_POST['id'])) {
	
	
	mysqli_query($con,"delete from faktur_penjualan where id= '".$_POST['id']."'");

}
?>