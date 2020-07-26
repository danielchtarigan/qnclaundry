<?php 
include '../../config.php';
include '../zonawaktu.php';
include '../kode.php';

$date = date('Y-m-d', strtotime($nowDate));

if($_GET['carabayar']=="undefined"){ 
	echo "Anda belum menentukan Cara Bayarnya!!";
} else if($_GET['hargapaket']=='0'){
	echo "Error";
} else {
	if($_GET['masa_aktif']=='1'){
		$endDate = date('Y-m-d', strtotime('+1 months', strtotime($nowDate)));
	} else if($_GET['masa_aktif']=='2'){
		$endDate = date('Y-m-d', strtotime('+2 months', strtotime($nowDate)));
	}

	$query = mysqli_query($con, "SELECT no_faktur_urut FROM faktur_penjualan WHERE nama_outlet='$_SESSION[outlet]' ORDER BY id DESC LIMIT 0,1");
	$result = mysqli_fetch_row($query);

	if(strlen($result[0]) == 10) {
		$lastfaktur = (int)substr($result[0], 4, 6)+1;
	}
	else {
		$lastfaktur = (int)substr($result[0], 8, 3)+1;
	}
	
	$no_faktur = $kode_faktur.sprintf('%03s', $lastfaktur);


	mysqli_query($con, "INSERT INTO faktur_penjualan (no_faktur,no_faktur_urut,nama_outlet,rcp,tgl_transaksi,total,cara_bayar,id_customer,jenis_transaksi) VALUES ('$no_faktur','$no_faktur','$_SESSION[outlet]','$_SESSION[user_id]','$nowDate','$_GET[hargapaket]','$_GET[carabayar]','$_GET[id]','deposit')");


	$langganan = mysqli_query($con, "SELECT * FROM langganan WHERE id_customer='$_GET[id]'");
	$row = mysqli_fetch_assoc($langganan);


	$hargapaket = $_GET['hargapaket'];
	$paket = $_GET['paket'];

	if($_SESSION['cabang']=="Mojokerto") {
		$hargakilo = 7000;
	} else if($_SESSION['cabang']=="Medan") {
		$hargakilo = 7000;
	} else if($_SESSION['cabang']=="Jakarta"){
		$hargakilo = ($_SESSION['outlet']=="Gading Serpong") ? 8000 : 8800;
	}
		

	if(mysqli_num_rows($langganan)>0){
		$getkuota = $hargapaket;
		$addkuota = $getkuota+$row['all_kuota'];
		if($paket=="all_kiloan"){		
			$addkiloan = 30*$_GET['masa_aktif']+$row['kilo_cks'];
			$addpotongan = 0+$row['potongan'];
		} else if($paket=="single"){
			$addkiloan = 20*$_GET['masa_aktif']+$row['kilo_cks'];
			$addpotongan = 99000*$_GET['masa_aktif']+$row['potongan'];
		} else if($paket=="double"){
			$addkiloan = 40*$_GET['masa_aktif']+$row['kilo_cks'];
			$addpotongan = 363000*$_GET['masa_aktif']+$row['potongan'];
		} else if($paket=="custom"){
			$addkiloan = $getkuota/$hargakilo+$row['kilo_cks'];
			$addpotongan = 0;
		}

		mysqli_query($con, "UPDATE customer SET lgn='1' WHERE id='$_GET[id]'");
		mysqli_query($con, "UPDATE langganan SET tgl_expire='$endDate', all_kuota='$addkuota', kilo_cks='$addkiloan', potongan='$addpotongan' WHERE id_customer='$_GET[id]'");
	} else {
		$getkuota = $hargapaket;
		$addkuota = $getkuota;
		if($paket=="all_kiloan"){		
			$addkiloan = 30*$_GET['masa_aktif'];
			$addpotongan = 0+$row['potongan'];
		} else if($paket=="single"){
			$addkiloan = 20*$_GET['masa_aktif'];
			$addpotongan = 99000*$_GET['masa_aktif'];
		} else if($paket=="double"){
			$addkiloan = 40*$_GET['masa_aktif'];
			$addpotongan = 363000*$_GET['masa_aktif'];
		} else if($paket=="custom"){
			$addkiloan = $getkuota/$hargakilo;
			$addpotongan = 0;
		}

		mysqli_query($con, "UPDATE customer SET lgn='1' WHERE id='$_GET[id]'");

		mysqli_query($con, "INSERT INTO langganan VALUES ('','$date','$_GET[id]','$addkuota','$addkiloan','$addpotongan','$endDate')");
	}

	?>
	<script type="text/javascript">
		window.location="";
	</script>

	<?php
}

	

?>