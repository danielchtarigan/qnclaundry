<?php 
include '../../config.php';

$query = mysqli_query($con, "SELECT *FROM kpi_resepsionis");
$cek = mysqli_fetch_assoc($query);

foreach ($_POST['id'] as $key => $val) {
	$id = $_POST['id'][$key];
	$nama = $_POST['rcp'][$key];	
	$tipe = $_POST['tipe'][$key];
	$hadir = $_POST['hadir'][$key];
	$gajipokok = $_POST['gajipokok'][$key];
	$lemburreg = $_POST['lemburreg'][$key];
	$duabelas = $_POST['duabelas'][$key];
	$bonusspk = $_POST['bonusspk'][$key];
	$bonusmember = $_POST['bonusmember'][$key];
	$bonusqa = $_POST['bonusqa'][$key];
	$komisilgn = $_POST['komisilgn'][$key];
	$komisiomset = $_POST['komisiomset'][$key];
	$reject = $_POST['reject'][$key];
	$tidaksetor = $_POST['tidaksetor'][$key];
	$tidaktk = $_POST['tidaktk'][$key];
	$tidakso = $_POST['tidakso'][$key];
	$absen = $_POST['absen'][$key];
	$izin1 = $_POST['izin1'][$key];
	$izin2 = $_POST['izin2'][$key];
	$terlambat = $_POST['terlambat'][$key];
	$gaji = $_POST['gaji'][$key];	
	$awal = $_POST['awal'][$key];
	$akhir = $_POST['akhir'][$key];	
	
	
	if($awal==$cek['tgl_awal'] || $akhir==$cek['tgl_akhir']){
		$boleh = "false";	
	}
	else{
		$boleh = "true";
		$sukses = mysqli_query($con, "INSERT INTO kpi_resepsionis (id,tgl_awal,tgl_akhir,rcp,tipe_rcp,hari_kerja,gaji_pokok,lembur_reg,lembur_duabelas,bonus_spk,bonus_member,bonus_qa,komisi_lgn,komisi_omset,kasus_reject,tidak_menyetor,tidak_tk,tidak_so,absen,izin_kurang_dua_jam,izin_lebih_dua_jam,akumulasi_terlambat,gaji_bersih) VALUES ('','$awal','$akhir', '$nama', '$tipe', '$hadir','$gajipokok','$lemburreg','$duabelas','$bonusspk','$bonusmember','$bonusqa','$komisilgn','$komisiomset','$reject','$tidaksetor','$tidaktk','$tidakso','$absen','$izin1','$izin2','$terlambat','$gaji') ");

		if($sukses){ ?>
			<script type="text/javascript">
				location.href="../kpi_reception.php";
			</script>
		<?php 
		} else {
			echo "Gagal!!";
		}
	}
}

if($boleh=="false"){
	echo "DATA PADA RANGE TANGGAL YANG SAMA TELAH DIKUNCI!";
}
?>