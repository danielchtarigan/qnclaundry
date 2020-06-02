<?php 
include '../../config.php';
include '../zona.php';

$nama = $_GET['nama'];
$alamat = $_GET['alamat'];
$telp = $_GET['telp'];
$kota = ucwords($_SESSION['cabang']);
$tgl = date('Y-m-d');

$sql = mysqli_query($con, "SELECT * FROM customer WHERE no_telp='$telp'");
if(mysqli_num_rows($sql)>0) {
	echo "Data sudah ada!!";
} else {
	mysqli_query($con, "INSERT INTO customer (nama_customer,no_telp,alamat,tgl_input,user_input,kota,outlet) VALUES ('$nama','$telp','$alamat','$tgl','$_SESSION[user_id]','$kota','$_SESSION[subagen]') ");
	echo "Data berhasil ditambahkan!!";
}

	

?>