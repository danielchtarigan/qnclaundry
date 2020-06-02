<?php
include "../config.php";
?>
<script type="text/javascript">
 function validasi()
    {
        var itemklp=document.forms["form1"]["itemklp"].value;
		if (itemklp==null || itemklp=="")
          {
          alert("Item tidak boleh kosong !");
          return false;
          };
	}
</script>

<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
var htmlobjek;
$(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=propinsi>
  $("#kategori").change(function(){
    var kategori = $("#kategori").val();
    $.ajax({
        url: "ambilkota.php",
        data: "kategori="+kategori,
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=kota>
            $("#itemklp").html(msg);
        }
    });
  });
});

</script>

				<div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Form Kiloan
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="home">
                                        <form action="act_order.php" method="get" onSubmit="return validasi()" id="form1" name="form1">
                                        <input type="hidden" name="jenis" value="potongan" />
                                        <div class="form-group">                                        
                                                <label class="control-label col-xs-3" for="kiloan">
                                                   Kategori
                                                </label>
                                                <div class="col-xs-9" >
                                                 <select name="kategori" class="form-control" id="kategori">
                                                     <option value="6">Clothes</option>
                                                     <option value="9">Karpet</option>
                                                     <option value="8">Gordyn</option>
                                                     <option value="5">Bedding</option>
                                                     <option value="7">Boneka Dll</option>
                                                 </select>
                                                </div><br><br>
                                        </div>
                                        <div class="form-group">                                        
                                                <label class="control-label col-xs-3" for="kiloan">
                                                   Item
                                                </label>
                                                <div class="col-xs-9" >
                                                <?php
                                                if (isset($_GET['status'])){
												?>
                                                <input type="hidden" name="status" value="<?php echo $_GET['status'];?>" />
                                                <?php	
													}
												else{ }											
												?>
                                                 
                                                 <select name="itemklp" class="form-control" id="itemklp">
                                                 	<option value="">Pilih Item</option>
													<?php
        	                                         $qitem = mysqli_query($con, "select * from item_spk where jenis_item='p' and kategory='$kat'");
		  											 while ($ritem = mysqli_fetch_array($qitem)){
                		                            ?>
                                                     <option value="<?php echo $ritem['id']; ?>">
                                                       <?php echo $ritem['nama_item']." - Rp.".$ritem['harga']; ?>
                                                     </option>
												<?php 
												 }
												?>                                                                        
                                                 </select>
                                                </div><br><br>
                                        </div>
                                        <div class="form-group">
                                                <label class="control-label col-xs-3" for="jumlahitem">
                                                        Jumlah
                                                </label>
                                                <div class="col-xs-9" >
                                                        <input type="text" id="jumlah" name="jumlah" class="form-control" placeholder="Jumlah potongan" width="100%" required="required">
                                                </div><br /><br>
                                        </div>
                                        <div class="form-group">
                                                <label class="control-label col-xs-3" for="jumlahitem">
                                                        Ket Item
                                                </label>
                                                <div class="col-xs-9" >
                                                        <input type="text" id="ket1" name="ket1" class="form-control" placeholder="keterangan item" width="100%">
                                                </div><br /><br>
                                        </div>

                                        <div class="form-group just_kiloan">
                                            <label class="control-label col-xs-3">
                                                    Charge
                                            </label>
                                            <div class="col-xs-9" >
                                                <select class="form-control" id="charge" name="charge">
                                                    <option value="0">Pilih charge</option>

													<?php
        	                                         $qitem1 = mysqli_query($con, "select * from item_spk where jenis_item='k' and nama_item like '%express%'");
		  											 while ($ritem1 = mysqli_fetch_array($qitem1)){
                		                            ?>
                                                     <option value="<?php echo $ritem1['id']; ?>">
                                                       <?php echo $ritem1['nama_item']." - Rp.".$ritem1['harga']; ?>
                                                     </option>
												<?php 
												 }
