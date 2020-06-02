<?php
include '../../config.php';
session_start();

function rupiah($angka){
	$jadi = "Rp.".number_format($angka,0,',','.');
	return $jadi;
}
date_default_timezone_set('Asia/Makassar');

$jam1 = date("Y-m-d H:i:s");	 

if (isset($_GET['nota'])){
 $nota = $_GET['nota'];
}

$workshop = $_SESSION['workshop'];
$user_id= $_SESSION['user_id'];

$qharga = mysqli_query($con, "update reception set workshop='$workshop', tgl_workshop='$jam1', op_workshop='$user_id' where no_nota='$nota'");	
if ($qharga){
?>
<script type="application/javascript">
// alert("Sukses!");
 location.href='../index.php?menu=check_in_workshop';
</script>
<?php
}
else{
?>
<script type="application/javascript">
 alert("Nota tidak ditemukan");
 location.href='../index.php?menu=check_in_workshop';
</script>
<?php
}
?>