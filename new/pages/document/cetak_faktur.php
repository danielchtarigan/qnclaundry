<?php 
include '../../config.php';
include '../zonawaktu.php';
include"../../../reception/bar128.php";

$cabang = $_SESSION['cabang'];
$outlet = $_SESSION['outlet'];
$kasir = $_SESSION['user_id'];

$faktur = $_GET['faktur'];

$dFaktur = mysqli_query($con, "SELECT * FROM faktur_penjualan AS a, customer AS b WHERE a.id_customer=b.id AND a.no_faktur='$faktur'");
$result = mysqli_fetch_assoc($dFaktur);

$customer = $result['nama_customer'];
$idcst = $result['id_customer'];

$query=mysqli_query($con,"SELECT * FROM outlet WHERE kota='$cabang' AND nama_outlet='$outlet'");
$row = mysqli_fetch_array($query);

if($result['jenis_transaksi']=="ritel") {
	$payIn = "Retail";
} else if($result['jenis_transaksi']=="deposit") {
	$payIn = "Deposit Langganan";
	if($result['total']=="265000") {
		$kuota = "All Kiloan 30 Kg";
	} else if($result['total']=="715000") {
		$kuota = "Double/Family";
	} else if($result['total']=="275000") {
		$kuota = "Single";
	} else {
		$kuota = "Custom";
	}
} else if($result['jenis_transaksi']=="membership") {
	$payIn = "Adm Membership";
	$level = $result['jenis_member'];
} else if($result['jenis_transaksi']=="mlocker") {
	$payIn = "Paket Locker";
} 


?>


