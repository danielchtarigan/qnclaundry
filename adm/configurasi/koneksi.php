<?php
require_once('timezone.php');
require_once('class_fungsi_string.php');
require_once('class_fungsi_keamanan.php');
require_once('class.SecuringData.php');
require_once('fungsi_indotgl.php');
require_once('fungsi_masaberlaku.php');

//Koneksi
$host="localhost";
$user="qnclaund_qncop";
$pass="kiloan123";
$database="qnclaund_qncop";
$mysqli= new mysqli($host,$user,$pass,$database);

$alamat = "http://localhost/cms_sederhana/";
$template = "http://localhost/cms_sederhana/template/";
$secure = new keamanan_sistem;
$str = new fungsi_string;
$SD = new SecuringData;
?>