<?php 
session_start();
if($_SESSION['cabang']!="makassar"){
	$_SESSION['zonatime'] = date_default_timezone_set('Asia/Jakarta');
} else {
	$_SESSION['zonatime'] = date_default_timezone_set('Asia/Makassar');
}

$nowDate = date('Y-m-d H:i:s');

?>