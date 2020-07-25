<?php
ini_set('session.cookie_domain', '.qnclaundry.com');
$SETT = array (
	'db_host'	=> 'localhost',
	'db_username' 	=> 'qnclaund_qncop',
	'db_password' 	=> 'kiloan123',
	'db_name'	=> 'qnclaund_qncop'
);

$con = new mysqli($SETT['db_host'], $SETT['db_username'], $SETT['db_password'], $SETT['db_name']);

if ($con->connect_error){
	echo "Gagal terkoneksi ke database : (".$mysqli->connect_error.")".$mysqli->connect_error;
}


