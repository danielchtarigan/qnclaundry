<?php
session_start(); //perintah agar file ini membaca/mengenal/memulai session
session_destroy(); // perintah menghapus semua session yg ada

if(isset($_COOKIE['login']))
{
$time = time();
setcookie("login", $time - 3600);
}
header("location: login.php");
exit();
?>