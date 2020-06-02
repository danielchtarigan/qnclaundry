<?php 

include '../../config.php';
include '../zonawaktu.php';
$rcpInput = $_SESSION['user_id'];

$query = mysqli_query($con, "SELECT total FROM faktur_penjualan WHERE no_faktur='$_GET[faktur]'");
$data = mysqli_fetch_row($query);

if(isset($_GET['ubah'])){
	$cekbaris = mysqli_query($con, "SELECT * FROM edit_faktur WHERE no_faktur='$_GET[faktur]'");
	if(mysqli_num_rows($cekbaris)>0){ ?>
		<script type="text/javascript">
			alert("Error, hanya bisa diedit satu kali!!");
			location.href="index.php?form=pembatalan";
		</script> <?php
	}
	else{
		mysqli_query($con, "INSERT INTO edit_faktur (tanggal,resepsionis,no_faktur,total_bayar,cara_bayar,keterangan) VALUES ('$nowDate','$rcpInput','$_GET[faktur]','$data[0]','$_GET[bayar]','$_GET[ket]')");
				
		mysqli_query($con, "UPDATE cara_bayar SET cara_bayar='$_GET[bayar]' WHERE no_faktur='$_GET[faktur]' AND jumlah<>'0' AND cara_bayar<>'Cashback' ");
		mysqli_query($con, "UPDATE faktur_penjualan SET cara_bayar='$_GET[bayar]' WHERE no_faktur='$_GET[faktur]'");

		mysqli_query($con, "UPDATE reception SET cara_bayar='$_GET[bayar]' WHERE no_faktur='$_GET[faktur]'");

		?>
		<script type="text/javascript">
			alert("Berhasil");
			location.href="index.php?form=pembatalan";
		</script> <?php
	}

}

?>