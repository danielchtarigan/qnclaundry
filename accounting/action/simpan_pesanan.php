<?php 
include '../config.php';
session_start();

date_default_timezone_set('Asia/Makassar');

$tanggal = date('Y-m-d H:i:s');
$date = date('Y-m-d');

if($_POST['nota']=='' || $_POST['supplier']=='--Pilih Nama supplier--' || $_POST['item']=='--Pilih Nama Item--' || $_POST['harga']=='0' ||$_POST['quantity']=='0'){
	echo '<td colspan="8" align="center" style="color: red">*Form Pemesanan belum terisi semua, silahkan ulangi kembali....!!</td>';
} else{
	$ceknota = mysqli_query($con, "SELECT no_nota FROM pemesanan WHERE no_nota='$_POST[nota]'");
	if(mysqli_num_rows($ceknota)>0){
		echo '<td colspan="8" align="center" style="color: red">*Nomor Nota tidak boleh sama..!!</td>';
	} else{
		$simpan = mysqli_query($con, "INSERT INTO pemesanan (id,tanggal_pesan,no_nota,nama_supplier,nama_item,harga,quantity,satuan,nama_pemesan) VALUES ('','$tanggal','$_POST[nota]','$_POST[supplier]','$_POST[item]','$_POST[harga]','$_POST[quantity]','$_POST[satuan]','$_SESSION[user_id]') ");

		if($simpan){ ?>
			<script type="text/javascript">
				alert("Pesanan berhasil ditambahkan");
				location.href="index.php?menu=Pemesanan";
			</script> 
			
			<?php
			}
	}

		
}

	

?>