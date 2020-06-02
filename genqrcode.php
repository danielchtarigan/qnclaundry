<?php
include "phpqrcode/qrlib.php"; //<-- LOKASI FILE UTAMA PLUGINNYA
 
$tempdir = "qrcodetemp/"; //<-- Nama Folder file QR Code kita nantinya akan disimpan
if (!file_exists($tempdir))#kalau folder belum ada, maka buat.
    mkdir($tempdir);

$sql = mysqli_query($con, "SELECT * FROM reception WHERE no_faktur='$no_faktur'");
		while($data = mysqli_fetch_array($sql)) {
			#parameter inputan
			$isi_teks = $data['no_nota'];
			$namafile = $data['no_nota'].'.png';
			$quality = 'H'; //ada 4 pilihan, L (Low), M(Medium), Q(Good), H(High)
			$ukuran = 5; //batasan 1 paling kecil, 10 paling besar
			$padding = 0;
			 
			$qrc = QRCode::png($isi_teks,$tempdir.$namafile,$quality,$ukuran,$padding);

		} 

		



 
?>


