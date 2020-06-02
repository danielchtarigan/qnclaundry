<?php
include '../../config.php';
include '../../wassenger_send.php';
session_start();
$us=$_SESSION['user_id'];
$ot=$_SESSION['nama_outlet'];
$jam1 = date("Y-m-d");	 
if (isset($_GET['nama'])){
 $nama = $_GET['nama'];
}
if (isset($_GET['telepon'])){
 $telepon = $_GET['telepon'];
}
if (isset($_GET['referensi'])){
 $referensi = $_GET['referensi'];
}
$cekref = mysqli_query($con, "select * from customer where no_telp='$referensi'");
$rcek = mysqli_num_rows($cekref);
if (($referensi<>'') and ($rcek<1)){
?>
<script type="text/javascript">
 alert('No Telepon Referensi tidak ditemukan!');
 history.back();
</script>	
<?php	
}
else{
$qcus = mysqli_query($con, "select * from customer where no_telp='$telepon'");
$ncus = mysqli_num_rows($qcus);
if ($ncus > 0){
?>
<script type="text/javascript">
 alert('No Telepon ini telah terdaftar sebelumnya!');
 history.back();
</script>	
<?php
	}
else{
$qcus = mysqli_query($con, "insert into customer (id, nama_customer, no_telp, alamat, tgl_input, info_dari, outlet, user_input, referensi) values ('', '$_GET[nama]', '$_GET[telepon]' , '$_GET[alamat]', '$jam1', '$_GET[info]', '$ot', '$us', '$referensi')");

$sql = mysqli_query($con, "SELECT * FROM kode_voucher_pack WHERE status=true AND tgl_berakhir>'$jam1' ORDER BY tgl_dibuat DESC");
$rr = mysqli_fetch_array($sql);

$sql2 = mysqli_query($con, "SELECT * FROM customer WHERE no_telp='$_GET[telepon]'");
$rr2 = mysqli_fetch_array($sql2);

$telp = $rr2['no_telp'];
$telp = str_replace("0", "+62", substr($telp, 0, 1)).substr($telp, 1);
$pesan = "Welcome to QnC Laundry\\nSimpanlah nomor ini agar Anda dapat mengakses link berisi real time update cucian Anda.\\n\\nAnda mendapatkan Welcome Voucher dengan kode ";

if(mysqli_num_rows($sql)>0){
	$qcus .= mysqli_query($con, "UPDATE customer SET kode_referral='".$rr['nama_kode'].$rr2['id']."' WHERE id='$rr2[id]' ");

	$pesan .= $rr['nama_kode'].$rr2['id'];
	$pesan .= "\\nDapatkan harga promo cuci berikut ini:\\n";

	$qi = "INSERT INTO pemilik_voucher_pack VALUES ";
	$no = 1;
	$packets = mysqli_query($con, "SELECT * FROM subkode_voucher_pack WHERE id_kode='$rr[id_kode]' ORDER BY id_subkode ASC");
	while($pack = mysqli_fetch_array($packets)){
		$pesan .= $no++;
		if($pack['gratis_order']!=""){
			$pesan .= ". ".$pack['syarat_order']." ".$pack['nama_item']." gratis cuci 1 ".$pack['gratis_order']." (max. ".$pack['maks_penggunaan']." kali transaksi)\\n";
		}
		else {
			$pesan .= ". ".$pack['nama_item']." hanya Rp".number_format($pack['harga_baru'],0,',','.')."/pcs (max. ".$pack['maks_penggunaan']." kali transaksi)\\n";
		}
			

		$id_pemilik = $pack['id_subkode'].$rr2['id'];
		$id_subkode = $pack['id_subkode'];
		$qi .= "('$id_pemilik','$id_subkode','$rr2[id]','0','0'),";		
	}

	$pesan .= "\\nGunakan semuanya sebelum tanggal ".date('d/m/Y', strtotime($rr['tgl_berakhir']))." yg berlaku di outlet ".$ot."\\n\\n";
	$pesan .= "Di QnC Laundry semua cucian Anda direkam kamera untuk memastikan jumlah awal dan jumlah akhir sama. Jika ada komplain, hubungi layanan pelanggan kami di 08119325258/08114443180\\n\\n";
	$pesan .= "Syarat dan ketentuan mencuci di QnC Laundry dapat diakses di www.qnclaundry.net/complaint";

	$qi = rtrim($qi,',');
	$qq = mysqli_query($con, $qi);	

	sendWassenger($telp,$pesan,"high");
}	


if ($qcus){
?>
<script type="text/javascript">
 alert('Pelanggan baru telah terdaftar!');
 history.back();
</script>	
<?php	
 }
 else{
?>
<script type="text/javascript">
 alert('Kesalahan query!');
 history.back();
</script>	
<?php	
	 }
}
}
?>