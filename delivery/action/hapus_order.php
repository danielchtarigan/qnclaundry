<?php 
include '../../config.php';

$id = $_GET['idkey'];

mysqli_query($con, "DELETE FROM reception WHERE no_nota='$_GET[nota]'");
mysqli_query($con, "DELETE FROM detail_penjualan WHERE no_nota='$_GET[nota]'");
mysqli_query($con, "DELETE FROM order_tmp WHERE no_nota='$_GET[nota]'");
mysqli_query($con, "DELETE FROM order_potongan_tmp WHERE no_nota='$_GET[nota]'");


$sqld = mysqli_query($con, "SELECT * FROM reception WHERE id_customer='$id' AND lunas=false ORDER BY id DESC");
if(mysqli_num_rows($sqld)>0) {
	while($rdata = mysqli_fetch_assoc($sqld)) {
		echo '
		<table>
		<tr>
			<td style="width: 50%"><a href="#" class="btshow" id="'.$rdata['jenis'].'-'.$rdata['id_customer'].'-'.$rdata['no_nota'].'"><b>'.$rdata['no_nota'].'</b></a></td>
			<td>&nbsp;</td>
			<td style="text-align: right; width: 30%"><b>'.number_format($rdata['total_bayar'],0,',','.').'</b></td>
			<td style="text-align: right; width: 20%"><b><a href="#" class="btn btn-xs btn-default btn-batal" id="'.$rdata['no_nota'].'"> <i class="fa fa-times" aria-hidden="true"></a></b></td>
		</tr>
		</table>';
	}
} else {
	echo "Belum ada transaksi";
}
?>