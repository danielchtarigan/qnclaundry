<?php 
include '../config.php';
session_start();

date_default_timezone_set('Asia/Makassar');

$jam = date('Y-m-d');
$reception = $_SESSION['user_id'];
$outlet = $_SESSION['nama_outlet'];

$query = "SELECT kode FROM outlet WHERE nama_outlet='$outlet'";
$hasil = mysqli_query($con,$query);
$data  = mysqli_fetch_array($hasil);

if($_POST['keterangan']=="kotor") {

	$kode = "MSK".$data['kode'];

	$sql = $con->query("SELECT kd_serah FROM manifest WHERE outlet='$outlet' AND kd_serah LIKE '%$kode%' ORDER BY kd_serah DESC LIMIT 0,1");
	if(mysqli_num_rows($sql)>0) {
		$rsql = $sql->fetch_array();

		$last = (int)substr($rsql['kd_serah'], 6,6) ;
		
	}
	else {
		$last = 0;
	}

	$next =  $last+1;
	$kode_serah = $kode.sprintf('%06s', $next);

	$driver = $_POST['driver'];
	$jumlah = $_POST['jumlah'];
	$date = date('Y-m-d H:i:s');

	$no_nota = explode(" ",$_POST["nota"]);
	  foreach($no_nota as $key => $value){
	  	if($value!='') {
			$q = mysqli_query($con, "INSERT INTO manifest (no_nota, outlet, kd_serah) VALUES ('$value', '$outlet', '$kode_serah')"); 
	  		$q .= mysqli_query($con," INSERT INTO man_serah (kode_serah,tgl,pemberi,driver,jumlah,tempat,tipe) VALUES ('$kode_serah','$date','$reception','$driver','$jumlah','$outlet','1') ");

	  		// $q .= mysqli_query($con, "UPDATE manifest SET kd_serah='$kode_serah' WHERE no_nota='$value'"); query lama
	  	}   	
	  }

	if($q) {
		mysqli_query($con, "UPDATE user_driver SET status='0',lokasiform='',lokasi='',keterangan='' WHERE name='$driver'");
	}


}

else {

	$kode = "MTB".$data['kode'];

	$sql = $con->query("SELECT kd_terima3 FROM manifest WHERE outlet='$outlet' AND kd_terima3 LIKE '%$kode%' ORDER BY kd_terima3 DESC LIMIT 0,1");
	if(mysqli_num_rows($sql)>0) {
		$rsql = $sql->fetch_array();

		$last = (int)substr($rsql['kd_terima3'], 6,6) ;
		
	}
	else {
		$last = 0;
	}

	$next =  $last+1;
	$kode_terima3 = $kode.sprintf('%06s', $next);

	$driver = $_POST['driver'];
	$jumlah = $_POST['jumlah'];
	
	$date = date('Y-m-d H:i:s');

	$no_nota = explode(" ",$_POST["nota"]);
	  foreach($no_nota as $key => $value){
	  	if($value!='') {
	  		$q = mysqli_query($con," INSERT INTO man_terima (kode_terima,tgl,penerima,driver,jumlah,tempat,tipe) VALUES ('$kode_terima3','$date','$reception','$driver','$jumlah','$outlet','3') ");

	  		$q .= mysqli_query($con, "UPDATE manifest SET kd_terima3='$kode_terima3' WHERE no_nota='$value'");
	  		
	  		$q .= mysqli_query($con, "UPDATE reception SET kembali='1',tgl_kembali='$date',reception_kembali='$reception' WHERE no_nota='$value'");
	  	}   	
	  }

	if($q) {
		mysqli_query($con, "UPDATE user_driver SET status='0',lokasiform='',lokasi='',keterangan='' WHERE name='$driver'");
	}
	
    require_once '../notifikasi_cucian_selesai.php';
	// Load Composer's autoloader
	require '../../phpmailer/vendor/autoload.php';

}
