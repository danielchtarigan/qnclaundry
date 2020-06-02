<?php 
include 'config.php';




$sql = mysqli_query($con, "SELECT * FROM penerimaan_bahan_baku ");
while($data=mysqli_fetch_assoc($sql)){
	echo $data['nama_supplier'].'<br>';
}


?>