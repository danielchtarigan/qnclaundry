<?php 
include '../config.php';



if(isset($_POST['tambah'])){
	$spl_baru = strtoupper($_POST['spl']);
	$tambah = mysqli_query($con, "INSERT INTO supplier VALUES ('','$spl_baru')");
		if($tambah){ ?>
		<script type="text/javascript">
			alert("supplier baru berhasil ditambahkan..!!");
			location.href="index.php?menu=List_supplier";
		</script>
		<?php } else{
			echo "Gagal";
		}
}

else if(isset($_POST['hapus'])){
	$hapus = mysqli_query($con, "DELETE FROM supplier WHERE id='$_POST[kode]'");
	if($hapus){ ?>
		<script type="text/javascript">
			alert("supplier berhasil dihapus");
			location.href='index.php?menu=List_supplier';
		</script> <?php
	}
}


?>