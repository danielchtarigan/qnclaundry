<?php 
include '../config.php';

if(isset($_POST['kode'])){
	$kode = $_POST['kode'];
	$newitem = ucwords($_POST['item_baru']);
	$edit = mysqli_query($con, "UPDATE nama_item SET nama_item='$newitem' WHERE kode_item='$kode'");
	if($edit){
		echo '<p style="color: #9beca5; text-align: center;">Item berhasil diubah!!</p>';
	} 
} else if(isset($_POST['kodex'])){;
	$hapus = mysqli_query($con, "DELETE FROM nama_item WHERE kode_item='$_POST[kodex]'"); 
	if($hapus){ 
	echo 'OK' ?>
	<script type="text/javascript">
		location.href="index.php?menu=list_akun";
	</script>
	<?php
	}
}
?>