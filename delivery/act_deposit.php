<?php 
include '../config.php';
include 'zona.php';
$subagen = $_SESSION['subagen'];
$nom = $_GET['nominal'];

$cekDeposit = mysqli_query($con, "SELECT * FROM deposit_subagen WHERE nama_subagen='$_SESSION[subagen]' ");
if(mysqli_num_rows($cekDeposit)>0){
    if($nom>=1000000) {
    	$bonus = $nom*0.25;
    } else {
    	$bonus = $nom*0.20;
    }
} 
else {
    if($nom>=1000000) {
    	$bonus = $nom*0.50;
    } else {
    	$bonus = $nom*0.20;
    }
}

    

$urut_faktur = mysqli_query($con, "SELECT no_faktur_urut FROM faktur_penjualan WHERE nama_outlet='$subagen' ORDER BY id DESC");
$result = mysqli_fetch_row($urut_faktur);
$lastfaktur = (int)substr($result[0], 4)+1;
$no_faktur = 'FSAG'.sprintf('%06s', $lastfaktur);

mysqli_query($con, "INSERT INTO faktur_penjualan (no_faktur,no_faktur_urut,nama_outlet,rcp,tgl_transaksi,total,cara_bayar,id_customer,jenis_transaksi) VALUES ('$no_faktur','$no_faktur','$_SESSION[subagen]','$_SESSION[user_id]','$nowDate','$_GET[nominal]','$_GET[carabayar]','','deposit_subagen')");

//cek subagen
// $cek = mysqli_query($con, "SELECT saldo,bonus FROM saldo_subagen WHERE subagen='$subagen'");

// if(mysqli_num_rows($cek)>0) {
// 	$ds = mysqli_fetch_row($cek);

// 	$upsaldo = $ds[0]+$nom;
// 	$upbonus = $bonus+$ds[1];
// 	$s = mysqli_query($con, "UPDATE saldo_subagen SET saldo='$upsaldo',tanggal_deposit='$nowDate',bonus='$upbonus',acc='0'");
// } else {
// 	$s = mysqli_query($con, "INSERT INTO saldo_subagen (id,subagen,saldo,tanggal_deposit,bonus) VALUES ('','$subagen','$nom','$nowDate','$bonus')");
// }


mysqli_query($con, "INSERT INTO deposit_subagen (tanggal,no_faktur,nama_subagen,jumlah,bonus) VALUES ('$nowDate','$no_faktur','$subagen','$nom','$bonus') ");



// if($s) {
// 	echo "Saldo Anda bertambah ".$nom;
// }

?>