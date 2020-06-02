<?php
include '../../config.php';

$query = mysqli_query($con, "SELECT *FROM kpi_opr");
$cek = mysqli_fetch_assoc($query);

foreach ($_POST['id'] as $key => $value) {
	$id = $_POST['id'][$key];
	$user = $_POST['user'][$key];
	$jabatan = $_POST['jabatan'][$key];
	$target = $_POST['target'][$key];
	$hadir = $_POST['hadir'][$key];
	$masuk_malam = $_POST['masuk_malam'][$key];
	$poin_minimal = $_POST['poin_minimal'][$key];
	$cuci_kiloan = $_POST['cuci_kiloan'][$key];
	$poin_pengering = $_POST['poin_pengering'][$key];
	$cuci_potongan = $_POST['cuci_potongan'][$key];
	$setrika = $_POST['setrika'][$key];
	$packing_kiloan = $_POST['packing_kiloan'][$key];
	$packing_potongan = $_POST['packing_potongan'][$key];
	$poin_hotel = $_POST['poin_hotel'][$key];
	$insentif_malam = $_POST['insentif_malam'][$key];
	$bagi_brosur = $_POST['bagi_brosur'][$key];
	$poin_express = $_POST['poin_express'][$key];
	$poin_priority = $_POST['poin_priority'][$key];
	$total_pencapaian_poin = $_POST['total_pencapaian_poin'][$key];
	$bonus_omset_potongan = $_POST['bonus_omset_potongan'][$key];
	$cucian_telat = $_POST['cucian_telat'][$key];
	$kasus_operasional = $_POST['kasus_operasional'][$key];
	$total_denda_operasional = $_POST['total_denda_operasional'][$key];
	$pencapaian_akhir = $_POST['pencapaian_akhir'][$key];
	$rata_harian = $_POST['rata_harian'][$key];
	$kekurangan_poin_perbulan = $_POST['kekurangan_poin_perbulan'][$key];
	$total_bonus = $_POST['total_bonus'][$key];
	$total_potongan = $_POST['total_potongan'][$key];
	$grand_total = $_POST['grand_total'][$key];
	$awal = $_POST['awal'][$key];
	$akhir = $_POST['akhir'][$key];

	
	if($awal==$cek['awal'] || $akhir==$cek['akhir']){
		$allow = "false";
	} else {
		$allow = "true";
		$sisipkan = mysqli_query($con, "INSERT INTO kpi_opr VALUES ('','$awal','$akhir','$id','$user','$jabatan','$target','$hadir','$masuk_malam','$poin_minimal','$cuci_kiloan','$poin_pengering','$cuci_potongan','$setrika','$packing_kiloan','$packing_potongan','$poin_hotel','$insentif_malam','$bagi_brosur','$poin_express','$poin_priority','$total_pencapaian_poin','$bonus_omset_potongan','$cucian_telat','$kasus_operasional','$total_denda_operasional','$pencapaian_akhir','$rata_harian','$kekurangan_poin_perbulan','$total_bonus','$total_potongan','$grand_total')");
	}

}
if($allow=="false"){?>
	<script type="text/javascript">
		alert("Data KPI tidak bisa dikunci dua kali!!");
	</script>
<?php }?>

<script type="text/javascript">
	location.href = "../kpi_operasional.php";
</script>
								
									
								