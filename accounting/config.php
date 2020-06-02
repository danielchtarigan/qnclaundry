<?php
$SETT = array (
	'db_host'	=> 'localhost',
	'db_username' 	=> 'qnclaund_acct',
	'db_password' 	=> 'shieldagent123',
	'db_name'	=> 'qnclaund_acct'
);

$con = new mysqli($SETT['db_host'], $SETT['db_username'], $SETT['db_password'], $SETT['db_name']);
$conn = mysqli_connect('localhost','qnclaund_qncop','kiloan123','qnclaund_qncop');

if ($con->connect_error || $conn->connect_error){
	echo "Gagal terkoneksi ke database : (".$mysqli->connect_error.")".$mysqli->connect_error;
}