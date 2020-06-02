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
date_default_timezone_set('Asia/Makassar');
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
<?php include"bar128.php" ?>
<div align="center"><img src="../logo.bmp" /></div>   
<div style="font-size: 9pt; font-family: Tahoma" >
  <div align="center"></div>
  
  			<?php
			$ot = $_SESSION['nama_outlet'];
			$no_nota = $_GET['no_nota'];
			$qrec = mysqli_query($con,"SELECT * FROM reception WHERE no_nota='$no_nota'");
			$rrec = mysqli_fetch_array($qrec);
			$nama_customer = $rrec['nama_customer'];
			$idc = $rrec['id_customer'];
			$charge = $rrec['express'];
			$new_nota = $rrec['new_nota'];
			
//menghapus data dari tabel tmp			
			$qtmp = mysqli_query($con, "delete from order_potongan_tmp where id_customer='$idc'");
			$qtmp = mysqli_query($con, "delete from order_tmp where id_customer='$idc'");	 


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
            ?>
            <div align="center" class="style1 style4"><strong><span class="style3" style="font-family: arial;font-siez:10pt;">NOTA ORDER</span></strong></div>
	<div align="center"><?php echo bar128(stripslashes($new_nota)); ?><br><?php echo $no_nota; ?></div>
     <br>
     <table style="border-top: 1px dotted #000;width:100%;">
         <tr>
             <td>
                 <span style="float:left;font-size: 9pt;"><?= date('l, d M y H:iA'); ?></span>
             </td>
             <td>
                 <span style="float:right;font-size: 9pt;">Kasir : <?php $_SESSION['user_id']; ?></span>
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
<table style="font-size:9pt;border-top: 1px dotted #000;width:100%;">
<?php
$totaltambahan = 0;
			$sql2=mysqli_query($con,"SELECT * FROM detail_penjualan a, item_spk b WHERE a.no_nota='$no_nota' and a.item=b.nama_item and b.ket='0'");			
			while ($data2 = mysqli_fetch_array($sql2)){
                            ?>
							<tr>
                                <td><?php echo $data2['jumlah'];?></td>
                                <td colspan="2"><?php echo ucwords($data2['item']);?></td>
                                <td>Rp.</td>
                                <td style="text-align:right;"><?php echo number_format($data2['total'],0,',','.');?>
                                </td>
                            </tr>	
                            <?php
                            if ($data2['keterangan']<>''){
								?>
							<tr>
                                <td></td>
                                <td colspan="4">( <?php echo $data2['keterangan'];?> )</td>
                            </tr>
                            <?php			
								}
                            ?>		
			<?php
			}
			$sql2=mysqli_query($con,"SELECT * FROM detail_penjualan a, item_spk b WHERE a.no_nota='$no_nota' and a.item=b.nama_item and b.ket='1'");			
			while ($data2 = mysqli_fetch_array($sql2)){
                            ?>
							<tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><?php echo ucwords($data2['item']);?></td>
                                <td>Rp.</td>
                                <td style="text-align:right;"><?php echo number_format($data2['total'],0,',','.');?>
                                </td>
                            </tr>			
<?php
			}
			$sql2=mysqli_query($con,"SELECT * FROM cris_icon_details WHERE id_reception='$no_nota'");			
			$data2 = mysqli_fetch_array($sql2);
			if ($data2['parfum']=='extra'){
                            ?>
							<tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>Ekstra Parfum</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                </td>
                            </tr>			
			<?php		}	
			if ($data2['parfum']=='no'){
                            ?>
							<tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>Tanpa Parfum</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                </td>
                            </tr>			
			<?php		}
			if ($data2['parfum']=='0'){
                            ?>
							<tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>Parfum Normal</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                </td>
                            </tr>			
			<?php		}	
			if ($data2['deliver']=='on'){
                            ?>
							<tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>Delivery Service</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                </td>
                            </tr>			
			<?php		}	
			if ($data2['hanger_own']=='on'){
                            ?>
							<tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>Hanger Own</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                </td>
                            </tr>			
			<?php		}	
			if ($data2['hanger']>0){
                            ?>
							<tr>
                                <td>&nbsp;</td>
                                <td><?php echo $data2['hanger']; ?></td>
                                <td>Hanger</td>
                                <td>Rp.</td>
                                <td style="text-align:right;"><?php echo number_format($data2['hanger']*2500,0,',','.');
								$totaltambahan = $totaltambahan+($data2['hanger']*2500);
								?>
                                </td>
                                </td>
                            </tr>			
			<?php		}	
			if ($data2['hanger_plastic']>0){
                            ?>
							<tr>
                                <td>&nbsp;</td>
                                <td><?php echo $data2['hanger_plastic']; ?></td>
                                <td>Hanger Plastik</td>
                                <td>Rp.</td>
                                <td style="text-align:right;"><?php echo number_format($data2['hanger_plastic']*2000,0,',','.');
								$totaltambahan = $totaltambahan+($data2['hanger_plastic']*2000);
								?>
                                </td>
                                </td>
                            </tr>			
			<?php		}	?>
