<?php
include '../../../../config.php';
session_start();

function rupiah($angka)
{
	$jadi = "Rp.".number_format($angka,0,',','.');
	return $jadi;
}
date_default_timezone_set('Asia/Jakarta');

$jam1 = date("Y-m-d h:i:s");	 

 if (isset($_GET['nota'])){
	 $no_nota = $_GET['nota'];
	 }


$ot = $_SESSION['nama_outlet'];


 if (isset($_GET['deliver'])){
	 $deliver = $_GET['deliver'];
	 }
 else{
	 $deliver = 'off';
 }
 if (isset($_GET['id'])){
	 $id_cs = $_GET['id'];
	 }

	 

$qrincian5 = mysqli_query($con, "update cris_icon_details set deliver='$deliver' where id_reception='$no_nota'");

	if ($_GET['jenis']=="kiloan"){
?>
<script type="text/javascript">
 alert("Data telah terinput!");
 location.href="../transaksi.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>&nota=<?php echo $no_nota;?>#popup8";
</script>
<?php
		}
	 else{
?>
<script type="text/javascript">
 alert("Data telah terinput!");
 location.href="../transaksi.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>&nota=<?php echo $no_nota;?>#popup8";
</script>
<?php
	 }
	 ?>