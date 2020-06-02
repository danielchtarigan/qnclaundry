<?php 
include 'config.php';
include 'encrypt-url.php';
include 'send_sms.php';
include 'wassenger_send.php';

date_default_timezone_set('Asia/Makassar');
$date = date('Y-m-d');

$kodeBersih = $kode_terima3;

$qman = $con->query("SELECT DISTINCT no_faktur, id_customer FROM reception c, (SELECT a.no_nota FROM manifest a, man_terima b WHERE a.kd_terima3=b.kode_terima AND b.kode_terima='$kodeBersih') d WHERE c.no_nota=d.no_nota ORDER BY no_faktur ASC");

while($data = $qman->fetch_array()){
	$id_cs = $data['id_customer']; 
	$noFaktur = $data['no_faktur'];

	$customers = mysqli_query($con, "SELECT * FROM customer WHERE id='$id_cs'");
	$cus = mysqli_fetch_assoc($customers);
	$telp = str_replace("0", "+62", substr($cus['no_telp'], 0,1)).substr($cus['no_telp'], 1);
	$nama = $cus['nama_customer'];

	$qdelivery = mysqli_query($con, "SELECT * FROM delivery WHERE no_faktur='$noFaktur'");
	$delivery = mysqli_num_rows($qdelivery);
	$url = encrypt("antarjemput",$key);
	$fdelivery = "www.qnclaundry.com/?delivery=".$url;

	if($delivery>0){
		$messageDel = "Form delivery Klik ".strip_tags($fdelivery)."\\n\\n";
		$messagequery = mysqli_query($con, "SELECT value FROM settings WHERE name='sms_cucian_selesai'");
	}
	else {
		$messageDel = "\\n";
		$messagequery = mysqli_query($con, "SELECT value FROM settings WHERE name='sms_cucian_selesai_delivery'");
	}

	$struk = encrypt($noFaktur,$key);
	$urlf = "www.notalaundry.com?id=".$struk;

	$message =  "QnC Laundry - Cucian Selesai\\n";
	$message .= "Cucian Anda dengan nomor Faktur ".strip_tags($noFaktur)." sudah selesai.\\n\\n";
	$message .= "Diskon 20% setiap transaksi dengan mendaftar sebagai Member Blue QnC\\n";
	$message .= strip_tags($messageDel);
	$message .= "Update status cucian Anda secara real-time di ".strip_tags($urlf).". Anda juga bisa mengatur metode notifikasi melalui SMS, Whatsapp, atau e-mail\\n\\n";
	$message .= "*Penyimpanan kontak ini sangat disarankan supaya link di atas dapat diklik secara otomatis tanpa perlu disalin terlebih dahulu\\n";
	$message .= "**Syarat dan ketentuan keluhan layanan QnC Laundry dapat dilihat di https://www.qnclaundry.net/complaint\\n";
	$message .= "***Pesan ini dikirim secara otomatis\\n\\n";



	$sql = $con->query("SELECT * FROM notifikasi_customer WHERE id_customer='$id_cs'");
	$rr = $sql->fetch_array();

	$notif = $rr['pilihan_notif'];

	$headMessage = "QnCLaundry";

	if(mysqli_num_rows($sql)>0) {
		switch ($notif) {
			case '0':
				$messagetemplate = mysqli_fetch_array($messagequery)[0];
				$message = str_replace("[NO_FAKTUR]",$noFaktur,$messagetemplate);
				$message = $headMessage."\r\n".$message."\r\n".$urlf;
				sendSMS($telp,$message);

				break;
			
			case '1':								
				$message = $message;
				sendWassenger($telp,$message,"normal");	
				
				$messagetemplate = mysqli_fetch_array($messagequery)[0];
				$message = str_replace("[NO_FAKTUR]",$noFaktur,$messagetemplate);
				$message = $headMessage."\r\n".$message."\r\n".$urlf;
				sendSMS($telp,$message);

				break;

			case '2':
				include 'send_mail.php';

				$email = $cus['email'] ;
				$subject = "Informasi Cucian Anda";

				$headMessage = "Dear Customer";
				$message = $headMessage."<br><br>".str_replace("\\n", "<br>", $message);
				$body = $message;

				send_mail($email,$subject,$body);

				break;
		}
	}

	else {
		$con->query("INSERT INTO notifikasi_customer VALUES ('$id_cs','$cus[no_telp]','1',NOW())");
		//$con->query("INSERT INTO notifikasi_customer VALUES ('$id_cs','$cus[no_telp]','0',NOW())");
		
		$message = $message;
		sendWassenger($telp,$message,"normal");
		
		$messagetemplate = mysqli_fetch_array($messagequery)[0];
		$message = str_replace("[NO_FAKTUR]",$noFaktur,$messagetemplate);
		$message = $headMessage."\r\n".$message."\r\n".$urlf;
		sendSMS($telp,$message);
	}	
}

	

	

	
