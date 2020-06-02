<?php
include '../../config.php';
session_start();

date_default_timezone_set('Asia/Makassar');
$jam1 = date("Y-m-d h:i:s");	 

 if (isset($_GET['voucher'])){
	 $voucher = $_GET['voucher'];
	 }

 $potongan = 0;
 if ($voucher<>''){
	 $qvouc = mysqli_query($con, "select * from voucher_lucky where no_voucher='$voucher' and aktif='1'");
	 $nvouc = mysqli_num_rows($qvouc);
	 $rvouc = mysqli_fetch_array($qvouc);
	 $potongan = $rvouc['disk'];
	 if ($nvouc<1){
	 ?>
     <script type="text/javascript">
	  alert('Kode Voucher tidak dapat digunakan!');
	  history.back();
	 </script>
     <?php
	 }
	 else if ($total<=30000){
	 ?>
     <script type="text/javascript">
	  alert('Kode Voucher tidak dapat digunakan! Nilai Transaksi diatas Rp. 30.000');
	  history.back();
	 </script>
     <?php
	 }
	 else{
	 $qv = mysqli_query($con, "select * from voucher_lucky where no_voucher='$voucher'");
	 $rv = mysqli_fetch_array($qv);
	 $qrincian10 = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', 'Voucher $rv[no_voucher]', '$rv[disk]', '0', '$rv[disk]', '$no_nota', '$id_cust', '0')");
	 
	  if (($rv['jenis_voucher'] == 'RV') and ($rv['kali'] <= 10 )){
		 $baru = $rv['kali']+1;
		 $qvouc1 = mysqli_query($con, "update voucher_lucky set kali='$baru' where no_voucher='$voucher'");
	  }
      else{
		 $qvouc1 = mysqli_query($con, "update voucher_lucky set aktif='0' where no_voucher='$voucher'");
		 $qvouc2 = mysqli_query($con, "insert into voucher_used values ('', '$jam1', '$_SESSION[user_id]', '$voucher', '$id_cust', '$_SESSION[nama_outlet]')");		
	  }
	 }
    }

 if (isset($_GET['itemklp'])){
	 $itemklp = $_GET['itemklp'];
 }
 if (isset($_GET['ket1'])){
	 $ket1 = $_GET['ket1'];
	 }
 if (isset($_GET['jumlah'])){
	 $ket1 = $_GET['jumlah'];
	 }
 if (isset($_GET['parfum'])){
	 $parfum = $_GET['parfum'];
	 }
 if (isset($_GET['beratitem'])){
	 $beratitem = $_GET['beratitem'];
	 }
 if (isset($_GET['id_cs'])){
	 $id_cs = $_GET['id_cs'];
	 }
 if (isset($_GET['nama_customer'])){
	 $nama_customer = $_GET['nama_customer'];
	 }
 if (isset($_GET['id_cust'])){
	 $id_cust = $_GET['id_cust'];
	 }
 if (isset($_GET['cabang'])){
	 $cabang = $_GET['cabang'];
	 }
 if (isset($_GET['ket'])){
	 $ket = $_GET['ket'];
	 }
 if (isset($_GET['hanger_own'])){
	 $hanger_own = $_GET['hanger_own'];
	 }
 else {
	 $hanger_own = "off";
 }
 if (isset($_GET['deliver'])){
	 $deliver = $_GET['deliver'];
	 }
 else{
	 $deliver = "off";
 }
 if (isset($_GET['hanger_plastic'])){
	 $hanger_plastic = $_GET['hanger_plastic'];
	 }
 else{
	 $hanger_plastic = 0;
 }
 if (isset($_GET['hanger'])){
	 $hanger = $_GET['hanger'];
	 }
 else{
	 $hanger = 0;
 }
	 

$ot = $_SESSION['nama_outlet'];

$query = "SELECT * FROM reception WHERE nama_outlet='$ot' AND no_so LIKE '%SD%' order by no_so desc LIMIT 0,1";
$hasil = mysqli_query($con,$query);
$data  = mysqli_fetch_array($hasil);
$lastNoTransaksi = $data['no_so'];
// baca nomor urut transaksi dari id transaksi terakhir
//soCDW000001
$lastNoUrut = (int)substr($lastNoTransaksi, 5, 6);
// nomor urut ditambah 1
$nextNoUrut1 = $lastNoUrut + 1;

