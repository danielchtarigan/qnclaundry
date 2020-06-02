<?php 

session_start();
// Test sesi jika is_auth telah di set berarti login sukses
// jika tidak maka diarahkan ke login.php
if (!isset($_SESSION["is_auth"])) {
	unset($_SESSION['is_auth']);
	session_destroy();
	header("location: ../index.php");
	exit;
}
else if (isset($_REQUEST['logout']) && $_REQUEST['logout'] == "true") {
	// logout dengan uset
	unset($_SESSION['is_auth']);
	session_destroy();
	// setelah logout, kembalikan ke login.php
	header("location: ../index.php");
	exit;
}

?>