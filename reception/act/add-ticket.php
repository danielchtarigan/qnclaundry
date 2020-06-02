<?php
include '../../config.php';
session_start();
$us=$_SESSION['user_id'];
date_default_timezone_set('Asia/Makassar');
$ot = $_SESSION['nama_outlet'];
$tgl = date('Y-m-d');
if (isset($_GET['kode'])){
 $kode = $_GET['kode'];
}
if (isset($_GET['title'])){
 $title = $_GET['title'];
}
if (isset($_GET['keterangan'])){
 $keterangan = $_GET['keterangan'];
}
$cekref = mysqli_query($con, "insert into ticket values ('$kode','$ot','$title','$keterangan','$tgl','$us', 'aktif')");
?>
<script type="text/javascript">
 alert('Terima kasih! Support tiket anda telah diterima.');
 location.href='../index.php';
</script>	