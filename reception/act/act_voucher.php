<?php
include '../../config.php';
session_start();

function rupiah($angka)
{
	$jadi = "Rp.".number_format($angka,0,',','.');
	return $jadi;
}
date_default_timezone_set('Asia/Makassar');

$jam1 = date("Y-m-d h:i:s");	 

 if (isset($_GET['nota'])){
	 $no_nota = $_GET['nota'];
	 }


$ot = $_SESSION['nama_outlet'];

 if (isset($_GET['id'])){
	 $id_cs = $_GET['id'];
	 }
 if (isset($_GET['voucher'])){
	 $voucher = $_GET['voucher'];
	 }
 $diskon = 0;
 if ($voucher<>''){
	 $qvouc = mysqli_query($con, "select * from voucher_lucky where no_voucher='$voucher' and aktif='1'");
	 $nvouc = mysqli_num_rows($qvouc);
	 $rvouc = mysqli_fetch_array($qvouc);
	 $potongan = $rvouc['disk'];
	 $qharga = mysqli_query($con, "select sum(total) as total from detail_penjualan where no_nota='$no_nota' and item not like '%express%' and item not like '%Hanger%'");		 
	 $rharga = mysqli_fetch_array($qharga);
	 $harga = $rharga['total'];
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
	 $qrincian10 = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', 'Voucher $rv[no_voucher]', '$diskon', '1', '$diskon', '$no_nota', '$id_cs', '0')");
	 
	  if (($rv['jenis_voucher'] == 'RV') and ($rv['kali'] <= 10 )){
		 $baru = $rv['kali']+1;
		 $qvouc1 = mysqli_query($con, "update voucher_lucky set kali='$baru' where no_voucher='$voucher'");
	  }
      else{
		 $qvouc1 = mysqli_query($con, "update voucher_lucky set aktif='0' where no_voucher='$voucher'");
		 $qvouc2 = mysqli_query($con, "insert into voucher_used values ('', '$jam1', '$_SESSION[user_id]', '$voucher', '$id_cs', '$_SESSION[nama_outlet]')");		
	  }
	  
?>
<script type="text/javascript">
 alert("Data telah terinput!");
 location.href="../index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>&nota=<?php echo $no_nota;?>#popup12";
</script>
<?php
	  
	 }
    }

 else if ($voucher==''){
?>
<script type="text/javascript">
 alert("Anda tidak memiliki voucher!");
 location.href="../index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>&nota=<?php echo $no_nota;?>#popup12";
</script>
<?php
}
?>