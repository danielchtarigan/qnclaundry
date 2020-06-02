<?php 
include 'config.php';


if(isset($_POST['catatan'])) {
	$cekCat = mysqli_query($con, "SELECT * FROM catatan_po WHERE nomor_po='$_POST[nomor]'");
	if(mysqli_num_rows($cekCat)<1) {
		$sql = "INSERT INTO catatan_po (nomor_po,total,catatan) VALUES ('$_POST[nomor]','$_POST[total]','$_POST[catatan]')";		
	} else {
		$sql = "UPDATE catatan_po SET catatan='$_POST[catatan]', total='$_POST[total]' WHERE nomor_po='$_POST[nomor]'";
	}

	if($con->query($sql)) {
		echo "Catatan disimpan!";
	} else {
		echo "Gagal menyimpan catatan!";
	}
}

else {
	$id = $_POST['id'];
	$text = str_replace(",", "", $_POST['text']);
	$nama_colom = $_POST['nama_colom'];

	$sql = $con->query("UPDATE purchase_order_data SET $nama_colom='$text' WHERE id='$id'");

	if($sql){
		echo "Kolom ".$nama_colom." berhasil diubah";

	}
}


?>