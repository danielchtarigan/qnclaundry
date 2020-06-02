<?php
include '../config.php';
session_start();
if (isset($_POST['d15'])){
$kode=$_POST['kode'];
$kategori=$_POST['kategori'];
$outlet=$_POST['outlet'];
$diskon=$_POST['diskon'];
$minimum_transaksi=$_POST['minimum_transaksi'];
$maksimum_transaksi=$_POST['maksimum_transaksi'];
if (isset($_POST['hari1'])){
	$hari1 = $_POST['hari1'];
}else{
	$hari1 = '';
}

if (isset($_POST['hari2'])){
	$hari2 = $_POST['hari2'];
}else{
	$hari2 = '';
}
	
if (isset($_POST['hari3'])){
	$hari3 = $_POST['hari3'];
}else{
	$hari3 = '';
}

if (isset($_POST['hari4'])){
	$hari4 = $_POST['hari4'];
}else{
	$hari4 = '';
}

if (isset($_POST['hari5'])){
	$hari5 = $_POST['hari5'];
}else{
	$hari5 = '';
}

if (isset($_POST['hari6'])){
	$hari6 = $_POST['hari6'];
}else{
	$hari6 = '';
}

if (isset($_POST['hari7'])){
	$hari7 = $_POST['hari7'];
}else{
	$hari7 = '';
}

if (isset($_POST['pembayaran1'])){
$pembayaran1 = $_POST['pembayaran1'];
}else{
	$pembayaran1 = '';
}

if (isset($_POST['pembayaran2'])){
	$pembayaran2 = $_POST['pembayaran2'];
}else{
	$pembayaran2 = '';
}

$jam1 = $_POST['jam1'];
$jam2 = $_POST['jam2'];

if ($hari1=='' and $hari2=='' and $hari3=='' and $hari4=='' and $hari5=='' and $hari6=='' and $hari7==''){
	?>
    <script type="text/javascript">
	 alert("Silahkan pilih hari pengaktifan terlebih dahulu!!");
	 history.back();
	</script>
    <?php
	}
else if ($pembayaran1=='' and $pembayaran2==''){
	?>
    <script type="text/javascript">
	 alert("Silahkan pilih pilihan pembayaran terlebih dahulu!!");
	 history.back();
	</script>
    <?php
	}
else{

$syarat=$_POST['syarat'];
$hariini=date('Y-m-d');
$hari=$hari1.", ".$hari2.", ".$hari3.", ".$hari4.", ".$hari5.", ".$hari6.", ".$hari7;	
$pembayaran = $pembayaran1.", ".$pembayaran2;
mysqli_query($con,"delete from kode_promo where kode='$kode'");
mysqli_query($con,"insert into kode_promo values ('', '$kode','$kategori','$outlet','$diskon', '$minimum_transaksi', '$maksimum_transaksi', '$hari', '$syarat', '$pembayaran', '$hariini', '$_SESSION[user_id]', 'Aktif', '$jam1' ,'$jam2')");
}
}
?>
<script type="text/javascript">
 location.href="index.php?menu=promo";
</script>