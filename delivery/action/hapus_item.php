<?php 
include '../../config.php';


$item = $_GET['item'];

mysqli_query($con, "DELETE FROM detail_penjualan WHERE item='$item' AND no_nota='$_GET[nota]'");

?>