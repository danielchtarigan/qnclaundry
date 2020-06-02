<body onLoad="print()">
<?php
session_start();
include '../config.php';
include '../auth.php';
include 'bar128.php';

function rupiah($angka)
{
    $jadi = "Rp.".number_format($angka,0,',','.');
    return $jadi;
}
date_default_timezone_set('Asia/Makassar');
$jam1 = date("Y-m-d h:i:s");     
$jam2 = date('Y-m-d');

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
<div style="max-width:80mm;margin:3mm;">
<div align="center"><img src="../logo.bmp" /></div>   
<div style="font-size: 9pt; font-family: Tahoma" >
  <div align="center"></div>
  
            <?php
            $ot = $_SESSION['nama_outlet'];
            $no_faktur = $_GET['faktur'];
            $qrec = mysqli_query($con,"SELECT * FROM reception WHERE no_faktur='$no_faktur'");
            $rrec = mysqli_fetch_array($qrec);      
            $cust = mysqli_query($con, "select *from faktur_penjualan as a INNER JOIN customer as b ON a.id_customer=b.id where no_faktur='$no_faktur' ");
            $qcus = mysqli_fetch_array($cust);
            $tgl_transaksi = $qcus['tgl_transaksi'];
            $idc = $qcus['id_customer'];
            $nama_customer = $qcus['nama_customer'];            
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
            <div align="center">Call Center : 08114443180 / 0411-444180</div>
            <br>
            <?php  
                }
                
                $qf = mysqli_query($con, "select * from reception where no_faktur='$no_faktur'");
                $rf = mysqli_fetch_array($qf);
            ?>
            <div align="center" class="style1 style4"><strong><span class="style3" style="font-family: arial;font-siez:10pt;">NOTA PEMBAYARAN</span></strong></div>
            <div align="center" class="style1 style4"><span style="font-family: arial;font-siez:10pt;">No Faktur : <?php echo $no_faktur; ?></span></div>
     <br>
         <?php if ($rrec['priority']==1) { ?><div style="text-align:center;font-size:12pt;font-family: Arial Black;border:2px solid black">PRIORITY<br>CUSTOMER</div><br><?php } ?>

     <table style="border-top: 1px dotted #000;width:100%;">
         <tr>
             <td>
                 <span style="float:left;font-size: 9pt;"><?= date('l, d M y H:iA'); ?></span>
             </td>
             <td>
                 <span style="float:right;font-size: 9pt;">Kasir : <?php echo $_SESSION['user_id']; ?></span>
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
                $qf1 = mysqli_query($con, "select * from reception where no_faktur='$no_faktur' and id_customer='$idc' and cara_bayar<>'Void' and cara_bayar<>'Reject' ");
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

<?php 
        $cekf = mysqli_query($con, "select *from faktur_penjualan where no_faktur='$no_faktur' and jenis_transaksi<>'ritel' ");
        $jnis = mysqli_fetch_array($cekf);   

        if(mysqli_num_rows($cekf)>0){
          $alltot = $jnis['total'];
        }
        else{
          $alltot = $total+$totretail;
        }

if($jnis['jenis_transaksi']=="deposit") {

  
  ?>

  <table style="font-size:9pt; width:100%;">
    <tr>
        <td>&nbsp;</td>
        <td width="30">Deposit Langganan</td>
        <td width="156"><?php echo $rretail['nama_barang']; ?></td>
        <td>Rp.</td>
        <td style="text-align:right;"><?php echo number_format($jnis['total'],0,',','.'); ?>
        </td>
    </tr> 
  </table>

  <?php
}

?>

<table style="font-size:9pt;border-top: 1px dotted #000; width:100%;">   
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
  <td>Rp.</td>
  <td style="text-align:right;"><?php  echo str_replace('Rp.','',rupiah($alltot, true)); ?>  </td>
</tr>       
<tr><td colspan="4" align="left">Cara Pembayaran</td></tr>
<?php
$poin = 0;
$qbayar = mysqli_query($con, "select * from cara_bayar where no_faktur='$_GET[faktur]'");

  if(mysqli_num_rows($cekf)>0){
    $cbayar = $jnis['cara_bayar'];
    $jbayar = $jnis['total'];?>
    <tr>
      <td>&nbsp;</td>
      <td><?php echo $cbayar ;?></td>
      <td>Rp.</td>
      <td style="text-align:right;">
      <?php echo str_replace('Rp.','',rupiah($jbayar, true)); ?>               
      </td>
    </tr><?php
  }
  else{
    while($rbayar = mysqli_fetch_array($qbayar)){
    $cbayar = $rbayar['cara_bayar'];
    $jbayar = $rbayar['jumlah'];?>
    <tr>
       <td>&nbsp;</td>
       <td><?php echo $cbayar ;?></td>
       <td>Rp.</td>
       <td style="text-align:right;">
       <?php echo str_replace('Rp.','',rupiah($jbayar, true)); ?>               
       </td>
    </tr><?php
    }
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
    </tr><?php
  }
