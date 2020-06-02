<?php
include "../config.php";
?>
				<div class="col-lg-6" style="width:100%;">
                    <div class="panel panel-default">
                        <div class="panel-heading"><?php $tgl = date("Y-m-d");?>
                            Preview Transaksi | <?php echo date("Y-m-d");?>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="home">

									<?php
	 $qview = mysqli_query($con, "select * from reception where id_customer='$_GET[id]' and lunas='0' and no_nota='$_GET[no_nota]'");
	 $nview = mysqli_num_rows($qview);
	  if ($nview > 0){
	   $to = 0;
	   $no = 1;
	   echo "<table width='100%'>";
		  while ($rview = mysqli_fetch_array($qview)){
			  $no_nota = $rview['no_nota'];
			$diskon = 0;
			$diskon = $rview['diskon'];
			$total = $rview['total_bayar'];
	      ?>
	      <table style="width:100%;">
	         <tr>
	            <?php
	                echo '<td>Nama</td> <td>:</td> <td>'.$rview['nama_customer'].'</td>
					<td rowspan=2 align=right>
					</td>
					</tr>';
	                echo '<tr><td>No Order</td> <td>:</td> <td>'.$rview['no_nota'].'</td>';
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
                                <td></td>
                                
                            </tr>			
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
                                <td><a href="batal_transaksi.php?no_nota=<?php echo $no_nota; ?>&id=<?php echo $data2['item']; ?>"><button type="button" class="btn btn-warning btn-circle"><i class="fa fa-times"></i>
                            </button></a></td>
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
                                <td><a href="batal_transaksi1.php?no_nota=<?php echo $no_nota; ?>&kode=p"><button type="button" class="btn btn-warning btn-circle"><i class="fa fa-times"></i>
                            </button></a></td>
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
                                <td><a href="batal_transaksi1.php?no_nota=<?php echo $no_nota; ?>&kode=p"><button type="button" class="btn btn-warning btn-circle"><i class="fa fa-times"></i>
                            </button></a></td>
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
                                <td><a href="batal_transaksi1.php?no_nota=<?php echo $no_nota; ?>&kode=p"><button type="button" class="btn btn-warning btn-circle"><i class="fa fa-times"></i>
                            </button></a></td>
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
                                <td><a href="batal_transaksi1.php?no_nota=<?php echo $no_nota; ?>&kode=d"><button type="button" class="btn btn-warning btn-circle"><i class="fa fa-times"></i>
                            </button></a></td>
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
                                <td><a href="batal_transaksi1.php?no_nota=<?php echo $no_nota; ?>&kode=ho"><button type="button" class="btn btn-warning btn-circle"><i class="fa fa-times"></i>
                            </button></a></td>
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
                                <td><a href="batal_transaksi1.php?no_nota=<?php echo $no_nota; ?>&kode=h"><button type="button" class="btn btn-warning btn-circle"><i class="fa fa-times"></i>
                            </button></a></td>
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
                                <td><a href="batal_transaksi1.php?no_nota=<?php echo $no_nota; ?>&kode=hp"><button type="button" class="btn btn-warning btn-circle"><i class="fa fa-times"></i>
                            </button></a></td>
                            </tr>			
			<?php		}	?>
      
			<?php
            $qretail = mysqli_query($con, "select * from detail_retail a, retail b where a.item=b.kode and a.no_nota='$no_nota'");
			$nretail = mysqli_num_rows($qretail);
			$totalretail = 0;
			if ($nretail>0){
				$totalretail = 0;
			while ($rretail = mysqli_fetch_array($qretail)){
			?>
							<tr>
                                <td>&nbsp;</td>
                                <td><?php echo $rretail['jumlah']; ?></td>
                                <td><?php echo $rretail['nama_barang']; ?></td>
                                <td>Rp.</td>
                                <td style="text-align:right;"><?php echo number_format($rretail['total'],0,',','.');?>
                                </td>
                                <td><a href="batal_retail.php?id=<?php echo $rretail['id']; ?>"><button type="button" class="btn btn-warning btn-circle"><i class="fa fa-times"></i>
                            </button></a></td>
                            </tr>			
			<?php
			$totalretail = $totalretail+$rretail['total'];
			}
			}
			?>

                        <tr style="font-size:9pt;border-top: 1px dotted #000;width:100%;">
	                            <td></td>
                                <td></td>
                                <td>Diskon</td>
				<td>Rp.</td>
                <td style="text-align:right;">
				<?php
echo str_replace('Rp.','',rupiah($diskon, true));
				?>				</td>
                                                <td width="32"></td>

			</tr>		
			
					<tr>
                                <td>&nbsp;</td>
                                <td style="width:50px;"></td>            
				<td>Total</td>
                                <td>Rp.</td><td style="text-align:right;">
				<?php
				
echo str_replace('Rp.','',rupiah($total+$totalretail, true));
				?>				</td>
                                <td></td>
			</tr>
<?php
	  echo "</table>";
	  }
     }
	  ?>
	                          </div>
                            </div>
                        </div>
                    </div>
                </div>              