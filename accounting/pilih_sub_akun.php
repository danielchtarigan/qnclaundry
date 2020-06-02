<?php 
include '../config.php';

if($_GET['kode']=="sa") {
	$sql = mysqli_query($con, "SELECT * FROM sub_akun WHERE kode_nama_akun='$_GET[id]' ");
	echo '<option>--Pilih Sub Akun</option>';
	while($data=mysqli_fetch_assoc($sql)){
		echo '<option value="'.$data['kode_sub_akun'].'">'.$data['kode_sub_akun'].' | '.$data['nama_sub_akun'].'</option>';
	}
}

else if($_GET['kode']=="nt") {
	$sql = mysqli_query($con, "SELECT * FROM nama_item WHERE kode_nama_sub_akun='$_GET[id]' ");
	echo '<option value="">--Nama Item</option>';
	while($data=mysqli_fetch_assoc($sql)){
		echo '<option value="'.$data['kode_item'].'">'.$data['kode_item'].' | '.$data['nama_item'].'</option>';
	}
}

	
?>


