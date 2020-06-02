<body onLoad="print()">
<?php
session_start();
include '../../../config.php';
include 'validasi.php';

function rupiah($angka)
{
    $jadi = "Rp.".number_format($angka,0,',','.');
    return $jadi;
}
date_default_timezone_set('Asia/Jakarta');
$jam1 = date("Y-m-d h:i:s");     

?>
<style type="text/css">
<!--
.style1 {font-weight: bold}
.style3 {font-size: 16px}
-->
</style>

<!-- 
<a id="cccc" href="javascript:Clickheretoprint()">Print</a>
-->
<div class="content" id="content">
<div style="max-width:80mm;margin:5mm;">
<div align="center"><img src="../../../logo.bmp" /></div>   
<div style="font-size: 9pt; font-family: Tahoma" >
  <div align="center"></div>
  
            <?php
            $ot = $_SESSION['nama_outlet'];
            $no_faktur = $_GET['faktur'];
            $qrec = mysqli_query($con,"SELECT * FROM reception WHERE no_faktur='$no_faktur'");
            $rrec = mysqli_fetch_array($qrec);
            $nama_customer = $rrec['nama_customer'];
            $idc = $rrec['id_customer'];
            $diskon = 0;
            $diskon = $rrec['diskon'];
            $total = $rrec['total_bayar'];
            $charge = $rrec['express'];

            $sql9=mysqli_query($con,"SELECT * FROM outlet WHERE nama_outlet='$ot'");
            while($dita = mysqli_fetch_array($sql9)){
            ?>
            <div align="center">Cabang : <b><?php echo $dita['nama_outlet']; ?></b></div>
            <br>
    <div align="center"><?php echo $dita['alamat']; ?>, <?php echo $dita['Kota']; ?></div>
            <div align="center">Call Center : 08113310075 / 0321-330075</div>
            <br>
            <?php  
                }
                
                $qf = mysqli_query($con, "select * from reception where no_faktur='$no_faktur'");
                $rf = mysqli_fetch_array($qf);
            ?>
            <div align="center" class="style1 style4"><strong><span class="style3" style="font-family: arial;font-siez:10pt;">NOTA PEMBAYARAN</span></strong></div>
            <div align="center" class="style1 style4"><span style="font-family: arial;font-siez:10pt;">No Faktur : <?php echo $no_faktur; ?></span></div>
     <br>
     <table style="border-top: 1px dotted #000;width:100%;">
         <tr>
             <td>
                 <span style="float:left;font-size: 9pt;"><?= date('l, d M y H:iA'); ?></span>
             </td>
             <td>
                 <span style="float:right;font-size: 9pt;">Kasir : <?php echo $_SESSION['name']; ?></span>
             </td>
         </tr>
     </table>     
     <table style="font-size:9pt;border-top: 1px dotted #000;width:100%;">
         <tr>
            <?php
            $qcus = mysqli_query($con, "select * from customer where id='$idc'");
            $rcus = mysqli_fetch_array($qcus);
            $jm=1;
            if ($rcus['jenis_member']=='Red') $jm=2;
            if (substr($rcus['jenis_member'],0,4)=='blue') $jm=3;
            
                echo '<td>Nama</td> <td>:</td> <td>'.$nama_customer.'</td></tr>';
                echo '<tr><td>No Telp</td> <td>:</td> <td>'.$rcus['no_telp'].'</td>';
            ?>
         </tr>
    </table>     
