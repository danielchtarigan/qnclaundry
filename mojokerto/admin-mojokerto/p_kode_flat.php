<?php
include '../../config.php';
session_start();
if (isset($_POST['d15'])){
$kode=$_POST['kode'];
$kategori=$_POST['kategori'];
$outlet=$_POST['outlet'];
$flat=$_POST['flat'];
$minimum_berat=$_POST['minimum_berat'];
$maksimum_berat=$_POST['maksimum_berat'];
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
mysqli_query($con,"delete from mjk_promo_flat where kode='$kode'");
mysqli_query($con,"insert into mjk_promo_flat values ('', '$kode','$kategori','$outlet','$flat', '$minimum_berat', '$maksimum_berat', '$hari', '$syarat', '$pembayaran', '$hariini', '$_SESSION[name]', 'Aktif')");
}
}
?>
<script type="text/javascript">
 location.href="index.php?menu=flat";
</script>