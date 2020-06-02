<?php 
include '../../config.php';
include '../zonawaktu.php';


if(isset($_GET['potongan'])){
	$query = mysqli_query($con, "SELECT * FROM order_potongan_tmp WHERE id_customer='$_GET[id]' AND no_nota='$_GET[nota]'");
	$row = mysqli_fecth_assoc($query);
	echo $row['no_nota'];
}




?>