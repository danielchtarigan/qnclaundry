<?php 
include '../../config.php';
include '../zonawaktu.php';
include '../../bar128.php';
include '../../../send_sms.php';

$us = $_SESSION['user_id'];

mysqli_query($con, "INSERT INTO nota_checkout (no_nota) VALUES ('$_GET[nota]') ");
mysqli_query($con, "UPDATE reception SET kembali='1',tgl_kembali=NOW(),rcp_kembali='$us' WHERE no_nota='$_GET[nota]' ");

$sql = mysqli_query($con, "SELECT * FROM reception a, customer b WHERE a.id_customer=b.id AND a.no_nota='$_GET[nota]'");
$q = mysqli_fetch_array($sql);

$telp = $q['no_telp'];

$msg_selesai = mysqli_fetch_array(mysqli_query($con, "SELECT value FROM settings WHERE name='sms_selesai_global'"))[0];

$message = str_replace("[NO_ORDER]", $_GET['nota'], $msg_selesai);

sendSMS($telp,$message);



?>

<body onload="window.print()">
	<div style="width: 80mm">
		<div align="center" style="font-family: Arial; font-size: 14px; margin-bottom: 15px"  class="style1 style4">Checkout Control</div>
		<div style="font-size: 14px; font-family: Arial; font-weight: bolder; text-align: center" >
		<?php echo strtoupper($q['nama_outlet'])?></div>
		<div style="font-family: Arial" >
		<?php
		echo 'Nama : '.$q['nama_customer'].'<br>';
		echo 'Alamat : '.$q['alamat'].'<br>';
		echo 'No Telp : '.$q['no_telp'].'<br>';

		?>
		</div><br />
		<div align="center"><?php echo bar128(stripslashes($_GET['nota']))?></div>
		<br />
		<div style="font-family: Arial" >
		<?php echo "Tgl $nowDate<br />" ?>
		<?php echo "Quality Control :$_SESSION[user_id]" ?>
		</div>
	</div>

	<script type="text/javascript">
		setTimeout(function(){ close(); }, 2000);
	</script>
		
</body>