?>                                                                        
                                                </select>                                          
                                            </div>
                                            <br>
                                        </div>
                                    
                                        <br>
                                </fieldset>

                                        <input type="hidden" readonly class="easyui-textbox" name="beratitem" id="beratitem" required />
                                                        <input type="hidden" class="form-control" name="id_cs" id="id_cs" value="<?php echo $r['id'] ?>" />
                                                        <input type="hidden" class="form-control" name="nama_customer" id="nama_customer" value="<?php echo $r['nama_customer'] ?>" />

                                                <div class="form-group">
                                                        <label class="control-label col-xs-3" for="voucher">
                                                                voucher
                                                        </label>
                                                        <div class="col-xs-9" >
                                                                <input autocomplete="off" type="text" class="form-control" name="voucher" id="voucher"  onkeydown="return tabOnEnter(this,event)" />                                                               
                                                                <input type="hidden" class="form-control" autocomplete="off" name="id_cust" id="id_cust" value="<?php echo $r['id']; ?>" />
                                                        </div>
                                                        <span id="pesan">
                                                        </span><br><br>
                                                </div>
                                                <div class="form-group">
                                                        <label class="control-label col-xs-3" for="cabang">
                                                                Lgn/sub
                                                        </label>
                                                        <div class="col-xs-9" >
                                                                <select class="form-control" name="cabang" id="cabang">
                                                                        <option value="">
                                                                                --
                                                                        </option>
<?php
	                                         $qlgn = mysqli_query($con, "select * from qnc_lgn");
											 while ($rlgn = mysqli_fetch_array($qlgn)){
                                              ?>
                                                                        <option value="<?php echo $rlgn['nama_lgn']; ?>">
                                                                           <?php echo $rlgn['keterangan']; ?>
                                                                        </option>
												<?php 
												 }
?>                                                                        



                                                                </select>
                                                        </div><br><br>
                                                </div>

                                                <div class="form-group">
                                                        <label class="control-label col-xs-3" for="ket">
                                                                Keterangan
                                                        </label>
                                                        <div class="col-xs-9" >
                                                                <textarea type="text" class="form-control" name="ket" id="ket">
                                                                </textarea><br>
                                                        </div>
                                                </div>                                
                                        <input type="submit" value="Tambah" name="simpanordersementara" id="simpanordersementara">
                                      </form>

                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>

				<div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading"><?php $tgl = date("Y-m-d");?>
                            Preview Transaksi | <?php echo date("Y-m-d");?>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="home">




									<?php
	 $no_nota = "Tanpa Laundry";
	 $qview = mysqli_query($con, "select * from reception where id_customer='$_GET[id]' and lunas='0' and jenis='p'");
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
					</tr>';
	                echo '<tr><td>No Order</td> <td>:</td> <td>'.$rview['no_nota'].'</td>';
	            ?>
	         </tr>
	    </table>     
		<table style="font-size:9pt;border-top: 1px dotted #000;width:100%;">
			<?php
				$sql2=mysqli_query($con,"SELECT * FROM detail_penjualan a, item_spk b WHERE a.no_nota='$no_nota' and a.item=b.nama_item and b.ket='0' and b.jenis_item='p'");			
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
			$sql2=mysqli_query($con,"SELECT * FROM detail_penjualan a, item_spk b WHERE a.no_nota='$no_nota' and a.item=b.nama_item and b.ket='1' and b.jenis_item='p'");			
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
                       <button type="submit" class="btn btn-default" style="width:100%">Transaksi Retail</button>             
                                    <br />
                                    
<script type="text/javascript">

function startCalculate1(){
interval=setInterval("Calculate1()",10);
}

function Calculate1(){
  var i;
	var a=document.form1.itemretail1.value.substr(5,10);
	var b=document.form1.jumlah1.value;
	document.form1.harga1.value=(a*b);
}

function stopCalc1(){
clearInterval(interval);
}


function startCalculate2(){
interval=setInterval("Calculate2()",10);
}

function Calculate2(){
  var i;
	var a=document.form1.itemretail2.value.substr(5,10);
	var b=document.form1.jumlah2.value;
	document.form1.harga2.value=(a*b);
}

function stopCalc2(){
clearInterval(interval);
}

