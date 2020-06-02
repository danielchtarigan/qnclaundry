<?php 
include '../config.php';
session_start();

date_default_timezone_set('Asia/Makassar');

$tanggal = date('Y-m-d H:i:s');
$date = date('Y-m-d');

if($_POST['nomor']=='' || $_POST['supplier']=='--Pilih Nama supplier--' || $_POST['item']=='--Pilih Nama Item--' || $_POST['quantity']=='0'){
	echo '<td colspan="8" align="center" style="color: red">*Form Pemesanan belum terisi semua, silahkan ulangi kembali....!!</td>';
} else{
	$ceknota = mysqli_query($con, "SELECT * FROM penerimaan_bahan_baku WHERE no_penerimaan='$_POST[nomor]'");
	if(mysqli_num_rows($ceknota)>0){
		echo '<td colspan="8" align="center" style="color: red">*Nomor Nota tidak boleh sama..!!</td>';
	} else{
		$no_pesanan = substr($_POST['item'], 0, 10);
		$item = substr($_POST['item'], 13);
		$simpan = mysqli_query($con, "INSERT INTO penerimaan_bahan_baku VALUES ('','$tanggal','$_POST[nomor]','$_SESSION[user_id]','$_POST[supplier]','$no_pesanan','$item','$_POST[quantity]','$_POST[satuan]') ");

		if($simpan){ ?>
			<script type="text/javascript">
				alert("Pesanan berhasil ditambahkan");
				location.href="index.php?menu=Penerimaan";
			</script> 
			
			<?php
			} else { ?>
			<script type="text/javascript">
				alert("Gagal");
				location.href="index.php?menu=Penerimaan";
			</script> 
			
			<?php

			}
	}
		
}	

?>