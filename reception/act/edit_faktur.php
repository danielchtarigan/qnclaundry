<?php
include '../../config.php';
session_start();

date_default_timezone_set('Asia/Makassar');
$tanggal = date("Y-m-d H:i:s");
if(isset($_GET['kirim'])){
$rcp = $_SESSION['user_id'];
$ket = $_GET['keterangan'];
$fktr = $_GET['faktur'];
$tot = $_GET['total'];
$byr = $_GET['carabayar'];
	
$qedit = mysqli_query($con, "insert into edit_faktur values ('','$tanggal','$rcp','$fktr','$tot','$byr','$ket','','')");
if($qedit){	

	$cekfakturcash = mysqli_query($con, "SELECT no_faktur,cara_bayar FROM faktur_penjualan WHERE no_faktur='$fktr' AND cara_bayar LIKE '%cash%' ");
	$data = mysqli_fetch_row($cekfakturcash);
	if(mysqli_num_rows($cekfakturcash)>0){
		mysqli_query($con, "UPDATE cara_bayar SET cara_bayar='Salah Cara Bayar' WHERE no_faktur='$fktr'");
		mysqli_query($con, "UPDATE faktur_penjualan SET cara_bayar='Salah Cara Bayar' WHERE no_faktur='$fktr'");
	}



	$to  = 'laurafany.m@gmail.com';

	// subject
	$subject = 'Salah Cara Bayar: ';
	$message = '<html><body>';
	$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
	$message .= "<tr><td><strong>Resepsionis:</strong> </td><td>" . strip_tags($rcp) . "</td></tr>";
	$message .= "<tr><td><strong>Faktur:</strong> </td><td>" . strip_tags($fktr) . "</td></tr>";
	$message .= "<tr><td><strong>Cara Bayar Seharusnya:</strong> </td><td>" . strip_tags($byr) . "</td></tr>";
	$message .= "<tr><td><strong>Keterangan:</strong> </td><td>" . strip_tags($ket) . "</td></tr>";


	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	// Additional headers
	$headers .= 'to :'.$to.'' . "\r\n";
	$headers .= 'From: Cara Bayar<admin@qnclaundry.com>' . "\r\n";
	$headers .= 'Cc: aruldyan14@gmail.com' . "\r\n";


	// Mail it
	mail($to, $subject, $message, $headers);
	
	?>
	<script type="text/javascript">
	alert("Berhasil");
	location.href="../index.php";
	</script>	
    <?php	
	}		
	else{
	?>    
	<script type="text/javascript">
	alert("Ulangi");
	location.href="../index.php?menu=void";
	</script>	
    <?php
	}
    
}
	
	
?>