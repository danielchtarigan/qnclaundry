<?php 
include '../../config.php';
include '../zonawaktu.php';
include '../kode.php';



$query = mysqli_query($con, "SELECT MAX(no_so) AS no_so FROM reception WHERE nama_outlet='$_SESSION[outlet]' AND no_so LIKE '$kode_order%' ");
$row = mysqli_fetch_row($query)[0];

if(strlen($row) == 11) {
	$no_urut = (int)substr($row, 5, 6)+1;
}
else {
	$no_urut = (int)substr($row, 9, 3)+1;
}


$no_so = $kode_order.sprintf('%03s', $no_urut);

if($_GET['nota']<>''){
	$no_nota = $_GET['nota'];
} else {
	$no_nota = $no_so;
}

$cdetail = mysqli_query($con, "SELECT * FROM detail_penjualan WHERE no_nota='$no_nota' AND item NOT LIKE 'Plastik Hanger' OR item NOT LIKE 'Hanger' OR item NOT LIKE '%Express%'");
if(mysqli_num_rows($cdetail)>0) {
	mysqli_query($con, "DELETE FROM detail_penjualan WHERE no_nota='$no_nota'");
	mysqli_query($con, "DELETE FROM order_tmp WHERE no_nota='$no_nota'");
	mysqli_query($con, "DELETE FROM order_potongan_tmp WHERE no_nota='$no_nota'");
}

$item = mysqli_query($con, "SELECT * FROM item_spk WHERE nama_item LIKE '$_GET[item]'");
$ritem = mysqli_fetch_assoc($item);
$berat = $ritem['berat'];

//periksa kembali order_tmp
$order_tmp = mysqli_query($con, "SELECT * FROM order_tmp WHERE id_customer='$_GET[idcst]' AND no_so='$no_so'");
if(mysqli_num_rows($order_tmp)>0){
	mysqli_query($con, "UPDATE order_tmp SET item='$_GET[item]',harga='$_GET[harga]',berat='$berat',ket='$_GET[ket]' WHERE id_customer='$_GET[idcst]' AND no_so='$no_so'");

	mysqli_query($con, "UPDATE detail_penjualan SET tgl_transaksi='$nowDate', item='$_GET[item]', harga='$_GET[harga]', jumlah='1', total='$_GET[harga]', no_nota='$no_nota', id_customer='$_GET[idcst]', keterangan='$_GET[ket]',berat='$berat' WHERE id_customer='$_GET[idcst]' AND no_nota='$no_nota'");

} else {
	mysqli_query($con, "INSERT INTO order_tmp (tgl,no_nota,no_so,id_customer,item,harga,jumlah,berat,cabang,ket) VALUES ('$nowDate','$no_nota','$no_so','$_GET[idcst]','$_GET[item]','$_GET[harga]','1','$berat','$_SESSION[cabang]','$_GET[ket]') ");

	mysqli_query($con, "INSERT INTO detail_penjualan SET tgl_transaksi='$nowDate', item='$_GET[item]', harga='$_GET[harga]', jumlah='1', total='$_GET[harga]', no_nota='$no_nota', id_customer='$_GET[idcst]', keterangan='$_GET[ket]',berat='$berat'");
}

//masuk ke tabel kategori_item_order

$kat = $ritem['kategory'];

$con->query("DELETE FROM kategori_item_order WHERE no_nota='$no_nota'");
$con->query("INSERT INTO kategori_item_order VALUES ('$no_nota','k','$kat','$nowDate')");


echo $no_nota;


?>
