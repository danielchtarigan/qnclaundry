<?php 

include '../../config.php';
include '../zonawaktu.php';
include '../kode.php';

$expDate = date('Y-m-d H:i:s', strtotime('+1 months', strtotime($nowDate)));

$id = $_POST['id'];
$paket = $_POST['paket'];
$harga = $_POST['harga'];
$pembayaran = $_POST['pembayaran'];
$carabayar = ($pembayaran=="Cash") ? "Cash" : $_POST['carabayar'];
$ket = "mlocker";

$query = mysqli_query($con, "SELECT no_faktur_urut FROM faktur_penjualan WHERE nama_outlet='$_SESSION[outlet]' ORDER BY id DESC LIMIT 0,1");
$result = mysqli_fetch_row($query);

$lastfaktur = (int)substr($result[0], 4)+1;
$no_faktur = $kode_faktur.sprintf('%06s', $lastfaktur);

mysqli_query($con, "INSERT INTO faktur_penjualan (no_faktur,no_faktur_urut,nama_outlet,rcp,tgl_transaksi,total,cara_bayar,id_customer,jenis_transaksi) VALUES ('$no_faktur','$no_faktur','$_SESSION[outlet]','$_SESSION[user_id]','$nowDate','$harga','$carabayar','$id','$ket')");

$ss = $con->query("INSERT INTO member_locker (id_customer,tgl_aktif,tgl_berakhir,paket) VALUES ('$id','$nowDate','$expDate','$paket') ");

if(empty($ss)) {
	$con->query("UPDATE member_locker SET tgl_aktif='$nowDate',tgl_berakhir='$expDate',paket='$paket' WHERE id_customer='$id'");
}
?>