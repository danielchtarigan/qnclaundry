<?php 
include '../../config.php';
include '../zonawaktu.php';
include '../kode.php';

$y = date('Y');
$m = date('m');
$d = date('d');

if($_GET['express']=="undefined"){
	$express = "0";	
} else{
	$express = $_GET['express'];
}

if($express=='1'){
	$charge = "15000";
	$item_charge = "Express";
} else if($express=="2"){
	$charge = "30000";
	$item_charge = "Double Express";
} else if($express=="3"){
	$charge = "45000";
	$item_charge = "Super Express";
}

$outlet = $_SESSION['outlet'];
$cabang = $_SESSION['cabang'];
$reception = $_SESSION['user_id'];


if(isset($_GET['potongan'])){
	mysqli_query($con, "UPDATE order_potongan_tmp SET charge='$express' WHERE no_nota='$_GET[nota]'");
	mysqli_query($con, "INSERT INTO detail_penjualan (tgl_transaksi,item,harga,jumlah,total,no_nota,id_customer) VALUES ('$nowDate','$item_charge','$charge','1','$charge','$_GET[nota]','$_GET[id]') ");

	$query = mysqli_query($con, "SELECT * FROM order_potongan_tmp AS a LEFT JOIN customer AS b ON a.id_customer=b.id WHERE a.no_nota='$_GET[nota]'");
	$result = mysqli_fetch_assoc($query);

	$total_bayar = mysqli_query($con, "SELECT SUM(total) AS total FROM detail_penjualan WHERE no_nota='$_GET[nota]'");
	$total = mysqli_fetch_row($total_bayar)[0];

	$no_nota = $_GET['nota'];
	$no_so = $result['no_so'];
	$idcst = $_GET['id'];
	$nama_customer = $result['nama_customer'];
	$new_nota = $char.$y.$m.$d.substr($no_so, 5);
	$jenis = 'p';

	//update new_nota ke order_potongan_tmp;

	mysqli_query($con, "UPDATE order_potongan_tmp SET new_nota='$new_nota' WHERE no_nota='$no_nota' AND no_so='$no_so'");

	

} 

else if(isset($_GET['kiloan'])) {
	mysqli_query($con, "UPDATE order_tmp SET charge='$express' WHERE no_nota='$_GET[nota]'");

	mysqli_query($con, "INSERT INTO detail_penjualan (tgl_transaksi,item,harga,jumlah,total,no_nota,id_customer) VALUES ('$nowDate','$item_charge','$charge','1','$charge','$_GET[nota]','$_GET[id]') ");

	$query = mysqli_query($con, "SELECT * FROM order_tmp AS a LEFT JOIN customer AS b ON a.id_customer=b.id WHERE a.no_nota='$_GET[nota]'");
	$result = mysqli_fetch_assoc($query);

	$total_bayar = mysqli_query($con, "SELECT SUM(total) AS total FROM detail_penjualan WHERE no_nota='$_GET[nota]'");
	$total = mysqli_fetch_row($total_bayar)[0];

	$no_nota = $_GET['nota'];
	$no_so = $result['no_so'];
	$idcst = $_GET['id'];
	$nama_customer = $result['nama_customer'];
	$new_nota = $char.$y.$m.$d.substr($no_so, 5);
	$jenis = 'k';

	//update new_nota ke order_potongan_tmp;

	mysqli_query($con, "UPDATE order_tmp SET new_nota='$new_nota' WHERE no_nota='$no_nota' AND no_so='$no_so'");
}



$v = $con-> query("SELECT item, total FROM detail_penjualan WHERE no_nota='$_GET[nota]' AND item LIKE '%Voucher%'");
if(mysqli_num_rows($v)>0){
	$data = $v -> fetch_array();
	$voucher = str_replace("Voucher", "", $data['item']);
	$diskon = $data['total']*-1;
} else{
	$voucher = "";
	$diskon = 0;
}

$berat = mysqli_fetch_array(mysqli_query($con, "SELECT berat FROM detail_penjualan WHERE no_nota='$_GET[nota]' AND item NOT LIKE '%Voucher%'"))[0];

//insert ke dalam tabel utama pemesananan(reception)
$inst = mysqli_query($con, "INSERT INTO reception (nama_outlet,tgl_input,nama_reception,id_customer,nama_customer,no_nota,no_so,total_bayar,new_nota,jenis,express,cabang,voucher,diskon,berat) VALUES ('$outlet','$nowDate','$reception','$idcst','$nama_customer','$no_nota','$no_so','$total','$new_nota','$jenis','$express','$cabang','$voucher','$diskon','$berat')");

mysqli_query($con, "DELETE FROM detail_penjualan WHERE no_nota='$no_nota' AND item=''");

?>