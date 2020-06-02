<?php 
include '../config.php';
session_start();
date_default_timezone_set('Asia/Makassar');
$nowDate = date('Y-m-d H:i:s');

$date = date('Y-m-d');

$no_nota = $_GET['nota'];
$id = $_GET['idcst'];
$user = $_SESSION['user_id'];
$total = $_GET['total'];
$cabang = 'Delivery';

$sql = mysqli_query($con, "SELECT * FROM detail_penjualan WHERE id_customer='$id' AND no_nota='$no_nota' ");
$data = mysqli_fetch_assoc($sql);

$customers = mysqli_query($con, "SELECT nama_customer FROM customer WHERE id='$id'");
$customer = mysqli_fetch_row($customers)[0];

$query = mysqli_query($con, "SELECT * FROM reception WHERE no_nota='$no_nota' AND id_customer='$id'");
$row = mysqli_fetch_assoc($query);

$sout = mysqli_query($con, "SELECT kode FROM outlet WHERE nama_outlet='$row[nama_outlet]'");
$charou = mysqli_fetch_row($sout)[0];
$kode_out = $charou;

$new_nota=$kode_out.date('Ymd').substr($row['no_so'], 5);

$qr = $con->query("SELECT id_user FROM log_rcp WHERE id_outlet='$row[nama_outlet]' ORDER BY tgl_log DESC");

if($_SESSION['subagen']<>'') {
    $rcp = $user;
}
else {
    $rcp = $qr->fetch_array()[0];
}

mysqli_query($con, "UPDATE reception SET total_bayar='$total',new_nota='$new_nota',nama_reception='$rcp' WHERE no_nota='$no_nota' AND id_customer='$id'");
mysqli_query($con, "UPDATE order_potongan_tmp SET new_nota='$new_nota' WHERE no_nota='$no_nota' AND id_customer='$id'");
mysqli_query($con, "UPDATE order_tmp SET new_nota='$new_nota' WHERE no_nota='$no_nota' AND id_customer='$id'");

//order nilai null
    mysqli_query($con, "DELETE FROM reception WHERE total_bayar='0' AND id_customer='$id' AND DATE(tgl_input)='$date' AND nama_reception='$user'");

$sqld = mysqli_query($con, "SELECT * FROM reception WHERE id_customer='$id' AND lunas=false ORDER BY id DESC ");
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