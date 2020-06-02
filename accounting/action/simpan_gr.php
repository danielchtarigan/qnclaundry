<?php 
include '../config.php';

$id = $_POST['id'];
$text = $_POST['text'];
$nama_colom = $_POST['nama_colom'];

$cekpo = mysqli_query($con, "SELECT qty FROM purchase_order_data WHERE id='$id'");
$qty = mysqli_fetch_row($cekpo)[0];

if($nama_colom=="qty_received"){
	$max_qr = $qty*0.1+$qty;
	if($text>$max_qr){ 
		?>
		<script type="text/javascript">
			alert("Gagal simpan, Maximal quantity GR yang bisa adalah "+<?= $max_qr; ?>+" satuan PO");
		</script>
		<?php
	}
	else {
		$sql = $con->query("UPDATE purchase_order_data SET $nama_colom='$text' WHERE id='$id'");

		if($sql){
			echo "Kolom ".$nama_colom." berhasil disimpan!";

		}
	}
}
else {
	$sql = $con->query("UPDATE purchase_order_data SET $nama_colom='$text' WHERE id='$id'");

	if($sql){
		echo "Kolom ".$nama_colom." berhasil disimpan!";
	}
}


		
?>