<table style="font-size:9pt;border-top: 1px dotted #000;width:100%;">
<?php
                $qf1 = mysqli_query($con, "select * from reception where no_faktur='$no_faktur' and id_customer='$idc'");
                $total = 0;
                $diskon = 0;
                $cb=0;
                while ($rf1 = mysqli_fetch_array($qf1)){
                    if(substr_count(strtolower($rf1['cara_bayar']),"bni")==1) $cb=2;
                            ?>
                            <tr>
                                <td width="93" colspan="3"><?php echo $rf1['no_nota'];?></td>
                                <td width="99">Rp.</td>
                                <td width="42" style="text-align:right; width:42px;"><?php echo number_format($rf1['total_bayar'],0,',','.');?>
                                </td>
                            </tr>           
            <?php
                $total = $total + $rf1['total_bayar'];
                $diskon = $diskon + $rf1['diskon'];
                    }

            $qretail = mysqli_query($con, "select * from detail_retail a, retail b where a.item=b.kode and a.no_faktur='$no_faktur'");
            $totretail = 0;
            while ($rretail = mysqli_fetch_array($qretail)){
                            ?>
                            <tr>
                                <td>&nbsp;</td>
                                <td width="30"><?php echo $rretail['jumlah']; ?></td>
                                <td width="156"><?php echo $rretail['nama_barang']; ?></td>
                                <td>Rp.</td>
                                <td style="text-align:right;"><?php echo number_format($rretail['total'],0,',','.');?>
                                </td>
                            </tr>           
            <?php   
            $totretail = $totretail + $rretail['total'];
            
                }   
            ?>
</table>

<table style="font-size:9pt;border-top: 1px dotted #000; width:100%;">                          
<!--
                        <tr>
                                <td width="229"></td>
                                <td width="78">Diskon</td>
                                <td width="53">Rp.</td>
                <td width="42" style="text-align:right; width:42px;">
                <?php
echo str_replace('Rp.','',rupiah($diskon, true));
                ?>              </td>
            </tr>       
-->
                        <tr>
                                <td width="229"></td>
                                <td width="78"></td>
                                <td width="53"></td>
                <td width="42" style="text-align:right; width:42px;">
                </td>
            </tr>       
                    <tr>
                                <td>&nbsp;</td>
                      <td>Total</td>
                                <td>Rp.</td><td style="text-align:right;">
                <?php
                
echo str_replace('Rp.','',rupiah($total+$totretail, true));
                ?>              </td>
            </tr>       
            <tr><td colspan="4" align="left">Cara Pembayaran</td></tr>
