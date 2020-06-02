<?php

ob_start();

include "../config.php";
session_start();

switch ( $_GET['p'] ) {

	default: echo "Halaman tidak ditemukan"; break;

	case "tambah":

		$nama_customer = $_POST['nama_customer'];
		$alamat 	= $_POST['alamat'];
		$no_telp = $_POST['no_telp'];
		$zona = $_POST['zona'];

		empty( $nama_customer ) 	 ? $err[] = "<h5>* nama customer Masih Kosong</h5>" : "";
		empty( $alamat ) 	 ? $err[] = "<h5>* alamat Masih Kosong</h5>" : "";
		empty( $no_telp ) ? $err[] = "<h5>* No Telp Masih Kosong</h5>" : "";
		empty( $zona ) ? $err[] = "<h5>* Pilih Zona</h5>" : "";

		// Cek apakah user_id belum terdaftar
		$sql = $con->query("SELECT no_telp from customer WHERE no_telp = '$no_telp' ");
		
		if ( $sql->num_rows > 0 ) { $err[] = "<h5>* user_id telah terdaftar</h5>"; }

		if ( isset( $err ) ) {

			foreach ( $err as $val ) {
				echo $val;
			}

		} else {

			$con->query("INSERT INTO customer(nama_customer,alamat,no_telp,zona) VALUES ('$nama_customer','$alamat','$no_telp','$zona')");
			$_SESSION['info'] = "Menyimpan";
			echo "Sukses";

		}

	break;

	case "update":

		$id = $_POST['id'];
		$cuci = $_POST['cuci'];
		$pengering = $_POST['pengering'];
		$setrika = $_POST['setrika'];
		$packing = $_POST['packing'];
		$kembali = $_POST['kembali'];
		empty( $cuci ) 	 ? $err[] = "<h5>* Pilih Cuci</h5>" : "";
		empty( $pengering ) 	 ? $err[] = "<h5>* Pilih pengering</h5>" : "";
		empty( $setrika ) 	 ? $err[] = "<h5>* Pilih setrika</h5>" : "";
		empty( $packing ) 	 ? $err[] = "<h5>* Pilih packing</h5>" : "";
		empty( $kembali ) 	 ? $err[] = "<h5>* Pilih kembali</h5>" : "";
		
			

			$con->query("UPDATE reception set cuci = '$cuci', pengering = '$pengering', setrika = '$setrika', packing = '$packing', packing = '$packing', kembali = '$kembali'
							WHERE id = '$id'");
			$_SESSION['info'] = "Mengubah";
			echo "Sukses";

		

	break;

	case "hapus" :

		$id = $_GET['id'];
		$con->query("DELETE FROM reception WHERE id = '$id'");
		$_SESSION['info'] = "Menghapus";
		header("location:data_reception.php");

	break;
}

ob_end_flush();

?>