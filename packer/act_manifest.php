<?php 
include "../config.php"; 
include "header.php";

$driver=$_POST['driver'];
$jumlah=$_POST['jumlah'];
$type=$_POST['type'];
$pemberi=$_SESSION['user_id'];
$tempat=$_POST['ot'];
$workshop=$_SESSION['workshop'];
date_default_timezone_set('Asia/Makassar');
$waktu = date("Y-m-d H:i:s");	
$query2 = "SELECT kode FROM workshop WHERE workshop='$workshop'";
$hasil2 = mysqli_query($con,$query2);
$data2  = mysqli_fetch_array($hasil2);
$kd = $data2['kode'];
$kode = 'MSO'.$kd;
$query = "SELECT * FROM man_serah WHERE kode_serah like '%$kode%' order by kode_serah desc LIMIT 0,1";
$hasil = mysqli_query($con,$query);
if ($hasil) {
	$data  = mysqli_fetch_array($hasil);
	$lastNoTransaksi = $data['kode_serah'];
	$lastNoUrut = (int)substr($lastNoTransaksi, 6, 6);
} else $lastNoUrut=0;

// baca nomor urut manifest_serah dari kode terakhir
// nomor urut ditambah 1
$nextNoUrut1 = $lastNoUrut + 1;
$kode_serah = $kode.sprintf('%06s', $nextNoUrut1);
$q=mysqli_query($con,"insert into man_serah value ('$kode_serah', '$waktu', '$pemberi', '$driver', $jumlah,'',3,'$tempat')");

$no_nota = explode(" ",$type);
  	foreach($no_nota as $key => $value){
  	$q=mysqli_query($con,"UPDATE manifest SET kd_serah3='$kode_serah' WHERE no_nota='$value'");
  }
?>
<script type="text/javascript">
 location.href="mserah.php";
</script>
