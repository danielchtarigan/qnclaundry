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

 if (isset($_GET['item'])){
	 $item = $_GET['item'];
 }
 if (isset($_GET['harga'])){
	 $harga = $_GET['harga'];
 }
 if (isset($_GET['id'])){
	 $id = $_GET['id'];
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
  
 if ($_GET['notanew']<>''){
	 $notanew = $_GET['notanew'];
	 $no_nota = $notanew;
}
 else{	
	$no_nota=$noso;
 }

 $new_nota = $char1.$t.$m.$d.$h.sprintf('%06s', $nextNoUrut1);

$qharga = mysqli_query($con, "select * from item_spk where nama_item='$item'");		 
$rharga = mysqli_fetch_array($qharga);

$qcus = mysqli_query($con, "select * from customer where id='$id'");
$rcus = mysqli_fetch_array($qcus);
$nama_customer = $rcus['nama_customer'];

 $qrincian5 = mysqli_query($con, "delete from cris_icon_details where id_reception='$no_nota'");	
 $qrincian5 = mysqli_query($con, "insert into cris_icon_details values ('', '$jam1', '$_SESSION[user_id]', '$no_nota', '$noso', 'off', '' , '', '', '0', '0', '$no_nota')");	

$qrincian2 = mysqli_query($con, "insert into detail_penjualan values ('', '$jam1', '$rharga[nama_item]', '$harga', '1', '$harga', '$no_nota' , '$id', '$rharga[berat]', '$ket1')");

 $qrincian6 = mysqli_query($con,"insert into reception(new_nota, nama_outlet,nama_reception,tgl_input,nama_customer,no_nota,jenis,express,no_so,id_customer,total_bayar,cabang,ket,berat,voucher,diskon) VALUES('$new_nota', '$ot', '$_SESSION[user_id]', '$jam1', '$nama_customer', '$no_nota', 'k', '', '$noso', '$id', '', '', '', '$rharga[berat]', '','','')");

if ($qrincian2){
?>
<script type="text/javascript">
 location.href="index.php?id=<?php echo $id; ?>&jenis=<?php echo $_GET['jenis']; ?>&nota=<?php echo $no_nota; ?>#popup4";
</script>
<?php
}
else{
?>
<script type="text/javascript">
 alert("Gagal!");
 history.back();
</script>
<?php
}
?>