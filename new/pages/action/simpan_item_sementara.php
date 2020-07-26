<?php 
include '../../config.php';
include '../zonawaktu.php';
include '../kode.php';

$query = mysqli_query($con, "SELECT MAX(no_so) AS no_so FROM reception WHERE nama_outlet='$_SESSION[outlet]'");
$row = mysqli_fetch_row($query)[0];

if(strlen($row) == 11) {
	$no_urut = (int)substr($row, 5, 6)+1;
}
else {
	$no_urut = (int)substr($row, 9, 3)+1;
}

$ym = date('ym');
$no_so = $kode_order.$ym.sprintf('%03s', $no_urut);

if($_GET['no_nota']<>''){
	$no_nota = $_GET['nota'];
} else {
	$no_nota = $no_so;
}

$total = $_GET['harga']*$_GET['jumlah'];

$cdetail = mysqli_query($con, "SELECT * FROM detail_penjualan WHERE no_nota='$no_nota' AND item LIKE '%Setrika%'");
if(mysqli_num_rows($cdetail)>0) {
	mysqli_query($con, "DELETE FROM detail_penjualan WHERE no_nota='$no_nota'");
	mysqli_query($con, "DELETE FROM order_tmp WHERE no_nota='$no_nota'");
	mysqli_query($con, "DELETE FROM order_potongan_tmp WHERE no_nota='$no_nota'");
}

$simpan = mysqli_query($con, "INSERT INTO order_potongan_tmp (tgl,id_customer,item,harga,jumlah,ket,cabang,no_nota,no_so) VALUES ('$nowDate','$_GET[id]','$_GET[item]','$_GET[harga]','$_GET[jumlah]','$_GET[ket]','$_SESSION[cabang]','$no_nota','$no_so')");

mysqli_query($con, "INSERT INTO detail_penjualan SET tgl_transaksi='$nowDate', item='$_GET[item]', harga='$_GET[harga]', jumlah='$_GET[jumlah]', total='$total', no_nota='$no_nota', id_customer='$_GET[id]', keterangan='$_GET[ket]'");

if($simpan){

	$no = 1;
	$query = mysqli_query($con, "SELECT *FROM order_potongan_tmp WHERE id_customer='$_GET[id]'");
	while($result = mysqli_fetch_assoc($query)){		
	?>
	<tr>
		<td align="center"><?php echo $no ?></td>
		<td><?php echo $result['item'] ?></td>
		<td><?php echo $result['harga'] ?></td>
		<td align="center"><?php echo $result['jumlah'] ?></td>
		<td><?php echo $result['ket'] ?></td>
	</tr>
	<?php
	$no++;
	} 
}

//masuk ke tabel kategori_item_order
$item = mysqli_query($con, "SELECT * FROM item_spk WHERE nama_item LIKE '$_GET[item]'");
$ritem = mysqli_fetch_assoc($item);

$kat = $ritem['kategory'];

$con->query("DELETE FROM kategori_item_order WHERE no_nota='$no_nota'");
$con->query("INSERT INTO kategori_item_order VALUES ('$no_nota','p','$kat','$nowDate')");


?>