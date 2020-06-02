<?php
	
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
	$total=$_GET['tt'];
	$carabayar=$_GET['carabayar'];
	$totalpoin=$_GET['totalpoin'];
	$poin=$_GET['poin'];
	$kuota_sekarang=$_GET['kuota_sekarang'];
	$nofaktur=$_GET['no_faktur'];

$brg=mysqli_query($con,"select * from rincian_faktur WHERE no_faktur='$nofaktur'");
	
   	while($r=mysqli_fetch_array($brg))
   	{
    	$no_nota = explode("\b", $r['no_nota']);
    	$s1=$no_nota;
    	foreach ($s1 as $val)
{
	 
	 $br=mysqli_query($con,"update reception set lunas='1',tgl_lunas='$jam',no_faktur='$nofaktur',rcp_lunas='$us',cara_bayar='$carabayar' WHERE  no_nota='$val'");
	}
	} 
	

	$tambah=mysqli_query($con,"insert into faktur_penjualan(no_faktur,nama_outlet,rcp,tgl_transaksi,total,cara_bayar,id_customer) VALUES('$nofaktur','$ot','$us','$jam','$total','$carabayar','$id_cs')");
	$cs=mysqli_query($con,"update customer set poin='$totalpoin' WHERE  id='$id_cs'");
	$lg=mysqli_query($con,"update customer set sisa_kuota='$kuota_sekarang' WHERE  id='$id_cs'");
	$tambah1=mysqli_query($con,"insert into transaksi_member (jenis_transaksi,jumlah_transaksi,id_customer,tgl_transaksi,no_nota,jumlah_poin) VALUES('1','$total','$id_cs','$jam','$nofaktur','$poin')");
	 $tambah2=mysqli_query($con,"insert into detail_lgn (jenis_transaksi,jumlah_transaksi,id_customer,tgl_transaksi,no_nota) VALUES('0','$total','$id_cs','$jam','$nofaktur')");
	 
    if($tambah)
    
    {
    	    	$edit = mysqli_query($con,"SELECT no_faktur,nama_customer,id FROM reception WHERE no_faktur='$nofaktur'");
	    	$r    = mysqli_fetch_array($edit);

    	?>
    	
<script language="javascript">
function Clickheretoprint()
{ 
	var newWindow = window.open('','_blank','status=0,toolbar=0,location=0,menubar=1,resizable=1,scrollbars=1');
    newWindow.document.write(document.getElementById("bayarr").innerHTML);
    newWindow.print(); 
}
</script>
<a id="cccc" href="javascript:Clickheretoprint()">Print</a>
<div class="bayarr" id="bayarr">    	

    <div style="font-size: 12px; font-family: Arial" >
<div align="center"><img src="../logo.bmp" /></div>
<div align="center">Quick &' Clean Laundry</div>
<div align="center">Jl Toddopuli Raya No 08</div>
<div align="center">Makassar</div>
<div align="center">0411-444180</div>
<div align="center" class="style1 style4">Nota Pembayaran</div>

 <div>
<?php
echo 'Nama : '.$r['nama_customer'].'<br>';
echo 'No Faktur : '.$nofaktur.'<br>';
?>
</div>
<table id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			<th></th>
			
			<th></th>
			
		</tr>
	</thead>
	<tbody>
	<?php
			
			$sql2=mysqli_query($con,"SELECT * FROM reception WHERE no_faktur= '$nofaktur'");
			
			while($s = mysqli_fetch_array($sql2)){
				$harga=rupiah($s['total_bayar']);
				?>
				<tr>
						
						<td colspan="2"><?php echo $s['no_nota'];?></td><td></td>
						<td colspan="4"><?php echo $harga;?></td>
				
				</tr>
			
						<?php  
						}
					?>
					<tr>
				<td colspan="2">Total:</td><td></td>
				<td colspan="4">
				<?php
				$sql3=mysqli_query($con,"SELECT sum(total_bayar) as total FROM reception WHERE no_faktur= '$nofaktur' and id_customer='$id_cs'");
$s1=mysqli_fetch_array($sql3);
$hr=rupiah($s1['total']);
echo $hr ;
				?>
				</td>
			</tr>
			<tr>
				<td colspan="2">Cara Pembayaran:</td><td></td>
				<td colspan="4">
				<?php
					echo $carabayar ;
				?>
				</td>
			</tr>
			
		
	</tbody>
</table>
</div>
<div id="mainmain">
<p style="border: 1px solid #000000;font-size: 12px; font-family: arial;border-radius: 2px;padding: 3px">
    Simpan bukti pembayaran ini. Anda Wajib menunjukan bukti ini jika akan melakukan komplain. Komplain Maksimal 3 hari setelah cucian di terima dan 14 hari setelah cucian bersih sampai di outlet.
</p>
</div>
<?php echo "Tgl $jam<br />" ?>
<?php echo "Reception :$_SESSION[user_id]" ?>

 <tr><td col><br/>
    <span style='float: left; text-align:center;'><br/ >
								Customer<br/> </br> </br>

								<br/>(<?php echo $r['nama_customer'] ?>)
	
	</span>
	
	</td>
	
	</tr>
	</div>
	<?php
    }else
    {
        echo "ERROR";
    }

?><?php

?>