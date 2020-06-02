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
 if (isset($_GET['parfum'])){
	 $parfum = $_GET['parfum'];
	 }
 if (isset($_GET['id'])){
	 $id_cs = $_GET['id'];
	 }

$qrincian5 = mysqli_query($con, "update cris_icon_details set parfum='$parfum' where id_reception='$no_nota'");

if ($_GET['jenis']=="kiloan"){
?>
<script type="text/javascript">
 alert("Data telah terinput!");
 location.href="../index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>&nota=<?php echo $no_nota;?>#popup5";
</script>
<?php
}
else{
?>
<script type="text/javascript">
 alert("Data telah terinput!");
 location.href="../index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>&nota=<?php echo $no_nota;?>#popup7";
</script>
<?php
}
?>