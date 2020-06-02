<?php 
include '../../config.php';

if(isset($_GET['potongan'])){

	$query = mysqli_query($con, "SELECT no_nota FROM order_potongan_tmp WHERE id_customer='$_GET[id]' ORDER BY id DESC LIMIT 0,1");
	$data = mysqli_fetch_row($query);
	$nota = $data[0];


	$hapus = mysqli_query($con, "DELETE FROM order_potongan_tmp WHERE id_customer='$_GET[id]' AND no_nota='$nota'");
	$hapus .= mysqli_query($con, "DELETE FROM detail_penjualan WHERE id_customer='$_GET[id]' AND no_nota='$nota'");

	if($hapus){ ?>

		<tr>
			<td colspan="5" align="center">..Data tidak ada..</td>			
		</tr>
		<?php
	}
	
}

else if(isset($_GET['remove'])) {
	$query = mysqli_query($con, "SELECT * FROM reception WHERE no_nota='$_GET[nota]'");
	$result = mysqli_fetch_assoc($query);

	if($result['jenis']=='k') {
		mysqli_query($con, "DELETE FROM order_tmp WHERE no_nota='$_GET[nota]'");
	} else if($result['jenis']=='p') {
		mysqli_query($con, "DELETE FROM order_potongan_tmp WHERE no_nota='$_GET[nota]'");
	}

	mysqli_query($con, "DELETE FROM reception WHERE no_nota='$_GET[nota]'");
	mysqli_query($con, "DELETE FROM detail_penjualan WHERE no_nota='$_GET[nota]'");

}
	

?>


