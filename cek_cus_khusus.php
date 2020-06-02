<?php 
require 'config.php';

include 'wassenger_send.php';

$date = date('Y-m-d H:i:s');

$sql = mysqli_query($con, "SELECT * from customer_khusus a, customer b where a.id_customer=b.id AND a.status='1' AND a.tgl_berakhir<='$date' ORDER BY id_customer ASC");
while($row = mysqli_fetch_array($sql)){
	
	$telp = str_replace("0", "+62", substr($row['no_telp'], 0,1)).substr($row['no_telp'], 1);
	$nama = $row['nama_customer'];
	$id = $row['id_customer'];

	$sql2 = mysqli_query($con, "SELECT COUNT(distinct date(tgl_input)) FROM reception WHERE id_customer='$row[id_customer]' AND tgl_input BETWEEN '$date' - INTERVAL 30 DAY AND '$date'");
	$countF = mysqli_fetch_array($sql2)[0];

	if($countF>=3){
		$con->query("UPDATE customer_khusus SET tgl_berakhir='$date' + INTERVAL 30 DAY, status='1' WHERE id_customer='$row[id_customer]'");
		$con->query("UPDATE customer SET type_c='1' WHERE id='$row[id_customer]'");

		$message = "Customer Yth. \\nharga khusus untuk Anda *Rp.7600/Kg* diperpanjang sampai ".date('d/m/Y', strtotime('+30 days', strtotime(date('Y-m-d'))))." \\n\\nPromo ini akan diperpanjang otomatis dengan syarat cucian minimanl 3x berkunjung tiap bulan tanpa minimal berat\\n\\n";
		$message .= "*Pesan ini dikirim secara otomatis";
		sendWassenger($telp,$message);
	}
	else {
		$con->query("UPDATE customer_khusus SET status='0' WHERE id_customer='$row[id_customer]'");
		$con->query("UPDATE customer SET type_c='0' WHERE id='$row[id_customer]'");
	}

		

}