</table>

<?php
			$diskon = 0;
			$sdiskon=mysqli_query($con,"SELECT sum(total) as totaldisk FROM detail_penjualan WHERE no_nota='$no_nota' and item like '%Voucher%'");			
			$rdiskon = mysqli_fetch_array($sdiskon);
			$diskon = $rdiskon['totaldisk'];


			$totalnoexpress = 0;
			$sql2=mysqli_query($con,"SELECT sum(total) as totalnoexpress FROM detail_penjualan a, item_spk b WHERE a.no_nota='$no_nota' and a.item=b.nama_item and b.ket='0' and item not like '%Voucher%'");			
			$data2 = mysqli_fetch_array($sql2);
			$totalnoexpress = $data2['totalnoexpress'];
			
			$totalexpress = 0;
			$sql2=mysqli_query($con,"SELECT sum(total) as totalexpress FROM detail_penjualan a, item_spk b WHERE a.no_nota='$no_nota' and a.item=b.nama_item and b.ket='1'");			
			$data2 = mysqli_fetch_array($sql2);
			$totalexpress = $data2['totalexpress'];
			
			$totaltanpadiskon = $totalnoexpress+$totalexpress+$totaltambahan;
			$total = $totalnoexpress+$totalexpress-$diskon+$totaltambahan;
?>
<table style="font-size:9pt;border-top: 1px dotted #000;width:100%;">                          
                        <tr>
	                            <td></td>
                                <td style="width:50px;"></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td width="123px;">Diskon</td>
				<td>Rp.</td><td style="text-align:right;">
				<?php
echo str_replace('Rp.','',rupiah($diskon, true));
				?>				</td>
			</tr>		
			
					<tr>
                                <td>&nbsp;</td>
                                <td style="width:50px;"></td>            
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
				<td>Total</td>
                                <td>Rp.</td><td style="text-align:right;">
				<?php
				
echo str_replace('Rp.','',rupiah($total, true));
				?>				</td>
			</tr>
