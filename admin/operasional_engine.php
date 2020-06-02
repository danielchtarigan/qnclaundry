<?php

ob_start();

include "../config.php";
session_start();

switch ( $_GET['p'] ) {

	default: echo "Halaman tidak ditemukan"; break;
	case "edit_cuci":

		$id = $_POST['id'];
		$no_nota = $_POST['no_nota'];
		
		empty( $no_nota ) 	 ? $err[] = "<h5>* no nota tidak boleh kosong</h5>" : "";
			$con->query("UPDATE cuci set no_nota='$no_nota'
							WHERE id = '$id'");
			$_SESSION['info'] = "Mengubah cuci";
			echo "Sukses";

	break;
	
	case "edit_setrika":

		$id = $_POST['id'];
		$no_nota = $_POST['no_nota'];
		$user_setrika= $_POST['user_setrika'];
		$berat= $_POST['berat'];
		
		empty( $no_nota ) 	 ? $err[] = "<h5>* no nota tidak boleh kosong</h5>" : "";
		empty( $user_setrika ) 	 ? $err[] = "<h5>* berat tidak boleh kosong</h5>" : "";
		empty( $berat ) 	 ? $err[] = "<h5>* berat tidak boleh kosong</h5>" : "";
		
			$con->query("UPDATE setrika set no_nota='$no_nota',user_setrika='$user_setrika',berat='$berat'
							WHERE id = '$id'");
			$_SESSION['info'] = "Mengubah setrika";
			echo "Sukses";

	break;
	

	case "hapus_cuci" :

		$id = $_GET['id'];
		$con->query("DELETE FROM cuci WHERE id = '$id'");
		$_SESSION['info'] = "Menghapus cuci";
		header("location:data_operator.php");

	break;
	
}

ob_end_flush();

?>