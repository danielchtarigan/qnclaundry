<?php
///rupiah adalah fungsi yang nantinya akan kita panggil
     function rupiah($angka){
           $jadi="Rp.".number_format($angka,0,',','.');
            return $jadi;
     }
session_start();
$us=$_SESSION['name'];
$ot='mojokerto';
?>
<?php
include '../../../config.php';
date_default_timezone_set('Asia/Jakarta');
$jam=date("Y-m-d H:i:s");
    $id_cs=$_POST['id_cs'];
    $s=$_POST['no_nota'];
    $nama_customer=$_POST['nama_customer'];
	$jenis=$_POST['jenis'];
	$express=$_POST['express1'];
	$ket=$_POST['ket'];
	$totalorder=$_POST['totalorder'];
	$diskon=$_POST['diskon'];
	$diskonrp=$_POST['diskonrp'];
	$voucher=$_POST['voucher'];
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
 if($s=='Auto'){
			 	$no_nota=$noso;
			 }else{
			 	$no_nota=$s;
			 }

function isi_keranjang()
{

include '../../../config.php';
	$ids          = session_id();
	$id_cs        = $_POST['id_cs'];

	$isikeranjang = array();

	$sql   = "SELECT * FROM rincian_order_temp WHERE id_customer='$id_cs'";


	$hasil = mysqli_query($con,$sql);

	while($r = mysqli_fetch_array($hasil))
	{
		$isikeranjang[] = $r;
	}
	return $isikeranjang;
}

$isikeranjang = isi_keranjang();
$jml          = count($isikeranjang);

