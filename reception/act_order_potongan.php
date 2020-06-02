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
 if (isset($_GET['itemklp'])){
	 $itemklp = $_GET['itemklp'];
 }
	 $id_cs = $_GET['id_cs'];
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

include 'code.php';
 
// membuat format nomor transaksi berikutnya
$noso = $char.sprintf('%06s', $nextNoUrut1);
$no_nota=$noso;
$t = date('Y');
$m = date('m');
$d = date('d');
$h = date('H');
$i = date('i');
$new_nota = $char1.$t.$m.$d.$h.sprintf('%06s', $nextNoUrut1);

 if (isset($_GET['ket1'])){
	 $ket1 = $_GET['ket1'];
	 }
 if (isset($_GET['jumlah'])){
	 $jumlah = $_GET['jumlah'];
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
	 
	 
	 $qharga = mysqli_query($con, "select * from item_spk where id='$itemklp'");		 
	 $rharga = mysqli_fetch_array($qharga);
	 if (isset($_GET['status'])){
	  $total = $jumlah * $rharga['disk'];
	  $qrincian2 = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', '$rharga[nama_item]', '$rharga[disk]', '$jumlah', '$total', '$no_nota', '$id_cs', '$rharga[berat]')");
	 }
	 else{
	  $total = $jumlah * $rharga['harga'];
	  $qrincian2 = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', '$rharga[nama_item]', '$rharga[harga]', '$jumlah', '$total', '$no_nota' , '$id_cs', '$rharga[berat]')");
	 }	 
	 
if (isset($_GET['status'])){
?>
<script type="text/javascript">
 alert("Data telah terinput!");
 location.href="index.php?id=<?php echo $id_cs; ?>&status=<?php echo $_GET['status']; ?>&nota=<?php echo $no_nota; ?>#popup10";
</script>
<?php
}
else{
?>
<script type="text/javascript">
 alert("Data telah terinput!");
 location.href="index.php?id=<?php echo $id_cs; ?>&nota=<?php echo $no_nota; ?>#popup10";
</script>
<?php
}
?>