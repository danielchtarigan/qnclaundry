<?php

ob_start();

include "../config.php";
session_start();


switch ( $_GET['p'] ) {

	default: echo "Halaman tidak ditemukan"; break;
	case "update":
$no_nota=$_POST['no_nota1'];
$jumlah=$_POST['jumlah'];
$nama_item1=$_POST['nama_item1'];
	
	empty( $jumlah ) ? $err[] = "<h5>* Jumlah belum terisi</h5>" : "";
empty( $no_nota ) ? $err[] = "<h5>* No Nota belum terisi</h5>" : "";
		if ( isset( $err ) ) {

			foreach ( $err as $val ) {
				echo $val;
			}

		} 
		else {
			
	
	
	$con->query("INSERT INTO detail_spk (no_nota,jenis_item,jumlah) VALUES('$no_nota', '$nama_item1', '$jumlah')");
	echo "Sukses";
		
	}
	break;
	case "hapus" :
		$id = $_GET['id'];
		$con->query("DELETE FROM detail_spk WHERE id = '$id'");
		
	break;

}

ob_end_flush();

?>