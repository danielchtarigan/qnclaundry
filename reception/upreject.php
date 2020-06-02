
<?php 
include "header.php";
include "../config.php"; 

// terima data dari halaman index.php
$not   = $_GET['id'];

// simpan data ke database
$updatev  = mysqli_query($con," update rijeck set status='1' WHERE no_nota='$not'");

if ($updatev) {
	echo "<script>alert('Nota Telah Teriject, lakukan proses SO');</script>";
	echo "<script>document.location='f_so.php';</script>";
	// jika berhasil menyimpan
	//echo('location: f_so.php');
	
	
} else {
	// jika gagal menyimpan
	echo "Data Gagal disimpan";
	
}
?>