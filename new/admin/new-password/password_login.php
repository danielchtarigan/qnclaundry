<?php 
include '../../config.php';

session_start();

$passwordPost = (isset($_POST['submit_password'])) ? "password_baru" : $_POST['passwordPost'];

switch ($passwordPost) {
	case 'password_baru':

		$newPassword = md5($_POST['new_password']);	
		$konfirmasiPassword = md5($_POST['konfirmasi_new_password']);

		if($newPassword==$konfirmasiPassword){

			$con->query("UPDATE user SET password='$newPassword' WHERE name='$_SESSION[user_id]'");

			header("location: ../");
		}
		else {
			echo "Konfirmasi password tidak sesuai";

			?>
			<script type="text/javascript">
				setTimeout(function(){
					window.location = "../new-password";
				}, 3000);
			</script>
			<?php
		}


		break;

	case 'cek_password':

		$sql = $con->query("SELECT password FROM user WHERE name='$_SESSION[user_id]'");
		$data = $sql->fetch_assoc();
		$password = $data['password'];
		$oldPassword = md5($_POST['oldPassword']);

		if($password==$oldPassword){
			echo "1";
		}
		else {
			echo "0";
		}	

		break;

}

