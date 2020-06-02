<?php 
// multiple recipients
include '../config.php';
session_start();$today = date("mY");
$query = "SELECT max(no_qa) AS last FROM quality_audit WHERE no_qa like '$today%'";
$hasil = mysqli_query($con,$query);
$data  = mysqli_fetch_array($hasil);
$lastNoTransaksi = $data['last'];
// baca nomor urut transaksi dari id transaksi terakhir
$lastNoUrut = substr($lastNoTransaksi, 6, 4);
// nomor urut ditambah 1
$nextNoUrut = $lastNoUrut + 1;
// membuat format nomor transaksi berikutnya
$nextNoTransaksi = $today.sprintf('%04s', $nextNoUrut);
date_default_timezone_set('Asia/Makassar');
$us=$_SESSION['user_id'];
$jam=date("Y-m-d H:i:s");
$no_nota=$_POST['no_nota'];
$ket=$_POST['ket'];
$bersih=$_POST['bersih'];
$harum=$_POST['harum'];
$rapi=$_POST['rapi'];
$jumlah=$_POST['jumlah'];
$waktu=$_POST['waktu'];
$nama_customer=$_POST['nama_customer'];
$qcek = mysqli_query($con,"select * from quality_audit where no_nota='$no_nota'");
$ncek = mysqli_num_rows($qcek);

if ($ncek<1){
	$q="insert into quality_audit(tgl_input,user_input,no_nota,bersih,harum,rapi,jumlah,waktu,ket,nama_customer,no_qa) VALUES('$jam','$us','$no_nota','$bersih','$harum','$rapi','$jumlah','$waktu','$ket','$nama_customer','$nextNoTransaksi')";
	$hasil2 = mysqli_query($con,$q);
	if($hasil2){
	$to  = 'aruldyan14@gmail.com' . ', '; // note the comma
	$to .= 'quicknclean.indonesia@gmail.com';
	// subject
	$subject = 'Quality Audit : ';
	$subject .= strip_tags($us);
	$message = '<html><body>';
	$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
	$message .= "<tr style='background: #eee;'><td><strong>NoNota:</strong> </td><td>" . strip_tags($no_nota) . "</td></tr>";
	$message .= "<tr><td><strong>Customer:</strong> </td><td>" . strip_tags($nama_customer) . "</td></tr>";
	$message .= "<tr><td><strong>Bersih:</strong> </td><td>" . strip_tags($bersih) . "</td></tr>";
	$message .= "<tr><td><strong>Rapi:</strong> </td><td>" . strip_tags($rapi) . "</td></tr>";
	$message .= "<tr><td><strong>Harum:</strong> </td><td>" . strip_tags($harum) . "</td></tr>";
	$message .= "<tr><td><strong>waktu:</strong> </td><td>" . strip_tags($waktu) . "</td></tr>";
	$message .= "<tr><td><strong>Jumlah:</strong> </td><td>" . strip_tags($jumlah) . "</td></tr>";
	$message .= "<tr><td><strong>Saran:</strong> </td><td>" . strip_tags($ket) . "</td></tr>";
	
	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	// Additional headers
	$headers .= 'to :'.$to.'' . "\r\n";
	$headers .= 'From: Quality Audit <admin@qnclaundry.com>' . "\r\n";
	$headers .= 'Cc: admin@qnclaundry.com' . "\r\n";
	$headers .= 'Bcc: admin@qnclaundry.com' . "\r\n";
	
	// Mail it
// 	mail($to, $subject, $message, $headers);
	?>
	<script type="text/javascript">
	location.href="index.php?menu=audit";
	</script>
	<?php
	}
	//echo'<font color="green">Sukses</font>';
}
else {
	?>
	<script type="text/javascript">
	 alert("Data telah di audit sebelumnya!!");
	 location.href="index.php?menu=audit";
	</script>
	<?php
}
?>
