<?php 
include '../config.php';
date_default_timezone_set('Asia/Makassar');
$tanggal = date('Y-m-d H:i:s');

if($_POST['karyawan']=='--Nama Karyawan--'){
	echo "<tr><td colspan='8' align='center'>Wajib mengisi nama karyawan</td></tr>";
} else if($_POST['item']==''){
	echo "<tr><td colspan='8' align='center'>Wajib mengisi nama barang</td></tr>";
} else if($_POST['harga']=='0'){
	echo "<tr><td colspan='8' align='center'>wajib mengisi harga satuan</td></tr>";
} else if($_POST['quantity']==''){
	echo "<tr><td colspan='8' align='center'>wajib mengisi quantity</td></tr>";
} else if($_POST['satuan']=='--Satuan--'){
	echo "<tr><td colspan='8' align='center'>wajib mengisi satuan barang</td></tr>";
} else{
	$barang = ucwords($_POST['item']);

	$folder = '../doc/image/';
	$image = $_FILES['gbr_nota']['name'];
	$size_image = $_FILES['gbr_nota']['size'];
	$orig = $_FILES['gbr_nota']['tmp_name'];
	$rename_image = date('Hs').$image;
	$move = move_uploaded_file($orig, $folder.$rename_image);

	$query = mysqli_query($con, "INSERT INTO pengeluaran_pety_cash (tanggal,nomor,pay_to,nama_barang,harga,quantity,satuan,nota,ket) VALUES ('$tanggal','$_POST[nomor]','$_POST[karyawan]','$barang','$_POST[harga]','$_POST[quantity]','$_POST[satuan]','$rename_image','$_POST[ket]') "); ?>
	<script type="text/javascript">
		alert("Data baru berhasil ditambahkan!!");
		location.href="index.php?menu=Pengeluaran";
	</script> <?php
}


?>