<?php
 function rupiah($angka){
       $jadi="Rp.".number_format($angka,0,',','.');
        return $jadi;
 }

session_start();
$us=$_SESSION['user_id'];
$ot=$_SESSION['nama_outlet'];

include "../../config.php";

	
date_default_timezone_set('Asia/Makassar');
$jam=date("Y-m-d H:i:s");
$tgl_join=date("Y-m-d");

$id_cs=$_GET['id_cs'];
$hargamember=$_GET['hargamember'];
$jenis_member=$_GET['jenis_member'];
$carabayarmbr=$_GET['carabayarmbr'];
$tgl_akhir=$_GET['tgl_akhir'];
		
include '../code.php';

$tambah = mysqli_query($con,"insert into faktur_penjualan(no_faktur,nama_outlet,rcp,tgl_transaksi,total,cara_bayar,id_customer,jenis_transaksi,no_faktur_urut) VALUES('$nofaktur','$ot','$us','$jam','$hargamember','$carabayarmbr','$id_cs','membership','$nofaktur')");
	
$tambah .= mysqli_query($con,"update customer set tgl_join='$tgl_join',tgl_akhir='$tgl_akhir',member='1',jenis_member='$jenis_member' WHERE  id='$id_cs'");

$member = $con->query("SELECT * FROM membership WHERE customer_id='$id_cs'");
$cekCount = mysqli_num_rows($member);

$custData = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM customer WHERE id='$id_cs'"));
$telp = $custData['no_telp'];

switch($jenis_member){
    case 'blue12bulan' : $level = "Blue 12 Bulan"; break;
    case 'blue6bulan' : $level = "Blue 6 Bulan"; break;
    case 'blue3bulan' : $level = "Blue 3 Bulan"; break;
}

if($cekCount>0){
    $tambah .= mysqli_query($con,"UPDATE membership SET level='$level',expire_date='$tgl_akhir',user_allow='$us',status='1' WHERE customer_id='$id_cs' ");
}
else {
    $tambah .= mysqli_query($con,"INSERT INTO membership (customer_id,no_telp,level,join_date,expire_date,user_allow,status) VALUES ('$id_cs','$telp','$level','$tgl_join','$tgl_akhir','$us','1')");
}

if($tambah)

{
	    $edit = mysqli_query($con,"SELECT  * FROM faktur_penjualan WHERE no_faktur='$nofaktur'");
    	$r    = mysqli_fetch_array($edit);

    	echo '

    	<a href="cetak_faktur.php?faktur='.$nofaktur.'" target="_blank" class="btn btn-default cetak-f">Cetak Faktur</a>

    	';

	
}
else
{  echo "ERROR"; }
?>