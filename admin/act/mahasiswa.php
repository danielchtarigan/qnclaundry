<?php 
include '../../config.php';
include '../../send_sms.php';

date_default_timezone_set('Asia/Makassar');
$eDate = date('Y-m-d H:i:s', strtotime('+ 7 days', strtotime(date('Y-m-d H:i:s'))));

$idmhs = $_GET['id'];
$stmhs = $_GET['status'];
$idcst = $_GET['cust'];
$telp = $_GET['telp'];

$rpmahasiswa = mysqli_query($con, "SELECT * FROM member_mahasiswa WHERE id_customer='$idcst'");
$rowmhs = mysqli_fetch_array($rpmahasiswa);
$nama = $rowmhs['nama'];

$vsms = mysqli_query($con, "SELECT value FROM settings WHERE name='aktivasi_mahasiswa'");
$dsms = mysqli_fetch_row($vsms);
$message = $dsms[0];

$message = str_replace("[NAMA]",$nama,$message);

$qcst = mysqli_query($con, "select *from customer WHERE no_telp='$telp'");
$cekcst = mysqli_num_rows($qcst);
$cst = mysqli_fetch_array($qcst);



if ($idcst <> 0) {
	if($stmhs=='tidak aktif'){
	$qmhs = mysqli_query($con, "UPDATE member_mahasiswa SET status='aktif', berakhir='$eDate', kuota='6' WHERE id='$idmhs' ");
	sendSMS($telp,$message);
	}
	else{
		$qmhs = mysqli_query($con, "UPDATE member_mahasiswa SET status='tidak aktif' WHERE id='$idmhs' ");
	}
		

	if ($qmhs)?>
		<script type="text/javascript">
			location.href = "../mahasiswa.php"
		</script>
		<?php		
}
else{
	if($stmhs=='tidak aktif'){
	$qmhs = mysqli_query($con, "UPDATE member_mahasiswa SET id_customer='".$cst['id']."', status='aktif', berakhir='$eDate', kuota='6' WHERE id='$idmhs' ");
	sendSMS($telp,$message);
	}
	else{
		$qmhs = mysqli_query($con, "UPDATE member_mahasiswa SET id_customer='".$cst['id']."', status='tidak aktif' WHERE id='$idmhs' ");
	}
		

	if ($qmhs)?>
		<script type="text/javascript">
			location.href = "../mahasiswa.php"
		</script>
		<?php
}	

?>