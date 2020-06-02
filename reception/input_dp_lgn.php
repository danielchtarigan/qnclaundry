<?php
 function rupiah($angka){
           $jadi="Rp.".number_format($angka,0,',','.');
            return $jadi;
     }
     session_start();
$us=$_SESSION['user_id'];
$ot=$_SESSION['nama_outlet'];
?>
<?php
include "../config.php";

	
	
	date_default_timezone_set('Asia/Makassar');
	$jam=date("Y-m-d H:i:s");
	$id_cs=$_GET['id_cs'];
	$hargapaket=$_GET['hargapaket'];
	$paket=$_GET['paket'];
	$carabayarlgn=$_GET['carabayarlgn'];
	$kuota_sekarang_tambah=$_GET['kuota_sekarang_tambah'];
	$totalpoin=$_GET['totalpoin'];
	$poin=$_GET['poin'];
	
	
	$query = "SELECT max(no_faktur) AS last FROM faktur_penjualan  WHERE nama_outlet='$ot' LIMIT 1";
$hasil = mysqli_query($con,$query);
$k  = mysqli_fetch_array($hasil);
$no_urut = $k['last'];
// baca nomor urut transaksi dari id transaksi terakhir
//fCDW000001
$terakhir = (int)substr($no_urut, 4, 6);
// nomor urut ditambah 1
$nextNoUrut = $terakhir + 1;

if ($ot=="Toddopuli"){
$char = "FTDL";
	
}elseif ($ot=="Landak"){
	$char="FLDK";
	
	
}elseif ($ot=="Baruga") {
	$char="FBRG";
	
}
elseif ($ot=="Cendrawasih"){
	$char="FCDW";
	
}
 elseif ($ot=="BTP"){
	$char="FBTP";
	
}elseif ($ot=="DAYA"){
	$char="FDYA";
	
}elseif ($ot=="support"){
	$char="FSPT";

}elseif ($ot=="Boulevard"){
	$char="FBLV";
	
}
// membuat format nomor transaksi berikutnya
$nofaktur= $char.sprintf('%06s', $nextNoUrut);

$tambah=mysqli_query($con,"insert into faktur_penjualan(no_faktur,nama_outlet,rcp,tgl_transaksi,total,cara_bayar,id_customer,jenis_transaksi,no_faktur_urut) VALUES('$nofaktur','$ot','$us','$jam','$hargapaket','$carabayarlgn','$id_cs','deposit','$nofaktur')");
	
	$cs=mysqli_query($con,"update customer set poin='$totalpoin' WHERE  id='$id_cs'");
	$lg=mysqli_query($con,"update customer set lgn='1' WHERE  id='$id_cs'");
	$lg1=mysqli_query($con,"update customer set sisa_kuota='$kuota_sekarang_tambah' WHERE  id='$id_cs'");
	
	$tambah1=mysqli_query($con,"insert into transaksi_member (jenis_transaksi,jumlah_transaksi,id_customer,tgl_transaksi,no_nota,jumlah_poin) VALUES('1','$hargapaket','$id_cs','$jam','$nofaktur','$poin')");
	$tambahlgn=mysqli_query($con,"insert into detail_lgn (jenis_transaksi,jumlah_transaksi,id_customer,tgl_transaksi,no_nota,cara_bayar) VALUES('1','$hargapaket','$id_cs','$jam','$nofaktur','$carabayarlgn')");
	
	if($lg)
    
    {
    	    	$edit = mysqli_query($con,"SELECT  * FROM faktur_penjualan WHERE no_faktur='$nofaktur'");
	    	$r    = mysqli_fetch_array($edit);

    	?>
    	    	<script language="javascript">
function Clickheretoprint()
{ 
	var newWindow = window.open('','_blank','status=0,toolbar=0,location=0,menubar=1,resizable=1,scrollbars=1');
    newWindow.document.write(document.getElementById("dp").innerHTML);
    newWindow.print(); 
}
</script>
    	<a id="cccc" href="javascript:Clickheretoprint()">Print</a>
<div class="dp" id="dp">   
<div style="font-size: 12px; font-family: Arial" >
<div align="center"><img src="../logo.bmp" ></div>

<div align="center">Quick &' Clean Laundry</div>
<div align="center">Jl Toddopuli Raya No 08</div>
<div align="center">Makassar</div>
<div align="center">0411-444180</div>
<div align="center" class="style1 style4">Nota Deposit Langganan</div>

 <div>
<?php
// echo 'Nama : '.$r['id_customer'].'<br>';
echo 'No Faktur : '.$nofaktur.'<br>';
?>
</div>
<table id="resultTable" data-responsive="table" style="text-align: left;">
	<thead>
		<tr>
			
			<th></th>
			
		</tr>
	</thead>
	<tbody>
	<?php
			
			$sql2=mysqli_query($con,"SELECT * FROM faktur_penjualan WHERE no_faktur= '$nofaktur'");
			
			while($s = mysqli_fetch_array($sql2)){
				$harga=rupiah($s['total']);
				?>
				<tr>
						
						<td colspan="4"><?php echo $harga;?></td>
				
				</tr>
			
						<?php  
						}
					?>
					<tr>
				
				<td colspan="2">Sisa Kuota:</td><td></td>
				<td colspan="4">
				<?php
				$sql3=mysqli_query($con,"SELECT sisa_kuota FROM customer WHERE id= '$id_cs'");
$s1=mysqli_fetch_array($sql3);
$hr=rupiah($s1['sisa_kuota']);
echo $hr ;
				?>
				</td>
			</tr>
			<tr>
				<td colspan="2">Cara Pembayaran:</td><td></td>
				<td colspan="4">
				<?php
					echo $carabayarlgn ;
				?>
				</td>
			</tr>
			
		
	</tbody>
</table>
</div>
<?php echo "Tgl $jam<br />" ?>
<?php echo "Reception :$_SESSION[user_id]" ?>

 <tr><td col><br/>
    <span style='float: left; text-align:center;'><br/ >
								Customer<br/> </br> </br>

								<br/>(<?php
								 $edit = mysqli_query($con,"SELECT nama_customer FROM customer WHERE id='$id_cs'");
	    						$r    = mysqli_fetch_array($edit);
								 echo $r['nama_customer'] ?>)
	
	</span>
	
	</td>
	
	</tr>
	</div>
	<?php
    }else
    {
        echo "ERROR";
    }
   
   

?>