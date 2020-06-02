<?php 
include 'config.php';
include 'send_sms.php';

/*==Kirim pesan reminder masa aktif==*/
$sql = $con->query("SELECT * FROM langganan WHERE (DATE(tgl_expire) = CURDATE() + INTERVAL 4 DAY) AND all_kuota>0 ");
while($rr = $sql->fetch_array()){
	$phone = mysqli_fetch_row(mysqli_query($con, "SELECT no_telp FROM customer WHERE id='$rr[id_customer]'"))[0];
	$message = mysqli_fetch_row(mysqli_query($con, "SELECT value FROM settings WHERE name='notif_langganan1'"))[0];
	$message = str_replace("[dd-mm-yyyy]", date('d-m-Y', strtotime($rr['tgl_expire'])) , $message);

	sendSMS($phone,$message);

}

/*==Non aktifkan Langganan==*/
$sql = $con->query("SELECT * FROM langganan WHERE DATE(tgl_expire) < CURDATE() AND CURDATE()>='2019-04-14' ORDER BY tgl_expire ASC");
while($rr = $sql->fetch_array()){	
	$con->query("UPDATE customer SET lgn='0' WHERE id='$rr[id_customer]'");

}

/*==Notifikasi Hanguskan Langganan==*/
$sql = $con->query("SELECT * FROM langganan WHERE (DATE(tgl_expire) <= CURDATE() - INTERVAL 90 DAY) AND all_kuota>0 ORDER BY tgl_expire ASC");
while($rr = $sql->fetch_array()){

	$telp = mysqli_fetch_row(mysqli_query($con, "SELECT no_telp FROM customer WHERE id='$rr[id_customer]'"))[0];
	$message = mysqli_fetch_row(mysqli_query($con, "SELECT value FROM settings WHERE name='notif_langganan2'"))[0];
	$message = str_replace("[dd-mm-yyyy]", date('d-m-Y', strtotime($rr['tgl_expire'])) , $message);	
	sendSMS($telp,$message);

}

/*==Hanguskan Langganan==*/
$sql = $con->query("SELECT * FROM langganan WHERE (DATE(tgl_expire) <= CURDATE() - INTERVAL 91 DAY) AND CURDATE()>='2019-04-14' AND all_kuota>0  ORDER BY tgl_expire ASC");
while($rr = $sql->fetch_array()){

	$con->query("UPDATE langganan SET all_kuota='0',kilo_cks='0',potongan='',harga_satuan='0' WHERE id_customer='$rr[id_customer]'");

}

?>