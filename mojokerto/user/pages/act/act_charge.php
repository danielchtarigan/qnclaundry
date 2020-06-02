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

 if (isset($_GET['id'])){
	 $id_cs = $_GET['id'];
	 }
 if (isset($_GET['charge'])){
	 $charge = $_GET['charge'];
		 if ($charge==""){
		 $ch = "";
			 }
		 else if ($charge=="190"){
		 $ch = "2";
			 }
		 else{
		 $ch = "1";
			 }
		  $qcharge = mysqli_query($con, "select * from item_spk where id='$charge'");		 
	 	  $rcharge = mysqli_fetch_array($qcharge);

		  $qrincian = mysqli_query($con, "delete from detail_penjualan where item='$rcharge[nama_item]' and no_nota='$no_nota'");
		  
		  $qrincian = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', '$rcharge[nama_item]', '$rcharge[harga]', '1', '$rcharge[harga]', '$no_nota', '$id_cs', '0','')");
	 }


$qrincian5 = mysqli_query($con, "update cris_icon_details set charge='$ch' where id_reception='$no_nota'");
$qrincian5 = mysqli_query($con, "update reception set express='$ch' where no_nota='$no_nota'");

	if (isset($_GET['status'])){
?>
<script type="text/javascript">
 alert("Data telah terinput!");
 location.href="../transaksi.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>&status=<?php echo $_GET['status']; ?>&nota=<?php echo $no_nota;?>#popup11";
</script>
<?php
		}
	 else{
?>
<script type="text/javascript">
 alert("Data telah terinput!");
 location.href="../transaksi.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>&nota=<?php echo $no_nota;?>#popup11";
</script>
<?php
	 }
	 ?>