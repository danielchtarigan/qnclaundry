<?php 
include '../../config.php';

foreach ($_POST['id'] as $key=>$val) {
	$id = $_POST['id'][$key];
	$izin2 = $_POST['izinlebihduajam'][$key];
	$izin1 = $_POST['izinkurangduajam'][$key];
	$absen = $_POST['absen'][$key];
	$duabelas = $_POST['duabelas'][$key];
	$komisiomset = $_POST['komisiomset'][$key];
	$reguler = $_POST['reguler'][$key];
	$aktelat = $_POST['aktelat'][$key];
	$telatsetor = $_POST['telatsetor'][$key];
	$date = date('Y-m-d');

	
	$update = mysqli_query($con, "UPDATE extra_operasional SET duabelasjam='$duabelas', izin_kurang_dua_jam='$izin1', izin_lebih_dua_jam='$izin2', absen='$absen', lembur_reguler='$reguler', komisi_omset='$komisiomset', tgl_update='$date', akumulasi_telat='$aktelat', telat_setor='$telatsetor' WHERE id_user='$id' ");	
}

if($update){?>
	<script type="text/javascript">
		alert("Data Berhasil Ditambahkan!!");
		location.href="../kerja_reception.php";
	</script><?php
}

?>