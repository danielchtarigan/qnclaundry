<?php 
include '../config.php';



if(isset($_POST['tambah'])){
	$spl_baru = strtoupper($_POST['spl']);
	$alamat = ucwords($_POST['alamat']);
	$phone = $_POST['phone'];
	$cont = ucwords($_POST['cont']);
	$tambah = mysqli_query($con, "INSERT INTO supplier VALUES ('','$spl_baru','$alamat','$phone','$cont','$_POST[ppn]','','','')");
	if($tambah){ 
		echo "Supplier baru ditambahkan!";
	}
}

else if(isset($_POST['hapus'])){
	$hapus = mysqli_query($con, "DELETE FROM supplier WHERE id='$_POST[kode]'");
	if($hapus){ ?>
		<script type="text/javascript">
			alert("supplier berhasil dihapus");
			location.href='index.php?menu=List_supplier';
		</script> <?php
	}
}

else if(isset($_POST['id'])) {
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
}


?>