for($i = 0; $i < $jml; $i++)
{
	mysqli_query($con,"insert into detail_penjualan (tgl_transaksi,item,no_nota,total,id_customer,jumlah,harga,berat) VALUES('$jam','{$isikeranjang[$i]['item']}','$no_nota','{$isikeranjang[$i]['total']}','$id_cs','{$isikeranjang[$i]['jumlah']}','{$isikeranjang[$i]['harga']}','{$isikeranjang[$i]['berat']}')");
}
for($i = 0; $i < $jml; $i++)
{
	mysqli_query($con,"DELETE FROM rincian_order_temp
		WHERE id_customer = '{$isikeranjang[$i]['id_customer']}'");
}



	$sql  = $con->query("select * from voucher_lucky WHERE no_voucher = '$voucher'");
	$r    = $sql->fetch_assoc();
	if($r['jenis_voucher'] == 'ld' ){
$updatev  = mysqli_query($con," update voucher_lucky set aktif='1' WHERE no_voucher='$voucher'");
		
	}else if($r['jenis_voucher'] == 'mb' ){
		$query5           = "SELECT kali AS last,id_customer FROM voucher_lucky WHERE no_voucher='$voucher' LIMIT 1";
$hasil5           = mysqli_query($con,$query5);
$data5            = mysqli_fetch_array($hasil5);
$lastNoTransaksi5 = $data5['last'];
$nextNoUrut5      = $lastNoTransaksi5 + 1;


		$updatev  = mysqli_query($con," update voucher_lucky set kali='$nextNoUrut5' WHERE no_voucher='$voucher'");

$idcc=$data5['id_customer'];	
$sqlm  = $con->query("select * from customer WHERE id = '$idcc'");
$p    = $sqlm->fetch_assoc();
$po=$p['poin'];
$posekarang=$po+1;
$cs     = mysqli_query($con,"update customer set poin='$posekarang' WHERE  id='$idcc'");
	

}

$sql=$con->query("SELECT sum(berat) as berat FROM detail_penjualan WHERE no_nota= '$no_nota' and id_customer='$id_cs'");
$k = $sql->fetch_assoc();
$berat=$k['berat'];
 

 
 
 
$tambah=mysqli_query($con,"insert into reception(nama_outlet,nama_reception,tgl_input,nama_customer,no_nota,jenis,express,no_so,id_customer,total_bayar,cabang,ket,berat,voucher,diskon) VALUES('$ot','$us','$jam', '$nama_customer','$no_nota','$jenis','$express','$noso','$id_cs','$totalorder','$cabang','$ket','$berat','$voucher','$diskonrp')");
    
    if($tambah)
    {
    ?>
<?php 
    	$edit=$con->query("SELECT * FROM reception WHERE no_nota='$no_nota'");
$r = $edit->fetch_assoc();
  
?>
<script language="javascript">
function Clickheretoprint()
{ 
	var newWindow = window.open('','_blank','status=0,toolbar=0,location=0,menubar=1,resizable=1,scrollbars=1');
    newWindow.document.write(document.getElementById("content").innerHTML);
    newWindow.print(); 
}
</script>
<a id="cccc" href="javascript:Clickheretoprint()">Print</a>
<div class="content" id="content">    	
<?php include"../../../reception/bar128.php" ?>
 <div align="center"><img src="../../../logo.bmp" /></div>   
<div style="font-size: 12px; font-family: Arial" >

<div align="center">Quick &' Clean Laundry</div>
<div align="center">Jl Toddopuli Raya No 08</div>
<div align="center">Makassar</div>
<div align="center">0411-444180</div>
<div align="center" class="style1 style4">Nota Order</div>
<div align="center"><?php echo bar128(stripslashes($no_nota))?></div>
 <div>
<?php
echo 'Nama : '.$nama_customer.'<br>';
echo 'No Order : '.$no_nota.'<br>';
?>
</div>
<table id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th></th>
			<th width="50%"> Item </th>
			<th width="21%"> Harga </th>
<th width="20%"> Total </th>

		</tr>
	</thead>
	<tbody>
	<?php
			
			$sql2=mysqli_query($con,"SELECT * FROM detail_penjualan WHERE no_nota= '$no_nota' and id_customer='$id_cs'");
			
			while($data = mysqli_fetch_array($sql2)){?>
				<tr>
						
						<td><?php echo $data['jumlah'];?></td>
						
						<td><?php echo $data['item'];?></td>
						<td><?php echo $data['harga'];?></td>
<td><?php echo $data['total'];?></td>
				
				</tr>
			
						<?php  
						}
					?>
			<tr>
				<td colspan="3">Diskon:</td>
				<td colspan="4">
				<?php
echo rupiah($diskonrp, true);
				?>
				</td>
			</tr>		
			
					<tr>
				<td colspan="2">Total:</td><td></td>
				<td colspan="3">
				<?php
				
echo rupiah($totalorder, true);
				?>
				</td>
			</tr>
		
	</tbody>
</table>
 <div>
<?php
echo ''.$ket.'<br>';

?>
</div>
</div>
   <div id="mainmain">
<p style="border: 1px solid #000000;font-size: 8px; font-family: arial;padding: 3px">
    Konsumen tunduk pada syarat dan ketentuan umum laundry kiloan dan laundry potongan di Quick & Clean. <br/><br />
    Cucian yang tidak diambil dalam 30 hari, di luar tanggung jawab Quick &' Clean.<br/><br >
    Komplain maksimal 3 hari sejak tanggal pengembalian, 14 hari sejak tgl order dan wajib menunjukkan nota pembayaran.<br/>
    <strong>Nota Ini BUKAN bukti pembayaran.</strong>
    </p>
    </div>
    <?php
    $sql4=$con->query("SELECT tgl_selesai FROM tgl_selesai");
    $t = $sql4->fetch_assoc();
	$tg=$t['tgl_selesai'];
 $todayDate = date("Y-m-d H:i:s");// current date
$now = strtotime(date("Y-m-d H:i:s"));
//Add one day to today
if ($jenis=='k'){
$addday = $tg;
	
}else if($jenis=='p'){
$addday = $tg+1;

}
$date = date('Y-m-d H:i:s', strtotime('+'.$addday.' day', $now));
echo "Tgl Selesai Paling Lambat: ".$date."<br>";
?>
<?php


echo "Tgl $jam<br />" ?>
<?php echo "Reception :$_SESSION[name]" ?>

 <tr><td col><br/>
    <span style='float: left; text-align:center;'><br/>
								Customer<br/> </br> </br>
								
								<br/>(<?php echo $r['nama_customer'] ?>)
	
	</span>
	
	</td>
	
	</tr>
<div style="page-break-before:always;">
<div style="font-size: 12px; font-family: Arial" >
<div align="center" class="style1 style4">Nota Order</div>
<?php echo bar128(stripslashes($no_nota))?>
<div>
<?php
echo 'Nama : '.$nama_customer.'<br>';
echo 'No Order : '.$no_nota.'<br>';
?>
</div>
<table id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th></th>
			<th width="70%"> Item </th>
		
<th width="20%"> Total </th>

		</tr>
	</thead>
	<tbody>
	<?php
			
			$sql2=mysqli_query($con,"SELECT * FROM detail_penjualan WHERE no_nota= '$no_nota' and id_customer='$id_cs'");
			
			while($data = mysqli_fetch_array($sql2)){?>
				<tr>
						
						<td><?php echo $data['jumlah'];?></td>
						
						<td><?php echo $data['item'];?></td>
						
<td><?php echo $data['total'];?></td>
				
				</tr>
			
						<?php  
						}
					?>
			<tr>
				<td colspan="2">Diskon:</td>
				<td colspan="3">
				<?php
echo rupiah($diskonrp, true);
				?>
				</td>
			</tr>		
			<tr>
				<td colspan="2">Total:</td>
				<td colspan="3">
				<?php
echo rupiah($totalorder, true);
				?>
				</td>
			</tr>
		
	</tbody>
</table>
</div>
   <div>
<?php
echo ''.$ket.'<br>';

?>
</div> 
<?php echo "Tgl $jam<br />" ?>
<?php echo "Reception :$_SESSION[name]" ?>

 <tr><td col><br/>
    <span style='float: left; text-align:center;'><br/>
								Customer<br/> </br> </br>
								
								<br/>(<?php echo $r['nama_customer'] ?>)
	
	</span>
	
	</td>
	
	</tr>


</div>
</div>

	<?php
	


}else
    {
        echo "ERROR";
    }
   
?>