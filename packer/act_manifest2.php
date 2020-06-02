<?php 
if (isset($_POST['man']) and $_POST['man']=="terima") {
include "../config.php"; 
include "header.php";
//manifest terima

$jumlah=$_POST['jumlah'];
$tipe=$_POST['tipe'];
$nota=$_POST['nota'];//no nota
$driver=$_POST['driver'];
$serah=$_POST['kd_serah'];
$penerima=$_SESSION['user_id'];
$workshop=$_SESSION['workshop'];
date_default_timezone_set('Asia/Makassar');
$waktu = date("Y-m-d H:i:s");	
$query2 = "SELECT kode FROM workshop WHERE workshop='$workshop'";
$hasil2 = mysqli_query($con,$query2);
$data2  = mysqli_fetch_array($hasil2);
$kd = $data2['kode'];
$kode = 'MTM'.$kd;
$query = "SELECT * FROM man_terima WHERE kode_terima like '%$kode%' order by kode_terima desc LIMIT 0,1";
$hasil = mysqli_query($con,$query);
if ($hasil) {
	$data  = mysqli_fetch_array($hasil);
	$lastNoTerima = $data['kode_terima'];
	$lastNoUrut = (int)substr($lastNoTerima, 6, 6);
} else $lastNoUrut=0;

$nextNoUrut1 = $lastNoUrut + 1;
$kode_terima = $kode.sprintf('%06s', $nextNoUrut1);
$q=mysqli_query($con,"insert into man_terima value ('$kode_terima', '$waktu', '$penerima', '$driver', $jumlah,$tipe,'$workshop')");
$kd_serah = explode(" ",$serah);
  	foreach($kd_serah as $key => $value){
  	$q=mysqli_query($con,"UPDATE man_serah SET kode_terima='$kode_terima' WHERE kode_serah='$value'");
  }
$no_nota = explode(" ",$nota);
  	foreach($no_nota as $key => $value){
  	$q=mysqli_query($con,"UPDATE manifest SET kd_terima2='$kode_terima' WHERE no_nota='$value'");
	$qwk = mysqli_query($con, "update reception set workshop='$workshop', tgl_workshop='$waktu', op_workshop='$penerima' where no_nota='$value'");
  }
?>
<script type="text/javascript">
 location.href="mterima.php";
</script>
<?php
}

//======================================== manifest serah
else {
?>
<script type="text/javascript">
 location.href="http://qnclaundry.com";
</script>

<?php }
?>