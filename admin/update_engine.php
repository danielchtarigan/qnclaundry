<?php

ob_start();

include "../config.php";
session_start();

switch ( $_GET['p'] ) {

	default: echo "Halaman tidak ditemukan"; break;
	case "update":

		$id = $_POST['id'];
		$no_nota = $_POST['no_nota'];
		$nama_outlet = $_POST['nama_outlet'];
			$con->query("update reception set no_nota='$no_nota',nama_outlet='$nama_outlet' WHERE id='$id'");
			$_SESSION['info'] = "Mengubah";
			echo "Sukses";

	break;

}

ob_end_flush();

?>