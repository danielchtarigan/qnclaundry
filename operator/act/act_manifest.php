<?php 
if (isset($_POST['man']) and $_POST['man']=="terima") {
//manifest terima
$jumlah=$_POST['jumlah'];
$tipe=$_POST['tipe'];
$nota=$_POST['nota'];//no nota
$driver=$_POST['driver'];
$serah=$_POST['kd_serah'];
$penerima=$_SESSION['user_id'];
date_default_timezone_set('Asia/Makassar');
$waktu = date("Y-m-d H:i:s");	
$query2 = "SELECT kode FROM workshop WHERE workshop='$workshop'";
$hasil2 = mysqli_query($con,$query2);
$data2  = mysqli_fetch_array($hasil2);
$kd = $data2['kode'];
  if ($tipe==1) { $kode = 'MTW'.$kd; $link='mterima';}
  else if ($tipe==2) {$kode = 'MTM'.$kd;$link='mterima2';}
$query = "SELECT * FROM man_terima WHERE kode_terima like '%$kode%' order by kode_terima desc LIMIT 0,1";
$hasil = mysqli_query($con,$query);
if ($hasil) {
	$data  = mysqli_fetch_array($hasil);
	$lastNoTerima = $data['kode_terima'];
	$lastNoUrut = (int)substr($lastNoTerima, 6, 6);
} else $lastNoUrut=0;

// baca nomor urut manifest_terima dari kode terakhir
// nomor urut ditambah 1
$nextNoUrut1 = $lastNoUrut + 1;
$kode_terima = $kode.sprintf('%06s', $nextNoUrut1);
$q=mysqli_query($con,"insert into man_terima value ('$kode_terima', '$waktu', '$penerima', '$driver', $jumlah,$tipe,'$workshop')");
$kd_serah = explode(" ",$serah);
  	foreach($kd_serah as $key => $value){
  	$q=mysqli_query($con,"UPDATE man_serah SET kode_terima='$kode_terima' WHERE kode_serah='$value'");
  }
$no_nota = explode(" ",$nota);
  	foreach($no_nota as $key => $value){
  		if ($tipe==1) {
  	$q=mysqli_query($con,"UPDATE manifest SET kd_terima='$kode_terima' WHERE no_nota='$value'");
  	    } else if ($tipe==2) {
  	$q=mysqli_query($con,"UPDATE manifest SET kd_terima2='$kode_terima' WHERE no_nota='$value'");}
	$qwk = mysqli_query($con, "update reception set workshop='$workshop', tgl_workshop='$waktu', op_workshop='$penerima' where no_nota='$value'");
  }
?>
<script type="text/javascript">
 location.href="index.php?menu=<?=$link?>";
</script>
<?php
}

//======================================== manifest serah
else if (isset($_POST['man']) and $_POST['man']=="serah"){
$driver=$_POST['driver'];
$jumlah=$_POST['jumlah'];
$type=$_POST['type'];
$pemberi=$_SESSION['user_id'];
$tempat=$workshop;
date_default_timezone_set('Asia/Makassar');
$waktu = date("Y-m-d H:i:s");	
$query2 = "SELECT kode FROM workshop WHERE workshop='$tempat'";
$hasil2 = mysqli_query($con,$query2);
$data2  = mysqli_fetch_array($hasil2);
$kd = $data2['kode'];
$kode = 'MTK'.$kd;
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
$q=mysqli_query($con,"insert into man_serah value ('$kode_serah', '$waktu', '$pemberi', '$driver', $jumlah,'',2,'$tempat')");

$no_nota = explode(" ",$type);
  	foreach($no_nota as $key => $value){
  	$q=mysqli_query($con,"UPDATE manifest SET kd_serah2='$kode_serah' WHERE no_nota='$value'");
  }
?>
<script type="text/javascript">
 location.href="index.php?menu=mserah";
</script>

<?php }
?>