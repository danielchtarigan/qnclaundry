<?php
include '../../config.php';
session_start();

function rupiah($angka)
{
	$jadi = "Rp.".number_format($angka,0,',','.');
	return $jadi;
}
date_default_timezone_set('Asia/Makassar');

$jam1 = date("Y-m-d h:i:s");	 

$ot = $_SESSION['nama_outlet'];

 if (isset($_GET['nota'])){
	 $no_nota = $_GET['nota'];
	 }
 if (isset($_GET['hanger'])){
	 $hanger = $_GET['hanger'];
	 }
 if (isset($_GET['hanger_plastic'])){
	 $hanger_plastic = $_GET['hanger_plastic'];
	 }
 if (isset($_GET['id'])){
	 $id_cs = $_GET['id'];
	 }

$qrincian5 = mysqli_query($con, "update cris_icon_details set hanger='$hanger', hanger_plastic='$hanger_plastic' where id_reception='$no_nota'");

?>
<script type="text/javascript">
 alert("Data telah terinput!");
 location.href="../index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>&nota=<?php echo $no_nota;?>#popup7";
</script>