<?php 
include '../config.php';


if(isset($_GET['supplier'])){
		echo '<option>--Pilih Nama Item--</option>';
	$query = mysqli_query($con, "SELECT * FROM pemesanan WHERE nama_supplier='$_GET[supplier]'");
	while($row = mysqli_fetch_assoc($query)){
		echo '<option>'.$row['no_nota'].' - '.$row['nama_item'].'</option>';
	}
} else if(isset($_GET['item'])){
	$item = substr($_GET['item'], 13);
	$query = mysqli_query($con, "SELECT harga FROM pemesanan WHERE nama_item='$item'");
	$row = mysqli_fetch_row($query);
	echo $row[0];
} else if(isset($_POST['id'])){
	$hapus = mysqli_query($con, "DELETE FROM penerimaan_bahan_baku WHERE no_penerimaan='$_POST[id]'");

	if($hapus){ ?>
		<script type="text/javascript">
			alert("Data berhasil dihapus");
			location.href="index.php?menu=Penerimaan";
		</script>		
		<?php
	} 
}

?>