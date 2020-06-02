<?php
include '../config.php';
session_start();

function rupiah($angka){
	$jadi = "Rp.".number_format($angka,0,',','.');
	return $jadi;
}
date_default_timezone_set('Asia/Makassar');

$jam1 = date("Y-m-d H:i:s");	 


$ot = $_SESSION['nama_outlet'];
$cabang = $ot;

 if (isset($_GET['itemklp'])){
	 $itemklp = $_GET['itemklp'];
 }
 if (isset($_GET['item'])){
	 $item = $_GET['item'];
 }
 if (isset($_GET['harga'])){
	 $harga = $_GET['harga'];
 }
 if (isset($_GET['jumlah'])){
	 $jumlah = $_GET['jumlah'];
 }
 if (isset($_GET['id_cust'])){
	 $id_cust = $_GET['id_cust'];
	 }
 if (isset($_GET['ket1'])){
	 $ket1 = $_GET['ket1'];
 }

$ot = $_SESSION['nama_outlet'];

$query = "SELECT * FROM reception WHERE nama_outlet='$ot' AND no_so LIKE '%SD%' order by id desc LIMIT 0,1";
$hasil = mysqli_query($con,$query);
$data  = mysqli_fetch_array($hasil);
$lastNoTransaksi = $data['no_so'];
// baca nomor urut transaksi dari id transaksi terakhir
//soCDW000001
$lastNoUrut = (int)substr($lastNoTransaksi, 5, 6);
// nomor urut ditambah 1
$nextNoUrut1 = $lastNoUrut + 1;

include 'code.php';
 
// membuat format nomor transaksi berikutnya
	$t = date('Y');
	$m = date('m');
	$d = date('d');
	$h = date('H');
	$i = date('i');
	
	
 $noso = $char.sprintf('%06s', $nextNoUrut1);

 if (isset($_GET['notanew'])){
  if ($_GET['notanew']<>''){
	 $notanew = $_GET['notanew'];
	 $no_nota = $notanew;
	 $getdata = (int)substr($no_nota, 5, 6);
  }
 else{
	$no_nota=$noso;
 }
 }
 else{
	$no_nota=$noso;
 }


$new_nota = $char1.$t.$m.$d.$h.sprintf('%06s', $nextNoUrut1);


if (isset($_GET['id_cs'])){
	 $id_cs = $_GET['id_cs'];
}

 $qrincian5 = mysqli_query($con, "delete from cris_icon_details where id_reception='$no_nota'");	

 $qrincian5 = mysqli_query($con, "insert into cris_icon_details values ('', '$jam1', '$_SESSION[user_id]', '$no_nota', '$noso', 'off', '' , '', '', '0', '0', '$no_nota')");	

$qcus = mysqli_query($con, "select * from customer where id='$id_cs'");
$rcus = mysqli_fetch_array($qcus);
$nama_customer = $rcus['nama_customer'];
  

$tot = $harga*$jumlah;
 $qrincian2 = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', '$item', '$harga', '$jumlah', '$tot', '$no_nota' , '$id_cs', '0', '$ket1')");


if (isset($_GET['status'])){
?>
<script type="text/javascript">
 alert("Data telah terinput!");
 location.href="index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>&status=<?php echo $_GET['status']; ?>#popup10";
</script>
<?php
}
else{
?>
<script type="text/javascript">
 alert("Data telah terinput!");
 location.href="index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>&nota=<?php echo $no_nota; ?>#popup10";
</script>
<?php
}
?>