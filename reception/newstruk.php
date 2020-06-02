<?php  
include '../config.php';
include "bar128.php";
session_start();

date_default_timezone_set('Asia/Makassar');

$cabang = "Makassar";
$outlet = $_SESSION['nama_outlet'];
$kasir = $_SESSION['user_id'];

$nota = $_GET['no_nota'];

mysqli_query($con, "DELETE FROM `kategori_item_order` WHERE no_nota='$nota'");

$orders = mysqli_query($con, "SELECT * FROM reception WHERE no_nota='$nota'");
$result = mysqli_fetch_array($orders);

$jenisCuci = ($result['jenis']=="k") ? "kiloan" : "potongan";

$customer = $result['nama_customer'];
$newNota = $result['new_nota'];
$charge = $result['express'];
$priority = $result['priority'];

$query = mysqli_query($con, "SELECT * FROM customer WHERE id='$result[id_customer]'");
$row = mysqli_fetch_assoc($query);

mysqli_query($con, "DELETE from order_tmp where id_customer = '$result[id_customer]' AND cabang<>'Delivery' ");
mysqli_query($con, "DELETE from order_potongan_tmp where id_customer = '$result[id_customer]' AND cabang<>'Delivery' ");

//cek status berlangganan
if($row['lgn']=='1'){
	$status = "langganan";
} else if($row['member']=='1') {
	$status = "member";
} else {
	$status = "normal";
} 


?>