if ($rsql['lgn']==1){
  $langganan = mysqli_query($con, "Select *from langganan where id_customer='$idc' ");
  $qlgn = mysqli_fetch_array($langganan);
?>

    <tr>
      <th>Sisa Kuota</th>
    </tr>
    <tr>
     <td>Kiloan</td><td> : <?php echo $qlgn['kilo_cks'].' Kg'; ?></td> 
     <td>Valid Thu</td><td> : 
      <?php 
        $queryl2 = mysqli_query($con, "select *from langganan where id_customer='$idc'");
        $ln2 = mysqli_fetch_array($queryl2);       
         $hr=$ln2['tgl_expire'];
         echo date('d/m/Y', strtotime($hr));
      ?></td>    
    </tr>
    <tr>
     <td>Potongan</td><td> : <?php echo rupiah ($qlgn['potongan']); ?></td> 
    </tr><br>    
</table>
<table style="width:100%;border-bottom: 1px dashed #000;font-size: 7pt;font-family: Tahoma; margin-top: 5px">
  <tr>  
      <th align="center"><?php
        if($qlgn['kilo_cks']<3 && $qlgn['kilo_cks']>1) echo "Segera update kuota Anda sebelum habis!"; else if($qlgn['kilo_cks']<=1) echo "Kuota Anda telah habis!"; else if($qlgn['kilo_cks']>4) echo "Anda akan mendapatkan kuota Laundry Potongan pada Paket Single, Family, dan Professional<br>Dapatkan harga khusus untuk item tertentu!";
        ?> 
      </th> 
    </tr>
</table>

<?php
}
if ($diskon>0){
}
else{
  $tot = $total+$totretail;
  if($ot<>'') {
      
  }   
  else {
      if($rsql['lgn']<>'1') {
          $sqbayar = mysqli_query($con, "select * from cara_bayar where no_faktur='$_GET[faktur]' AND cara_bayar='Cashback'");
          $nbayar = mysqli_num_rows($sqbayar);
        
          if($nbayar>0) {
        
          } 
          else {  
        
          //Mengisi voucher cashback pada tabel phpmyadmin untuk customer bersangkutan
          if(date('Y-m-d', strtotime($tgl_transaksi))==date('Y-m-d')) {
            $qvoucher = mysqli_query($con, "SELECT * FROM voucher_rupiah WHERE id_customer<>'0' ORDER BY id DESC LIMIT 1");
            $rvoucher = mysqli_fetch_assoc($qvoucher);
        
            $lastnumberkode = (int) substr($rvoucher['kode'], 9, 13);
            $lastnumberkode++;
            $newnumberkode = sprintf('%05s', $lastnumberkode);
            $kodebulan = substr(date('Ym', strtotime($jam1)), 2);
        
            if (($tot>=25000) and ($tot<50000)) { 
              $kodec = '10'.$kodebulan.$newnumberkode;
              $nilaivoucher = '10000';
            }
            else if(($tot>=50000) and ($tot<100000)) {
              $kodec = '25'.$kodebulan.$newnumberkode;
              $nilaivoucher = '25000';
            }
            else if($tot>=100000) {
              $kodec = '50'.$kodebulan.$newnumberkode;
              $nilaivoucher = '50000';
            }
        
            $newvoucher = 'QCB'.$kodec;
            $date_aktif = date('Y-m-d', strtotime('+1 days', strtotime($jam1)));
            $date_exp = date('Y-m-d', strtotime('+7 days', strtotime($jam1)));
        
            $qcb = mysqli_query($con, "SELECT kode FROM voucher_rupiah WHERE status='Aktif' AND kode LIKE 'QCB%' AND nilai='$nilaivoucher' AND id_customer='$idc' AND tgl_awal='$jam2' ");
            $ncb = mysqli_num_rows($qcb);
        
            if($tot>=25000 && $ncb==0) {
              $inscashback = mysqli_query($con, "INSERT INTO voucher_rupiah (kode,nilai,tgl_awal,tgl_akhir,status,user_aktif,id_customer) VALUES ('$newvoucher','$nilaivoucher','$date_aktif','$date_exp','Aktif','$_SESSION[user_id]','$idc') ");
              // if($inscashback){
              //   echo "OK";
              // }else {
              //   echo "Gagal";
              // }
            } 
        
              
          }
          
              $selamat = "SELAMAT! ANDA MENDAPATKAN";      
              $outlett = "SEMUA OUTLET QNCLAUNDRY";       
             
            if (($tot>=25000) and ($tot<50000)){ 
              $cb25 = mysqli_query($con, "SELECT * FROM voucher_rupiah WHERE status<>'Terpakai' AND kode LIKE 'QCB%' AND tgl_akhir>'$jam1' AND nilai='10000' AND id_customer='$idc' ORDER BY id DESC");
              $datacb25 = mysqli_fetch_assoc($cb25);
              $kode = $datacb25['kode'];
              $voucher = "VOUCHER CASHBACK RP. 10.000"; ?>
                <table style="width:100%;border-bottom: 1px dashed #000;font-size: 7pt;font-family: Tahoma; margin-top: 5px; page-break-before: always;">
                <tr>  
                     <th align="center"><?php
                      echo $selamat.'<br>'.$voucher.'<p style="font-size:9px; color:green;">Berlaku '.$datacb25['tgl_awal'].' hingga '.$datacb25['tgl_akhir'].bar128($kode).'</p> Voucher hanya bisa digunakan oleh customer yang sama untuk transaksi berikutnya di semua outlet QNCLAUNDRY<br><br>'.'TANPA MINIMAL TRANSAKSI<br>';
                      ?> 
                    </th>  
                  </tr>
              </table>
              <?php 
            } 
            else if(($tot>=50000) and ($tot<100000)){   
              $cb25 = mysqli_query($con, "SELECT * FROM voucher_rupiah WHERE status<>'Terpakai' AND kode LIKE 'QCB%' AND tgl_akhir>'$jam1' AND nilai='25000' AND id_customer='$idc' ORDER BY id DESC");
              $datacb25 = mysqli_fetch_assoc($cb25);
              $kode = $datacb25['kode'];
              $voucher = "VOUCHER CASHBACK RP. 25.000"; ?>
                <table style="width:100%;border-bottom: 1px dashed #000;font-size: 7pt;font-family: Tahoma; margin-top: 5px; page-break-before: always;">
                <tr>  
                    <th align="center"><?php
                      echo $selamat.'<br>'.$voucher.'<p style="font-size:9px; color:green;">Berlaku '.$datacb25['tgl_awal'].' hingga '.$datacb25['tgl_akhir'].bar128($kode).'</p> Voucher hanya bisa digunakan oleh customer yang sama untuk transaksi berikutnya di semua outlet QNCLAUNDRY<br><br>'.'TANPA MINIMAL TRANSAKSI<br>';
                      ?> 
                    </th> 
                  </tr>
              </table>
              <?php 
            }
            else if($tot>=100000){   
              $cb25 = mysqli_query($con, "SELECT * FROM voucher_rupiah WHERE status<>'Terpakai' AND kode LIKE 'QCB%' AND tgl_akhir>'$jam1' AND nilai='50000' AND id_customer='$idc' ORDER BY id DESC");
              $datacb25 = mysqli_fetch_assoc($cb25);
              $kode = $datacb25['kode'];
              $voucher = "VOUCHER CASHBACK RP. 50.000"; ?>
                <table style="width:100%;border-bottom: 1px dashed #000;font-size: 7pt;font-family: Tahoma; margin-top: 5px; page-break-before: always;">
                <tr>  
                     <th align="center"><?php
                      echo $selamat.'<br>'.$voucher.'<p style="font-size:9px; color:green;">Berlaku '.$datacb25['tgl_awal'].' hingga '.$datacb25['tgl_akhir'].bar128($kode).'</p> Voucher hanya bisa digunakan oleh customer yang sama untuk transaksi berikutnya di semua outlet QNCLAUNDRY<br><br>'.'TANPA MINIMAL TRANSAKSI<br>';
                      ?> 
                    </th> 
                  </tr>
              </table>
              <?php 
            }
          }
      }
  }
      
  
}



$tot = $total+$totretail;
$ku=$tot / 20000;
$kun=floor($ku);
$kund=$kun*($jm+$cb);//jm jenis member, cb cara bayar, kund kupon undian
if ($tot>=20000){
?>

<?php 
}
?>
    <br>
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
            <div align="center">Call Center : 08114443180 / 0411-444180</div>
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