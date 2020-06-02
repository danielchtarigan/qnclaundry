<?php 
include '../../config.php';
include '../zonawaktu.php';
include '../../../send_sms.php';

$nowDate = date('Y-m-d');
$expDate = date('Y-m-d', strtotime('+1 months', strtotime($nowDate)));

$custData = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM customer WHERE id='$_POST[id]'"));

$upd = $con-> query("UPDATE customer SET member='1', jenis_member='Blue Free', tgl_join='$nowDate', tgl_akhir='$expDate' WHERE id='$_POST[id]'");

$upd .=	$con-> query("INSERT INTO membership (customer_id,no_telp,level,join_date,expire_date,user_allow,status) VALUES ('$custData[id]','$custData[no_telp]','Blue Free','$nowDate','$expDate','$_SESSION[user_id]','1')");

if($upd){	

	$telp = $custData['no_telp'];

$message = "QNCLAUNDRY
Anda telah terdaftar sbgai membership qnclaundry Free 1 bulan. Diskon 20% setiap transaksi. Aktif sampai ".date('d/m/Y', strtotime($expDate));
	
	sendSms($telp,$message);

	echo "Customer berhasil menjadi Membership selama 1 bulan";
}


?>