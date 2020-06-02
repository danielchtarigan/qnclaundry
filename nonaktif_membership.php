<?php 
include 'config.php';
include 'send_sms.php';

$date = date('Y-m-d');

$sql = $con->query("SELECT a.customer_id AS cst, b.no_telp AS telp FROM membership a, customer b WHERE a.customer_id=b.id AND a.status=true AND a.expire_date<'$date' ");


while($rs = $sql->fetch_array()){

	$telp = $rs['telp'];

	$idtlp = explode(",", rtrim($telp,","));
	foreach ($idtlp as $key => $value) {
		$tlp = explode("-", $value);
		$tlp = $tlp[0];
		$msgs = "QNCLAUNDRY
Membership Anda telah berakhir, silahkan perpanjang untuk mendapatkan Diskon 20% stiap transaksi di outlet kami";

		$idcs = $rs['cst'];

		mysqli_query($con, "UPDATE customer SET member='0', jenis_member='' WHERE no_telp='$tlp' ");
		mysqli_query($con, "UPDATE membership SET status='0' WHERE customer_id='$idcs' ");
		
		sendSMS($tlp,$msgs);
	}


}


?>