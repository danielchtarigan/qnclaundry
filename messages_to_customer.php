<?php 
include 'config.php';
include 'encrypt-url.php';

date_default_timezone_set('Asia/Makassar');

$outlet = $ot;
$id_cs = $id_cs;
$noFaktur = $noFaktur;
$nominalFaktur = $tagihan;

$customers = mysqli_query($con, "SELECT * FROM customer WHERE id='$id_cs'");
$cus = mysqli_fetch_assoc($customers);
$telp = str_replace("0", "+62", substr($cus['no_telp'], 0,1)).substr($cus['no_telp'], 1);
$nama = $cus['nama_customer'];
$struk = encrypt($noFaktur,$key);
$urlf = "www.notalaundry.com/?id=".$struk;

$sql = $con->query("SELECT * FROM notifikasi_customer WHERE id_customer='$id_cs'");
$rr = $sql->fetch_array();

$notif = $rr['pilihan_notif'];

$headMessage = "QnCLaundry";
$bodyMessage = "Nota Order Cucian Anda di QnC Laundry ".strip_tags($outlet)." telah kami terima dengan detail berikut:\\n";
$bodyMessage .= "Nomor Faktur ".strip_tags($noFaktur)."\\nNominal Transaksi Rp. ".strip_tags($nominalFaktur)."\\n\\n";
$bodyMessage .= "Update status cucian Anda secara real-time di ".strip_tags($urlf).". Anda juga bisa mengatur metode notifikasi melalui SMS, Whatsapp, atau e-mail\\n\\n";
$footMessage = "*Penyimpanan kontak ini sangat disarankan supaya link di atas dapat diklik secara otomatis tanpa perlu disalin terlebih dahulu\\n";
$footMessage = "Anda dapat juga membalas Whatsapp ini dan Customer Service kami siap melayani Anda.\\n";
$footMessage .= "**Syarat dan ketentuan keluhan layanan QnC Laundry dapat dilihat di https://www.qnclaundry.net/complaint\\n";
$footMessage .= "***Pesan ini dikirim secara otomatis";

if(mysqli_num_rows($sql)>0) {
	switch ($notif) {
		case '0':
			include 'send_sms.php';

			$message = mysqli_fetch_row(mysqli_query($con, "SELECT value FROM settings WHERE name='cucian_masuk'"))[0];
			$message = str_replace("[no_faktur]", $noFaktur, $message);
			$message = str_replace("[nominal]", $nominalFaktur, $message);
			$message = $headMessage."\r\n".$message."\r\n".$urlf;
			sendSMS($telp,$message);

			break;
		
		case '1':
			include 'wassenger_send.php';
			include 'send_sms.php';

			$message = strip_tags($headMessage)." - ".strip_tags($bodyMessage).strip_tags($footMessage);
			sendWassenger($telp,$message,"urgent");		
			

			/*$message = mysqli_fetch_row(mysqli_query($con, "SELECT value FROM settings WHERE name='cucian_masuk'"))[0];
			$message = str_replace("[no_faktur]", $noFaktur, $message);
			$message = str_replace("[nominal]", $nominalFaktur, $message);
			$message = $headMessage."\r\n".$message."\r\n".$urlf;
			sendSMS($telp,$message);*/

			break;

		case '2':
			include 'send_mail.php';

			$email = $cus['email'] ;
			$subject = "Informasi Cucian Anda";

			$message = mysqli_fetch_row(mysqli_query($con, "SELECT value FROM settings WHERE name='cucian_masuk'"))[0];
			$message = str_replace("[no_faktur]", $noFaktur, $message);
			$message = str_replace("[nominal]", $nominalFaktur, $message);
			$message = "Dear Customer\r\n<br>".$message."<br>\r\nUpdate status cucian Anda secara real-time di ".strip_tags($urlf);

			$body = $message;

			send_mail($email,$subject,$body);	

			break;
	}
}

else {

	$con->query("INSERT INTO notifikasi_customer VALUES ('$id_cs','$cus[no_telp]','1',NOW())");
	//$con->query("INSERT INTO notifikasi_customer VALUES ('$id_cs','$cus[no_telp]','0',NOW())");

	include 'wassenger_send.php';
	include 'send_sms.php';

	$message = strip_tags($headMessage)." - ".strip_tags($bodyMessage).strip_tags($footMessage);
	sendWassenger($telp,$message,"urgent");
	
	$message = mysqli_fetch_row(mysqli_query($con, "SELECT value FROM settings WHERE name='cucian_masuk'"))[0];
	$message = str_replace("[no_faktur]", $noFaktur, $message);
	$message = str_replace("[nominal]", $nominalFaktur, $message);
	$message = $headMessage."\r\n".$message."\r\n".$urlf;
	sendSMS($telp,$message);
}
	
	

?>

	