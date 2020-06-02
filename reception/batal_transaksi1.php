<?php
include '../config.php';
session_start();
  if ($_GET['kode']=='p'){	  
	$qrec = mysqli_query($con, "update cris_icon_details set parfum='no' where id_detail_penjualan='$_GET[no_nota]'");  
  }

  if ($_GET['kode']=='d'){	  
	$qrec = mysqli_query($con, "update cris_icon_details set deliver='off' where id_detail_penjualan='$_GET[no_nota]'");  
  }

  if ($_GET['kode']=='ho'){	  
	$qrec = mysqli_query($con, "update cris_icon_details set hanger_own='off' where id_detail_penjualan='$_GET[no_nota]'");  
  }

  if ($_GET['kode']=='h'){	
  $qrec = mysqli_query($con, "select * from reception where no_nota='$_GET[no_nota]'");  
  $rrec = mysqli_fetch_array($qrec);
  $totalawal = $rrec['total_bayar'];
  $qrin = mysqli_query($con, "select * from cris_icon_details where id_detail_penjualan='$_GET[no_nota]'");  
  $rrin = mysqli_fetch_array($qrin);
  $kurang = $rrin['hanger']*2500;
  $totalbaru = $totalawal-$kurang;

  $qrec = mysqli_query($con, "update reception set total_bayar='$totalbaru' where no_nota='$_GET[no_nota]'");  

	$qrec = mysqli_query($con, "update cris_icon_details set hanger='0' where id_detail_penjualan='$_GET[no_nota]'");  
  }

  if ($_GET['kode']=='hp'){	  
  $qrec = mysqli_query($con, "select * from reception where no_nota='$_GET[no_nota]'");  
  $rrec = mysqli_fetch_array($qrec);
  $totalawal = $rrec['total_bayar'];
  $qrin = mysqli_query($con, "select * from cris_icon_details where id_detail_penjualan='$_GET[no_nota]'");  
  $rrin = mysqli_fetch_array($qrin);
  $kurang = $rrin['hanger_plastic']*2000;
  $totalbaru = $totalawal-$kurang;

  $qrec = mysqli_query($con, "update reception set total_bayar='$totalbaru' where no_nota='$_GET[no_nota]'");  

	$qrec = mysqli_query($con, "update cris_icon_details set hanger_plastic='0' where id_detail_penjualan='$_GET[no_nota]'");  
  }

?>
	<script type="text/javascript">
	 alert('Data telah terhapus!');
	 history.back();
	</script>
