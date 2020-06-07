<?php
include '../config.php';
session_start();

if(isset($_GET['order_item'])) {
	$nota = $_GET['no_order'];
	mysqli_query($con, "Delete From detail_order_item Where no_order='$nota'");
}

else {
	$nota = $_GET['no_nota'];
	$qrincian = mysqli_query($con, "delete from reception where no_nota='$nota'");  
	$qrincian .= mysqli_query($con, "delete from detail_penjualan where no_nota='$nota'");  
	$qrincian .= mysqli_query($con, "delete from rincian_pilihan_order where no_nota='$_GET[no_nota]'");  
	$qtmp = mysqli_query($con, "delete from order_potongan_tmp where id_customer='$_GET[id]'");  
	$qtmp .= mysqli_query($con, "delete from order_tmp where id_customer='$_GET[id]'");  
	$qtmp .= mysqli_query($con, "update pemilik_voucher_pack set status='0' where id_customer='$_GET[id]'");  
}

?>
	<script type="text/javascript">
	 location.href="index.php?id=<?php echo $_GET['id']; ?>";
	</script>
