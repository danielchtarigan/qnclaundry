<?php

ob_start();

include "../config.php";
session_start();

switch ( $_GET['p'] ) {

	default: echo "Halaman tidak ditemukan"; break;

	case "tambah":

		$name 	= $_POST['name'];
		$level = $_POST['level'];
		$password = md5($_POST['password']);
		$cabang = $_POST['cabang'];
		if (isset($_POST['jenis'])) $jenis = $_POST['jenis'];


		empty( $name ) 	 ? $err[] = "<h5>* Nama Masih Kosong</h5>" : "";
		empty( $level ) ? $err[] = "<h5>* Pilih Level</h5>" : "";
		empty( $password ) ? $err[] = "<h5>* Password Masih Kosong</h5>" : "";
		//
		// // Cek apakah user_id belum terdaftar
		// $sql = $con->query("SELECT user_id from user WHERE user_id = '$user_id' ");
		//
		// if ( $sql->num_rows > 0 ) { $err[] = "<h5>* user_id telah terdaftar</h5>"; }

		if ( isset( $err ) ) {

			foreach ( $err as $val ) {
				echo $val;
			}

		} else {
			if (!isset($jenis) || $jenis=='')
			$sql = "INSERT INTO user (name,password,level,aktif,cabang) VALUES ('$name','$password','$level','Ya','$cabang')";
			else $sql = "INSERT INTO user (name,password,level,aktif,jenis,cabang) VALUES ('$name','$password','$level','Ya','$jenis','$cabang')";
			$rs = mysqli_query($con,$sql);			
			if (!$rs)
				echo mysqli_error();
			else {
				$_SESSION['info'] = "Menyimpan";
				echo "Sukses";

				$query = mysqli_query($con, "SELECT MAX(user_id) AS user_id FROM user");
				$data = mysqli_fetch_array($query);
				mysqli_query($con, "INSERT INTO extra_operasional (id,id_user) VALUES ('','$data[user_id]')");
			}
		}

	break;

	case "update":

		$user_id = $_POST['user_id'];
		$name 	= $_POST['name'];
		$level = $_POST['level'];
		$cabang = $_POST['cabang'];
		if (isset($_POST['jenis'])) $jenis = $_POST['jenis'];
		$qpassword = mysqli_query($con,"SELECT password FROM user WHERE user_id='$user_id'");
		$oldpassword = mysqli_fetch_array($qpassword)[0];
		if ($oldpassword==$_POST['password']) $password=$oldpassword;
		else $password = md5($_POST['password']);

		empty( $name ) 	 ? $err[] = "<h5>* Nama Masih Kosong</h5>" : "";
		empty( $level ) ? $err[] = "<h5>* Pilih Jenis Kelamin</h5>" : "";
		empty( $password ) ? $err[] = "<h5>* password Masih Kosong</h5>" : "";

		// Cek apakah user_id belum terdaftar
		$sql = $con->query("SELECT user_id from user WHERE user_id = '$user_id'");



		if ( isset( $err ) ) {

			foreach ( $err as $val ) {
				echo $val;
			}

		} else {

			if (!isset($jenis) || $jenis=='')
			$sql="UPDATE user set user_id = '$user_id', name = '$name', level = '$level', password = '$password', jenis = NULL, cabang = '$cabang'
							WHERE user_id = '$user_id'";
			else $sql = "UPDATE user set user_id = '$user_id', name = '$name', level = '$level', password = '$password', jenis = '$jenis', cabang = '$cabang'
							WHERE user_id = '$user_id'";
			$rs = mysqli_query($con,$sql);
			if (!$rs) {
				echo mysqli_error();
			} else {
				$_SESSION['info'] = "Mengubah";
				echo "Sukses";
			}
		}

	break;

	case "hapus" :

		$user_id = $_GET['user_id'];
		$con->query("DELETE FROM user WHERE user_id = '$user_id'");
		$_SESSION['info'] = "Menghapus";
		header("location:user.php");

	break;
}

ob_end_flush();

?>