if ($ot=="Toddopuli"){
$char = "SDTDL";
	
}elseif ($ot=="Landak"){
	$char="SDLDK";
	
	
}elseif ($ot=="Baruga") {
	$char="SDBRG";
	
}
elseif ($ot=="Cendrawasih"){
	$char="SDCDW";
	
}
elseif ($ot=="BTP"){
	$char="SDBTP";
	
}
elseif ($ot=="DAYA"){
	$char="SDDYA";
	
}elseif ($ot=="support"){
	$char="SDSPT";
	
}elseif ($ot=="mojokerto"){
	$char="SDMJK";
	
}
 
// membuat format nomor transaksi berikutnya
$noso = $char.sprintf('%06s', $nextNoUrut1);
$no_nota=$noso;
	 
	 
 if (isset($_GET['hanger'])){
	 $hanger = $_GET['hanger'];
	 $h = 2500 * $hanger;
	 $qrincian3 = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', 'Hanger', '2500', '$hanger', '$h', '$no_nota', '$id_cust', '0')");
	 }
 if (isset($_GET['hanger_plastic'])){
	 $hanger_plastic = $_GET['hanger_plastic'];
	 $hp = 2000 * $hanger_plastic;
	 $qrincian3 = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', 'Hanger Plastik', '2000', '$hanger_plastic', '$hp', '$no_nota', '$id_cust', '0')");
	 }
	 
	 $totcharge = 0;
 if (isset($_GET['charge'])){
	 $charge = $_GET['charge'];
		 if ($charge==""){
		 $ch = "";
			 }
		 else if ($charge=="190"){
		 $ch = "2";
			 }
		 else{
		 $ch = "1";
			 }
		  $qcharge = mysqli_query($con, "select * from item_spk where id='$charge'");		 
	 	  $rcharge = mysqli_fetch_array($qcharge);
		  $qrincian = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', '$rcharge[nama_item]', '$rcharge[harga]', '1', '$rcharge[harga]', '$no_nota', '$id_cust', '$rcharge[berat]')");
	 }

  
	 $qharga = mysqli_query($con, "select * from item_spk where id='$itemklp'");		 
	 $rharga = mysqli_fetch_array($qharga);
	 if (isset($_GET['status'])){
	  $qrincian2 = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', '$rharga[nama_item]', '$rharga[disk]', '1', '$rharga[disk]', '$no_nota', '$id_cust', '$rharga[berat]')");
	 }
	 else{
	  $qrincian2 = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', '$rharga[nama_item]', '$rharga[harga]', '1', '$rharga[harga]', '$no_nota' , '$id_cust', '$rharga[berat]')");
	 }	 


$qtotal = mysqli_query($con,"select sum(total) as totalOld from detail_penjualan where no_nota='$no_nota' and item not like '%voucher%'");
$rtotal = mysqli_fetch_array($qtotal);


$qtotal1 = mysqli_query($con,"select * from detail_penjualan where no_nota='$no_nota' and item like '%voucher%'");
$rtotal1 = mysqli_fetch_array($qtotal1);

$total = $rtotal['totalOld'] - $rtotal1['total'];

$qrincian6 = mysqli_query($con,"insert into reception(nama_outlet,nama_reception,tgl_input,nama_customer,no_nota,jenis,express,no_so,id_customer,total_bayar,cabang,ket,berat,voucher,diskon) VALUES('$ot', '$_SESSION[user_id]', '$jam1', '$nama_customer', '$no_nota', 'k', '$ch', '$no_nota', '$_SESSION[id]', '$total', '$cabang', '$ket', '$beratitem', '$voucher', '$rtotal1[total]')");


$qrincian5 = mysqli_query($con, "insert into cris_icon_details values ('', '$jam1', '$_SESSION[user_id]', '$no_nota', '$no_nota', '$hanger_own', '$deliver' , '$parfum', '$ch', '$hanger_plastic', '$hanger', '$no_nota')");

include "../struk.php";

?>