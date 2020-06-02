<?php
error_reporting(0);
///rupiah adalah fungsi yang nantinya akan kita panggil
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
    $s=$_GET['no_nota'];
    $nama_customer=$_GET['nama_customer'];
	$jen=$_GET['jenis'];
	if ($jen=='Kiloan'){
		$jenis=='k';
	}
	if ($jen=='Potongan'){
		$jenis=='p';
	}
	$express=$_GET['express1'];
	$ket=$_GET['ket'];
	$totalorder=$_GET['totalorder'];
	$diskon=$_GET['diskon'];
	$diskonrp=$_GET['diskonrp'];
	$voucher=$_GET['voucher'];
	

if(isset($voucher) && $voucher!=""){    
    mysqli_query($con,"update voucher_berkala set status='Tidak aktif' where kode_voucher='$voucher'");
    if(!mysqli_query($con,"insert into voucher_used (creator,voucher,id_customer,outlet) values ('$us','$voucher','$id_cs','$ot')")){
        echo("Error description: " . mysqli_error($con));
    }
}   	
	
	
$cb=$_GET['cabang'];
	if($cb==""){
		$cabang=$ot;
		
		}else{
			$cabang=$cb;
		}
	

	$query = "SELECT max(no_so) AS last FROM reception WHERE nama_outlet='$ot' LIMIT 0,1";
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

	include '../config.php';
	$ids          = session_id();
	$id_cs        = $_GET['id_cs'];

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
        $last_id = mysqli_insert_id($con);
        mysqli_query($con,"update cris_icon_details set id_detail_penjualan='$last_id' where id_rincian_order_tmp='{$isikeranjang[$i]['id']}'");
}
for($i = 0; $i < $jml; $i++)
{
	mysqli_query($con,"DELETE FROM rincian_order_temp
		WHERE id_customer = '{$isikeranjang[$i]['id_customer']}'");
                $last_i=$i;
}



	$sql  = $con->query("select * from voucher_lucky WHERE no_voucher = '$voucher'");
	$r    = $sql->fetch_assoc();
	if($r['jenis_voucher'] == 'ld' ){
$updatev  = mysqli_query($con," update voucher_lucky set aktif='1' WHERE no_voucher='$voucher'");
		
	}else if($r['jenis_voucher'] == 'RV' ){
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
 

 
 
if(isset($last_i)){ 
    $tambah=mysqli_query($con,"insert into reception(nama_outlet,nama_reception,tgl_input,nama_customer,no_nota,jenis,express,no_so,id_customer,total_bayar,cabang,ket,berat,voucher,diskon) VALUES('$ot','$us','$jam', '$nama_customer','$no_nota','$jenis','$express','$noso','$id_cs','$totalorder','$cabang','$ket','$berat','$voucher','$diskonrp')");
}else{
    Echo"Maaf anda harus kembali untuk melakukan print ulang nota order ini. Silahkan klik tombol back untuk kembali...";
    exit();
}

$last_id = mysqli_insert_id($con);    
    if($tambah)
    {
        mysqli_query($con,"update cris_icon_details set id_reception='$last_id' where id_rincian_order_tmp='{$isikeranjang[$last_i]['id']}'");              
    ?>
<?php 
    	$edit=$con->query("SELECT r.*,cid.hanger_own,cid.deliver,cid.parfum,cid.charge,cid.hanger,cid.hanger_plastic FROM reception r left join cris_icon_details cid on r.id = cid.id_reception  WHERE r.no_nota='$no_nota' order by cid.id desc");
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
<style type="text/css">
<!--
.style1 {font-weight: bold}
.style3 {font-size: 16px}
-->
</style>

<a id="cccc" href="javascript:Clickheretoprint()">Print</a>

<div class="content" id="content">
<div style="max-width:80mm;margin:5mm;">
<?php include"bar128.php" ?>
<div align="center"><img src="../logo.bmp" /></div>   
<div style="font-size: 9pt; font-family: Tahoma" >
  <div align="center"></div>
  
  			<?php
			$sql9=mysqli_query($con,"SELECT * FROM outlet WHERE nama_outlet='$ot'");
			while($dita = mysqli_fetch_array($sql9)){
			?>
            <div align="center">Outlet : <b><?php echo $dita['nama_outlet']; ?></b></div>
            <br>
	<div align="center"><?php echo $dita['alamat']; ?>, <?php echo $dita['Kota']; ?></div>
            <div align="center">Call Center : <?php echo $dita['no_telp']; ?></div>
            <br>
            <?php  
                }
            ?>
            <div align="center" class="style1 style4"><strong><span class="style3" style="font-family: arial;font-siez:10pt;">NOTA ORDER</span></strong></div>
	<div align="center"><?php echo bar128(stripslashes($no_nota))?></div>
 <div>
     <br>
     <table style="border-top: 1px dotted #000;width:100%;">
         <tr>
             <td>
                 <span style="float:left;font-size: 9pt;"><?= date('l, d M y H:iA'); ?></span>
             </td>
             <td>
                 <span style="float:right;font-size: 9pt;">Kasir : <?= $_SESSION['user_id']; ?></span>
             </td>
         </tr>
     </table>     
     <table style="font-size:9pt;border-top: 1px dotted #000;width:100%;">
         <tr>
            <?php
                echo '<td>Nama</td> <td>:</td> <td>'.$nama_customer.'</td></tr>';
                echo '<tr><td>No Order</td> <td>:</td> <td>'.$no_nota.'</td>';
            ?>
         </tr>
    </table>     
</div>
<table id="resultTable" data-responsive="table" style="text-align: left;font-size:9pt;border-top: 1px dotted #000;width:100%;">
	
	<tbody>
<?php
			$sql2=mysqli_query($con,"SELECT * FROM detail_penjualan WHERE no_nota= '$no_nota' and id_customer='$id_cs'");
			while($data = mysqli_fetch_array($sql2)){
			?>
                            <tr>
                                <td><?php echo $data['jumlah'];?></td>
                                <td width="100%" colspan="2"><?php echo $data['item'];?></td>
                                <td>Rp.</td>
                                <td style="text-align:right;"><?php echo number_format($data['total'],0,',','.');?></td>
                            </tr>			
                        <?php  
                            }
                        ?>
                            
                    <?php
                    if($_GET["jenis"]=="k"){
                        $rincian = 0;
                        if($r['charge']=="express"){
                    ?>        
                        <tr>
                            <td></td>
                            <td colspan="2" style="padding-left: 20px;">Express</td>
                            <td>Rp.</td>
                            <td style="text-align:right;"><?= number_format($expres=15000,0,',','.') ?></td>
                        </tr>    
                    <?php
                        $rincian=$rincian+$expres;
                        $left_code ="EXPRESS";
                        }
                    ?>  
                            
                    <?php
                        if($r['charge']=="double"){
                    ?>        
                        <tr>
                            <td></td>
                            <td colspan="2" style="padding-left: 20px;">Double Express</td>
                            <td>Rp.</td>
                            <td style="text-align:right;"><?= number_format($double=30000,0,',','.') ?></td>
                        </tr>    
                    <?php
                        $rincian=$rincian+$double;
                        $left_code ="DOUBLE EXPRESS";
                        }
                    ?>  
                        
                        
                    <?php
                        if($r['parfum']=="extra"){
                    ?>        
                        <tr>
                            <td></td>
                            <td colspan="2" style="padding-left: 20px;">Extra Parfum</td>
                            <td></td>
                            <td></td>
                        </tr>    
                    <?php
                        }
                    ?>  
                        
                        
                    <?php
                        if($r['parfum']=="no"){
                    ?>        
                        <tr>
                            <td></td>
                            <td colspan="2" style="padding-left: 20px;">Without Parfum</td>
                            <td></td>
                            <td></td>
                        </tr>    
                    <?php
                        }
                    ?>  
                        
                        
                    <?php
                        if($r['deliver']=="true"){
                    ?>        
                        <tr>
                            <td></td>
                            <td colspan="2" style="padding-left: 20px;">Delivery Service</td>
                            <td></td>
                            <td></td>
                        </tr>    
                    <?php
                        }
                    ?>        
                        
                        
                    <?php
                        if($r['hanger']>0){
                    ?>        
                        <tr>
                            <td></td>
                            <td colspan="2"><span  style="float:left;width:19px;"><?= $r['hanger']; ?></span>
                            <span>Hanger</span></td>
                            <td>Rp.</td>
                            <td style="text-align:right;"><?= number_format($hanger=$r['hanger']*2500,0,',','.') ?></td>
                        </tr>    
                    <?php
                        $rincian=$rincian+$hanger;
                        }
                    ?>        
                        
                        
                    <?php
                        if($r['hanger_plastic']>0){
                    ?>        
                        <tr>
                            <td></td>
                            <td colspan="2"><span  style="float:left;width:19px;"><?= $r['hanger_plastic']; ?></span>
                            <span>Plastic Hanger</span></td>
                            <td>Rp.</td>
                            <td style="text-align:right;"><?= number_format($hanger_plastic=$r['hanger_plastic']*2000,0,',','.') ?></td>
                        </tr>    
                    <?php
                            $rincian=$rincian+$hanger_plastic;
                        }                        
                    }
                    ?>           
                        <tr>
                                <td style="border-top: 1px dotted #000;"></td>
                                <td style="width:50px;border-top: 1px dotted #000;"></td>
                                <td style="border-top: 1px dotted #000;">Diskon</td>
				<td style="border-top: 1px dotted #000;">Rp.</td><td style="border-top: 1px dotted #000;text-align:right;">
				<?php
echo str_replace('Rp.','',rupiah($diskonrp, true));
				?>				</td>
			</tr>		
			
					<tr>
                                <td></td>            
                                <td style="width:50px;"></td>            
				<td>Total</td>
                                <td>Rp.</td><td style="text-align:right;">
				<?php
				
echo str_replace('Rp.','',rupiah($totalorder+$rincian, true));
				?>				</td>
			</tr>
	</tbody>
</table>    
 <div>
<?php
echo ''.$ket.'<br>';

?>
</div>
</div>
<!--   <div id="mainmain">
<p style="border: 1px solid #000000;font-size: 8px; font-family: arial;padding: 3px">
    Konsumen tunduk pada syarat dan ketentuan umum laundry kiloan dan laundry potongan di Quick & Clean. <br/><br />
    Cucian yang tidak diambil dalam 30 hari, di luar tanggung jawab Quick &' Clean.<br/><br >
    Komplain maksimal 3 hari sejak tanggal pengembalian, 14 hari sejak tgl order dan wajib menunjukkan nota pembayaran.<br/>
    <strong>Nota Ini BUKAN bukti pembayaran.</strong>
    </p>
    </div>-->
<div style="width:100%;border-top: 1px dotted #000;font-size: 9pt;font-family: Tahoma;padding: 5px 0px;border-bottom: 1px dashed #000;margin-bottom:1px;">
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
        }else{
        $addday = $tg+1;    
        }
        $date = date('d M y', strtotime('+'.$addday.' day', $now));
        if($r['charge']=="double"){
            echo "Tanggal Selesai : ".date('d M y',strtotime('+6 hours'))."<br>";
        }elseif($r['charge']=="express"){
            echo "Tanggal Selesai : ".date('d M y',strtotime('+24 hours'))."<br>";
        }else{
            echo "Tanggal Selesai : ".$date."<br>";
        }
    ?>
</div>
<table style="width:100%;border-top: 1px dashed #000;border-bottom: 1px dashed #000;font-size: 6pt;font-family: Tahoma;text-align: justify;">
    <tr>
        <td colspan="2">
            Syarat dan ketentuan:
        </td>
    </tr>
    <tr valign="top">
        <td style="width:20px;">
            1
        </td>
        <td>
            Kami tidak bertanggung jawab atas cucian kiloan yang luntur atau kena luntur dalam cucian satu nota
        </td>
    </tr>
    <tr valign="top">
        <td style="width:20px;">
            2
        </td>
        <td>
            Segala ganti rugi akibat kesalahan kami akan diganti maksimal 25X biaya cuci (Laundry Kiloan) atau 15X biaya cuci (Laundry Potongan)
        </td>
    </tr>
    <tr valign="top">
        <td style="width:20px;">
            3
        </td>
        <td>
            Konsumen hanya dapat melakukan komplain dalam maksimal 3 hari sejak tanggal pengembalian atau 14 hari sejak tanggal nota order (mana yang lebih dulu) dan wajib menunjukkan nota asli
        </td>
    </tr>
    <tr valign="top">
        <td style="width:20px;">
            4
        </td>
        <td>
            Kami tidak bertanggung jawab atas cucian yang tidak diambil dalam 30 hari sejak tanggal nota order
        </td>
    </tr>
    <tr valign="top">
        <td style="width:20px;">
            5
        </td>
        <td>
            Dengan menerima nota ini, konsumen tunduk pada syarat dan ketentuan ini dan yang tercantum di seluruh toko kami
        </td>
    </tr>
</table>
<!--    
<?php
//echo "Tgl $jam<br />" ?>
<?php //echo "Reception :$_SESSION[user_id]" ?>

 <tr><td col><br/>
    <span style='float: left; text-align:center;'><br/>
								Customer<br/> </br> </br>
								
								<br/>(<?php //echo $r['nama_customer'] ?>)
	
	</span>
	
	</td>
	
	</tr>-->
<div style="width:100%;border-top: 1px dotted #000;font-size: 8pt;font-family: Tahoma;padding: 5px 0px;border-top: 1px dashed #000;margin-top:1px;text-align: center;">
    <b style="font-weight: bold;font-family: arial;">Disokon 25% jika cucian Anda TELAT!!</b><br>
    khusus transaksi berikutnya, mintalah voucher di Resepsionis S&K berlaku
</div>
<br><br><br>

<div style="page-break-before:always;">
    

<div align="center"><h3 style="margin:0px;">Quick &` Clean Laundry</h3></div>   
<div style="font-size: 9pt; font-family: Tahoma" >
  <div align="center"></div>
  
  			<?php
			$sql9=mysqli_query($con,"SELECT * FROM outlet WHERE nama_outlet='$ot'");
			while($dita = mysqli_fetch_array($sql9)){
			?>
            <div align="center">Outlet : <b><?php echo $dita['nama_outlet']; ?></b></div>
            <br>
	<div align="center"><?php echo $dita['alamat']; ?>, <?php echo $dita['Kota']; ?></div>
            <div align="center">Call Center : <?php echo $dita['no_telp']; ?></div>
            <br>
            <?php  
                }
            ?>
            <div align="center" class="style1 style4"><strong><span class="style3" style="font-family: arial;font-siez:10pt;">NOTA ORDER</span></strong></div>
            <center>-----------------DUPLICATE-----------------</center>
            <div align="center" style="margin-top:5px;"><?php echo bar128(stripslashes($no_nota))?></div>
 <div>
     <br>
     <table style="border-top: 1px dotted #000;width:100%;">
         <tr>
             <td>
                 <span style="float:left;font-size: 9pt;"><?= date('l, d M y H:iA'); ?></span>
             </td>
             <td>
                 <span style="float:right;font-size: 9pt;">Kasir : <?= $_SESSION['user_id']; ?></span>
             </td>
         </tr>
     </table>     
     <table style="font-size:9pt;border-top: 1px dotted #000;width:100%;">
         <tr>
            <?php
                echo '<td>Nama</td> <td>:</td> <td>'.$nama_customer.'</td></tr>';
                echo '<tr><td>No Order</td> <td>:</td> <td>'.$no_nota.'</td>';
            ?>
         </tr>
    </table>     
</div>
<table id="resultTable" data-responsive="table" style="text-align: left;font-size:9pt;border-top: 1px dotted #000;width:100%;">
	
	<tbody>
<?php
			$sql2=mysqli_query($con,"SELECT * FROM detail_penjualan WHERE no_nota= '$no_nota' and id_customer='$id_cs'");
			while($data = mysqli_fetch_array($sql2)){
			?>
                            <tr>
                                <td><?php echo $data['jumlah'];?></td>
                                <td width="100%" colspan="2"><?php echo $data['item'];?></td>
                                <td>Rp.</td>
                                <td style="text-align:right;"><?php echo number_format($data['total'],0,',','.');?></td>
                            </tr>			
                        <?php  
                            }
                        ?>
                            
                    <?php
                    if($_GET["jenis"]=="k"){
                        $rincian = 0;
                        if($r['charge']=="express"){
                    ?>        
                        <tr>
                            <td></td>
                            <td colspan="2" style="padding-left: 20px;">Express</td>
                            <td>Rp.</td>
                            <td style="text-align:right;"><?= number_format($expres=15000,0,',','.') ?></td>
                        </tr>    
                    <?php
                        $rincian=$rincian+$expres;
                        $left_code ="EXPRESS";
                        }
                    ?>  
                            
                    <?php
                        if($r['charge']=="double"){
                    ?>        
                        <tr>
                            <td></td>
                            <td colspan="2" style="padding-left: 20px;">Double Express</td>
                            <td>Rp.</td>
                            <td style="text-align:right;"><?= number_format($double=30000,0,',','.') ?></td>
                        </tr>    
                    <?php
                        $rincian=$rincian+$double;
                        $left_code ="DOUBLE EXPRESS";
                        }
                    ?>  
                        
                        
                    <?php
                        if($r['parfum']=="extra"){
                    ?>        
                        <tr>
                            <td></td>
                            <td colspan="2" style="padding-left: 20px;">Extra Parfum</td>
                            <td></td>
                            <td></td>
                        </tr>    
                    <?php
                        }
                    ?>  
                        
                        
                    <?php
                        if($r['parfum']=="no"){
                    ?>        
                        <tr>
                            <td></td>
                            <td colspan="2" style="padding-left: 20px;">Without Parfum</td>
                            <td></td>
                            <td></td>
                        </tr>    
                    <?php
                        }
                    ?>  
                        
                        
                    <?php
                        if($r['deliver']=="true"){
                    ?>        
                        <tr>
                            <td></td>
                            <td colspan="2" style="padding-left: 20px;">Delivery Service</td>
                            <td></td>
                            <td></td>
                        </tr>    
                    <?php
                        }
                    ?>        
                        
                        
                    <?php
                        if($r['hanger']>0){
                    ?>        
                        <tr>
                            <td></td>
                            <td colspan="2"><span  style="float:left;width:19px;"><?= $r['hanger']; ?></span>
                            <span>Hanger</span></td>
                            <td>Rp.</td>
                            <td style="text-align:right;"><?= number_format($hanger=$r['hanger']*2500,0,',','.') ?></td>
                        </tr>    
                    <?php
                        $rincian=$rincian+$hanger;
                        }
                    ?>        
                        
                        
                    <?php
                        if($r['hanger_plastic']>0){
                    ?>        
                        <tr>
                            <td></td>
                            <td colspan="2"><span  style="float:left;width:19px;"><?= $r['hanger_plastic']; ?></span>
                            <span>Plastic Hanger</span></td>
                            <td>Rp.</td>
                            <td style="text-align:right;"><?= number_format($hanger_plastic=$r['hanger_plastic']*2000,0,',','.') ?></td>
                        </tr>    
                    <?php
                            $rincian=$rincian+$hanger_plastic;
                        }                        
                    }
                    ?>    
                        <tr>
                                <td style="border-top: 1px dotted #000;"></td>
                                <td style="width:50px;border-top: 1px dotted #000;"></td>
                                <td style="border-top: 1px dotted #000;">Diskon</td>
				<td style="border-top: 1px dotted #000;">Rp.</td><td style="border-top: 1px dotted #000;text-align:right;">
				<?php
echo str_replace('Rp.','',rupiah($diskonrp, true));
				?>				</td>
			</tr>		
			
					<tr>
                                <td></td>            
                                <td style="width:50px;"></td>            
				<td>Total</td>
                                <td>Rp.</td><td style="text-align:right;">
				<?php
				
echo str_replace('Rp.','',rupiah($totalorder+$rincian, true));
				?>				</td>
			</tr>
	</tbody>
</table>    
 <div>
<?php
echo ''.$ket.'<br>';

?>
</div>
</div>
<!--   <div id="mainmain">
<p style="border: 1px solid #000000;font-size: 8px; font-family: arial;padding: 3px">
    Konsumen tunduk pada syarat dan ketentuan umum laundry kiloan dan laundry potongan di Quick & Clean. <br/><br />
    Cucian yang tidak diambil dalam 30 hari, di luar tanggung jawab Quick &' Clean.<br/><br >
    Komplain maksimal 3 hari sejak tanggal pengembalian, 14 hari sejak tgl order dan wajib menunjukkan nota pembayaran.<br/>
    <strong>Nota Ini BUKAN bukti pembayaran.</strong>
    </p>
    </div>-->
<div style="width:100%;border-top: 1px dotted #000;font-size: 9pt;font-family: Tahoma;padding: 5px 0px;border-bottom: 1px dashed #000;margin-bottom:1px;">
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
        }else{
        $addday = $tg+1;    
        }
        $date = date('d M y', strtotime('+'.$addday.' day', $now));
        if($r['charge']=="double"){
            echo "Tanggal Selesai : ".date('d M y',strtotime('+6 hours'))."<br>";
        }elseif($r['charge']=="express"){
            echo "Tanggal Selesai : ".date('d M y',strtotime('+24 hours'))."<br>";
        }else{
            echo "Tanggal Selesai : ".$date."<br>";
        }
    ?>
</div>
<table style="width:100%;border-top: 1px dashed #000;border-bottom: 1px dashed #000;font-size: 6pt;font-family: Tahoma;text-align: justify;">
    <tr>
        <td colspan="2">
            Syarat dan ketentuan:
        </td>
    </tr>
    <tr valign="top">
        <td style="width:20px;">
            1
        </td>
        <td>
            Kami tidak bertanggung jawab atas cucian kiloan yang luntur atau kena luntur dalam cucian satu nota
        </td>
    </tr>
    <tr valign="top">
        <td style="width:20px;">
            2
        </td>
        <td>
            Segala ganti rugi akibat kesalahan kami akan diganti maksimal 25X biaya cuci (Laundry Kiloan) atau 15X biaya cuci (Laundry Potongan)
        </td>
    </tr>
    <tr valign="top">
        <td style="width:20px;">
            3
        </td>
        <td>
            Konsumen hanya dapat melakukan komplain dalam maksimal 3 hari sejak tanggal pengembalian atau 14 hari sejak tanggal nota order (mana yang lebih dulu) dan wajib menunjukkan nota asli
        </td>
    </tr>
    <tr valign="top">
        <td style="width:20px;">
            4
        </td>
        <td>
            Kami tidak bertanggung jawab atas cucian yang tidak diambil dalam 30 hari sejak tanggal nota order
        </td>
    </tr>
    <tr valign="top">
        <td style="width:20px;">
            5
        </td>
        <td>
            Dengan menerima nota ini, konsumen tunduk pada syarat dan ketentuan ini dan yang tercantum di seluruh toko kami
        </td>
    </tr>
</table>
<!--    
<?php
//echo "Tgl $jam<br />" ?>
<?php //echo "Reception :$_SESSION[user_id]" ?>

 <tr><td col><br/>
    <span style='float: left; text-align:center;'><br/>
								Customer<br/> </br> </br>
								
								<br/>(<?php //echo $r['nama_customer'] ?>)
	
	</span>
	
	</td>
	
	</tr>-->
<div style="width:100%;border-top: 1px dotted #000;font-size: 8pt;font-family: Tahoma;padding: 5px 0px;border-top: 1px dashed #000;margin-top:1px;text-align: center;">
    <b style="font-weight: bold;font-family: arial;">Disokon 25% jika cucian Anda TELAT!!</b><br>
    khusus transaksi berikutnya, mintalah voucher di Resepsionis S&K berlaku
    <br><br><br>
    Saya setuju dan telah  mengerti seluruh syarat dan ketentuan di Quick &` Clean Laundry
    <br><br><br><br><br><br><br><br>
    <hr>
    (<?= ucwords($r['nama_customer']) ?>)
</div>    
    

</div>
<br><br><br>
<?php if($_GET["jenis"]=="k"){ ?>
<div style="page-break-before:always;">
    

<div style="font-size: 9pt; font-family: Tahoma" >
  <div align="center"></div>
  
            <?php
            $sql9=mysqli_query($con,"SELECT * FROM outlet WHERE nama_outlet='$ot'");
            while($dita = mysqli_fetch_array($sql9)){
            ?>
              <table style="width:100%;">
                      <tr>
                          <td style="width:33.33%">
                              <h3 style="margin:0px;">
                                  <center>
                                      <?= $left_code; ?>
                                  </center>
                              </h3>
                          </td>
                          <td style="width:33.33%">
                              <h1 style="margin:0px;">
                                  <center>
                                  <?php
                                    if($dita['nama_outlet']=="Toddopuli"){
                                        echo "TDP";
                                    }elseif($dita['nama_outlet']=="Landak"){
                                        echo "LDB";
                                    }elseif($dita['nama_outlet']=="Baruga"){
                                        echo "BBG";
                                    }elseif($dita['nama_outlet']=="Cendrawasih"){
                                        echo "CDW";
                                    }elseif($dita['nama_outlet']=="Bumi Taman Permai"){
                                        echo "BTP";
                                    }elseif($dita['nama_outlet']=="Daya"){
                                        echo "DYA";
                                    }
                                  ?>
                                      </center>
                              </h1>
                          </td>
                          <td style="width:33.33%">
                              <h3 style="margin:0px;">
                                  <center>
                                  <?= strtoupper(date('l 12 M')) ?>
                                  </center>    
                              </h3>
                          </td>
                      </tr>
                  </table>
            <?php  
                }
            ?>

 <div>
     <br>
     <table style="border-top: 1px dotted #000;width:100%;">
         <tr>
             <td>
                 <span style="float:left;font-size: 9pt;"><?= date('l, d M y H:iA'); ?></span>
             </td>
             <td>
                 <span style="float:right;font-size: 9pt;">Kasir : <?= $_SESSION['user_id']; ?></span>
             </td>
         </tr>
     </table>     
     <table style="font-size:9pt;border-top: 1px dotted #000;width:100%;">
         <tr>
            <?php
                echo '<td>Nama</td> <td>:</td> <td>'.$nama_customer.'</td></tr>';
                echo '<tr><td>No Order</td> <td>:</td> <td>'.$no_nota.'</td>';
            ?>
         </tr>
    </table>     
</div>
<table id="resultTable" data-responsive="table" style="text-align: left;font-size:9pt;border-top: 1px dotted #000;width:100%;">
	
	<tbody>
<?php
			$sql2=mysqli_query($con,"SELECT * FROM detail_penjualan WHERE no_nota= '$no_nota' and id_customer='$id_cs'");
			while($data = mysqli_fetch_array($sql2)){
			?>
                            <tr>
                                <td><?php echo $data['jumlah'];?></td>
                                <td width="100%" colspan="2"><?php echo $data['item'];?></td>
                                <td>Rp.</td>
                                <td style="text-align:right;"><?php echo number_format($data['total'],0,',','.');?></td>
                            </tr>			
                        <?php  
                            }
                        ?>
                            
                    <?php
                        $rincian = 0;
                        if($r['charge']=="express"){
                    ?>        
                        <tr>
                            <td></td>
                            <td colspan="2" style="padding-left: 20px;">Express</td>
                            <td>Rp.</td>
                            <td style="text-align:right;"><?= number_format($expres=15000,0,',','.') ?></td>
                        </tr>    
                    <?php
                        $rincian=$rincian+$expres;
                        }
                    ?>  
                            
                    <?php
                        if($r['charge']=="double"){
                    ?>        
                        <tr>
                            <td></td>
                            <td colspan="2" style="padding-left: 20px;">Double Express</td>
                            <td>Rp.</td>
                            <td style="text-align:right;"><?= number_format($double=30000,0,',','.') ?></td>
                        </tr>    
                    <?php
                        $rincian=$rincian+$double;
                        }
                    ?>  
                        
                        
                    <?php
                        if($r['parfum']=="extra"){
                    ?>        
                        <tr>
                            <td></td>
                            <td colspan="2" style="padding-left: 20px;">Extra Parfum</td>
                            <td></td>
                            <td></td>
                        </tr>    
                    <?php
                        }
                    ?>  
                        
                        
                    <?php
                        if($r['parfum']=="no"){
                    ?>        
                        <tr>
                            <td></td>
                            <td colspan="2" style="padding-left: 20px;">Without Parfum</td>
                            <td></td>
                            <td></td>
                        </tr>    
                    <?php
                        }
                    ?>  
                        
                        
                    <?php
                        if($r['deliver']=="true"){
                    ?>        
                        <tr>
                            <td></td>
                            <td colspan="2" style="padding-left: 20px;">Delivery Service</td>
                            <td></td>
                            <td></td>
                        </tr>    
                    <?php
                        }
                    ?>        
                        
                        
                    <?php
                        if($r['hanger']>0){
                    ?>        
                        <tr>
                            <td></td>
                            <td colspan="2"><span  style="float:left;width:19px;"><?= $r['hanger']; ?></span>
                            <span>Hanger</span></td>
                            <td>Rp.</td>
                            <td style="text-align:right;"><?= number_format($hanger=$r['hanger']*2500,0,',','.') ?></td>
                        </tr>    
                    <?php
                        $rincian=$rincian+$hanger;
                        }
                    ?>        
                        
                        
                    <?php
                        if($r['hanger_plastic']>0){
                    ?>        
                        <tr>
                            <td></td>
                            <td colspan="2"><span  style="float:left;width:19px;"><?= $r['hanger_plastic']; ?></span>
                            <span>Plastic Hanger</span></td>
                            <td>Rp.</td>
                            <td style="text-align:right;"><?= number_format($hanger_plastic=$r['hanger_plastic']*2000,0,',','.') ?></td>
                        </tr>    
                    <?php
                            $rincian=$rincian+$hanger_plastic;
                        }
                    ?>        
                        <tr>
                                <td style="border-top: 1px dotted #000;"></td>
                                <td style="width:50px;border-top: 1px dotted #000;"></td>
                                <td style="border-top: 1px dotted #000;">Diskon</td>
				<td style="border-top: 1px dotted #000;">Rp.</td><td style="border-top: 1px dotted #000;text-align:right;">
				<?php
echo str_replace('Rp.','',rupiah($diskonrp, true));
				?>				</td>
			</tr>		
			
					<tr>
                                <td></td>            
                                <td style="width:50px;"></td>            
				<td>Total</td>
                                <td>Rp.</td><td style="text-align:right;">
				<?php
				
echo str_replace('Rp.','',rupiah($totalorder+$rincian, true));
				?>				</td>
			</tr>
	</tbody>
</table>    
 <div>
<?php
echo ''.$ket.'<br>';

?>
</div>
</div>
<!--   <div id="mainmain">
<p style="border: 1px solid #000000;font-size: 8px; font-family: arial;padding: 3px">
    Konsumen tunduk pada syarat dan ketentuan umum laundry kiloan dan laundry potongan di Quick & Clean. <br/><br />
    Cucian yang tidak diambil dalam 30 hari, di luar tanggung jawab Quick &' Clean.<br/><br >
    Komplain maksimal 3 hari sejak tanggal pengembalian, 14 hari sejak tgl order dan wajib menunjukkan nota pembayaran.<br/>
    <strong>Nota Ini BUKAN bukti pembayaran.</strong>
    </p>
    </div>-->
<div style="border-bottom: 1px dashed #000;margin-bottom:1px;width:100%"></div>
<div style="width:100%;border-top: 1px dotted #000;font-size: 9pt;font-family: Tahoma;padding: 5px 0px;border-top: 1px dashed #000;margin-bottom:1px;">
    <div align="center" style="margin-top:5px;"><?php echo bar128(stripslashes($no_nota))?></div>
    <br><br>
    <div style="width:100%;">
        <center>
        <?php if($r["deliver"]=="true"){ ?>
            <img src="img/delivery.png">
        <?php } ?>
        <?php if($r["hanger"]>0){ ?>    
        <img src="img/hanger.png">
        <?php } ?>
        <?php if($r["parfum"]=="extra"){ ?>            
        <img src="img/extra.png">
        <?php } ?>
        <?php if($r["parfum"]=="no"){ ?>                            
        <img src="img/no.png">
        <?php } ?>
        <?php if($r["hanger_own"]=="true"){ ?>            
        <img src="img/own.png">
        <?php } ?>
        <?php if($r["hanger_plastic"]>0){ ?>            
        <img src="img/plastic.png">
        <?php } ?>        
        </center>
    </div>
</div>
    

</div>
<br><br><br>

<div style="page-break-before:always;">
    

<div style="font-size: 9pt; font-family: Tahoma" >
  <div align="center"></div>
  
            <?php
            $sql9=mysqli_query($con,"SELECT * FROM outlet WHERE nama_outlet='$ot'");
            while($dita = mysqli_fetch_array($sql9)){
            ?>
              <table style="width:100%;">
                      <tr>
                          <td style="width:33.33%">
                              <h3 style="margin:0px;">
                                  <center>
                                      <?= $left_code; ?>
                                  </center>
                              </h3>
                          </td>
                          <td style="width:33.33%">
                              <h1 style="margin:0px;">
                                  <center>
                                  <?php
                                    if($dita['nama_outlet']=="Toddopuli"){
                                        echo "TDP";
                                    }elseif($dita['nama_outlet']=="Landak"){
                                        echo "LDB";
                                    }elseif($dita['nama_outlet']=="Baruga"){
                                        echo "BBG";
                                    }elseif($dita['nama_outlet']=="Cendrawasih"){
                                        echo "CDW";
                                    }elseif($dita['nama_outlet']=="Bumi Taman Permai"){
                                        echo "BTP";
                                    }elseif($dita['nama_outlet']=="Daya"){
                                        echo "DYA";
                                    }
                                  ?>
                                  </center>    
                              </h1>
                          </td>
                          <td style="width:33.33%">
                              <h3 style="margin:0px;">
                                  <center>
                                  <?= strtoupper(date('l 12 M')) ?>
                                  </center>    
                              </h3>
                          </td>
                      </tr>
                  </table>
            <?php  
                }
            ?>

 <div>
     <br>
     <table style="border-top: 1px dotted #000;width:100%;">
         <tr>
             <td>
                 <span style="float:left;font-size: 9pt;"><?= date('l, d M y H:iA'); ?></span>
             </td>
             <td>
                 <span style="float:right;font-size: 9pt;">Kasir : <?= $_SESSION['user_id']; ?></span>
             </td>
         </tr>
     </table>     
     <table style="font-size:9pt;border-top: 1px dotted #000;width:100%;">
         <tr>
            <?php
                echo '<td>Nama</td> <td>:</td> <td>'.$nama_customer.'</td></tr>';
                echo '<tr><td>No Order</td> <td>:</td> <td>'.$no_nota.'</td>';
            ?>
         </tr>
    </table>     
</div>
<table id="resultTable" data-responsive="table" style="text-align: left;font-size:9pt;border-top: 1px dotted #000;width:100%;">
	
	<tbody>
<?php
			$sql2=mysqli_query($con,"SELECT * FROM detail_penjualan WHERE no_nota= '$no_nota' and id_customer='$id_cs'");
			while($data = mysqli_fetch_array($sql2)){
			?>
                            <tr>
                                <td><?php echo $data['jumlah'];?></td>
                                <td width="100%" colspan="2"><?php echo $data['item'];?></td>
                                <td>Rp.</td>
                                <td style="text-align:right;"><?php echo number_format($data['total'],0,',','.');?></td>
                            </tr>			
                        <?php  
                            }
                        ?>
                            
                    <?php
                        $rincian = 0;
                        if($r['charge']=="express"){
                    ?>        
                        <tr>
                            <td></td>
                            <td colspan="2" style="padding-left: 20px;">Express</td>
                            <td>Rp.</td>
                            <td style="text-align:right;"><?= number_format($expres=15000,0,',','.') ?></td>
                        </tr>    
                    <?php
                        $rincian=$rincian+$expres;
                        }
                    ?>  
                            
                    <?php
                        if($r['charge']=="double"){
                    ?>        
                        <tr>
                            <td></td>
                            <td colspan="2" style="padding-left: 20px;">Double Express</td>
                            <td>Rp.</td>
                            <td style="text-align:right;"><?= number_format($double=30000,0,',','.') ?></td>
                        </tr>    
                    <?php
                        $rincian=$rincian+$double;
                        }
                    ?>  
                        
                        
                    <?php
                        if($r['parfum']=="extra"){
                    ?>        
                        <tr>
                            <td></td>
                            <td colspan="2" style="padding-left: 20px;">Extra Parfum</td>
                            <td></td>
                            <td></td>
                        </tr>    
                    <?php
                        }
                    ?>  
                        
                        
                    <?php
                        if($r['parfum']=="no"){
                    ?>        
                        <tr>
                            <td></td>
                            <td colspan="2" style="padding-left: 20px;">Without Parfum</td>
                            <td></td>
                            <td></td>
                        </tr>    
                    <?php
                        }
                    ?>  
                        
                        
                    <?php
                        if($r['deliver']=="true"){
                    ?>        
                        <tr>
                            <td></td>
                            <td colspan="2" style="padding-left: 20px;">Delivery Service</td>
                            <td></td>
                            <td></td>
                        </tr>    
                    <?php
                        }
                    ?>        
                        
                        
                    <?php
                        if($r['hanger']>0){
                    ?>        
                        <tr>
                            <td></td>
                            <td colspan="2"><span  style="float:left;width:19px;"><?= $r['hanger']; ?></span>
                            <span>Hanger</span></td>
                            <td>Rp.</td>
                            <td style="text-align:right;"><?= number_format($hanger=$r['hanger']*2500,0,',','.') ?></td>
                        </tr>    
                    <?php
                        $rincian=$rincian+$hanger;
                        }
                    ?>        
                        
                        
                    <?php
                        if($r['hanger_plastic']>0){
                    ?>        
                        <tr>
                            <td></td>
                            <td colspan="2"><span  style="float:left;width:19px;"><?= $r['hanger_plastic']; ?></span>
                            <span>Plastic Hanger</span></td>
                            <td>Rp.</td>
                            <td style="text-align:right;"><?= number_format($hanger_plastic=$r['hanger_plastic']*2000,0,',','.') ?></td>
                        </tr>    
                    <?php
                            $rincian=$rincian+$hanger_plastic;
                        }
                    ?>        
                        <tr>
                                <td style="border-top: 1px dotted #000;"></td>
                                <td style="width:50px;border-top: 1px dotted #000;"></td>
                                <td style="border-top: 1px dotted #000;">Diskon</td>
				<td style="border-top: 1px dotted #000;">Rp.</td><td style="border-top: 1px dotted #000;text-align:right;">
				<?php
echo str_replace('Rp.','',rupiah($diskonrp, true));
				?>				</td>
			</tr>		
			
					<tr>
                                <td></td>            
                                <td style="width:50px;"></td>            
				<td>Total</td>
                                <td>Rp.</td><td style="text-align:right;">
				<?php
				
echo str_replace('Rp.','',rupiah($totalorder+$rincian, true));
				?>				</td>
			</tr>
	</tbody>
</table>    
 <div>
<?php
echo ''.$ket.'<br>';

?>
</div>
</div>
<!--   <div id="mainmain">
<p style="border: 1px solid #000000;font-size: 8px; font-family: arial;padding: 3px">
    Konsumen tunduk pada syarat dan ketentuan umum laundry kiloan dan laundry potongan di Quick & Clean. <br/><br />
    Cucian yang tidak diambil dalam 30 hari, di luar tanggung jawab Quick &' Clean.<br/><br >
    Komplain maksimal 3 hari sejak tanggal pengembalian, 14 hari sejak tgl order dan wajib menunjukkan nota pembayaran.<br/>
    <strong>Nota Ini BUKAN bukti pembayaran.</strong>
    </p>
    </div>-->
<div style="border-bottom: 1px dashed #000;margin-bottom:1px;width:100%"></div>
<div style="width:100%;border-top: 1px dotted #000;font-size: 9pt;font-family: Tahoma;padding: 5px 0px;border-top: 1px dashed #000;margin-bottom:1px;">
    <div align="center" style="margin-top:5px;"><?php echo bar128(stripslashes($no_nota))?></div>
    <br><br>
    <div style="width:100%;">
        <center>
        <?php if($r["deliver"]=="true"){ ?>
            <img src="img/delivery.png">
        <?php } ?>
        <?php if($r["hanger"]>0){ ?>    
        <img src="img/hanger.png">
        <?php } ?>
        <?php if($r["parfum"]=="extra"){ ?>            
        <img src="img/extra.png">
        <?php } ?>
        <?php if($r["parfum"]=="no"){ ?>                            
        <img src="img/no.png">
        <?php } ?>
        <?php if($r["hanger_own"]=="true"){ ?>            
        <img src="img/own.png">
        <?php } ?>
        <?php if($r["hanger_plastic"]>0){ ?>            
        <img src="img/plastic.png">
        <?php } ?>        
        </center>
    </div>
</div>
    

</div>
    <?php } ?>

</div>        
</div>
<?php
}else
{
    echo "ERROR";
}   
?>