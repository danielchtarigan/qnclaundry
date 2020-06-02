<?php 
include 'config.php';
include 'encrypt-url.php';
include 'send_sms.php';
include 'wassenger_send.php';

date_default_timezone_set('Asia/Makassar');

$outlet = $ot;
$id_cs = $idcs;
$noNota = $no_nota;
$noFaktur = $faktur;
$jumlah = $hr;


$notamasuk = $con->query("SELECT * FROM reception WHERE no_faktur='$noFaktur' AND cara_bayar<>'Void' AND status_order=''");
$jumNotamasuk = mysqli_num_rows($notamasuk);

$notaSpk = $con->query("SELECT * FROM reception WHERE no_faktur='$noFaktur' AND cara_bayar<>'Void' AND status_order='' AND spk=true");
$jumNotaSpk = mysqli_num_rows($notaSpk);

$message = "QnC laundry - Jumlah Pakaian\\n\\n";
$message .= "Cucian Anda di QnC Laundry ".strip_tags($outlet)." telah kami terima dengan detail sebagai berikut :\\n\\n"; 
$message .= "Nomor Faktur : ".strip_tags($noFaktur)."\\n";
$message .= "Nomor Order : \\n";

if($jumNotamasuk==$jumNotaSpk){
	while($data = $notaSpk->fetch_array()){

		$qhr = $con->query("SELECT SUM(jumlah) FROM detail_spk WHERE no_nota='".$data['no_nota']."'");
		$hr = $qhr->fetch_array();

		$message .= strip_tags($data['no_nota']).' jumlah item '.strip_tags($hr[0]).'\\n';
	}

    $customers = mysqli_query($con, "SELECT * FROM customer WHERE id='$id_cs'");
    $cus = mysqli_fetch_assoc($customers);
    $telp = str_replace("0", "+62", substr($cus['no_telp'], 0,1)).substr($cus['no_telp'], 1);
    $nama = $cus['nama_customer'];
    $struk = encrypt($noFaktur,$key);
    $urlf = "www.notalaundry.com/?id=".$struk;
    
    $message .= "\\nUpdate status cucian Anda secara real-time di ".strip_tags($urlf)."\\n\\n";
    $message .= "*Penyimpanan kontak ini sangat disarankan supaya link di atas dapat diklik secara otomatis tanpa perlu disalin terlebih dahulu\\n";
    $message .= "**Pesan ini dikirim secara otomatis";
    
    $sql = $con->query("SELECT * FROM notifikasi_customer WHERE id_customer='$id_cs'");
    $rr = $sql->fetch_array();
    $notif = $rr['pilihan_notif'];
    if(mysqli_num_rows($sql)>0) {
    	switch ($notif) {
    		case '0':
    
    			$message = mysqli_fetch_row(mysqli_query($con, "SELECT value FROM settings WHERE name='notif_spk'"))[0];
    			$message = str_replace("[no_nota]", $noNota, $message);
    			$message = str_replace("[jumlah]", $jumlah, $message);
    			$message = $headMessage."\r\n".$message."\r\n".$urlf;
    			sendSMS($telp,$message);
    
    			break;
    		
    		case '1':
    			
    			$message = strip_tags($headMessage)." - Customer Yth.\\nCucian Anda dengan nomor order ".strip_tags($noNota)." sudah dihitung dengan jumlah ".strip_tags($jumlah)." pcs.\\n\\n";
    			$message .= "Update status cucian Anda secara real-time di ".strip_tags($urlf)."\\n\\n";
    			sendWassenger($telp,$message,"normal");		
    			
    			/*$message = mysqli_fetch_row(mysqli_query($con, "SELECT value FROM settings WHERE name='notif_spk'"))[0];
    			$message = str_replace("[no_nota]", $noNota, $message);
    			$message = str_replace("[jumlah]", $jumlah, $message);
    			$message = $headMessage."\r\n".$message."\r\n".$urlf;
    			sendSMS($telp,$message);*/
    
    			break;
    
    		case '2':
    			include 'send_mail.php';
    
    			$email = $cus['email'] ;
    			$subject = "Informasi Cucian Anda";
    
    			/*$message = mysqli_fetch_row(mysqli_query($con, "SELECT value FROM settings WHERE name='notif_spk'"))[0];
    			$message = str_replace("[no_nota]", $noNota, $message);
    			$message = str_replace("[jumlah]", $jumlah, $message);
    			$message = "Dear Customer<br>\r\n<br>\r\n".$message."<br>\r\n<br>\r\nUpdate status cucian Anda secara real-time di ".strip_tags($urlf);*/
    
    			$body = str_replace("\\n", "<br>", $message);
    
    			send_mail($email,$subject,$body);	
    
    			break;
    	}
    }
    
    else {
    
    	$con->query("INSERT INTO notifikasi_customer VALUES ('$id_cs','$cus[no_telp]','1',NOW())");
    	//$con->query("INSERT INTO notifikasi_customer VALUES ('$id_cs','$cus[no_telp]','0',NOW())");
    
    	$message = strip_tags($headMessage)." - Customer Yth.\\nCucian Anda dengan nomor order ".strip_tags($noNota)." sudah dihitung dengan jumlah ".strip_tags($jumlah)." pcs.\\n\\n";
    	$message .= "Update status cucian Anda secara real-time di ".strip_tags($urlf)."\\n\\n";
    	sendWassenger($telp,$message,"normal");
    	
    	$message = mysqli_fetch_row(mysqli_query($con, "SELECT value FROM settings WHERE name='notif_spk'"))[0];
		$message = str_replace("[no_nota]", $noNota, $message);
		$message = str_replace("[jumlah]", $jumlah, $message);
		$message = $headMessage."\r\n".$message."\r\n".$urlf;
		sendSMS($telp,$message);
    }
}

?>

	