<body onload="window.print()">
	<div class="content" id="content">
		<div style="max-width:80mm;margin:2mm;">
			<div align="center"><img width="80%" src="../../logo 2017.bmp" /></div>   
			<div style="font-size: 9pt; font-family: Tahoma">
				<div align="center" style="margin-top: 5px">Outlet : <b><?php echo ucwords($row['nama_outlet']); ?></b></div>
			     <div align="center" style="margin-top: 1px"><?php echo $row['alamat']; ?>, <?php echo $row['Kota']; ?></div>
			     <div align="center" style="margin-top: 1px; margin-bottom: 10px">Call Center : <?php echo $row['no_telp'] ?></div>
			 
			     <div align="center" class="style1 style4"><strong><span class="style3" style="font-family: arial;font-size:10pt;">NOTA PEMBAYARAN</span></strong></div>
			     <div align="center" style="margin-top: 5px"><strong><?php echo $faktur ?></strong></div>
		         <br>
			     <table style="border-top: 1px dotted #000;width:100%;">
		           <tr>
		               <td>
		                   <span style="float:left;font-size: 9pt;"><?= date('D, d M y H:i A'); ?></span>
		               </td>
		               <td>
		                   <span style="float:right;font-size: 9pt;">Kasir : <?php echo $kasir; ?></span>
		               </td>
		           </tr>
		           <tr>
		           	<td style="float:left;font-size: 9pt;">Ket :</td>
		           	<td style="float:left;font-size: 9pt;">&nbsp; <?php echo $payIn ?></td>
		           </tr>
		       	 </table>
			     <table style="font-size:9pt;border-top: 1px dotted #000;width:100%;">
			     	<tr>
			     		<?php 
			                echo '<td>Nama</td> <td>:</td> <td>'.$customer.'</td></tr>';
			                echo '<tr><td>No Telp</td> <td>:</td> <td>'.$result['no_telp'].'</td>';
			            ?>
			     	</tr>
			     </table>

			     <?php 
			     if($payIn=="Retail") {
			     	?>
			     	<table style="font-size:9pt;border-top: 1px dotted #000;width:100%;">
						<?php
		                $totaltambahan = 0;		               
	                	$sql=mysqli_query($con,"SELECT * FROM reception WHERE no_faktur='$faktur'"); 
	                	while ($data = mysqli_fetch_array($sql)){
		                    ?>
	                    <tr>
	                    	<td>&nbsp;</td>
	                        <td><?php echo ucwords($data['no_nota']);?></td>
	                        <td width="5%">Rp.</td>
	                        <td style="text-align:right; width: 20%">
	                        	<?php echo number_format($data['total_bayar'],0,',','.'); 
	                        	$totaltambahan = $totaltambahan+$data['total_bayar']; ?>
	                        </td>
	                    </tr>
	                    <?php    
		                }   
			            ?> 	                    
					</table>

					<table style="font-size:9pt;border-top: 1px dotted #000; border-bottom: 1px dashed #000; width:100%;">	
							<?php 
							$sql = mysqli_query($con, "SELECT SUM(total_bayar) AS total FROM reception WHERE no_faktur='$faktur'");
							$data = mysqli_fetch_row($sql);
							?>				
		                    <tr>
		                        <td style="text-align: right">Total</td>
		                        <td width="42%">&nbsp;</td>
		                        <td width="5%">Rp.</td>
		                        <td style="text-align:right; width: 20%">
		                        	<?php echo number_format($data[0],0,',','.'); ?>
		                        </td>
		                    </tr>   
		                    <tr>
		                        <td style="text-align: right">&nbsp;</td>	                        
		                    </tr>   
		                    <tr><td colspan="4" align="left"><em>Cara Pembayaran</em></td></tr> 
		                    <?php 
							$sql = mysqli_query($con, "SELECT * FROM cara_bayar WHERE no_faktur='$faktur'");
							while($data = mysqli_fetch_assoc($sql)){
							?>							
		                    <tr>
		                        <td style="text-align: right"><?= $data['cara_bayar'] ?></td>
		                        <td width="42%">&nbsp;</td>
		                        <td width="5%">Rp.</td>
		                        <td style="text-align:right; width: 20%">
		                        	<?php echo number_format($data['jumlah'],0,',','.'); ?>
		                        </td>
		                    </tr>  
		                    <?php 
		                	}
		                    ?>  
					</table>
			     	<?php

			     	if($result['lgn']==1){ ?>
			     		<table style="width:100%;border-top: 1px dashed #000;font-size: 9pt;font-family: Tahoma;padding: 5px 0px;border-bottom: 1px dashed #000;margin-bottom:1px; font-style: italic">
							<?php 
							$sql = mysqli_query($con, "SELECT * FROM langganan WHERE id_customer='$idcst'");
							$data = mysqli_fetch_array($sql);

							?>
					 		<tr><td colspan="4" align="left">Info Kuota Sekarang</td></tr>
					 		<tr>
					 			<td>&nbsp;</td>
					 			<td style="text-align: left">Kiloan</td>
					 			<td width="1%">:</td>
					 			<td width="64%" style="text-decoration: underline"><?php echo number_format($data['kilo_cks'],2,',','.').' Kg' ?></td>
					 		</tr> 
					 		<tr>
					 			<td>&nbsp;</td>
					 			<td style="text-align: left">Potongan</td>
					 			<td width="1%">:</td>
					 			<td width="64%" style="text-decoration: underline"><?php echo 'Rp. '. number_format($data['potongan'],0,',','.') ?></td>
					 		</tr> 	
					 	</table>
					 	<?php
				    }
			     }
			     else if($payIn=="Deposit Langganan") {
			     	?>
			     	<table style="font-size:9pt;border-top: 1px dotted #000;width:100%;">
						<?php
		                $totaltambahan = 0;		               
	                	$sql=mysqli_query($con,"SELECT * FROM faktur_penjualan WHERE no_faktur='$faktur'"); 
	                	while ($data = mysqli_fetch_array($sql)){
		                    ?>
	                    <tr>
	                    	<td>&nbsp;</td>
	                        <td><?php echo ucwords($kuota);?></td>
	                        <td width="5%">Rp.</td>
	                        <td style="text-align:right; width: 20%">
	                        	<?php echo number_format($data['total'],0,',','.'); 
	                        	$total = $totaltambahan+$data['total']; ?>
	                        </td>
	                    </tr>
	                    <?php    
		                }   
			            ?> 	                    
					</table>

					<table style="font-size:9pt; border-top: 1px dotted #000; width:100%;">	
	                    <tr>
	                        <td style="text-align: right">Total</td>
	                        <td width="42%">&nbsp;</td>
	                        <td width="5%">Rp.</td>
	                        <td style="text-align:right; width: 20%">
	                        	<?php echo number_format($total,0,',','.'); ?>
	                        </td>
	                    </tr>   
	                    <tr>
	                        <td style="text-align: right">&nbsp;</td>	                        
	                    </tr>   
	                    <tr><td colspan="4" align="left"><em>Cara Pembayaran</em></td></tr> 							
	                    <tr>	
	                        <td style="text-align: right"><?= $result['cara_bayar'] ?></td>
	                        <td width="42%">&nbsp;</td>
	                        <td width="5%">Rp.</td>
	                        <td style="text-align:right;">
	                        	<?php echo number_format($result['total'],0,',','.'); ?>
	                        </td>
	                    </tr>   
					</table>

					<table style="width:100%;border-top: 1px dashed #000;font-size: 9pt;font-family: Tahoma;padding: 5px 0px;border-bottom: 1px dashed #000;margin-bottom:1px; font-style: italic">
						<?php 
						$sql = mysqli_query($con, "SELECT * FROM langganan WHERE id_customer='$idcst'");
						$data = mysqli_fetch_array($sql);

						?>
				 		<tr><td colspan="4" align="left">Info Kuota Sekarang</td></tr>
				 		<tr>
				 			<td>&nbsp;</td>
				 			<td style="text-align: left">Kiloan</td>
				 			<td width="1%">:</td>
				 			<td width="64%" style="text-decoration: underline"><?php echo number_format($data['kilo_cks'],2,',','.').' Kg' ?></td>
				 		</tr> 
				 		<tr>
				 			<td>&nbsp;</td>
				 			<td style="text-align: left">Potongan</td>
				 			<td width="1%">:</td>
				 			<td width="64%" style="text-decoration: underline"><?php echo 'Rp. '. number_format($data['potongan'],0,',','.') ?></td>
				 		</tr> 	
				 	</table>
			     	<?php
			     }
			     else if($payIn=="Adm Membership") {
			     	?>
			     	<table style="font-size:9pt;border-top: 1px dotted #000;width:100%;">
						<?php
		                $totaltambahan = 0;		               
	                	$sql=mysqli_query($con,"SELECT * FROM faktur_penjualan WHERE no_faktur='$faktur'"); 
	                	while ($data = mysqli_fetch_array($sql)){
		                    ?>
	                    <tr>
	                    	<td>&nbsp;</td>
	                        <td><?php echo ucwords($level);?></td>
	                        <td width="5%">Rp.</td>
	                        <td style="text-align:right; width: 20%">
	                        	<?php echo number_format($data['total'],0,',','.'); 
	                        	$total = $totaltambahan+$data['total']; ?>
	                        </td>
	                    </tr>
	                    <?php    
		                }   
			            ?> 	                    
					</table>

					<table style="font-size:9pt; border-top: 1px dotted #000; width:100%;">	
	                    <tr>
	                        <td style="text-align: right">Total</td>
	                        <td width="42%">&nbsp;</td>
	                        <td width="5%">Rp.</td>
	                        <td style="text-align:right; width: 20%">
	                        	<?php echo number_format($total,0,',','.'); ?>
	                        </td>
	                    </tr>   
	                    <tr>
	                        <td style="text-align: right">&nbsp;</td>	                        
	                    </tr>   
	                    <tr><td colspan="4" align="left"><em>Cara Pembayaran</em></td></tr> 							
	                    <tr>	
	                        <td style="text-align: right"><?= $result['cara_bayar'] ?></td>
	                        <td width="42%">&nbsp;</td>
	                        <td width="5%">Rp.</td>
	                        <td style="text-align:right;">
	                        	<?php echo number_format($result['total'],0,',','.'); ?>
	                        </td>
	                    </tr>   
					</table>

					<table style="width:100%;border-top: 1px dashed #000;font-size: 9pt;font-family: Tahoma;padding: 5px 0px;border-bottom: 1px dashed #000;margin-bottom:1px; font-style: italic">
						<tr>
							<td style="text-align: left; width: 43%">Level</td>
							<td width="2%">:</td>
							<td><?php echo $result['jenis_member'] ?></td>
						</tr>
						<tr>
							<td style="text-align: left; width: 43%">Tanggal Berakhir</td>
							<td width="2%">:</td>
							<td><?php echo date('d F Y', strtotime($result['tgl_akhir'])) ?></td>
						</tr>
				 	</table>
				 	<?php
			     } 
			     else if($payIn=="Paket Locker") {
					$qlock = $con->query("SELECT * FROM member_locker WHERE id_customer='$idcst'");
					$datalock = $qlock->fetch_array();
			     	?>
			     	<table style="font-size:9pt;border-top: 1px dotted #000;width:100%;">
						<?php
		                $totaltambahan = 0;		               
	                	$sql=mysqli_query($con,"SELECT * FROM faktur_penjualan WHERE no_faktur='$faktur'"); 
	                	while ($data = mysqli_fetch_array($sql)){
		                    ?>
	                    <tr>
	                    	<td>1 Bulan</td>
	                        <td><?php echo ucwords(($datalock['paket']=="slock") ? "Small Locker" : "Medium Locker");?></td>
	                        <td width="5%">Rp.</td>
	                        <td style="text-align:right; width: 20%">
	                        	<?php echo number_format($data['total'],0,',','.'); 
	                        	$total = $totaltambahan+$data['total']; ?>
	                        </td>
	                    </tr>
	                    <?php    
		                }   
			            ?> 	                    
					</table>

					<table style="font-size:9pt; border-top: 1px dotted #000; width:100%;">	
	                    <tr>
	                        <td style="text-align: right">Total</td>
	                        <td width="42%">&nbsp;</td>
	                        <td width="5%">Rp.</td>
	                        <td style="text-align:right; width: 20%">
	                        	<?php echo number_format($total,0,',','.'); ?>
	                        </td>
	                    </tr>   
	                    <tr>
	                        <td style="text-align: right">&nbsp;</td>	                        
	                    </tr>   
	                    <tr><td colspan="4" align="left"><em>Cara Pembayaran</em></td></tr> 							
	                    <tr>	
	                        <td style="text-align: right"><?= $result['cara_bayar'] ?></td>
	                        <td width="42%">&nbsp;</td>
	                        <td width="5%">Rp.</td>
	                        <td style="text-align:right;">
	                        	<?php echo number_format($result['total'],0,',','.'); ?>
	                        </td>
	                    </tr>   
					</table>

					<table style="width:100%;border-top: 1px dashed #000;font-size: 9pt;font-family: Tahoma;padding: 5px 0px;border-bottom: 1px dashed #000;margin-bottom:1px; font-style: italic">
						<tr>
							<td style="text-align: left; width: 43%">Level</td>
							<td width="2%">:</td>
							<td><?php echo $datalock['paket'] ?></td>
						</tr>
						<tr>
							<td style="text-align: left; width: 43%">Tanggal Berakhir</td>
							<td width="2%">:</td>
							<td><?php echo date('d F Y', strtotime($datalock['tgl_berakhir'])) ?></td>
						</tr>
				 	</table>
				 	<?php
			     }
			     ?>
				     

				<table style="font-size:8pt; width:100%; border-bottom: 1px solid; margin-top: 1px">
					<tr>
						<td align="center">-- Terima Kasih Telah Mencuci di QnC Laundry --</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</body>