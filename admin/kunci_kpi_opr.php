<?php 
include '../config.php';

$query = mysqli_query($con, "SELECT *FROM kpi_operasional");
$cek = mysqli_fetch_assoc($query);

foreach ($_POST['id'] as $key => $val) {
	$id = $_POST['id'][$key];
	$nama = $_POST['nama'][$key];
	$jabatan = $_POST['jabatan'][$key];
	$harikerja = $_POST['harikerja'][$key];
	$malam = $_POST['masukmalam'][$key];
	$pbrosur = $_POST['pbrosur'][$key];
	$poinhari = $_POST['target'][$key];
	$poinmin = $_POST['poinmin'][$key];
	$poinnonbonus = $_POST['poinnonbonus'][$key];
	$pencpoin = $_POST['pencapaianpoin'][$key];
	$pencpoinpotongan = $_POST['pencapaianpoin2'][$key];
	$bonuspot = $_POST['bonuspot'][$key];
	$cucikilo = $_POST['cucikiloan'][$key];
	$keringkilo = $_POST['keringkiloan'][$key];
	$setrikaritel = $_POST['poinsetrika'][$key];
	$cucipot = $_POST['cucipotongan'][$key];
	$photel = $_POST['poinhotel'][$key];
	$packingkilo = $_POST['packingkilo'][$key];
	$packingpot = $_POST['packingpot'][$key];
	$instmalam = $_POST['insmalam'][$key];
	$ketbonus = $_POST['ketbonus'][$key];
	$jumbonus = $_POST['bonusopr'][$key];
	$ketbonuspotongan = $_POST['ketbonus2'][$key];
	$jumbonuspotongan = $_POST['bonusopr2'][$key];
	$ketdenda = $_POST['ketdenda'][$key];
	$jumdenda = $_POST['denda'][$key];
	$ratahari = $_POST['rataharian'][$key];
	$kekuranganpoin = $_POST['kurangpoin'][$key];
	$awal = $_POST['awal'][$key];
	$akhir = $_POST['akhir'][$key];	
	
	
	if($awal==$cek['awal'] || $akhir==$cek['akhir']){
		$boleh = "false";	
	}
	else{
		$boleh = "true";
		$sukses = mysqli_query($con, "INSERT INTO kpi_operasional (id,awal,akhir, nama_crew, jabatan, hari_kerja, masuk_malam, poin_brosur, poin_harian,poin_min,poin_nonbonus,pencapaian_poin,bonus_potongan,cuci_kiloan,kering_kiloan,setrika_ritel,cuci_potongan,cuci_packing_hotel,packing_kiloan,packing_potongan,insentif_malam,ket_bonus,jum_bonus,ket_denda,jum_denda,rata_harian,kekurangan_poin_perbulan,pencapaian_potongan,bonus_kpi_potongan,ket_bonus_potongan) VALUES ('','$awal','$akhir', '$nama', '$jabatan', '$harikerja','$malam','$pbrosur','$poinhari','$poinmin','$poinnonbonus','$pencpoin','$bonuspot','$cucikilo','$keringkilo','$setrikaritel','$cucipot','$photel','$packingkilo','$packingpot','$instmalam','$ketbonus','$jumbonus','$ketdenda','$jumdenda','$ratahari','$kekuranganpoin','$pencpoinpotongan', '$jumbonuspotongan', '$ketbonuspotongan') ");

		if($sukses){ ?>
			<script type="text/javascript">
				location.href="kpi_operasional.php";
			</script>
		<?php 
		} 
	}
}

if($boleh=="false"){
	echo "DATA PADA RANGE TANGGAL YANG SAMA TELAH DIKUNCI!";
}
?>