<body onload="window.print()">	

	<body onload="">	

	<div class="" id="">
	    <div style="max-width:80mm;margin:3mm;">
	        <div align="center"><img width="80%" src="../new/logo 2017.bmp" /></div>
	        <?php 
	        $query=mysqli_query($con,"SELECT * FROM outlet WHERE kota='$cabang' AND nama_outlet='$outlet'");
	        $row = mysqli_fetch_array($query);
		     ?>
		     <div style="font-size: 9pt; font-family: Tahoma;">
			     <div align="center" style="margin-top: 5px">Outlet : <b><?php echo ucwords($row['nama_outlet']); ?></b></div>
			     <div align="center" style="margin-top: 1px"><?php echo $row['alamat']; ?>, <?php ($row['Kota']=="Jakarta") ? "Tangerang" : $row['Kota'] ; ?></div>
			     <div align="center" style="margin-top: 1px; margin-bottom: 10px">Call Center : <?php echo $row['no_telp'] ?></div>
			 
			     <div align="center" class="style1 style4"><strong><span class="style3" style="font-family: arial;font-size:10pt;">NOTA ORDER</span></strong></div>
			     <div align="center"><?php echo bar128(stripslashes($newNota)); ?><br>
		            <?php if ($priority==1) { ?>
		            <div style="font-size:12pt;font-family: Arial Black;border:2px solid black">PRIORITY<br>CUSTOMER
		            </div><br><?php } ?>
		                <?php echo $nota; ?>
		         </div>
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
		       </table>

		        <table style="font-size:9pt;border-top: 1px dotted #000;width:100%;">
					<tr>
				   		<?php
				        echo '<td>Nama</td> <td>:</td> <td>'.$customer.'</td></tr>';
				        echo '<tr><td>No Order</td> <td>:</td> <td>'.$nota.'</td>';
				        ?>
				   	</tr>
				</table>

				<table style="font-size:9pt;border-top: 1px dotted #000;width:100%;">
					<?php
	                $totaltambahan = 0;
	                if($jenisCuci=="k") {
	                	$katitem = "k1";
	                }
	                $itemlike = ""; $jumlahharga = 0; $item = ""; $item2 = ""; $hargaitem = 0;  $hargaitem2 = 0;
	                $sql=mysqli_query($con,"SELECT * FROM detail_penjualan WHERE item NOT LIKE '%Voucher%' AND item NOT LIKE '%Flat%' AND item NOT LIKE '%Express%' AND no_nota='$nota'");            
	                while ($data = mysqli_fetch_array($sql)){
	                	if($status=="member"){
	                		$harga_normal = $data['total']/0.80;
	                	} else {
	                		$harga_normal = $data['total'];
	                	}

	                	if($jenisCuci=="kiloan") {

	                		$strPos = (substr($data['item'], 12,5)=="Lipat") ? strrpos($data['item'], "Lipat")+strlen("Lipat") : strrpos($data['item'], "Setrika")+strlen("Setrika");    		                	

		                	$item = substr($data['item'], 0,12).substr($data['item'], $strPos);
	                		$item2 = substr($data['item'], 12);

	                		if(strrpos($data['item'], "Setrika")=="12" OR strrpos($data['item'], "Lipat")=="12") {
	                			$hargaitem = ($data['berat']>3) ? 15000 : 10000;
	                			$hargaitem2 = $harga_normal-$hargaitem;
	                			$totaltambahan = $totaltambahan+$hargaitem;
	                			$totaltambahan = $totaltambahan+$hargaitem2;
	                			$jumlahharga = $data['jumlah'];
			                	$tampilan_nota = '
			                	<tr>
			                        <td>'.$jumlahharga.'</td>
			                        <td colspan="2">'.ucwords($item).'</td>
			                        <td>Rp.</td>
			                        <td style="text-align:right;">'.number_format($hargaitem,0,',','.').'</td>
			                    </tr>
			                    <tr>
			                        <td>'.$jumlahharga.'</td>
			                        <td colspan="2">'.ucwords($item2).'</td>
			                        <td>Rp.</td>
			                        <td style="text-align:right;">'.number_format($hargaitem2,0,',','.').'</td>
			                    </tr>
			                	';	
	                		}
	                		else {

			                	$item = $data['item'];
			                	$totaltambahan = $totaltambahan+$harga_normal;
			                	$tampilan_nota = '
			                	<tr>
			                        <td>'.$data['jumlah'].'</td>
			                        <td colspan="2">'.ucwords($item).'</td>
			                        <td>Rp.</td>
			                        <td style="text-align:right;">'.number_format($harga_normal,0,',','.').'</td>
			                    </tr>
			                	';	
	                		}

		                			                		
	                	}	
	                	else {  		                	

		                	$item = $data['item'];
		                	$totaltambahan = $totaltambahan+$harga_normal;
		                	$tampilan_nota = '
		                	<tr>
		                        <td>'.$data['jumlah'].'</td>
		                        <td colspan="2">'.ucwords($item).'</td>
		                        <td>Rp.</td>
		                        <td style="text-align:right;">'.number_format($harga_normal,0,',','.').'</td>
		                    </tr>
		                	';		                		

	                	}		                	

                		echo $tampilan_nota;
                        $itemlike = $data['item'];
                    }


                    if ($data['keterangan']<>''){
                        ?>
                        <tr>
                            <td></td>
                            <td colspan="4">( <?php echo $data['keterangan'];?> )</td>
                        </tr>
                        <?php           
                    }
                    
                    $sql=mysqli_query($con,"SELECT SUM(total) AS total FROM detail_penjualan WHERE item NOT LIKE '%Voucher%' AND item NOT LIKE '%Flat%' AND item NOT LIKE '%Express%' AND no_nota='$nota'");            
	                $data = mysqli_fetch_array($sql);		                
                    
                	if($status=="member"){ 
                		$diskon_member = ($data['total']-$data['total']/0.80)*-1;
                		?>
                    	<tr>
	                        <td>&nbsp;</td>
	                        <td>&nbsp;</td>
	                        <td>Diskon Member</td>
	                        <td>Rp.</td>
	                        <td style="text-align:right;">
	                        	<?php echo "(".number_format($diskon_member,0,',','.').")"; 
	                        	$totaltambahan = $totaltambahan-$diskon_member;
	                        	?>
	                        </td>
	                    </tr> <?php
                    }       

                    //diskon promo utama
                    $diskon_promo = mysqli_fetch_array(mysqli_query($con, "SELECT SUM(total) FROM detail_penjualan WHERE no_nota='$nota' AND item LIKE '%Voucher%'"))[0];

                    if($diskon_promo>0){
                    	?>
	                    <tr>
	                        <td>&nbsp;</td>
	                        <td>&nbsp;</td>
	                        <td>Diskon Promo</td>
	                        <td>Rp.</td>
	                        <td style="text-align:right;">
	                        	<?php echo "(".number_format($diskon_promo,0,',','.').")"; 
	                        		$totaltambahan = $totaltambahan-$diskon_promo;
	                        	?>
	                        </td>
	                    </tr>

	                    <?php
                    }
	         
	                $sql = mysqli_query($con, "SELECT * FROM rincian_pilihan_order WHERE no_nota='$nota'");	 
	                $data = mysqli_fetch_array($sql);
	            	if($data['parfum']=="extra") {
	            		?>
	            		<tr>
	                        <td>&nbsp;</td>
	                        <td>&nbsp;</td>
	                        <td>Ekstra Parfum</td>
	                        <td>Rp.</td>
	                        <td style="text-align:right;">0</td>
	                    </tr>
	                    <?php
	            	} else if($data['parfum']=="no") {
	            		?>
	            		<tr>
	                        <td>&nbsp;</td>
	                        <td>&nbsp;</td>
	                        <td>Tanpa Parfum</td>
	                        <td>Rp.</td>
	                        <td style="text-align:right;">0</td>
	                    </tr>
	                    <?php
	            	} else if($data['parfum']=="0") {
	            		?>
	            		<tr>
	                        <td>&nbsp;</td>
	                        <td>&nbsp;</td>
	                        <td>Parfum Normal</td>
	                        <td>Rp.</td>
	                        <td style="text-align:right;">0</td>
	                    </tr>
	                    <?php
	            	}
	            	if($data['hanger_own']=="1") {
	            		?>
	            		<tr>
	                        <td>&nbsp;</td>
	                        <td>&nbsp;</td>
	                        <td>Hanger Sendiri</td>
	                        <td>&nbsp;</td>
	                        <td>&nbsp;</td>
	                    </tr>
	                    <?php
	            	}
	            	if($data['hanger']>0) {
	            		?>
	            		<tr>
	                        <td>&nbsp;</td>
	                        <td><?php echo $data['hanger']; ?></td>
	                        <td>Hanger</td>
	                        <td>Rp.</td>
	                        <td style="text-align:right;"><?php echo number_format($data['hanger']*2500,0,',','.');
	                            $totaltambahan = $totaltambahan+($data['hanger']*2500);
	                            ?>
	                        </td>
	                    </tr>
	                    <?php
	            	}
	            	if($data['hanger_plastik']>0) {
	            		?>
	            		<tr>
	                        <td>&nbsp;</td>
	                        <td><?php echo $data['hanger_plastik']; ?></td>
	                        <td>Hanger Plastik</td>
	                        <td>Rp.</td>
	                        <td style="text-align:right;"><?php echo number_format($data['hanger_plastik']*2000,0,',','.');
	                            $totaltambahan = $totaltambahan+($data['hanger_plastik']*2000);
	                            ?>
	                        </td>
	                    </tr>
	                    <?php
	            	}    
	            	if($data['charge']>0) {
	            		switch ($data['charge']) {
	            			case '1' : $express = 'Express'; break;
	            			case '2' : $express = 'Double Express';  break;
	            			case '3' : $express = 'Super Express';  break;	                		
	            		    
	            		}
	            		?>
	            		<tr>
	                        <td>&nbsp;</td>
	                        <td>&nbsp;</td>
	                        <td><?= $express ?></td>
	                        <td>Rp.</td>
	                        <td style="text-align:right;">
	                        	<?php echo number_format($data['charge']*15000,0,',','.');
	                        		$totaltambahan = $totaltambahan+$data['charge']*15000;
	                            ?>
	                        </td>
	                    </tr>
	                    <?php
	                    
	            	}       

	               ?>
			</table>

			<?php       	        

	        $total = $totaltambahan;
	        ?>
			 <table style="font-size:9pt;border-top: 1px dotted #000;width:100%;"> 
			 	<tr>
	               <td></td>
	               <td style="width:50px;"></td>
	               <td>&nbsp;</td>
	               <td>&nbsp;</td>
	               <td width="123px;">Total</td>
	               <td>Rp.</td>
	               <td style="text-align:right;">
		               <?php
		               echo str_replace('Rp.','',number_format($total,0,',','.'));
		               ?>               
		           </td>
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
		            Syarat dan ketentuan komplain klik:
		        </td>
		    </tr>
		     <tr valign="top"> 
		        <td style="text-align: center; font-size: 8pt">
		            www.qnclaundry.net/complaint 
		        </td>
		    </tr>

		    <tr valign="top">
		        <td style="text-align: center">
		            <img style="width: 10px" src="../../../accounting/icon/hand-pointer.ico">
		        </td>
		    </tr>
		</table>

		<div style="width:100%;border-top: 1px dotted #000;font-size: 8pt;font-family: Tahoma;padding: 5px 0px;border-top: 1px dashed #000;margin-top:1px;text-align: center;">			    
		    Saya setuju dan telah  mengerti seluruh syarat dan ketentuan di QnCLaundry
		    <br><br><br><br><br><br><br><br>
		    <hr>
		    (<?php echo ucwords($customer) ?>)
		</div>

		<br><br><br>

		<!-- End Nota Customer -->


		<?php
		$qres = mysqli_query($con,"SELECT * FROM reception WHERE no_nota='$nota'");
		$rres = mysqli_fetch_array($qres);

		$nota2 = '
		<div style="page-break-before:always;">
			<div style="font-size: 9pt; font-family: Tahoma; margin-top: 3mm" >';
				
			      $sql=mysqli_query($con,"SELECT * FROM outlet WHERE nama_outlet='$outlet'");
			      while($data = mysqli_fetch_array($sql)){
		$nota2 .= '
			        <table style="width:100%;">
			          <tr>
			              <td style="width:33.33%">
			                  <h3 style="margin:0px;">
			                      <center>';
			                          if($result['jenis']=="k") :
		$nota2 .= '                    <h3 style="margin:0px; border: 1px solid">
					                      <center>
					                          << KILOAN >>
					                      </center>
					                  </h3>';			                          
			                     	  endif;
			                          if($result['jenis']=="p") :
		$nota2 .= '                    <h3 style="margin:0px; border: 1px solid">
					                      <center>
					                          << POTONGAN >>
					                      </center>
					                  </h3>';
					              	  endif;
		$nota2 .= '                 </center>
			                  </h3>
			              </td>				              
			      	  </tr>
				    </table>

			        <table style="width:100%;">
			          <tr>
			              <td style="width:33.33%">
			                  <h3 style="margin:0px;">
			                      <center>
			                          '.$left_code.'
			                      </center>
			                  </h3>
			              </td>
			              <td style="width:33.33%">
			                  <h1 style="margin:0px;">
			                      <center>
			                        '.$data['kode'].'
			                      </center>
			                  </h1>
			              </td>
				          <td style="width:33.33%">
				             <h3 style="margin:0px;">
				                 <center>
				                    '.strtoupper(date('l, d M y')).'
				                 </center>    
				              </h3>
				          </td>
			      	  </tr>
				    </table>';
				   }
				   
		$nota2 .= '<br>
   				<table style="border-top: 1px dotted #000;width:100%;">
   					<tr>
			           <td>
			               <span style="float:left;font-size: 9pt;">'.date('l, d M y H:iA').'</span>
			           </td>
			           <td>
			               <span style="float:right;font-size: 9pt;">Kasir : '.$_SESSION['user_id'].'</span>
			           </td>
			       </tr>
   				</table>

   				<table style="font-size:9pt;border-top: 1px dotted #000;width:100%;">
					<tr>
				        <td>Nama</td> <td>:</td> <td>'.$customer.'</td></tr>
				        <tr><td>No Order</td> <td>:</td> <td>'.$nota.'</td>
				   	</tr>
				</table>

   				<table style="font-size:9pt;border-top: 1px dotted #000;width:100%;">';				
	                $totaltambahan = 0;
	                if($jenisCuci=="k") {
	                	$katitem = "k1";
	                }
	                $sql=mysqli_query($con,"SELECT * FROM detail_penjualan WHERE item NOT LIKE '%Voucher%' AND item NOT LIKE '%Flat%' AND item NOT LIKE '%Express%' AND no_nota='$nota'");            
	                while ($data = mysqli_fetch_array($sql)){
	                	if($status=="member"){
	                		$harga_normal = $data['total']/0.80;
	                	} else {
	                		$harga_normal = $data['total'];
	                	}

	                	if($jenisCuci=="kiloan") {

	                		$strPos = (substr($data['item'], 12,5)=="Lipat") ? strrpos($data['item'], "Lipat")+strlen("Lipat") : strrpos($data['item'], "Setrika")+strlen("Setrika");    		                	

		                	$item = substr($data['item'], 0,12).substr($data['item'], $strPos);
	                		$item2 = substr($data['item'], 12);

	                		if(strrpos($data['item'], "Setrika")=="12" OR strrpos($data['item'], "Lipat")=="12") {
	                			$hargaitem = ($data['berat']>3) ? 15000 : 10000;
	                			$hargaitem2 = $data['total']-$hargaitem;
	                			$totaltambahan = $totaltambahan+$hargaitem;
	                			$totaltambahan = $totaltambahan+$hargaitem2;
	                			$jumlahharga = $data['jumlah'];
			                	$nota2 .= '
			                	<tr>
			                        <td>'.$jumlahharga.'</td>
			                        <td colspan="2">'.ucwords($item).'</td>
			                        <td>Rp.</td>
			                        <td style="text-align:right;">'.number_format($hargaitem,0,',','.').'</td>
			                    </tr>
			                    <tr>
			                        <td>'.$jumlahharga.'</td>
			                        <td colspan="2">'.ucwords($item2).'</td>
			                        <td>Rp.</td>
			                        <td style="text-align:right;">'.number_format($hargaitem2,0,',','.').'</td>
			                    </tr>
			                	';	
	                		}
	                		else {

			                	$item = $data['item'];
			                	$totaltambahan = $totaltambahan+$harga_normal;
			                	$nota2 .= '
			                	<tr>
			                        <td>'.$data['jumlah'].'</td>
			                        <td colspan="2">'.ucwords($item).'</td>
			                        <td>Rp.</td>
			                        <td style="text-align:right;">'.number_format($harga_normal,0,',','.').'</td>
			                    </tr>
			                	';	
	                		}

		                			                		
	                	}	
	                	else {  		                	

		                	$item = $data['item'];
		                	$totaltambahan = $totaltambahan+$harga_normal;
		                	$nota2 .= '
		                	<tr>
		                        <td>'.$data['jumlah'].'</td>
		                        <td colspan="2">'.ucwords($item).'</td>
		                        <td>Rp.</td>
		                        <td style="text-align:right;">'.number_format($harga_normal,0,',','.').'</td>
		                    </tr>
		                	';		                		

	                	}	                	

                    }

					if ($data['keterangan']<>''){
        $nota2 .= '	    <tr>
                            <td></td>
                            <td colspan="4">( '.$data['keterangan'].' )</td>
                        </tr>';       
                    }

                    $sql=mysqli_query($con,"SELECT SUM(total) AS total FROM detail_penjualan WHERE item NOT LIKE '%Voucher%' AND item NOT LIKE '%Flat%' AND item NOT LIKE '%Express%' AND no_nota='$nota'");            
	                $data = mysqli_fetch_array($sql);		                

                	if($status=="member"){ 
                		$diskon_member = ($data['total']-$data['total']/0.80)*-1;
        $nota2 .= '	 	<tr>
	                        <td>&nbsp;</td>
	                        <td>&nbsp;</td>
	                        <td>Diskon Member</td>
	                        <td>Rp.</td>
	                        <td style="text-align:right;">
	                        	('.number_format($diskon_member,0,',','.').')'; 
	                        	$totaltambahan = $totaltambahan-$diskon_member;
	    $nota2 .= '          </td>
	                    </tr>';
                    }                     

                    if($diskon_promo>0){
	    $nota2 .= '      <tr>
	                        <td>&nbsp;</td>
	                        <td>&nbsp;</td>
	                        <td>Diskon Promo</td>
	                        <td>Rp.</td>
	                        <td style="text-align:right;">
	                        	('.number_format($diskon_promo,0,',','.').')'; 
	                        		$totaltambahan = $totaltambahan-$diskon_promo;
	    $nota2 .= '          </td>
	                    </tr>';
                    }
	         
	                $sql = mysqli_query($con, "SELECT * FROM rincian_pilihan_order WHERE no_nota='$nota'");	 
	                $data = mysqli_fetch_array($sql);
	            	if($data['parfum']=="extra") {
	    $nota2 .= '		<tr>
	                        <td>&nbsp;</td>
	                        <td>&nbsp;</td>
	                        <td>Ekstra Parfum</td>
	                        <td>Rp.</td>
	                        <td style="text-align:right;">0</td>
	                    </tr>';
	            	} else if($data['parfum']=="no") {
	    $nota2 .= ' 		<tr>
	                        <td>&nbsp;</td>
	                        <td>&nbsp;</td>
	                        <td>Tanpa Parfum</td>
	                        <td>Rp.</td>
	                        <td style="text-align:right;">0</td>
	                    </tr>';
	            	} else if($data['parfum']=="0") {
	    $nota2 .= ' 		<tr>
	                        <td>&nbsp;</td>
	                        <td>&nbsp;</td>
	                        <td>Parfum Normal</td>
	                        <td>Rp.</td>
	                        <td style="text-align:right;">0</td>
	                    </tr>';
	            	}
	            	if($data['hanger_own']=="1") {
	    $nota2 .= ' 		<tr>
	                        <td>&nbsp;</td>
	                        <td>&nbsp;</td>
	                        <td>Hanger Sendiri</td>
	                        <td>&nbsp;</td>
	                        <td>&nbsp;</td>
	                    </tr>';
	            	}
	            	if($data['hanger']>0) {
	    $nota2 .= ' 		<tr>
	                        <td>&nbsp;</td>
	                        <td>'.$data['hanger'].'</td>
	                        <td>Hanger</td>
	                        <td>Rp.</td>
	                        <td style="text-align:right;">'.number_format($data['hanger']*2500,0,',','.');
	                            $totaltambahan = $totaltambahan+($data['hanger']*2500);
	    $nota2 .= '          </td>
	                    </tr>';
	            	}
	            	if($data['hanger_plastik']>0) {
	    $nota2 .= ' 		<tr>
	                        <td>&nbsp;</td>
	                        <td>'.$data['hanger_plastik'].'</td>
	                        <td>Hanger Plastik</td>
	                        <td>Rp.</td>
	                        <td style="text-align:right;">'.number_format($data['hanger_plastik']*2000,0,',','.');
	                            $totaltambahan = $totaltambahan+($data['hanger_plastik']*2000);
	    $nota2 .= '          </td>
	                    </tr>';
	            	}    
	            	if($data['charge']>0) {
	            		switch ($data['charge']) {
	            			case '1' : $express = 'Express'; break;
	            			case '2' : $express = 'Double Express';  break;
	            			case '3' : $express = 'Super Express';  break;	                		
	            		}
	    $nota2 .= ' 		<tr>
	                        <td>&nbsp;</td>
	                        <td>&nbsp;</td>
	                        <td>'.$express.'</td>
	                        <td>Rp.</td>
	                        <td style="text-align:right;">
	                        	'.number_format($data['charge']*15000,0,',','.');
	                        		$totaltambahan = $totaltambahan+$data['charge']*15000;
	    $nota2 .= '          </td>
	                    </tr>';	                    
	            	}  

		$nota2 .= '</table>

			 <table style="font-size:9pt;border-top: 1px dotted #000;width:100%;"> 
			 	<tr>
	               <td></td>
	               <td style="width:50px;"></td>
	               <td>&nbsp;</td>
	               <td>&nbsp;</td>
	               <td width="123px;">Total</td>
	               <td>Rp.</td>
	               <td style="text-align:right;">
		               '.str_replace('Rp.','',number_format($total,0,',','.'));             
		$nota2 .= ' </td>
	           </tr>     
			 </table>
		 </div>

		 <div style="border-bottom: 1px dashed #000;margin-bottom:1px;width:100%"></div>
		 <div style="width:100%;border-top: 1px dotted #000;font-size: 9pt;font-family: Tahoma;padding: 5px 0px;border-top: 1px dashed #000;margin-bottom:1px;">
		    <div align="center" style="margin-top:5px;">'.bar128(stripslashes($nota)).'<br>';
		    if ($priority==1) { 
		    	$nota2 .= '
		        <div style="font-size:12pt;font-family: Arial Black;border:2px solid black">PRIORITY<br>CUSTOMER</div><br>'; 
		    }
		$nota2 .= '     
		    </div>
	        <br><br>
	        <div style="width:100%;">
	            <center>';		                
	                if($data['hanger']>0){ 
	                $nota2 .= '    
	                <img src="img/hanger.png">';
	                }		                
	                if($data["parfum"]=="extra"){
	                $nota2 .= '            
	                <img src="img/extra.png">';
	                }
	                if($data["parfum"]=="no"){
	                $nota2 .= '                            
	                <img src="img/no.png">';
	                }		                
	                if($data["hanger_own"]=="1"){ 
	                $nota2 .= '           
	                <img src="img/own.png">';
	                }
	                if($data["hanger_plastik"]>0){
	                $nota2 .= '            
	                <img src="img/plastic.png">';
	               	}
	               	$nota2 .= '     
	            </center>
	        </div>
	    </div>
		    

		 </div>';
		 for($i=1;$i<=2; $i++){
		 	echo $nota2;
		 }
		 
		 ?>	
	 </div>
</div>

</body>