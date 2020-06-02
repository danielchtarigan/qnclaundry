<?php
///rupiah adalah fungsi yang nantinya akan kita panggil
     function rupiah($angka){
           $jadi="Rp.".number_format($angka,0,',','.');
            return $jadi;
     }
     session_start();
$us=$_SESSION['user_id'];
$ot='mojokerto';
?>
<?php
include "../../../config.php";
date_default_timezone_set('Asia/Makassar');
$jam=date("Y-m-d H:i:s");
    $id_cs=$_GET['id_cs'];
    $no_nota=$_GET['no_nota'];
    $nama_customer=$_GET['nama_customer'];
	$jenis=$_GET['jenis'];
	$express=$_GET['express'];
	$ket=$_GET['ket'];
	
$cb=$_GET['cabang'];
	if($cb==""){
		$cabang=$ot;
		
		}else{
			$cabang=$cb;
		}
	




	$query = "SELECT max(no_so) AS last FROM reception WHERE nama_outlet='$ot' LIMIT 1";
$hasil = mysqli_query($con,$query);
$data  = mysqli_fetch_array($hasil);
$lastNoTransaksi = $data['last'];
// baca nomor urut transaksi dari id transaksi terakhir
//soCDW000001
$lastNoUrut = (int)substr($lastNoTransaksi, 5, 6);
// nomor urut ditambah 1
$nextNoUrut1 = $lastNoUrut + 1;

$char = "SDMJK";
	

 
// membuat format nomor transaksi berikutnya
$noso = $char.sprintf('%06s', $nextNoUrut1);

$sql=$con->query("SELECT sum(total) as total FROM detail_penjualan WHERE no_nota= '$no_nota' and id_customer='$id_cs'");
$k = $sql->fetch_assoc();
$total=$k['total'];
 
$tambah=mysqli_query($con,"insert into reception(nama_outlet,nama_reception,tgl_input,nama_customer,no_nota,jenis,express,no_so,id_customer,total_bayar,cabang,ket) VALUES('$ot','$us','$jam', '$nama_customer','$no_nota','$jenis','$express','$noso','$id_cs','$total','$cabang','$ket')");
    
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
				<td colspan="2">Total:</td><td></td>
				<td colspan="3">
				<?php
				$sql3=mysqli_query($con,"SELECT sum(total) as total FROM detail_penjualan WHERE no_nota= '$no_nota' and id_customer='$id_cs'");
				$s1=mysqli_fetch_array($sql3);
				$hr=$s1['total'];
echo rupiah($hr, true);
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
<p style="border: 1px solid #000000;font-size: 12px; font-family: arial;padding: 3px">
    Konsumen tunduk pada syarat dan ketentuan umum laundry kiloan dan laundry potongan di Quick & Clean. <br/><br />
    Cucian yang tidak diambil dalam 30 hari, di luar tanggung jawab Quick &' Clean.<br/><br >
    Komplain maksimal 3 hari sejak tanggal pengembalian, 14 hari sejak cucian bersih sampai di outlet dan wajib menunjukkan nota pembayaran.<br/>
    <strong>Nota Ini BUKAN bukti pembayaran.</strong>
    </p>
    </div>
<?php echo "Tgl $jam<br />" ?>
<?php echo "Reception :$_SESSION[user_id]" ?>

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
				<td colspan="2">Total:</td>
				<td colspan="3">
				<?php
				$sql3=mysqli_query($con,"SELECT sum(total) as total FROM detail_penjualan WHERE no_nota= '$no_nota' and id_customer='$id_cs'");
				$s1=mysqli_fetch_array($sql3);
				$hr=$s1['total'];
echo rupiah($hr, true);
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
<?php echo "Reception :$_SESSION[user_id]" ?>

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