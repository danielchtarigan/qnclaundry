<?php
include '../config.php';
session_start();

function rupiah($angka)
{
	$jadi = "Rp.".number_format($angka,0,',','.');
	return $jadi;
}
date_default_timezone_set('Asia/Makassar');

$jam1 = date("Y-m-d H:i:s");	 

 if (isset($_GET['voucher'])){
	 $voucher = $_GET['voucher'];
	 }
 if (isset($_GET['no_nota'])){
	 $no_nota = $_GET['no_nota'];
	 }


$ot = $_SESSION['nama_outlet'];

include 'code.php';



$lastNoUrut = substr($no_nota, 5, 6);
$t = date('Y');
$m = date('m');
$d = date('d');
$h = date('H');
$i = date('i');
$new_nota = $char1.$t.$m.$d.$h.$lastNoUrut;

 $diskon = 0;
 if ($voucher<>''){
	 $qvouc = mysqli_query($con, "select * from voucher_lucky where no_voucher='$voucher' and aktif='1'");
	 $nvouc = mysqli_num_rows($qvouc);
	 $rvouc = mysqli_fetch_array($qvouc);
	 $potongan = $rvouc['disk'];


	 $qharga = mysqli_query($con, "select * from item_spk where id='$itemklp'");		 
	 $rharga = mysqli_fetch_array($qharga);
	 if (isset($_GET['status'])){
		 $harga = $rharga['disk'];
		 }
	 else{
		 $harga = $rharga['harga'];
		 }

	 if ($nvouc<1){
	 ?>
     <script type="text/javascript">
	  alert('Kode Voucher tidak dapat digunakan!');
	  history.back();
	 </script>
     <?php
	 }
	 else if ($harga<=30000){
	 ?>
     <script type="text/javascript">
	  alert('Kode Voucher tidak dapat digunakan! Nilai Transaksi dibawah Rp. 30.000');
	  history.back();
	 </script>
     <?php
	 }
	 else{
	 $qv = mysqli_query($con, "select * from voucher_lucky where no_voucher='$voucher'");
	 $rv = mysqli_fetch_array($qv);
	 $diskon = $harga*$rv['disk'];
	 $qrincian10 = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', 'Voucher $rv[no_voucher]', '$diskon', '1', '$diskon', '$no_nota', '$id_cust', '0')");
	 
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

 if (isset($_GET['deliver'])){
	 $deliver = $_GET['deliver'];
	 }
 else{
	 $deliver = 'off';
 }
 if (isset($_GET['parfum'])){
	 $parfum = $_GET['parfum'];
	 }
 if (isset($_GET['ket1'])){
	 $ket1 = $_GET['ket1'];
	 }
 if (isset($_GET['jumlah'])){
	 $ket1 = $_GET['jumlah'];
	 }
 if (isset($_GET['id_cs'])){
	 $id_cs = $_GET['id_cs'];
	 }
 if (isset($_GET['nama_customer'])){
	 $nama_customer = $_GET['nama_customer'];
	 }
 if (isset($_GET['cabang'])){
	 $cabang = $_GET['cabang'];
	 }
 if (isset($_GET['ket'])){
	 $ket = $_GET['ket'];
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
		  $qrincian = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', '$rcharge[nama_item]', '$rcharge[harga]', '1', '$rcharge[harga]', '$no_nota', '$id_cs', '0')");
	 }

  
$qtotal = mysqli_query($con,"select sum(total) as totalOld from detail_penjualan where no_nota='$no_nota' and item not like '%voucher%'");
$rtotal = mysqli_fetch_array($qtotal);


$qtotal1 = mysqli_query($con,"select * from detail_penjualan where no_nota='$no_nota' and item like '%voucher%'");
$rtotal1 = mysqli_fetch_array($qtotal1);

$total = $rtotal['totalOld'] - $rtotal1['total'];


$qrincian5 = mysqli_query($con, "insert into cris_icon_details values ('', '$jam1', '$_SESSION[user_id]', '$no_nota', '$no_nota', 'off', '$deliver' , '$parfum', '$ch', '0', '0', '$no_nota')");

//include "struk.php";
$qrincian6 = mysqli_query($con,"insert into reception(new_nota, nama_outlet,nama_reception,tgl_input,nama_customer,no_nota,jenis,express,no_so,id_customer,total_bayar,cabang,ket,berat,voucher,diskon) VALUES('$new_nota', '$ot', '$_SESSION[user_id]', '$jam1', '$nama_customer', '$no_nota', 'p', '$ch', '$no_nota', '$id_cs', '$total', '$cabang', '$ket', '0', '$voucher','$diskon')");



	if (isset($_GET['status'])){
?>
<script type="text/javascript">
 alert("Data telah terinput!");
 location.href="index.php?id=<?php echo $id_cs; ?>&status=<?php echo $_GET['status']; ?>";
</script>
<?php
		}
	 else{
?>
<script type="text/javascript">
 alert("Data telah terinput!");
 location.href="index.php?id=<?php echo $id_cs; ?>";
</script>
<?php
	 }
	 ?>