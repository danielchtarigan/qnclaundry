<?php
include '../config.php';
session_start();

function rupiah($angka){
	$jadi = "Rp.".number_format($angka,0,',','.');
	return $jadi;
}
date_default_timezone_set('Asia/Jakarta');

$jam1 = date("Y-m-d H:i:s");	 


$ot = $_SESSION['nama_outlet'];
$cabang = $ot;

if (isset($_GET['jenis'])){
 $jenis = $_GET['jenis'];
}
if (isset($_GET['id'])){
 $id_cs = $_GET['id'];
}
if (isset($_GET['nota'])){
	 $no_nota = $_GET['nota'];
}
$ot = $_SESSION['nama_outlet'];

$qcustomer = mysqli_query($con, "select * from customer where id='$id_cs'");
$rcustomer = mysqli_fetch_array($qcustomer);
$nama_customer = $rcustomer['nama_customer'];


$query = "SELECT * FROM reception WHERE nama_outlet='$ot' order by id desc LIMIT 0,1";
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

 if (isset($_GET['nota'])){
  if ($_GET['nota']<>''){
	 $notanew = $_GET['nota'];
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


 $qrincian6 = mysqli_query($con,"insert into reception(new_nota, nama_outlet,nama_reception,tgl_input,nama_customer,no_nota,jenis,express,no_so,id_customer,total_bayar,cabang,ket,berat,voucher,diskon) VALUES('$new_nota', '$ot', '$_SESSION[user_id]', '$jam1', '$nama_customer', '$no_nota', 'p', '', '$noso', '$id_cs', '', '', '', '0', '','')");


if (isset($_GET['status'])){
?>
<script type="text/javascript">
 alert("Data telah terinput!");
 location.href="index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>&status=<?php echo $_GET['status']; ?>#popup4";
</script>
<?php
}
else{
?>
<script type="text/javascript">
 alert("Data telah terinput!");
 location.href="index.php?id=<?php echo $id_cs; ?>&jenis=<?php echo $_GET['jenis']; ?>&nota=<?php echo $no_nota; ?>#popup4";
</script>
<?php
}

?>