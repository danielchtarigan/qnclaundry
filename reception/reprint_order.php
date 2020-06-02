<?php
error_reporting(0);
include '../config.php';
date_default_timezone_set('Asia/Makassar');
///rupiah adalah fungsi yang nantinya akan kita panggil
     function rupiah($angka){
           $jadi="Rp.".number_format($angka,0,',','.');
            return $jadi;
     }
     session_start();

$no_nota=$_GET['no_nota'];

$sql=$con->query("SELECT r.*,cid.hanger_own,cid.deliver,cid.parfum,cid.charge,cid.hanger,cid.hanger_plastic FROM reception r left join cris_icon_details cid on r.id = cid.id_reception  WHERE r.no_nota='$no_nota' order by cid.id desc");
$r = $sql->fetch_assoc();
$id_cs=$r['id_customer'];
$nama_customer=$r['nama_customer'];
$jam=$r['tgl_input'];
$us=$r['nama_reception'];
$disk=$r['diskon']
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
<div style="max-width:80mm;margin:5mm;">
    <?php include"bar128.php" ?>


    
<div align="center"><h3 style="margin:0px;">Quick &` Clean Laundry</h3></div>   
<div style="font-size: 9pt; font-family: Tahoma" >
  <div align="center"></div>
  
            <div align="center">Outlet : <b>Toddopuli</b></div>
            <br>
	<div align="center">Jl Toddopuli Raya No 08, Makassar</div>
            <div align="center">Call Center : 0411-444180</div>
            <br>
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
                   // if($_GET["jenis"]=="k"){
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
//                    }
                    ?>    
                        <tr>
                                <td style="border-top: 1px dotted #000;"></td>
                                <td style="width:50px;border-top: 1px dotted #000;"></td>
                                <td style="border-top: 1px dotted #000;">Diskon</td>
				<td style="border-top: 1px dotted #000;">Rp.</td><td style="border-top: 1px dotted #000;text-align:right;">
				<?php
echo str_replace('Rp.','',rupiah($disk, true));
				?>				</td>
			</tr>		
			
					<tr>
                                <td></td>            
                                <td style="width:50px;"></td>            
				<td>Total</td>
                                <td>Rp.</td><td style="text-align:right;">
				<?php
				$sql3=mysqli_query($con,"SELECT sum(total_bayar) as total FROM reception WHERE no_nota= '$no_nota' and id_customer='$id_cs'");
				$s1=mysqli_fetch_array($sql3);
				$hr=$s1['total'];
echo str_replace('Rp.','',rupiah($hr, true));
				?>				</td>
			</tr>
	</tbody>
</table>                
            
            
<!--
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
echo rupiah($disk, true);
				?>
				</td>
			</tr>		
			
					<tr>
				<td colspan="2">Total:</td><td></td>
				<td colspan="3">
				<?php
				$sql3=mysqli_query($con,"SELECT sum(total_bayar) as total FROM reception WHERE no_nota= '$no_nota' and id_customer='$id_cs'");
				$s1=mysqli_fetch_array($sql3);
				$hr=$s1['total'];
echo rupiah($hr, true);
				?>
				</td>
			</tr>
		
	</tbody>
</table>
     
            
-->            
</div>

<!--   <div id="mainmain">
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
	
	</tr>-->
<div style="width:100%;border-top: 1px dotted #000;font-size: 9pt;font-family: Tahoma;padding: 5px 0px;border-bottom: 1px dashed #000;margin-bottom:1px;">
    <?php

        $date = date('d M y', strtotime($jam));
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

<!--<div style="page-break-before:always;">
<div style="font-size: 12px; font-family: Arial" >
<div align="center" class="style1 style4">Reprint Nota Order</div>
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
				<td colspan="3">Diskon:</td>
				<td colspan="4">
				<?php
echo rupiah($disk, true);
				?>
				</td>
			</tr>		
			
				<tr>
				<td colspan="2">Total:</td>
				<td colspan="3">
				<?php
				$sql3=mysqli_query($con,"SELECT sum(total_bayar) as total FROM reception WHERE no_nota= '$no_nota' and id_customer='$id_cs'");
				$s1=mysqli_fetch_array($sql3);
				$hr=$s1['total'];
echo rupiah($hr, true);
				?>
				</td>
			</tr>
		
	</tbody>
</table>
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


</div>-->
</div>
</div>