</table>    
</div>
<div style="width:100%;border-top: 1px dotted #000;font-size: 9pt;font-family: Tahoma;padding: 5px 0px;border-bottom: 1px dashed #000;margin-bottom:1px;">
    <?php
        $sql4=$con->query("SELECT tgl_selesai FROM tgl_selesai");
        $t = $sql4->fetch_assoc();
        $tg=$t['tgl_selesai'];
        $todayDate = date("Y-m-d H:i:s");// current date
        $now = strtotime(date("Y-m-d H:i:s"));
        //Add one day to today
        $date = date('d M y', strtotime('+'.$tg.' day', $now));
        if($charge=="3"){
			$left_code = "SUPER EXPRESS";
            echo "Tanggal Selesai : ".date('d M y h:i:s',strtotime('+3 hours'))."<br>";
		}
        else if($charge=="2"){
			$left_code = "DOUBLE EXPRESS";
            echo "Tanggal Selesai : ".date('d M y h:i:s',strtotime('+6 hours'))."<br>";
        }else if($charge=="1"){
			$left_code = "EXPRESS";
            echo "Tanggal Selesai : ".date('d M y',strtotime('+24 hours'))."<br>";
        }else{
			$left_code = "";
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
<?php
$qfoot = mysqli_query($con, "select * from footer");
$rfoot = mysqli_fetch_array($qfoot);
?>
    <b style="font-weight: bold;font-family: arial;"><?php echo $rfoot['head1']; ?></b><br />
    <font style="font-family:Tahoma, Geneva, sans-serif; font-size:9px;"> <?php echo $rfoot['head2']; ?></font>
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
            <div align="center">Call Center : 08114443180 / 0411-444180</div>
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
<table style="font-size:9pt;border-top: 1px dotted #000;width:100%;">
<?php
			$sql2=mysqli_query($con,"SELECT * FROM detail_penjualan a, item_spk b WHERE a.no_nota='$no_nota' and a.item=b.nama_item and b.ket='0'");			
			while ($data2 = mysqli_fetch_array($sql2)){
                            ?>
							<tr>
                                <td><?php echo $data2['jumlah'];?></td>
                                <td colspan="2"><?php echo ucwords($data2['item']);?></td>
                                <td>Rp.</td>
                                <td style="text-align:right;"><?php echo number_format($data2['total'],0,',','.');?>
                                </td>
                            </tr>			
                            <?php
                            if ($data2['keterangan']<>''){
								?>
							<tr>
                                <td></td>
                                <td colspan="4">( <?php echo $data2['keterangan'];?> )</td>
                            </tr>
                            <?php			
								}
                            ?>		
			<?php
			}
			$sql2=mysqli_query($con,"SELECT * FROM detail_penjualan a, item_spk b WHERE a.no_nota='$no_nota' and a.item=b.nama_item and b.ket='1'");			
			while ($data2 = mysqli_fetch_array($sql2)){
                            ?>
							<tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><?php echo ucwords($data2['item']);?></td>
                                <td>Rp.</td>
                                <td style="text-align:right;"><?php echo number_format($data2['total'],0,',','.');?>
                                </td>
                            </tr>			
<?php
			}
			$sql2=mysqli_query($con,"SELECT * FROM cris_icon_details WHERE id_reception='$no_nota'");			
			$data2 = mysqli_fetch_array($sql2);
			if ($data2['parfum']=='extra'){
                            ?>
							<tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>Ekstra Parfum</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                </td>
                            </tr>			
			<?php		}	
			if ($data2['parfum']=='no'){
                            ?>
							<tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>Tanpa Parfum</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                </td>
                            </tr>			
			<?php		}
			if ($data2['parfum']=='0'){
                            ?>
							<tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>Parfum Normal</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                </td>
                            </tr>			
			<?php		}	
			if ($data2['deliver']=='on'){
                            ?>
							<tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>Delivery Service</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                </td>
                            </tr>			
			<?php		}	
			if ($data2['hanger_own']=='on'){
                            ?>
							<tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>Hanger Own</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                </td>
                            </tr>			
			<?php		}	
			if ($data2['hanger']>0){
                            ?>
							<tr>
                                <td>&nbsp;</td>
                                <td><?php echo $data2['hanger']; ?></td>
                                <td>Hanger</td>
                                <td>Rp.</td>
                                <td style="text-align:right;"><?php echo number_format($data2['hanger']*2500,0,',','.');?>
                                </td>
                                </td>
                            </tr>			
			<?php		}	
			if ($data2['hanger_plastic']>0){
                            ?>
							<tr>
                                <td>&nbsp;</td>
                                <td><?php echo $data2['hanger_plastic']; ?></td>
                                <td>Hanger Plastik</td>
                                <td>Rp.</td>
                                <td style="text-align:right;"><?php echo number_format($data2['hanger_plastic']*2000,0,',','.');?>
                                </td>
                                </td>
                            </tr>			
			<?php		}	?>
</table>

<table style="font-size:9pt;border-top: 1px dotted #000;width:100%;">                          
                        <tr>
	                            <td></td>
                                <td style="width:50px;"></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td width="123px;">Diskon</td>
				<td>Rp.</td><td style="text-align:right;">
				<?php
echo str_replace('Rp.','',rupiah($diskon, true));
				?>				</td>
			</tr>		
			
					<tr>
                                <td>&nbsp;</td>
                                <td style="width:50px;"></td>            
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
				<td>Total</td>
                                <td>Rp.</td><td style="text-align:right;">
				<?php
				
echo str_replace('Rp.','',rupiah($total, true));
				?>				</td>
			</tr>
</table>    
  
 <div>
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
        $date = date('d M y', strtotime('+'.$tg.' day', $now));
        if($charge=="3"){
			$left_code = "SUPER EXPRESS";
            echo "Tanggal Selesai : ".date('d M y h:i:s',strtotime('+3 hours'))."<br>";
		}else if($charge=="2"){
			$left_code = "DOUBLE EXPRESS";
            echo "Tanggal Selesai : ".date('d M y h:i:s',strtotime('+6 hours'))."<br>";
        }else if($charge=="1"){
			$left_code = "EXPRESS";
            echo "Tanggal Selesai : ".date('d M y',strtotime('+24 hours'))."<br>";
        }else{
			$left_code = "";
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
    <b style="font-weight: bold;font-family: arial;">Diskon 15% jika cucian Anda TELAT!!</b><br>
    khusus transaksi berikutnya, mintalah voucher di Resepsionis S&K berlaku
    <br><br><br>
    Saya setuju dan telah  mengerti seluruh syarat dan ketentuan di Quick &` Clean Laundry
    <br><br><br><br><br><br><br><br>
    <hr>
    (<?php echo ucwords($nama_customer) ?>)
</div>    
    

</div>
<br><br><br>

<?php
$qres = mysqli_query($con,"SELECT * FROM reception WHERE no_nota='$no_nota'");
$rres = mysqli_fetch_array($qres);




// if($rres["jenis"]=="k"){ ?>
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
                                      <?php echo $left_code; ?>
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
                                  <?= strtoupper(date('l, d M y')) ?>
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
<table style="font-size:9pt;border-top: 1px dotted #000;width:100%;">
<?php
			$sql2=mysqli_query($con,"SELECT * FROM detail_penjualan a, item_spk b WHERE a.no_nota='$no_nota' and a.item=b.nama_item and b.ket='0'");			
			while ($data2 = mysqli_fetch_array($sql2)){
                            ?>
							<tr>
                                <td><?php echo $data2['jumlah'];?></td>
                                <td colspan="2"><?php echo ucwords($data2['item']);?></td>
                                <td>Rp.</td>
                                <td style="text-align:right;"><?php echo number_format($data2['total'],0,',','.');?>
                                </td>
                            </tr>			
                            <?php
                            if ($data2['keterangan']<>''){
								?>
							<tr>
                                <td></td>
                                <td colspan="4">( <?php echo $data2['keterangan'];?> )</td>
                            </tr>
                            <?php			
								}
                            ?>		
			<?php
			}
			$sql2=mysqli_query($con,"SELECT * FROM detail_penjualan a, item_spk b WHERE a.no_nota='$no_nota' and a.item=b.nama_item and b.ket='1'");			
			while ($data2 = mysqli_fetch_array($sql2)){
                            ?>
							<tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><?php echo ucwords($data2['item']);?></td>
                                <td>Rp.</td>
                                <td style="text-align:right;"><?php echo number_format($data2['total'],0,',','.');?>
                                </td>
                            </tr>			
<?php
			}
			$sql2=mysqli_query($con,"SELECT * FROM cris_icon_details WHERE id_reception='$no_nota'");			
			$data2 = mysqli_fetch_array($sql2);
			if ($data2['parfum']=='extra'){
                            ?>
							<tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>Ekstra Parfum</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                </td>
                            </tr>			
			<?php		}	
			if ($data2['parfum']=='no'){
                            ?>
							<tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>Tanpa Parfum</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                </td>
                            </tr>			
			<?php		}
			if ($data2['parfum']=='0'){
                            ?>
							<tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>Parfum Normal</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                </td>
                            </tr>			
			<?php		}	
			if ($data2['deliver']=='on'){
                            ?>
							<tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>Delivery Service</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                </td>
                            </tr>			
			<?php		}	
			if ($data2['hanger_own']=='on'){
                            ?>
							<tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>Hanger Own</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                </td>
                            </tr>			
			<?php		}	
			if ($data2['hanger']>0){
                            ?>
							<tr>
                                <td>&nbsp;</td>
                                <td><?php echo $data2['hanger']; ?></td>
                                <td>Hanger</td>
                                <td>Rp.</td>
                                <td style="text-align:right;"><?php echo number_format($data2['hanger']*2500,0,',','.');?>
                                </td>
                                </td>
                            </tr>			
			<?php		}	
			if ($data2['hanger_plastic']>0){
                            ?>
							<tr>
                                <td>&nbsp;</td>
                                <td><?php echo $data2['hanger_plastic']; ?></td>
                                <td>Hanger Plastik</td>
                                <td>Rp.</td>
                                <td style="text-align:right;"><?php echo number_format($data2['hanger_plastic']*2000,0,',','.');?>
                                </td>
                                </td>
                            </tr>			
			<?php		}	?>
</table>
<table style="font-size:9pt;border-top: 1px dotted #000;width:100%;">                                   
                        <tr>
	                            <td></td>
                                <td style="width:50px;"></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td width="123px;">Diskon</td>
				<td>Rp.</td><td style="text-align:right;">
				<?php
echo str_replace('Rp.','',rupiah($diskon, true));
				?>				</td>
			</tr>		
			
					<tr>
                                <td>&nbsp;</td>
                                <td style="width:50px;"></td>            
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
				<td>Total</td>
                                <td>Rp.</td><td style="text-align:right;">
				<?php
				
echo str_replace('Rp.','',rupiah($total, true));
				?>				</td>
			</tr>
</table>   
</div>
  
 <div>
</div>
</div>
<div style="border-bottom: 1px dashed #000;margin-bottom:1px;width:100%"></div>
<div style="width:100%;border-top: 1px dotted #000;font-size: 9pt;font-family: Tahoma;padding: 5px 0px;border-top: 1px dashed #000;margin-bottom:1px;">
    <div align="center" style="margin-top:5px;"><?php echo bar128(stripslashes($no_nota))?></div>
    <br><br>
    <div style="width:100%;">
        <center>
        <?php if($data2["deliver"]=="on"){ ?>
            <img src="img/delivery.png">
        <?php } ?>
        <?php if($data2["hanger"]>0){ ?>    
        <img src="img/hanger.png">
        <?php } ?>
        <?php if($data2["parfum"]=="extra"){ ?>            
        <img src="img/extra.png">
        <?php } ?>
        <?php if($data2["parfum"]=="no"){ ?>                            
        <img src="img/no.png">
        <?php } ?>
        <?php if($data2["hanger_own"]=="on"){ ?>            
        <img src="img/own.png">
        <?php } ?>
        <?php if($data2["hanger_plastic"]>0){ ?>            
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
                                      <?php echo $left_code; ?>
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
                                  <?= strtoupper(date('l, d M y')) ?>
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
<table style="font-size:9pt;border-top: 1px dotted #000;width:100%;">
<?php
			$sql2=mysqli_query($con,"SELECT * FROM detail_penjualan a, item_spk b WHERE a.no_nota='$no_nota' and a.item=b.nama_item and b.ket='0'");			
			while ($data2 = mysqli_fetch_array($sql2)){
                            ?>
							<tr>
                                <td><?php echo $data2['jumlah'];?></td>
                                <td colspan="2"><?php echo ucwords($data2['item']);?></td>
                                <td>Rp.</td>
                                <td style="text-align:right;"><?php echo number_format($data2['total'],0,',','.');?>
                                </td>
                            </tr>			
                            <?php
                            if ($data2['keterangan']<>''){
								?>
							<tr>
                                <td></td>
                                <td colspan="4">( <?php echo $data2['keterangan'];?> )</td>
                            </tr>
                            <?php			
								}
                            ?>		
			<?php
			}
			$sql2=mysqli_query($con,"SELECT * FROM detail_penjualan a, item_spk b WHERE a.no_nota='$no_nota' and a.item=b.nama_item and b.ket='1'");			
			while ($data2 = mysqli_fetch_array($sql2)){
                            ?>
							<tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><?php echo ucwords($data2['item']);?></td>
                                <td>Rp.</td>
                                <td style="text-align:right;"><?php echo number_format($data2['total'],0,',','.');?>
                                </td>
                            </tr>			
<?php
			}
			$sql2=mysqli_query($con,"SELECT * FROM cris_icon_details WHERE id_reception='$no_nota'");			
			$data2 = mysqli_fetch_array($sql2);
			if ($data2['parfum']=='extra'){
                            ?>
							<tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>Ekstra Parfum</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                </td>
                            </tr>			
			<?php		}	
			if ($data2['parfum']=='no'){
                            ?>
							<tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>Tanpa Parfum</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                </td>
                            </tr>			
			<?php		}
			if ($data2['parfum']=='0'){
                            ?>
							<tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>Parfum Normal</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                </td>
                            </tr>			
			<?php		}	
			if ($data2['deliver']=='on'){
                            ?>
							<tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>Delivery Service</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                </td>
                            </tr>			
			<?php		}	
			if ($data2['hanger_own']=='on'){
                            ?>
							<tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>Hanger Own</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                </td>
                            </tr>			
			<?php		}	
			if ($data2['hanger']>0){
                            ?>
							<tr>
                                <td>&nbsp;</td>
                                <td><?php echo $data2['hanger']; ?></td>
                                <td>Hanger</td>
                                <td>Rp.</td>
                                <td style="text-align:right;"><?php echo number_format($data2['hanger']*2500,0,',','.');?>
                                </td>
                                </td>
                            </tr>			
			<?php		}	
			if ($data2['hanger_plastic']>0){
                            ?>
							<tr>
                                <td>&nbsp;</td>
                                <td><?php echo $data2['hanger_plastic']; ?></td>
                                <td>Hanger Plastik</td>
                                <td>Rp.</td>
                                <td style="text-align:right;"><?php echo number_format($data2['hanger_plastic']*2000,0,',','.');?>
                                </td>
                                </td>
                            </tr>			
			<?php		}	?>
</table>
<table style="font-size:9pt;border-top: 1px dotted #000;width:100%;">                                   
                        <tr>
	                            <td></td>
                                <td style="width:50px;"></td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td width="123px;">Diskon</td>
				<td>Rp.</td><td style="text-align:right;">
				<?php
echo str_replace('Rp.','',rupiah($diskon, true));
				?>				</td>
			</tr>		
			
					<tr>
                                <td>&nbsp;</td>
                                <td style="width:50px;"></td>            
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
				<td>Total</td>
                                <td>Rp.</td><td style="text-align:right;">
				<?php
				
echo str_replace('Rp.','',rupiah($total, true));
				?>				</td>
			</tr>
</table>   
</div>
  
 <div>
</div>
</div>
<div style="border-bottom: 1px dashed #000;margin-bottom:1px;width:100%"></div>
<div style="width:100%;border-top: 1px dotted #000;font-size: 9pt;font-family: Tahoma;padding: 5px 0px;border-top: 1px dashed #000;margin-bottom:1px;">
    <div align="center" style="margin-top:5px;"><?php echo bar128(stripslashes($no_nota))?></div>
    <br><br>
    <div style="width:100%;">
        <center>
        <?php if($data2["deliver"]=="on"){ ?>
            <img src="img/delivery.png">
        <?php } ?>
        <?php if($data2["hanger"]>0){ ?>    
        <img src="img/hanger.png">
        <?php } ?>
        <?php if($data2["parfum"]=="extra"){ ?>            
        <img src="img/extra.png">
        <?php } ?>
        <?php if($data2["parfum"]=="no"){ ?>                            
        <img src="img/no.png">
        <?php } ?>
        <?php if($data2["hanger_own"]=="on"){ ?>            
        <img src="img/own.png">
        <?php } ?>
        <?php if($data2["hanger_plastic"]>0){ ?>            
        <img src="img/plastic.png">
        <?php } ?>        
        </center>
    </div>
</div>
    

</div>
    <?php // } ?>
</div>        
</div>
</body>