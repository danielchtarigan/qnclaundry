<?php
include '../../config.php';
session_start();
$us=$_SESSION['user_id'];
$ot=$_SESSION['nama_outlet'];
$idc = $_GET['idc'];
$total = $_GET['total'];
$disk = $_GET['disk'];
$jam1 = date("Y-m-d h:i:s");	 
$tgl = date("Y-m-d");

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

	$cabang=$ot;

	$query = "SELECT max(no_so) AS last FROM reception WHERE nama_outlet='$ot' LIMIT 1";
$hasil = mysqli_query($con,$query);
$data  = mysqli_fetch_array($hasil);
$lastNoTransaksi = $data['last'];
// baca nomor urut transaksi dari id transaksi terakhir
//soCDW000001
$lastNoUrut = (int)substr($lastNoTransaksi, 5, 6);
// nomor urut ditambah 1
$nextNoUrut1 = $lastNoUrut + 1;

$noso = $char.sprintf('%06s', $nextNoUrut1);

			 	$no_nota=$noso;

function isi_keranjang()
{
include '../../config.php';
$idc = $_GET['idc'];

	$isikeranjang = array();
	$qambilrincian  = mysqli_query($con, "SELECT * FROM rincian_order_temp a, item_spk b WHERE a.item=b.id and id_customer='$idc'");
	while($r = mysqli_fetch_array($qambilrincian))
	{
		$isikeranjang[] = $r;
	}
	return $isikeranjang;
}
$isikeranjang = isi_keranjang();
$jml          = count($isikeranjang);

for($i = 0; $i < $jml; $i++)
{
	mysqli_query($con,"insert into detail_penjualan VALUES ('', '$jam1', '{$isikeranjang[$i]['nama_item']}', '{$isikeranjang[$i]['harga']}', '{$isikeranjang[$i]['jumlah']}', '{$isikeranjang[$i]['total']}', '$no_nota', '$idc', '{$isikeranjang[$i]['berat']}')");
        $last_id = mysqli_insert_id($con);
        mysqli_query($con,"update cris_icon_details set id_detail_penjualan='$last_id' where id_rincian_order_tmp='{$isikeranjang[$i]['id']}'");
}
for($i = 0; $i < $jml; $i++)
{
	mysqli_query($con,"DELETE FROM rincian_order_temp
		WHERE id_customer = '{$isikeranjang[$i]['id_customer']}'");
                $last_i=$i;
}

$qcari = mysqli_query($con,"select * from customer WHERE id = '$idc'");
$p    = mysqli_fetch_array($qcari);
$total = $_GET['total'];
if ($p['member']==1){
	if ($total>25000){
		$poin = ($total / 25000);

$po=$p['poin'];
$posekarang=$po+$poin;
$cs     = mysqli_query($con,"update customer set poin='$posekarang' WHERE  id='$idc'");

if ($cs){
		
	}

		}		
	}

$sql=$con->query("SELECT sum(berat) as berat FROM detail_penjualan WHERE no_nota= '$no_nota' and id_customer='$idc'");
$k = $sql->fetch_assoc();
$berat=$k['berat'];

$qcust = mysqli_query($con,"select * from customer where id=$idc");
$rcust = mysqli_fetch_array($qcust);

$qvoucv = mysqli_query($con,"select * from voucher_used where id_customer=$idc and created like '%$tgl%'");
$rvoucv = mysqli_fetch_array($qvoucv);

	$express = 0;

$qexpres = mysqli_query($con,"select * from detail_penjualan where id_customer=$idc and tgl_transaksi like '%$tgl%' and item = 'express kiloan'");
$nexpres = mysqli_num_rows($qexpres);
if ($nexpres>0){
	$express = 1;
	}

$qexpres1 = mysqli_query($con,"select * from detail_penjualan where id_customer=$idc and tgl_transaksi like '%$tgl%' and item = 'double express kiloan'");
$nexpres1 = mysqli_num_rows($qexpres1);
if ($nexpres1>0){
	$express = 2;
	}


    $tambah=mysqli_query($con,"insert into reception (nama_outlet, nama_reception, tgl_input, nama_customer, no_nota, jenis, express, no_so, id_customer, total_bayar, cabang, berat, voucher, diskon) VALUES ('$ot', '$us', '$jam1',  '$rcust[nama_customer]', '$no_nota', 'k', '$express', '$noso', '$idc', '$total', '$ot', '$berat', '$rvoucv[voucher]', '$disk')");
if ($tambah){
//hapus keterangan jika sukses


include "struk.php";





}
else{
?>
<script type="application/javascript">
 alert('Query gagal!');
 history.back();
</script>
<?php
}
?>