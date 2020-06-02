<?php  
include '../../config.php';
include '../zonawaktu.php';
include"../../../reception/bar128.php";

$cabang = $_SESSION['cabang'];
$outlet = $_SESSION['outlet'];
$kasir = $_SESSION['user_id'];

$nota = $_GET['nota'];

$orders = mysqli_query($con, "SELECT * FROM reception WHERE no_nota='$nota'");
$result = mysqli_fetch_array($orders);

$jenisCuci = ($result['jenis']=="k") ? "kiloan" : "potongan";

$customer = $result['nama_customer'];
$newNota = $result['new_nota'];
$charge = $result['express'];
$priority = $result['priority'];

$query = mysqli_query($con, "SELECT * FROM customer WHERE id='$result[id_customer]'");
$row = mysqli_fetch_assoc($query);


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

	<div class="" id="">
	    <div style="max-width:80mm;margin:3mm;">
	        <div align="center"><img width="80%" src="../../logo 2017.bmp" /></div>
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
	                $sql=mysqli_query($con,"SELECT * FROM detail_penjualan a LEFT JOIN item_spk b ON a.item=b.nama_item WHERE a.no_nota='$nota' and b.ket<>'1'");            
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

	                		if($cabang=="Jakarta" && (strrpos($data['item'], "Setrika")=="12" OR strrpos($data['item'], "Lipat")=="12")) {
	                			$hargaitem = ($data['berat']>3) ? 15000 : 10000;
	                			$hargaitem2 = $data['total']-$hargaitem;

			                	$tampilan_nota = '
			                	<tr>
			                        <td>'.$data['jumlah'].'</td>
			                        <td colspan="2">'.ucwords($item).'</td>
			                        <td>Rp.</td>
			                        <td style="text-align:right;">'.number_format($hargaitem,0,',','.').'</td>
			                    </tr>
			                    <tr>
			                        <td>'.$data['jumlah'].'</td>
			                        <td colspan="2">'.ucwords($item2).'</td>
			                        <td>Rp.</td>
			                        <td style="text-align:right;">'.number_format($hargaitem2,0,',','.').'</td>
			                    </tr>
			                	';	
	                		}
	                		else {

			                	$item = $data['item'];

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
                            
                    }


                    if ($data['keterangan']<>''){
                        ?>
                        <tr>
                            <td></td>
                            <td colspan="4">( <?php echo $data['keterangan'];?> )</td>
                        </tr>
                        <?php           
                    }

                    $sql=mysqli_query($con,"SELECT SUM(total) AS total FROM detail_penjualan a, item_spk b WHERE a.no_nota='$nota' and a.item=b.nama_item and b.ket<>'1'");            
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
	                        	<?php echo "(".number_format($diskon_member,0,',','.').")"; ?>
	                        </td>
	                    </tr> <?php
                    } 

                    $diskon_promo = mysqli_fetch_array(mysqli_query($con, "SELECT SUM(total) FROM detail_penjualan WHERE no_nota='$nota' AND item LIKE '%Voucher%'"))[0];

                    if($diskon_promo<0){
                    	?>
	                    <tr>
	                        <td>&nbsp;</td>
	                        <td>&nbsp;</td>
	                        <td>Diskon Promo</td>
	                        <td>Rp.</td>
	                        <td style="text-align:right;">
	                        	<?php echo "(".number_format($diskon_promo*-1,0,',','.').")"; 
	                        		$totaltambahan = $totaltambahan+$diskon_promo;
	                        	?>
	                        </td>
	                    </tr>

	                    <?php
                    }

	                if($result['jenis']=='k'){
	                	$sql = mysqli_query($con, "SELECT * FROM order_tmp WHERE no_nota='$nota'");	   
	                }             	
	                else if($result['jenis']=='p'){
	                	$sql = mysqli_query($con, "SELECT * FROM order_potongan_tmp WHERE no_nota='$nota'");	                	
	                }
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
	            	} else if($data['parfum']=="0") {
	            		?>
	            		<tr>
	                        <td>&nbsp;</td>
	                        <td>&nbsp;</td>
	                        <td>Tanpa Parfum</td>
	                        <td>Rp.</td>
	                        <td style="text-align:right;">0</td>
	                    </tr>
	                    <?php
	            	} else if($data['parfum']=="normal") {
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
	            	if($data['hanger_plastic']>0) {
	            		?>
	            		<tr>
	                        <td>&nbsp;</td>
	                        <td><?php echo $data['hanger_plastic']; ?></td>
	                        <td>Hanger Plastik</td>
	                        <td>Rp.</td>
	                        <td style="text-align:right;"><?php echo number_format($data['hanger_plastic']*2000,0,',','.');
	                            $totaltambahan = $totaltambahan+($data['hanger_plastic']*2000);
	                            ?>
	                        </td>
	                    </tr>
	                    <?php
	            	}    
	            	if($data['charge']>0) {
	            		switch ($data['charge']) {
	            			case '1' : $express = 'Express'; break;
	            			case '2' : $express = 'Double Express';  break;
	            			case '3' : $express = 'Super Express';  break;	                		}
	            		?>
	            		<tr>
	                        <td>&nbsp;</td>
	                        <td>&nbsp;</td>
	                        <td><?= $express ?></td>
	                        <td>Rp.</td>
	                        <td style="text-align:right;"><?php echo number_format($data['charge']*15000,0,',','.');
	                            ?>
	                        </td>
	                    </tr>
	                    <?php
	            	}       

	               ?>
			</table>

			<?php       

	        $totalexpress = 0;
	        $sql=mysqli_query($con,"SELECT COALESCE(sum(total),0) as totalexpress FROM detail_penjualan WHERE no_nota='$nota' AND item LIKE '%Express%'");        
	        $data = mysqli_fetch_array($sql);
	        $totalexpress = $data['totalexpress'];

	        $totalnoexpress = 0;
            $sql2=mysqli_query($con,"SELECT sum(total) as totalnoexpress FROM detail_penjualan a, item_spk b WHERE a.no_nota='$nota' and a.item=b.nama_item and b.ket='0' and item not like '%Voucher%'");           
            $data2 = mysqli_fetch_array($sql2);
            $totalnoexpress = $data2['totalnoexpress'];

	        $total = $totalexpress+$totalnoexpress+$totaltambahan;
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
		         echo "Tanggal Selesai : ".date('d M y',strtotime('+72 hours'))."<br>";
		         //echo "Tanggal Selesai : ".$date."<br>";
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

		?>
		<div style="page-break-before:always;">
			<div style="font-size: 9pt; font-family: Tahoma" >
				<?php
			      $sql=mysqli_query($con,"SELECT * FROM outlet WHERE nama_outlet='$outlet'");
			      while($data = mysqli_fetch_array($sql)){
			        ?>
			        <table style="width:100%;">
			          <tr>
			              <td style="width:33.33%">
			                  <h3 style="margin:0px;">
			                      <center>
			                          <?php 
			                          if($result['jenis']=="k") { ?>
			                          <h3 style="margin:0px; border: 1px solid">
					                      <center>
					                          << KILOAN >>
					                      </center>
					                  </h3> 
			                          <?php 
			                     	  }
			                          else if($result['jenis']=="p") { ?>
			                          <h3 style="margin:0px; border: 1px solid">
					                      <center>
					                          << POTONGAN >>
					                      </center>
					                  </h3>
					                  <?php 
					              	  }
					                  ?>
			                      </center>
			                  </h3>
			              </td>				              
			      	  </tr>
				    </table>

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
			                        <?php echo $data['kode'] ?>
			                      </center>
			                  </h1>
			              </td>
				          <td style="width:33.33%">
				             <h3 style="margin:0px;">
				                 <center>
				                    <?php echo strtoupper(date('l, d M y')) ?>
				                 </center>    
				              </h3>
				          </td>
			      	  </tr>
				    </table>
				    <?php  
				   }
				?>

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
				        echo '<td>Nama</td> <td>:</td> <td>'.$customer.'</td></tr>';
				        echo '<tr><td>No Order</td> <td>:</td> <td>'.$nota.'</td>';
				        ?>
				   	</tr>
				</table>

   				<table style="font-size:9pt;border-top: 1px dotted #000;width:100%;">
					<?php
	                $totaltambahan = 0;
	                $sql=mysqli_query($con,"SELECT * FROM detail_penjualan a LEFT JOIN item_spk b ON a.item=b.nama_item WHERE a.no_nota='$nota' and b.ket<>'1'");            
	                while ($data = mysqli_fetch_array($sql)){
	                	if($status=="member"){
	                		$harga_normal = $data['total']/0.80;
	                	} else {
	                		$harga_normal = $data['total'];
	                	}

	                	if($jenisCuci=="kiloan") {

	                		if($cabang=="Jakarta" && (strrpos($data['item'], "Setrika")=="12" OR strrpos($data['item'], "Lipat")=="12")) {
	                			$hargaitem = ($data['berat']>3) ? 15000 : 10000;
	                			$hargaitem2 = $data['total']-$hargaitem;

			                	$tampilan_nota = '
			                	<tr>
			                        <td>'.$data['jumlah'].'</td>
			                        <td colspan="2">'.ucwords($item).'</td>
			                        <td>Rp.</td>
			                        <td style="text-align:right;">'.number_format($hargaitem,0,',','.').'</td>
			                    </tr>
			                    <tr>
			                        <td>'.$data['jumlah'].'</td>
			                        <td colspan="2">'.ucwords($item2).'</td>
			                        <td>Rp.</td>
			                        <td style="text-align:right;">'.number_format($hargaitem2,0,',','.').'</td>
			                    </tr>
			                	';	
	                		}
	                		else {

			                	$item = $data['item'];

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
                            
                    }

                    $sql=mysqli_query($con,"SELECT SUM(total) AS total FROM detail_penjualan a, item_spk b WHERE a.no_nota='$nota' and a.item=b.nama_item and b.ket<>'1'");            
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
	                        	<?php echo "(".number_format($diskon_member,0,',','.').")"; ?>
	                        </td>
	                    </tr> <?php
                    } 

                    $diskon_promo = mysqli_fetch_array(mysqli_query($con, "SELECT SUM(total) FROM detail_penjualan WHERE no_nota='$nota' AND item LIKE '%Voucher%'"))[0];

                    if($diskon_promo<0){
                    	?>
	                    <tr>
	                        <td>&nbsp;</td>
	                        <td>&nbsp;</td>
	                        <td>Diskon Promo</td>
	                        <td>Rp.</td>
	                        <td style="text-align:right;">
	                        	<?php echo "(".number_format($diskon_promo*-1,0,',','.').")"; 
	                        		$totaltambahan = $totaltambahan+$diskon_promo;
	                        	?>
	                        </td>
	                    </tr>

	                    <?php
                    }		

	                if($result['jenis']=='k'){
	                	$sql = mysqli_query($con, "SELECT * FROM order_tmp WHERE no_nota='$nota'");	   
	                }             	
	                else if($result['jenis']=='p'){
	                	$sql = mysqli_query($con, "SELECT * FROM order_potongan_tmp WHERE no_nota='$nota'");	                	
	                }
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
                	} else if($data['parfum']=="0") {
                		?>
                		<tr>
	                        <td>&nbsp;</td>
	                        <td>&nbsp;</td>
	                        <td>Tanpa Parfum</td>
	                        <td>Rp.</td>
	                        <td style="text-align:right;">0</td>
	                    </tr>
	                    <?php
                	} else if($data['parfum']=="normal") {
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
                	if($data['hanger_plastic']>0) {
                		?>
                		<tr>
	                        <td>&nbsp;</td>
	                        <td><?php echo $data['hanger_plastic']; ?></td>
	                        <td>Hanger Plastik</td>
	                        <td>Rp.</td>
	                        <td style="text-align:right;"><?php echo number_format($data['hanger_plastic']*2000,0,',','.');
	                            $totaltambahan = $totaltambahan+($data['hanger_plastic']*2000);
	                            ?>
	                        </td>
	                    </tr>
	                    <?php
                	}    
                	if($data['charge']>0) {
                		switch ($data['charge']) {
                			case '1' : $express = 'Express'; break;
                			case '2' : $express = 'Double Express';  break;
                			case '3' : $express = 'Super Express';  break;	                		}
                		?>
                		<tr>
	                        <td>&nbsp;</td>
	                        <td>&nbsp;</td>
	                        <td><?= $express ?></td>
	                        <td>Rp.</td>
	                        <td style="text-align:right;"><?php echo number_format($data['charge']*15000,0,',','.');
	                            ?>
	                        </td>
	                    </tr>
	                    <?php
                	}          


	               ?>
			</table>

			<?php       

	        $totalexpress = 0;
	        $sql=mysqli_query($con,"SELECT COALESCE(sum(total),0) as totalexpress FROM detail_penjualan WHERE no_nota='$nota' AND item LIKE '%Express%'");        
	        $data = mysqli_fetch_array($sql);
	        $totalexpress = $data['totalexpress'];

	        $totalnoexpress = 0;
            $sql2=mysqli_query($con,"SELECT sum(total) as totalnoexpress FROM detail_penjualan a, item_spk b WHERE a.no_nota='$nota' and a.item=b.nama_item and b.ket='0' and item not like '%Voucher%'");           
            $data2 = mysqli_fetch_array($sql2);
            $totalnoexpress = $data2['totalnoexpress'];

	        $total = $totalexpress+$totalnoexpress+$totaltambahan;
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

		 <div style="border-bottom: 1px dashed #000;margin-bottom:1px;width:100%"></div>
		 <div style="width:100%;border-top: 1px dotted #000;font-size: 9pt;font-family: Tahoma;padding: 5px 0px;border-top: 1px dashed #000;margin-bottom:1px;">
		    <div align="center" style="margin-top:5px;"><?php echo bar128(stripslashes($nota))?><br>
		        <?php if ($priority==1) { ?>
		        <div style="font-size:12pt;font-family: Arial Black;border:2px solid black">PRIORITY<br>CUSTOMER</div><br><?php } ?></div>
		        <br><br>
		        <div style="width:100%;">
		        	<?php 
		        	if($result['jenis']=='k'){
	                	$sql = mysqli_query($con, "SELECT * FROM order_tmp WHERE no_nota='$nota'");	   
	                }             	
	                else if($result['jenis']=='p'){
	                	$sql = mysqli_query($con, "SELECT * FROM order_potongan_tmp WHERE no_nota='$nota'");	                	
	                }
	                $data = mysqli_fetch_array($sql);
		        	?>
		            <center>		                
		                <?php if($data['hanger']>0){ ?>    
		                <img src="../assets/images/hanger.png">
		                <?php } ?>
		                <?php if($data["parfum"]=="extra"){ ?>            
		                <img src="../assets/images/extra.png">
		                <?php } ?>
		                <?php if($data["parfum"]=="0"){ ?>                            
		                <img src="../assets/images/no.png">
		                <?php } ?>
		                <?php if($data["hanger_own"]=="1"){ ?>            
		                <img src="../assets/images/own.png">
		                <?php } ?>
		                <?php if($data["hanger_plastic"]>0){ ?>            
		                <img src="../assets/images/plastic.png">
		                <?php } ?>        
		            </center>
		        </div>
		    </div>
		    

		 </div>
		 <br><br><br>		
	 </div>

    </div>
</div>
         

		

</body>