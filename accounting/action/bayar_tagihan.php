<?php 
include '../config.php';
session_start();
date_default_timezone_set('Asia/Makassar');
$date = date('Y-m-d H:i:s');


if(isset($_POST['simpan'])){
	if($_POST['cara_bayar']=="--Pilih Cara Bayar--"){ ?>
		<script type="text/javascript">
			alert("Cara Bayar Tidak Boleh Kosong!!");
			location.href="../index.php?menu=Pembayaran";
		</script> <?php
	} else{
		$simpan = mysqli_query($con, "UPDATE pemesanan SET no_faktur='$_POST[no_faktur]', lunas='1', tanggal_lunas='$date', user_lunas='$_SESSION[user_id]' WHERE no_nota='$_POST[id]'");
		if($simpan){ ?>
			<script type="text/javascript">
				alert("Order berhasil dibayar");
				location.href="../index.php?menu=Pembayaran";
			</script> <?php
		}
	}
		
}


?>