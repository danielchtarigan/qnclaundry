<?php 

include '../config.php';

$id = $_POST['id'];
$text = $_POST['text'];
$nama_colom = $_POST['nama_colom'];
if($nama_colom=="nama_supplier"){
	$text = strtoupper($_POST['text']);
}
else {
	$text = ucwords($_POST['text']);
}

$update = mysqli_query($con, "UPDATE supplier SET $nama_colom='$text' WHERE id='$id'");
if($update) {
	echo $nama_colom.' berhasil diubah!';
}

?>