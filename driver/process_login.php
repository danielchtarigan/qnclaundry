<?php 

include '../config.php';

$post = (isset($_POST['login'])) ? "Login" : "Drop";

switch ($post) {
	case 'Login':

		$name = $_POST['nama'];
		$password = md5($_POST['password']);

		$cek = mysqli_num_rows($con->query("SELECT * FROM user_driver WHERE name='$name' AND password='$password'"));
		if($cek>0){
			echo "1";
		} else {
			echo "Username dan Password salah !";
		}

		break;
	
	case 'Drop':
		
		$name = $_POST['nama'];
		$lokasiform = $_POST['lokasiform'];
		$lokasi = $_POST['lokasi'];
		$keterangan = $_POST['keterangan'];

		$aktif = $con->query("UPDATE user_driver SET status='1', lokasiform='$lokasiform', lokasi='$lokasi', keterangan='$keterangan', created_at=NOW() WHERE name='$name'");

		break;
}