function startCalculate3(){
interval=setInterval("Calculate3()",10);
}

function Calculate3(){
  var i;
	var a=document.form1.itemretail3.value.substr(5,10);
	var b=document.form1.jumlah3.value;
	document.form1.harga3.value=(a*b);
}

function stopCalc3(){
clearInterval(interval);
}

</script>

<form id="form1" name="form1" method="get" action="act_retail.php">
                                    
<table style="font-size:9pt; width:100%;">
 <tr><td align="center">ITEM RETAIL</td><td align="center">JUMLAH</td><td colspan="2" align="center">HARGA</td></tr>
 <tr>
  <td>
  <input type="hidden" name="no_nota" value="<?php echo $no_nota; ?>" />
  <input type="hidden" name="id_cust" value="<?php echo $_GET['id']; ?>" />
                                                 <select name="itemretail1" class="form-control" onfocus="startCalculate1()" onblur="stopCalc1()">
                                                 	<option value="">Pilih Item Retail</option>
													<?php
        	                                         $qitem = mysqli_query($con, "select * from retail");
		  											 while ($ritem = mysqli_fetch_array($qitem)){
                		                            ?>
                                                     <option value="<?php echo $ritem['kode']."-".$ritem['harga']; ?>">
                                                       <?php echo $ritem['nama_barang']." - Rp.".$ritem['harga']; ?>
                                                     </option>
												<?php 
												 }
?>                                                                        
                                                 </select>
  </td>
  <td><input type="text" value="0" name="jumlah1" id="jumlah1" class="form-control" style="width:40px;" onfocus="startCalculate1()" onblur="stopCalc1()"/></td>
  <td>Rp. </td>
  <td><input type="text" value="0" name="harga1" id="harga1" class="form-control" readonly="readonly"/></td>
 </tr>

 <tr>
  <td>
                                                 <select name="itemretail2" class="form-control" onfocus="startCalculate2()" onblur="stopCalc2()">
                                                 	<option value="">Pilih Item Retail</option>
													<?php
        	                                         $qitem = mysqli_query($con, "select * from retail");
		  											 while ($ritem = mysqli_fetch_array($qitem)){
                		                            ?>
                                                     <option value="<?php echo $ritem['kode']."-".$ritem['harga']; ?>">
                                                       <?php echo $ritem['nama_barang']." - Rp.".$ritem['harga']; ?>
                                                     </option>
												<?php 
												 }
?>                                                                        
                                                 </select>
  </td>
  <td><input type="text" value="0" name="jumlah2" id="jumlah2" class="form-control" style="width:40px;" onfocus="startCalculate2()" onblur="stopCalc2()"/></td>
  <td>Rp. </td>
  <td><input type="text" value="0" name="harga2" id="harga2" class="form-control" readonly="readonly"/></td>
 </tr>

 <tr>
  <td>
                                                 <select name="itemretail3" class="form-control" onfocus="startCalculate3()" onblur="stopCalc3()">
                                                 	<option value="">Pilih Item Retail</option>
													<?php
        	                                         $qitem = mysqli_query($con, "select * from retail");
		  											 while ($ritem = mysqli_fetch_array($qitem)){
                		                            ?>
                                                     <option value="<?php echo $ritem['kode']."-".$ritem['harga']; ?>">
                                                       <?php echo $ritem['nama_barang']." - Rp.".$ritem['harga']; ?>
                                                     </option>
												<?php 
												 }
?>                                                                        
                                                 </select>
  </td>
  <td><input type="text" value="0" name="jumlah3" id="jumlah3" class="form-control" style="width:40px;" onfocus="startCalculate3()" onblur="stopCalc3()"/></td>
  <td>Rp. </td>
  <td><input type="text" value="0" name="harga3" id="harga3" class="form-control" readonly="readonly"/></td>
 </tr>
 <tr>
  <td colspan="4" align="right">&nbsp;</td>
 </tr>
 <tr>
  <td colspan="4" align="right"><input type="submit" value="Simpan" /></td>
 </tr>

