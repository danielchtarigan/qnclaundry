<?php
include '../../../config.php';
session_start();
 $nota = $_GET['no_nota'];
  $qrincian = mysqli_query($con, "delete from reception where no_nota='$nota'");  
  $qrincian = mysqli_query($con, "delete from detail_penjualan where no_nota='$nota'");  
  $qrincian = mysqli_query($con, "delete from cris_icon_details where id_detail_penjualan='$_GET[no_nota]'");  
	 $qtmp = mysqli_query($con, "delete from order_potongan_tmp where id_customer='$_GET[id]'");  
	 $qtmp = mysqli_query($con, "delete from order_tmp where id_customer='$_GET[id]'");  
?>
	<script type="text/javascript">
	 location.href="transaksi.php?id=<?php echo $_GET['id']; ?>";
	</script>
