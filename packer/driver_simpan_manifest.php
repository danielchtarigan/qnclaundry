<?php 
include '../config.php';
session_start();

date_default_timezone_set('Asia/Makassar');

$jam = date('Y-m-d');
$username = $_SESSION['user_id'];
$workshop = $_SESSION['workshop'];

$query = "SELECT kode FROM workshop WHERE workshop='$workshop'";
$hasil = mysqli_query($con,$query);
$data  = mysqli_fetch_array($hasil);

if($_POST['keterangan']=="bersih") {

	$kode = "MSB".$data['kode'];

	$sql = $con->query("SELECT kd_serah3 FROM manifest WHERE kd_serah3 LIKE '%$kode%' ORDER BY kd_serah3 DESC LIMIT 0,1");
	if(mysqli_num_rows($sql)>0) {
		$rsql = $sql->fetch_array();

		$last = (int)substr($rsql['kd_serah3'], 6,6) ;
		
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
	  		$q = mysqli_query($con," INSERT INTO man_serah (kode_serah,tgl,pemberi,driver,jumlah,tempat,tipe) VALUES ('$kode_serah','$date','$username','$driver','$jumlah','$workshop','3') ");

	  		$q .= mysqli_query($con, "UPDATE manifest SET kd_serah3='$kode_serah' WHERE no_nota='$value'");
	  	}   	
	  }

	if($q) {
		mysqli_query($con, "UPDATE user_driver SET status='0',lokasiform='',lokasi='',keterangan='' WHERE name='$driver'");
	}


}