</table>
</form>
                                    <br />
                                    <button class="btn btn-lg btn-success pull-right" data-id='0' data-toggle="modal" data-target="#tambah-data"> <i class="icon-plus"></i>Pembayaran</button>
                                    
                          </div>
                            </div>
                        </div>
                    </div>
                </div>
                



<div id="tambah-data" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">

<script type="text/javascript">
function startHitung(){
interval=setInterval("Hitung()",10);
}

function Hitung(){
	var a=document.form2.total1.value;
	var b=document.form2.cash.value;
	var c=document.form2.voucher.value.substr(8,10);
	var d=document.form2.nilaiedc.value;
	document.form2.sisa.value=(a-b-c-d);
}

function stopHitung(){
clearInterval(interval);
}

function edc(){
	document.form2.nilaiedc.readOnly = false;
}
</script>

		<div class="modal-dialog">
		
		<div class="modal-content">

<form name="form2" id="form2" action="act_penjualan.php" method="GET" class="form-horizontal"><br>
<input type="hidden" name="no_nota" value="<?php echo $no_nota; ?>" />
<?php
$tottaaaall = $total+$totalretail
?>
<input type="hidden" name="total" value="<?php echo $tottaaaall;?>" />
<input type="hidden" class="form-control" name="id_cs" id="id_cs" value="<?php echo $r['id'] ?>" />
<h4  align="center"><strong>Formulir Pembayaran</strong></h4>
<table width="90%" align="center">
 <tr>
  <td width="58%"><strong>Total Tagihan</strong></td>
  <td> : </td><td>
  <?php  $tot = $total+$totalretail; ?>
 <input type="text" value="<?php echo $tot; ?>" id="total1" name="total1" class="form-control" style="width:100%" readonly="readonly">
 </td></tr>
 <tr>
  <td width="58%">Pembayaran Cash</td>
  <td width="3%"> : </td>
  <td width="39%" align="right">
   <input type="text" placeholder="0" value="0" id="cash" name="cash" class="form-control" style="width:100%" onfocus="startHitung()" onblur="stopHitung()">
  </td>
 </tr>
 <tr>
  <td>Voucher</td>
  <td> : </td>
  <td align="right">
    <select class="form-control" name="voucher" id="voucher" onfocus="startHitung()" onblur="stopHitung()">
     <option value="0">Pilih Kode Voucher</option>
     <?php
     $qvou = mysqli_query($con, "select * from voucher_rupiah where status='aktif'");
	 while ($rvou = mysqli_fetch_array($qvou)){
	 ?>
	  <option value="<?php echo $rvou['kode_voucher']."-".$rvou['nilai_voucher']; ?>"><?php echo $rvou['kode_voucher']." - Rp. ".$rvou['nilai_voucher']; ?></option>
     <?php
	 }
	 ?>
	</select>
  </td>
 </tr>
 <tr>
  <td>
    <select class="form-control" name="bankedc" id="bankedc" onclick="edc()">
     <option value="">Pilih Mesin EDC</option>
	 <option value="BCA">BCA</option>
	 <option value="Mandiri">Mandiri</option>
	 <option value="BRI">BRI</option>
	</select>
  </td>
  <td> : </td>
  <td align="right">
   <input type="text" placeholder="0" id="nilaiedc" name="nilaiedc" class="form-control" style="width:100%" value="0" onfocus="startHitung()" onblur="stopHitung()" readonly="readonly" ">
  </td>
 </tr>
 <tr>
  <td width="58%"><strong>Sisa Tagihan</strong></td>
  <td> : </td><td>
 <input type="text" value="<?php echo str_replace("Rp."," ",rupiah($total+$totalretail, true)); ?>" id="sisa" name="sisa" class="form-control" style="width:100%" readonly="readonly">
 </td></tr>
 <tr><td colspan="3">&nbsp;</td></tr>
 <tr><td colspan="3" style="text-align:center;"><input type="submit" value="simpan" class="btn btn-lg btn-success pull-right" style="width:100%;"/></td></tr>
</table>
<br />
				</form>
			</div>
		</div>
	</div>                
    <?php
    include "include/daftar_faktur.php";
	?>