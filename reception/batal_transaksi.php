<?php
include '../config.php';
session_start();
  

  $qrec = mysqli_query($con, "select * from reception where no_nota='$_GET[no_nota]'");  
  $rrec = mysqli_fetch_array($qrec);
  $totalawal = $rrec['total_bayar'];
  $qrin = mysqli_query($con, "select * from detail_penjualan where no_nota='$_GET[no_nota]' and item='$_GET[id]'");  
  $rrin = mysqli_fetch_array($qrin);
  $kurang = $rrin['total'];
  $totalbaru = $totalawal-$kurang;
  $qrincian2 = mysqli_query($con, "UPDATE rincian_pilihan_order SET charge='0' WHERE no_nota='$_GET[no_nota]'");
  $qrec = mysqli_query($con, "update reception set total_bayar='$totalbaru', express='0' where no_nota='$_GET[no_nota]'");  
  $qrincian = mysqli_query($con, "delete from detail_penjualan where no_nota='$_GET[no_nota]' and item='$_GET[id]'");  

?>
	<script type="text/javascript">
	 alert('Data telah terhapus!');
	 history.back();
	</script>