<?php
$poin = 0;
$qbayar = mysqli_query($con, "select * from cara_bayar where no_faktur='$_GET[faktur]'");
while ($rbayar = mysqli_fetch_array($qbayar)){
?>          
            <tr>
                     <td>&nbsp;</td>
                     <td><?php echo $rbayar['cara_bayar']; ?></td>
                     <td>Rp.</td>
                     <td style="text-align:right;">
                     <?php echo str_replace('Rp.','',rupiah($rbayar['jumlah'], true)); ?>               
                     </td>
            </tr>
<?php
}
$sisa =($total+$totretail) % 25000;
$jum =($total+$totretail)-$sisa;
$poin = $jum / 25000;
?>            
</table>    
</div>
<table style="width:100%;border-top: 1px dashed #000;border-bottom: 1px dashed #000;font-size: 7pt;font-family: Tahoma;text-align: justify;">
<?php
$cek = mysqli_query($con, "select * from customer where id='$idc'");                                        
$rsql = mysqli_fetch_array($cek);
if ($rsql['member']==1){
?>
    <tr>
     <td>No. Member</td><td> : <?php echo $rsql['member_id']; ?></td><td>Valid Thu</td><td> : <?php echo $rsql['tgl_akhir']; ?></td>
    </tr>
    <tr>
     <td>POIN Masuk</td><td> : <?php echo $poin; ?></td><td>Saldo POIN</td><td> : <?php echo $rcus['poin']; ?></td>
    </tr>
</table>

<table style="width:100%;border-top: 1px dashed #000;border-bottom: 1px dashed #000; font-family: Tahoma;text-align: justify;">
<?php
if ($poin>0){
?>
      <tr style="font-size: 5pt;">
       <td colspan="4" align="center">
        <b>Anda Mendapat Referal Voucher</b><br>
        Bagikan nomor referal di bawah ke rekan Anda (non-member Quick &' Clean). Teman Anda akan mendapatkan diskon 15% dan Anda akan mendapatkan 1 poin setiap kali nomor digunakan<br>        
        <?php
$query = "SELECT max(no_voucher) AS last FROM voucher_lucky WHERE jenis_voucher='RV' LIMIT 1";
$hasil = mysqli_query($con,$query);
$k  = mysqli_fetch_array($hasil);
$no_urut = $k['last'];

$lastNoUrut =(int)substr($no_urut, 2, 7);
$lastNoUrut1 = $lastNoUrut+1;
$lastNoUrut2 = $lastNoUrut+2;

if ($poin==1){
 $no_v1 = "RF".sprintf('%07s', $lastNoUrut1);
 echo $no_v1;
 $query = "insert into voucher_lucky values ('$no_v1', '0.15', '0', 'RV', '0', '$idc')";
 $hasil = mysqli_query($con,$query);
}
else{
 $no_v1 = "RF".sprintf('%07s', $lastNoUrut1);
 echo $no_v1."<br>";
 $no_v2 = "RF".sprintf('%07s', $lastNoUrut2);
 echo $no_v2;
 $query = "insert into voucher_lucky values ('$no_v1', '0.15', '0', 'RV', '0', '$idc')";
 $hasil = mysqli_query($con,$query);
 $query = "insert into voucher_lucky values ('$no_v2', '0.15', '0', 'RV', '0', '$idc')";
 $hasil = mysqli_query($con,$query);
}
        ?>
       </td>
      </tr>
<?php   
}
}
?>

    <tr style="font-size: 7pt;">
        <td align="center" colspan="4">
            Terima kasih telah mencuci di Quick &' Clean
        </td>
    </tr>
    <tr>
     <td colspan="4">&nbsp;</td>
    </tr>
</table>

<?php 
$qpark = mysqli_query($con,"SELECT * FROM parkir natural join outlet WHERE nama_outlet='$ot' and status=1");
            $rpark = mysqli_fetch_array($qpark);
if (mysqli_num_rows($qpark)>0) {

?>
<div style="page-break-before:always;">
<div align="center"><img src="../logo.bmp" /></div> 
<div style="font-size: 9pt; font-family: Tahoma" >
  <div align="center"></div>
  
            <?php
            $ot = $_SESSION['nama_outlet'];
            $no_faktur = $_GET['faktur'];
            $qrec = mysqli_query($con,"SELECT * FROM reception WHERE no_faktur='$no_faktur'");
            $rrec = mysqli_fetch_array($qrec);
            $nama_customer = $rrec['nama_customer'];
            $idc = $rrec['id_customer'];
            $diskon = 0;
            $diskon = $rrec['diskon'];
            $total = $rrec['total_bayar'];
            $charge = $rrec['express'];

            $sql9=mysqli_query($con,"SELECT * FROM outlet WHERE nama_outlet='$ot'");
            while($dita = mysqli_fetch_array($sql9)){
            ?>
            <div align="center">Outlet : <b><?php echo $dita['nama_outlet']; ?></b></div>
            <br>
    <div align="center"><?php echo $dita['alamat']; ?>, <?php echo $dita['Kota']; ?></div>
            <div align="center">Call Center : 08113310075 / 0321-330075</div>
            <br>
            <?php  
                }
                
                $qf = mysqli_query($con, "select * from reception where no_faktur='$no_faktur'");
                $rf = mysqli_fetch_array($qf);
            ?>
            <div align="center" class="style1 style4"><strong><span class="style3" style="font-family: arial;font-siez:10pt;">BEBAS PARKIR</span></strong></div>
            <div align="center" class="style1 style4"><span style="font-family: arial;font-siez:10pt;">No Faktur : <?php echo $no_faktur; ?></span></div>
     <br>        
</div>
</div>
<?php }
?>
</div>
</div>