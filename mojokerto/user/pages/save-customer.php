<?php
include '../../../config.php';
session_start();
$us=$_SESSION['name'];
$jam1 = date("Y-m-d");	
$ot = $_SESSION['nama_outlet']; 
if (isset($_GET['nama'])){
 $nama = $_GET['nama'];
}
if (isset($_GET['telepon'])){
 $telepon = $_GET['telepon'];
}
if (isset($_GET['referensi'])){
 $referensi = $_GET['referensi'];
}
$cekref = mysqli_query($con, "select * from customer where no_telp='$referensi'");
$rcek = mysqli_num_rows($cekref);
if (($referensi<>'') and ($rcek<1)){
?>
<script type="text/javascript">
 alert('No Telepon Referensi tidak ditemukan!');
 history.back();
</script>	
<?php	
}
else{
$qcus = mysqli_query($con, "select * from customer where no_telp='$telepon'");
$ncus = mysqli_num_rows($qcus);
if ($ncus > 0){
?>
<script type="text/javascript">
 alert('No Telepon ini telah terdaftar sebelumnya!');
 history.back();
</script>	
<?php
	}
else{
$qcus = mysqli_query($con, "insert into customer (id, nama_customer, no_telp, alamat, tgl_input, info_dari,outlet, user_input, referensi) values ('', '$_GET[nama]', '$_GET[telepon]' , '$_GET[alamat]', '$jam1', '$_GET[info]','$ot','$us', '$referensi')");
 if ($qcus){
?>
<script type="text/javascript">
 alert('Pelanggan baru telah terdaftar!');
 location.href="customer.php";
</script>	
<?php	
 }
 else{
?>
<script type="text/javascript">
 alert('Kesalahan query!');
 history.back();
</script>	
<?php	
	 }
}
}
?>