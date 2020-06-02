<?php 

include '../../config.php';

$item = $_GET['item'];

$drecp = mysqli_query($con, "SELECT SUM(total_bayar) AS total FROM reception WHERE no_nota='$_GET[nota]'");
$rrecp = mysqli_fetch_assoc($drecp);
$harga_order = $rrecp['total'];

$query = mysqli_query($con, "SELECT * FROM detail_penjualan WHERE no_nota='$_GET[nota]' AND item LIKE '$item'");
$data = mysqli_fetch_assoc($query);
$harga_item = $data['total'];

$harga_order_sekarang = $harga_order-$harga_item;
echo $harga_order_sekarang;

mysqli_query($con, "UPDATE reception SET total_bayar='$harga_order_sekarang' WHERE no_nota='$_GET[nota]'");

if($item=="Express" OR $item=="Double Express" OR $item=="Super Express") {
	mysqli_query($con, "UPDATE order_tmp SET charge='0' WHERE no_nota='$_GET[nota]'");
	mysqli_query($con, "UPDATE order_potongan_tmp SET charge='0' WHERE no_nota='$_GET[nota]'");
} else if($item=="Hanger") {
	mysqli_query($con, "UPDATE order_tmp SET hanger='0' WHERE no_nota='$_GET[nota]'");
	mysqli_query($con, "UPDATE order_potongan_tmp SET hanger='0' WHERE no_nota='$_GET[nota]'");
} else if($item=="Plastik Hanger") {
	mysqli_query($con, "UPDATE order_tmp SET hanger_plastic='0' WHERE no_nota='$_GET[nota]'");
	mysqli_query($con, "UPDATE order_potongan_tmp SET hanger_plastic='0' WHERE no_nota='$_GET[nota]'");
}

mysqli_query($con, "DELETE FROM detail_penjualan WHERE no_nota='$_GET[nota]' AND item LIKE '$item'");



?>
