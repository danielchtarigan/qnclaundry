<?php 
include '../wassenger_send.php';
include '../config.php';
include '../encrypt-url.php';

$date = date('Y-m-d');
$ot = $_SESSION['nama_outlet'];

$qnotsends = $con->query("SELECT DISTINCT(id_customer) AS id_customer, no_faktur FROM reception WHERE sms_sent=false AND DATE(tgl_kembali) BETWEEN '2019-03-26' AND '$date' AND nama_outlet='$ot'");
while($notsend = $qnotsends->fetch_array()){

	$custs = $con->query("SELECT * FROM customer WHERE id='$notsend[id_customer]'");
	$cust = $custs->fetch_array();
	$telp = str_replace(".", "", str_replace("0", "+62", substr($cust['no_telp'], 0, 1)).substr($cust['no_telp'], 1));
	
	$qdelivery = mysqli_query($con, "SELECT * FROM delivery WHERE no_faktur='$notsend[no_faktur]'");
	$delivery = mysqli_num_rows($qdelivery);

	$url = encrypt("antarjemput",$key);

	$fdelivery = "www.qnclaundry.com/?delivery=".$url;
	if($delivery>0){
		$messagequery = mysqli_query($con, "SELECT value FROM settings WHERE name='sms_cucian_selesai'");
		$messageDelivery = "";
	}
	else{
		$messagequery = mysqli_query($con, "SELECT value FROM settings WHERE name='sms_cucian_selesai_delivery'");
		$messageDelivery = "\\n\\nJIka butuh pengantaran dan penjemputan cucian, silahkan isi form ".strip_tags($fdelivery);
	}
	$messagetemplate = mysqli_fetch_array($messagequery)[0];
	$message = str_replace("[NO_FAKTUR]",$notsend['no_faktur'],$messagetemplate).$messageDelivery;

	// echo $telp.' '.$message;
	// echo '<br><br>';
	sendWassenger($telp,$message);
	// echo $cust['id'].' '.$cust['nama_customer'].' '.$telp.' '.$notsend['no_faktur'];
	// echo '<br>';

	mysqli_query($con, "UPDATE reception SET sms_sent='1' WHERE no_nota='$notsend[no_nota]'");		
} 