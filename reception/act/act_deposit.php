<?php
include '../../config.php';
session_start();
$us=$_SESSION['user_id'];
$ot = $_SESSION['nama_outlet'];

date_default_timezone_set('Asia/Makassar');
$jam=date("Y-m-d H:i:s");
$date = date("Y-m-d");
$id_cs=$_GET['id'];
$hargapaket=$_GET['hargapaket'];
$paket=$_GET['paket'];
$carabayarlgn=$_GET['carabayarlgn'];
$npaket = $_GET['npaket'];
$kuotakilo=$_GET['kuota_kilo'];
$sisa_kuota = $_GET['sisa_kuota'];
$kuota_rp = floatval($hargapaket+$sisa_kuota) ;

if($hargapaket>=350000) $expire = date('Y-m-d', strtotime('+3 months', strtotime($date))); else $expire = date('Y-m-d', strtotime('+1 months', strtotime($date)));

if($_GET['paket']=="hemat_50"){
	$kuota_kilo=$kuotakilo+$npaket;	
	$pot = $_GET['kuota_pot']+0;
	$konvHarga = ($hargapaket+$sisa_kuota-$pot)/$kuota_kilo;
}
if($_GET['paket']=="kilo30"){
	$kuota_kilo= floatval($kuotakilo+$npaket) ;	
	$pot = floatval($_GET['kuota_pot']+0) ;
	$konvHarga = ($hargapaket+$sisa_kuota-$pot)/$kuota_kilo;
}
if($_GET['paket']=="singgle"){
	$kuota_kilo = $kuotakilo+$npaket;
	$pot = $_GET['kuota_pot']+99000;
	$konvHarga = ($hargapaket+$sisa_kuota-$pot)/$kuota_kilo;
}
if($_GET['paket']=="family"){
	$kuota_kilo = $kuotakilo+$npaket;
	$pot = $_GET['kuota_pot']+275000;
	$konvHarga = ($hargapaket+$sisa_kuota-$pot)/$kuota_kilo;
}
if($_GET['paket']=="custom"){
	$kuota_kilo = $kuotakilo+($hargapaket/8800);
	$pot = $_GET['kuota_pot'];
	$konvHarga = ($hargapaket+$sisa_kuota-$pot)/$kuota_kilo;
	
}


function rupiah($angka)
{
	$jadi = "Rp.".number_format($angka,0,',','.');
	return $jadi;
}



include '../code.php';

$tambah=mysqli_query($con,"insert into faktur_penjualan(no_faktur,nama_outlet,rcp,tgl_transaksi,total,cara_bayar,id_customer,jenis_transaksi,no_faktur_urut) VALUES('$nofaktur','$ot','$us','$jam','$hargapaket','$carabayarlgn','$id_cs','deposit','$nofaktur')");

$lg=mysqli_query($con,"update customer set lgn='1' WHERE  id='$id_cs'");

$queryl = mysqli_query($con, "select *from langganan where id_customer='$id_cs'");
$ln = mysqli_fetch_array($queryl);
if(mysqli_num_rows($queryl)>0){
	$aclg = mysqli_query($con, "update langganan set all_kuota='$kuota_rp', kilo_cks='$kuota_kilo', potongan='$pot', tgl_expire='$expire', harga_satuan='$konvHarga' where id_customer='$id_cs' ");
}else{
	$aclg = mysqli_query($con, "insert into langganan values ('', '$date', '$id_cs', '$kuota_rp', '$kuota_kilo', '$pot', '$konvHarga', '$expire' ) ");
}
	
$tambahlgn=mysqli_query($con,"insert into detail_lgn (jenis_transaksi,jumlah_transaksi,id_customer,tgl_transaksi,no_nota,cara_bayar) VALUES('1','$hargapaket','$id_cs','$jam','$nofaktur','$carabayarlgn')");
	
if($aclg){
    $edit = mysqli_query($con,"SELECT  * FROM faktur_penjualan WHERE no_faktur='$nofaktur'");
	$r    = mysqli_fetch_array($edit);

	echo '
	<a href="cetak_faktur.php?faktur='.$nofaktur.'" target="_blank" class="btn btn-default cetak-f">Cetak Faktur</a>
	';

}else{
	echo "ERROR";
}
?>

</body>