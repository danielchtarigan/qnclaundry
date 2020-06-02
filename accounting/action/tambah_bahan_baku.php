<?php 
include '../config.php';

if(isset($_POST['kategori'])){
	$kategori = $_POST['kategori'];
	if($kategori=="--Pilih Kategori--" || $_POST['item']==""){
		echo "<p style='color: red; font-size: 9pt; text-align: center'>*Kategori atau nama item belum diisi!!</p>";
	} else{
		if($kategori=="Chemical") $kat = "1"; else if($kategori=="Pengemasan") $kat="2"; else if($kategori=="Perlengkapan") $kat="3"; else if($kategori=="Lain-Lain") $kat="4";
		$item_baru = strtoupper($_POST['item']);
		$tambah = mysqli_query($con, "INSERT INTO item_bahan_baku VALUES ('','$item_baru','$kat','')");

		if($tambah){ ?>
			<script type="text/javascript">
				alert("Item baru berhasil ditambahkan");
				location.href="index.php?menu=List_item_bahan_baku";
			</script>

		<?php
		}
	}
}

else if(isset($_POST['hapus'])){
	$hapus = mysqli_query($con, "DELETE FROM item_bahan_baku WHERE id='$_POST[kode]'");
	if($hapus){ ?>
		<script type="text/javascript">
			alert("Item berhasil dihapus");
			location.href='index.php?menu=List_item_bahan_baku';
		</script> <?php
	}
}

	


	

?>