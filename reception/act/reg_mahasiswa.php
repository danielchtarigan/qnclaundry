<?php
include '../../config.php';
session_start();

date_default_timezone_set('Asia/Makassar');
$tanggal = date("Y-m-d");
if(isset($_POST['kirim'])){
$ot = $_SESSION['nama_outlet'];
$rcp = $_SESSION['user_id'];
$telp = $_POST['telepon'];
$sekolah = $_POST['sekolah'];
$stbk = $_POST['stb'];
$nama = $_POST['nama'];
$tl =$_POST['tl'];
$id = $_POST['idcst'];


$qstb = mysqli_query($con, "insert into member_mahasiswa values ('','$id','$nama','$telp','$tl','$sekolah','MHS$stbk','6600','Kiloan','2018-01-01','aktif','$ot')");
if($qstb){	
	?>
	<script type="text/javascript">
	alert("Registrasi Berhasil");
	location.href="../index.php?menu=customer";
	</script>	
    <?php	
	}		
	else{
	?>    
	<script type="text/javascript">
	alert("Ulangi");
	location.href="../index.php?menu=customer";
	</script>
	
    <?php
	}
    
}
?>