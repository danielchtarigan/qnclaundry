<?php
include "header.php";
include "popup.php";
date_default_timezone_set('Asia/Jakarta');
$jam1 = date("Y-m-d");
$id   = $_GET['id'];
$sql  = $con->query("select * from customer WHERE outlet='mojokerto' and id = '$id'");
$r    = $sql->fetch_assoc();
$ot   = $_SESSION['nama_outlet'];
	
$query   = "SELECT max(no_faktur) AS last FROM faktur_penjualan  WHERE nama_outlet='$ot' LIMIT 1";
$hasil   = mysqli_query($con,$query);
$k       = mysqli_fetch_array($hasil);
$no_urut = $k['last'];
// baca nomor urut transaksi dari id transaksi terakhir
//fCDW000001
$terakhir= (int)substr($no_urut, 4, 6);
// nomor urut ditambah 1
$nextNoUrut = $terakhir + 1;

if($ot == "Toddopuli"){
	$char = "FTDL";
}
elseif($ot == "Landak"){
	$char = "FLDK";
}
elseif($ot == "Baruga"){
	$char = "FBRG";
}
elseif($ot == "Cendrawasih"){
	$char = "FCDW";
}
elseif($ot == "BTP"){
	$char = "FBTP";
}
elseif($ot == "DAYA"){
	$char = "FDYA";
}
elseif ($ot=="Boulevard"){
  $char = "FBLV";
}
elseif($ot == "support"){
	$char = "FSPT";
}
elseif($ot == "mojokerto"){
	$char = "FMJK";
}
// membuat format nomor transaksi berikutnya
$nofaktur = $char.sprintf('%06s', $nextNoUrut);
?>                        
						<div class="panel-heading">
                            <p align="center" style="color:#690;"><strong> TRANSAKSI PENJUALAN </strong></p>
                        </div>
                        <div class="panel-body">
                            <div class="row">
								<div class="col-lg-6">
				                    <div class="panel panel-default">
				                        <div class="panel-body">
                                         <h4>Daftar Belanja Anda :</h4>
                                          <?php
											 $id = $_GET['id'];
	                                         $qkeranjang = mysqli_query($con, "select * from reception where id_customer='$id' and lunas='0'");
 											
											 $nkeranjang = mysqli_num_rows($qkeranjang);
											 while ($rkeranjang = mysqli_fetch_array($qkeranjang)){
												?>
                                                <font color="#009900">
                                                <a href="transaksi.php?id=<?php echo $_GET['id'];?>&no_nota=<?php echo $rkeranjang['no_nota']; ?>&jenis=<?php echo $rkeranjang['jenis']; ?>">
												<?php 
												echo $rkeranjang['no_nota'];							 
												?>
                                                </a>
                                                <a href="struk.php?id=<?php echo $_GET['id'];?>&no_nota=<?php echo $rkeranjang['no_nota']; ?>" target="_blank">
                                                 <button type="submit" class="btn btn-default">Cetak</button>
                                                </a>
                                                <a href="batal_order.php?id=<?php echo $_GET['id'];?>&no_nota=<?php echo $rkeranjang['no_nota']; ?>"> 
                                                 <button type=submit class=btn btn-default>Batal</button>
                                                </a>
                                                <br />
												<?php
												 }
												 ?>
                                                 </font>
                                        <br />
				                        </div>
				                        <div class="panel-footer">
                                         <table width="100%">
                                          <tr>
                                           <td align="center"><font color="#009900"><b> Jumlah item<br /> <?php echo $nkeranjang; ?></b></font></td>
                                           <td>
                                           <?php 
										   if (isset($_GET['status'])){
										   ?>
                                        <a href="transaksi.php?id=<?php echo $id; ?>&status=<?php echo $_GET['status']; ?>&selesai=ya">
                                        <input type="button" class="btn btn-success btkiloan" value="Selesai" style="width:100%; background-color:#6C0;"/>
                                        <?php
										   }
										   else{
										   ?>
                                        <a href="transaksi.php?id=<?php echo $id; ?>&selesai=ya">
                                        <input type="button" class="btn btn-success btkiloan" value="Selesai" style="width:100%; background-color:#6C0;"/>
                                        </a>
                                        <?php
										   }
										   ?>

                                           </td>
										   <td align="right">
                                           <?php 
										   if (isset($_GET['status'])){
										   ?>
                                        <a href="transaksi.php?id=<?php echo $id; ?>&status=<?php echo $_GET['status']; ?>">
                                        <input type="button" class="btn btn-success btkiloan" value="New" style="width:100%; background-color:#6C0;"/>
                                        <?php
										   }
										   else{
										   ?>
                                        <a href="transaksi.php?id=<?php echo $id; ?>">
                                        <input type="button" class="btn btn-success btkiloan" value="New" style="width:100%; background-color:#6C0;"/>
                                        <?php
										   }
										   ?>
                                           </td>                                           
                                          </tr>
                                         </table>
                                         
				                        </div>
				                    </div>
				                </div>
								<div class="col-lg-6">
				                    <div class="panel panel-default">
				                        <div class="panel-body">
                                        <?php
										 if (isset($_GET['id'])){
											 $id = $_GET['id'];
	                                         $qcustomer1 = mysqli_query($con, "select * from customer where id='$id'");
											 $rcustomer1 = mysqli_fetch_array($qcustomer1);
										 }
										?>
                                         <table>
                                          <tr>
                                           <td valign="top" colspan="3" align="center"><strong>Customer Information</strong></td>
                                          </tr>
                                          <tr>
                                           <td valign="top"><?php echo $rcustomer1['nama_customer']; ?></td>
                                           <td valign="top"> | </td>
                                           <td valign="top"><?php echo $rcustomer1['no_telp']; ?></td>
                                          </tr>
                                          <tr>
                                           <td valign="top" colspan="3"><?php echo $rcustomer1['alamat']; ?></td>
                                          </tr>
                                         </table>
                                         <br />
                                        <a href="transaksi.php?id=<?php echo $_GET['id']; ?>&menu=ambil">
                                        <input type="button" class="btn btn-success btkiloan" value="Ambil Barang" style="width:49%; background-color:#6C0;"/>
                                        </a>
                                        <a href="transaksi.php?id=<?php echo $id; ?>&jenis=setrika#popup20">
                                        <input type="button" class="btn btn-success btpotongan" value="Order Setrika" style="width:49%; background-color:#6C0;"/>
                                        </a>
                                        <a href="transaksi.php?id=<?php echo $id; ?>&jenis=Kiloan#popup" class="popup-link">
                                        <input type="button" class="btn btn-success btkiloan" value="Order Kiloan" style="width:49%; background-color:#6C0;"/>
                                        </a>
                                        <a href="transaksi.php?id=<?php echo $id; ?>&jenis=Potongan#popup10">
                                        <input type="button" class="btn btn-success btpotongan" value="Order Potongan" style="width:49%; background-color:#6C0;"/>
                                        </a>                                        
										<a href="cari_complain.php" target="_blank">
                                        <input type="button" class="btn btn-success btpotongan" value="Komplain" style="width:49%; background-color:#6C0;"/>
                                        </a>					
                                        
<?php
                                            $rajin = mysqli_query($con, "select * from reception where id_customer='$_GET[id]' and datediff(current_date(),DATE_FORMAT(tgl_ambil, '%Y-%m-%d')) <= 30");
											$rrajin = mysqli_fetch_array($rajin);
											$nrajin = mysqli_num_rows($rajin);
											if ($nrajin>0){
  ?>                                        
                                        <a href="#popupaudit">
                                        <input type="button" class="btn btn-success btpotongan" value="Quality Audit" style="width:49%; background-color:#6C0;"/>
                                        </a>
  <?php
   }
   ?>                                        	                                        
				                        </div>
										
				                    </div>
				                </div>
                            </div>
                        </div>
						
						
						
<?php
 if (isset($_GET['tipe'])){
	$tipe = $_GET['tipe'];
	if ($tipe=="Kiloan"){
//		include "form/kiloan.php";
		}
	else if ($tipe=='potongan'){
//		include "form/potongan.php";
		}
	 }
 else if (isset($_GET['lanjut'])){
		include "form/potongan_lanjut.php";
 }
 else if (isset($_GET['selesai'])){
		include "form/retail.php";
 }
 else if (isset($_GET['no_nota'])){
		include "form/rincian.php";
 }
 else if (isset($_GET['menu'])){
	 $menu = $_GET['menu'];
	 if ($menu=="ambil"){
		include "include/cari_ambil.php";
     }
 }
 else {	 
    include "include/daftar_faktur.php";
	 }
?>

<div class="popup-wrapper" id="popup">
	<div class="popup-container">
                                        <div class="form-group  just_kiloan">
                                            <label class="control-label col-xs-12">
                                              Apakah pakaian anda ada yang luntur?
                                            </label>
                                            <div class="col-xs-12" >
	                                        <a href="transaksi.php?id=<?php echo $_GET['id'];?>&luntur=ya&jenis=Kiloan&nota=<?php echo $nofaktur; ?>#popup9" class="popup-link">
	                                        <input type="button" class="btn btn-success btkiloan" value="Ya" style="width:32%; background-color:#FFF; color:#6C0"/>
	                                        </a>
	                                        <a href="#popup1" class="popup-link">
	                                        <input type="button" class="btn btn-success btpotongan" value="Tidak" style="width:32%; background-color:#FFF; color:#6C0"/>
    	                                    </a>
	                                        <a href="transaksi.php?id=<?php echo $_GET['id'];?>" class="popup-link">
	                                        <input type="button" class="btn btn-success btpotongan" value="Batal" style="width:32%; background-color:#FFF; color:#6C0"/>
	                                        </a>
                                            </div>
                                            <br>
                                            <br>      
		<a class="popup-close" href="transaksi.php?id=<?php echo $_GET['id'];?>"><img src="back.png" />
        </a>
                                      </div>
    </div>
</div>    



<div class="popup-wrapper" id="popup1">
	<div class="popup-container">
                                        <div class="form-group  just_kiloan">
                                            <label class="control-label col-xs-12">
                                              Pisah nota antara warna Terang dan warna Gelap?
                                            </label>
                                            <div class="col-xs-12" >
	                                        <a href="#popup2">
	                                        <input type="button" class="btn btn-success btkiloan" value="Pisah" style="width:33%; background-color:#FFF; color:#6C0"/>
	                                        </a>
	                                        <a href="#popup2" class="popup-link">
	                                        <input type="button" class="btn btn-success btpotongan" value="Tidak" style="width:32%; background-color:#FFF; color:#6C0"/>
	                                        </a>
	                                        <a href="#popup" class="popup-link">
	                                        <input type="button" class="btn btn-success btpotongan" value="Batal" style="width:32%; background-color:#FFF; color:#6C0"/>
	                                        </a>
                                            </div>
                                            <br>
                                            <br>          
		<a class="popup-close" href="#popup"><img src="back.png" />
        </a>
                                        </div>
    </div>
</div>    


<div class="popup-wrapper" id="popup2">
	<div class="popup-container">
                                        <div class="form-group  just_kiloan">
                                            <label class="control-label col-xs-12">
                                              Pastikan tidak ada cucian berbahan sutera, pakaian berenda, bermanik dan cucian cucian yang tidak bisa dicuci di Kiloan!!
                                            </label>
                                            <div class="col-xs-12" >
	                                        <a href="#popup3" class="popup-link">
	                                        <input type="button" class="btn btn-success btpotongan" value="Next" style="width:49%; background-color:#FFF; color:#6C0"/>
	                                        </a>
	                                        <a href="transaksi.php?id=<?php echo $_GET['id'];?>" class="popup-link">
	                                        <input type="button" class="btn btn-success btpotongan" value="Batal" style="width:49%; background-color:#FFF; color:#6C0"/>
	                                        </a>
                                            </div>
                                            <br>
                                            <br>          
                                            <br>          
		<a class="popup-close" href="#popup1"><img src="back.png" />
        </a>
                                       </div>
    </div>
</div>    

<!--
<form action="act_order.php" method="get" onSubmit="return validasi()" id="form1">
-->

<div class="popup-wrapper" id="popup3">
	<div class="popup-container">
                        <div class="panel-heading">
                            Form Kiloan
                        </div>
<script type="text/javascript">
function itemxx(){
	var itemK = document.form1.itemklp.value;	
	var it = itemK.split("-");
	document.form1.harga.value = it[1];
	document.form1.item.value = it[0];
}


function hargayy(){
	var itemK = document.form1.itemklp.value;	
	var it = itemK.split("-");
//	document.form1.harga.value = it[1];
	if (document.form1.harga.value < it[1]){
		alert("Harga dibawah minimum!");
		document.form1.harga.value = it[1];
		}
}

</script>
<form method="get" id="form1" name="form1">
                                        <div class="form-group">
										  <input type="text" name="notanew" id="notanew" value="" class="form-control" placeholder="No Nota (Auto)"/>
									      <br />
                                        <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>" />
                                        <input type="hidden" name="jenis" id="jenis" value="Kiloan" />
                                                <label class="control-label col-xs-3" for="Kiloan">
                                                   Item
                                                </label>
                                                <div class="col-xs-9" >
                                                   <select name="itemklp" id="itemklp" class="form-control" onchange="itemxx()">
                                                     <option value=""></option>
                                                    <?php
                                                    $qitem = mysqli_query($con, "select * from item_spk where jenis_item='k' and nama_item like '%Cuci Kering Setrika%'");
													while($ritem = mysqli_fetch_array($qitem)){													
													?>
                                                     <option value="<?php echo $ritem['nama_item']."-".$ritem['harga_mjkt']; ?>"><?php echo $ritem['nama_item']; ?></option>
                                                    <?php
														
													}
													?>
                                                   </select>
                                                </div><br><br>
                                        </div>
                                        <div class="form-group">
                                                <label class="control-label col-xs-3" for="jumlahitem">
                                                        Harga
                                                </label>
                                                <div class="col-xs-9" >
                                                <input type="hidden" name="item" id="item" class="form-control" placeholder="0" width="100%"/>
                                                <input type="text" id="harga" name="harga" class="form-control" placeholder="0" width="100%" onmousemove="hargayy()">
                                                </div><br /><br>
                                        </div>
                                        <div class="form-group">
                                                <label class="control-label col-xs-3" for="jumlahitem">
                                                        Ket Item
                                                </label>
                                                <div class="col-xs-9" >
                                                        <input type="text" id="ket1" name="ket1" class="form-control" placeholder="keterangan item" width="100%" onfocus="hargayy()">
                                                </div><br /><br>
                                        </div>
                                        <a href="#popup4" class="popup-link">
                                        <input type="button" class="btn btn-success btkiloan" value="Next" style="width:49%; background-color:#FFF; color:#6C0" name="simpanordersementara" id="simpanordersementara"/>
                                        </a>
                                        <a href="transaksi.php?id=<?php echo $_GET['id'];?>" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Batal" style="width:49%; background-color:#FFF; color:#6C0"/>
                                        </a>
        </form>
		<a class="popup-close" href="#popup2"><img src="back.png" />
        </a>
        <br />
    </div>
</div>
<script>
	$("#simpanordersementara").click(function()
		{
			notanew=$("#notanew").val();
			id=$("#id").val();
			jenis=$("#jenis").val();
			item=$("#item").val();                       
			harga=$("#harga").val();                       
			ket1=$("#ket1").val();                                              
			$.ajax(
				{
					url:"act_order_kiloan1_tmp.php",
					data:"notanew="+notanew+"&id="+id+"&jenis="+jenis+"&item="+item+"&harga="+harga+"&ket1="+ket1,
					cache:false,
					success:function(msg)
					{
					}
				})
		})
</script>   



<div class="popup-wrapper" id="popup19">
	<div class="popup-container">
                        <div class="panel-heading">
                            Sub Agen / KOST Exclusive / Tamu Hotel
                        </div>
<form action="" method="get" id="form19" name="form19">
                                        <div class="form-group">
                                        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
                                        <input type="hidden" name="jenis" value="setrika" />
                                                <label class="control-label col-xs-3" for="Kiloan">
                                                   Agen
                                                </label>
                                                <div class="col-xs-9" >
                                                                <select class="form-control" name="cabang" id="cabang">
                                                                        <option value="">--</option>
                                                                        <?php
                                                                        $hotel = mysqli_query($con, "select * from hotel where status='0'");
																		while($rh=mysqli_fetch_array($hotel)){
                                                                        ?>
                                                                        <option value="<?php echo $rh['nama_hotel']; ?>"><?php echo $rh['nama_hotel']; ?></option>
																		<?php
																			}
																		?>
                                                                </select>
                                                </div><br><br>
                                        </div>
                                        <a href="#popup11">
                                       <input type="button" class="btn btn-success btkiloan" value="Next" style="width:49%; background-color:#FFF; color:#6C0" name="simpanagen" id="simpanagen"/>
                                        </a>
                                        <a href="transaksi.php?id=<?php echo $_GET['id'];?>" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Batal" style="width:49%; background-color:#FFF; color:#6C0;" />
                                        </a>
        </form>
		<a class="popup-close" href="#popup7"><img src="back.png" />
        </a>
        <br />
    </div>
</div>

<script>
	$("#simpanagen").click(function()
		{
			id=$("#id").val();
			cabang=$("#cabang").val();
			$.ajax(
				{
					url:"act/act_cabang_tmp.php",
					data:"id="+id+"&cabang="+cabang,
					cache:false,
					success:function(msg)
					{
					}
				})
		})
</script>


<div class="popup-wrapper" id="popup20">
	<div class="popup-container">
                        <div class="panel-heading">
                            Form Setrika
                        </div>
<script type="text/javascript">
function fitem20(){
	var itemK = document.form20.itemklp20.value;	
	var it = itemK.split("-");
	document.form20.harga20.value = it[1];
	document.form20.item20.value = it[0];
}

function fharga20(){
	var itemK = document.form20.itemklp20.value;	
	var it = itemK.split("-");
//	document.form1.harga.value = it[1];
	if (document.form20.harga20.value < it[1]){
		alert("Harga dibawah minimum!"); 	
		document.form20.harga.value = it[1];
		}
}


</script>




<form action="act_order_setrika1.php" method="get" id="form20" name="form20">
                                        <div class="form-group">
										  <input type="text" name="notanew" value="" class="form-control" placeholder="No Nota (Auto)"/>
									      <br />
                                        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
                                        <input type="hidden" name="jenis" value="setrika" />
                                                <label class="control-label col-xs-3" for="Kiloan">
                                                   Item
                                                </label>
                                                <div class="col-xs-9" >
                                                   <select name="itemklp20" id="itemklp20" class="form-control" onchange="fitem20()">
												   <option value=""></option>
                                                    <?php
                                                    $qitem = mysqli_query($con, "select * from item_spk where jenis_item='k' and nama_item like 'Setrika%'");
													while($ritem = mysqli_fetch_array($qitem)){														
													?>
                                                     <option value="<?php echo $ritem['nama_item']."-".$ritem['harga_mjkt']; ?>"><?php echo $ritem['nama_item']; ?></option>
                                                    <?php
														
													}
													?>
                                                   </select>
                                                </div><br><br>
                                        </div>
                                        
										<div class="form-group">
                                                <label class="control-label col-xs-3" for="jumlahitem">
                                                        Harga
                                                </label>
                                                <div class="col-xs-9" >
                                                <input type="hidden" name="item20" id="item20" class="form-control" placeholder="0" width="100%"/>
                                                <input type="text" id="harga20" name="harga20" class="form-control" placeholder="0" width="100%" onmousemove="fharga20()">
                                                </div><br /><br>
                                        </div>
                                        <div class="form-group">
                                                <label class="control-label col-xs-3" for="jumlahitem">
                                                        Ket Item
                                                </label>
                                                <div class="col-xs-9" >
                                                        <input type="text" id="ket20" name="ket20" class="form-control" placeholder="keterangan item" width="100%" onfocus="fharga20()">
                                                </div><br /><br>
                                        </div>
                                        
                                        <a href="#popup4">
                                       <input type="button" class="btn btn-success btkiloan" value="Next" style="width:49%; background-color:#FFF; color:#6C0" name="simpansetrika" id="simpansetrika"/>
                                        </a>
                                        <a href="transaksi.php?id=<?php echo $_GET['id'];?>" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Batal" style="width:49%; background-color:#FFF; color:#6C0;" />
                                        </a>
        </form>
		<a class="popup-close" href="transaksi.php?id=<?php echo $_GET['id'];?>"><img src="back.png" />
        </a>
        <br />
    </div>
</div>    

<script>
	$("#simpansetrika").click(function()
		{
			id=$("#id").val();
			jenis=$("#jenis").val();
			item20=$("#item20").val();                       
			harga20=$("#harga20").val();                       
			ket20=$("#ket20").val();                                              
			$.ajax(
				{
					url:"act_order_kiloan1_tmp.php",
					data:"id="+id+"&jenis="+jenis+"&item="+item20+"&harga="+harga20+"&ket1="+ket20,
					cache:false,
					success:function(msg)
					{
					}
				})
		})
</script>

<div class="popup-wrapper" id="popup21">
	<div class="popup-container">
<form action="act/act_parfum.php" method="get">
<?php
if (isset($_GET['nota'])){
?>
<label class="control-label col-xs-3" for="jumlahitem">
  No. Nota : <?php echo $_GET['nota']; ?>
</label>
<div class="col-xs-9" >
</div><br />
<?php	
}
?>
                                        <div class="form-group  just_kiloan">
                                            <label class="control-label col-xs-12">
                                                    Pilih Parfum (Pilih Salah Satu)
                                            </label>
                                        </div>
                                        <a href="act/act_parfum.php?id=<?php echo $_GET['id'];?>&nota=<?php echo $_GET['nota']; ?>&jenis=setrika&parfum=0" class="popup-link">
                                        <input type="button" class="btn btn-success btkiloan" value="Normal" style="width:24%; background-color:#FFF; color:#6C0"/>
                                        </a>
                                        <a href="act/act_parfum.php?id=<?php echo $_GET['id'];?>&nota=<?php echo $_GET['nota']; ?>&jenis=setrika&parfum=extra" class="popup-link">
                                        <input type="button" class="btn btn-success btkiloan" value="Ekstra" style="width:24%; background-color:#FFF; color:#6C0"/>
                                        </a>
                                        <a href="act/act_parfum.php?id=<?php echo $_GET['id'];?>&nota=<?php echo $_GET['nota']; ?>&jenis=setrika&parfum=no" class="popup-link">
                                        <input type="button" class="btn btn-success btkiloan" value="No Parfum" style="width:24%; background-color:#FFF; color:#6C0"/>
                                        </a>
                                        <a href="batal_order.php?id=<?php echo $_GET['id'];?>&no_nota=<?php  echo $_GET['nota']; ?>" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Batal" style="width:24%; background-color:#FFF; color:#6C0"/>
                                        </a>
</form>
		<a class="popup-close" href="#popup20"><img src="back.png" />
        </a>
<br />
    </div>
</div>    


<div class="popup-wrapper" id="popup4">
	<div class="popup-container">
                                        <div class="form-group  just_kiloan">
                                            <label class="control-label col-xs-12">
                                                    Pilih Parfum (Pilih Salah Satu)
                                            </label>
                                        </div>
                                        <a href="#popup5" class="popup-link">
                                        <input type="button" name="parfum0" id="parfum0" class="btn btn-success btkiloan" value="Normal" style="width:24%; background-color:#FFF; color:#6C0"/>
                                        </a>                                        
                                        <a href="#popup5" class="popup-link">
                                        <input type="button" name="parfumextra" id="parfumextra" class="btn btn-success btkiloan" value="Extra" style="width:24%; background-color:#FFF; color:#6C0"/>
                                        </a>                                        
                                        <a href="#popup5" class="popup-link">
                                        <input type="button" name="parfumno" id="parfumno" class="btn btn-success btkiloan" value="Tanpa Parfum" style="width:24%; background-color:#FFF; color:#6C0"/>
                                        </a>                                        
                                        <a href="batal_order.php?id=<?php echo $_GET['id'];?>&no_nota=<?php  echo $_GET['nota']; ?>" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Batal" style="width:24%; background-color:#FFF; color:#6C0"/>
                                        </a>
                                        <br />

<?php
if ($_GET['jenis']=='Potongan'){
?>
		<a class="popup-close" href="#popup10"><img src="back.png" />
        </a>
<?php	
}
else if ($_GET['jenis']=='setrika'){
?>
		<a class="popup-close" href="#popup20"><img src="back.png" />
        </a>
<?php	
}
else{
?>
		<a class="popup-close" href="#popup3"><img src="back.png" />
        </a>
<?php
}
?>
		<br />
    </div>
</div>    

<script>
	$("#parfum0").click(function()
		{
			id=$("#id").val();
			$.ajax(
				{
					url:"act/act_parfum_tmp.php",
					data:"id="+id+"&parfum=0",
					cache:false,
					success:function(msg)
					{
					}
				})
		})

	$("#parfumextra").click(function()
		{
			id=$("#id").val();
			$.ajax(
				{
					url:"act/act_parfum_tmp.php",
					data:"id="+id+"&parfum=extra",
					cache:false,
					success:function(msg)
					{
					}
				})
		})

	$("#parfumno").click(function()
		{
			id=$("#id").val();
			$.ajax(
				{
					url:"act/act_parfum_tmp.php",
					data:"id="+id+"&parfum=no",
					cache:false,
					success:function(msg)
					{
					}
				})
		})
</script>


<div class="popup-wrapper" id="popup5">
	<div class="popup-container">
<form method="get">
                                        <div class="form-group just_kiloan">
                                            <label class="control-label col-xs-20">
                                                    Pilih Hanger
                                            </label>
                                            <div class="col-xs-20" >
                                                <label><input type="checkbox" id="hanger_own" name="hanger_own"> Hanger Sendiri<br />Hanger yang dibawa sendiri hanya mendapatkan satu plastik hanger per nota. Beli plastik hanger jika membutuhkan plastik tambahan</label>                                          
                                            </div>
                                            <label class="control-label col-xs-4">
                                                    Hanger
                                            </label>
                                            <div class="col-xs-3" >
                                                <input type="text" class="form-control" id="hanger" name="hanger">                                            </div>
                                            <label class="control-label col-xs-4">
                                                    @ Rp. 2.500
                                            </label>
                                                <br /><br />
                                            <label class="control-label col-xs-4">
                                                    Plastik Hanger
                                            </label>
                                            <div class="col-xs-3" >
                                                <input type="text" class="form-control" id="hanger_plastik" name="hanger_plastik">
                                            </div>
                                            <label class="control-label col-xs-4">
                                                    @ Rp. 2.000
                                            </label>
                                            <br><br>
                                        </div>
                                        <a href="#popup8" class="popup-link">
                                        <input type="button" class="btn btn-success btkiloan" value="Next" style="width:49%; background-color:#FFF; color:#6C0" name="buttonhanger" id="buttonhanger"/>
                                        </a>
                                        <a href="batal_order.php?id=<?php echo $_GET['id'];?>&no_nota=<?php  echo $_GET['nota']; ?>" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Batal" style="width:49%; background-color:#FFF; color:#6C0"/>
                                        </a>
</form>
		<a class="popup-close" href="#popup4"><img src="back.png" />
        </a>
<br />
    </div>
</div>    

<script>
	$("#buttonhanger").click(function()
		{
			id=$("#id").val();
			hanger_own = $("#hanger_own").prop('checked');
			hanger=$("#hanger").val();
			hanger_plastik=$("#hanger_plastik").val();
			$.ajax(
				{
					url:"act/act_hanger_tmp.php",
					data:"id="+id+"&hanger_own="+hanger_own+"&hanger="+hanger+"&hanger_plastik="+hanger_plastik,
					cache:false,
					success:function(msg)
					{
					}
				})
		})
</script>

<div class="popup-wrapper" id="popup22">
	<div class="popup-container">
<form action="act/act_hanger.php" method="get">
<?php
if (isset($_GET['nota'])){
?>
<label class="control-label col-xs-20" for="jumlahitem">
  No. Nota : <?php echo $_GET['nota']; ?>
  <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
  <input type="hidden" name="nota" value="<?php echo $_GET['nota']; ?>" />
  <input type="hidden" name="jenis" value="setrika" />
</label>
<?php	
}
?>
                                        <div class="form-group just_kiloan">
                                            <label class="control-label col-xs-20">
                                                    Pilih Hanger
                                            </label>
                                            <div class="col-xs-20" >
                                                <label><input type="checkbox" id="hanger_own" name="hanger_own"> Hanger Sendiri<br />Hanger yang dibawa sendiri hanya mendapatkan satu plastik hanger per nota. Beli plastik hanger jika membutuhkan plastik tambahan</label>                                          
                                            </div>
                                            <label class="control-label col-xs-4">
                                                    Hanger
                                            </label>
                                            <div class="col-xs-3" >
                                                <input type="text" class="form-control" id="hanger" name="hanger">                                            </div>
                                            <label class="control-label col-xs-4">
                                                    @ Rp. 2.500
                                            </label>
                                                <br /><br />
                                            <label class="control-label col-xs-4">
                                                    Plastik Hanger
                                            </label>
                                            <div class="col-xs-3" >
                                                <input type="text" class="form-control" id="hanger_plastik" name="hanger_plastik">
                                            </div>
                                            <label class="control-label col-xs-4">
                                                    @ Rp. 2.000
                                            </label>
                                            <br><br>
                                        </div>
                                        <input type="submit" class="btn btn-success btkiloan" value="Next" style="width:49%; background-color:#FFF; color:#6C0"/>
                                        <a href="batal_order.php?id=<?php echo $_GET['id'];?>&no_nota=<?php  echo $_GET['nota']; ?>" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Batal" style="width:49%; background-color:#FFF; color:#6C0"/>
                                        </a>
</form>
		<a class="popup-close" href="#popup21"><img src="back.png" />
        </a>
<br />
    </div>
</div>    

<!--
<div class="popup-wrapper" id="popup6">
	<div class="popup-container">
                        <div class="panel-heading">
                            Form Kiloan
                        </div>
<form action="act/act_hanger2.php" method="get">
<?php
if (isset($_GET['nota'])){
?>
<label class="control-label col-xs-3" for="jumlahitem">
  No. Nota : <?php echo $_GET['nota']; ?>
  <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
  <input type="hidden" name="nota" value="<?php echo $_GET['nota']; ?>" />
  <input type="hidden" name="jenis" value="<?php echo $_GET['jenis']; ?>" />
</label>
<div class="col-xs-9" >
</div><br><br><br>
<?php	
}
?>
                                        <div class="form-group  just_kiloan">
                                            <label class="control-label col-xs-3">
                                                    Hanger
                                            </label>
                                            <div class="col-xs-3" >
                                                <input type="text" class="form-control" id="hanger" name="hanger">                                            </div><br><br>
                                        </div>
                                        <div class="form-group just_kiloan">
                                            <label class="control-label col-xs-3">
                                                    P.Hanger
                                            </label>
                                            <div class="col-xs-3" >
                                                <input type="text" class="form-control" id="hanger_plastic" name="hanger_plastic">
                                            </div>
                                            <br><br>
                                        </div>
                                        <input type="submit" class="btn btn-success btkiloan" value="Save Nota" style="width:100%; background-color:#FFF; color:#6C0"/>
</form>
		
    </div>
</div>    
-->
<div class="popup-wrapper" id="popup7">
	<div class="popup-container">
                        <div class="panel-heading">
                            Pilih Delivery
                        </div>
                                        <a href="#popup19" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Diantar" style="width:32%; background-color:#FFF; color:#6C0" name="deliverOn" id="deliverOn"/>
                                        </a>
                                        <a href="#popup19" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Ambil Sendiri" style="width:32%; background-color:#FFF; color:#6C0" name="deliverOff" id="deliverOff"/>
                                        </a>
                                        <a href="batal_order.php?id=<?php echo $_GET['id'];?>&no_nota=<?php  echo $_GET['nota']; ?>" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Batal" style="width:32%; background-color:#FFF; color:#6C0"/>
                                        </a>
<br />
		<a class="popup-close" href="#popup8"><img src="back.png" />
        </a>
<br />
    </div>
</div>    

<script>
	$("#deliverOn").click(function()
		{
			id=$("#id").val();
			$.ajax(
				{
					url:"act/act_delivery_tmp.php",
					data:"id="+id+"&deliver=on",
					cache:false,
					success:function(msg)
					{
					}
				})
		})

	$("#deliverOff").click(function()
		{
			id=$("#id").val();
			$.ajax(
				{
					url:"act/act_delivery_tmp.php",
					data:"id="+id+"&deliver=off",
					cache:false,
					success:function(msg)
					{
					}
				})
		})
</script>


<div class="popup-wrapper" id="popup8">
	<div class="popup-container">
                        <div class="panel-heading">
                            Pilih Express
                        </div>
                                        <div class="form-group just_kiloan">
                                        <a href="#popup7" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Normal" style="width:15%; background-color:#FFF; color:#6C0" name="express0" id="express0"/>
                                        </a>
                                        <a href="#popup7" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Express (+ Rp. 15.000)" style="width:35%; background-color:#FFF; color:#6C0" name="express191" id="express191"/>
                                        </a>
                                        <a href="#popup7" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Double Express (+ Rp. 30.000)" style="width:45%; background-color:#FFF; color:#6C0" name="express192" id="express192"/>
                                        </a>
                                        <a href="#popup7" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Super Express (+ Rp. 45.000)" style="width:45%; background-color:#FFF; color:#6C0" name="express193" id="express193"/>
                                        </a>

                                        <a href="batal_order.php?id=<?php echo $_GET['id'];?>&no_nota=<?php  echo $_GET['nota']; ?>" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Batal" style="width:25%; background-color:#FFF; color:#6C0"/>
                                        </a>
<br />
<?php
if ($_GET['jenis']=='Potongan'){
?>
		<a class="popup-close" href="#popup4"><img src="back.png" />
        </a>
<?php	
}
else if ($_GET['jenis']=='setrika'){
?>
		<a class="popup-close" href="#popup22"><img src="back.png" />
        </a>
<?php	
}
else{
?>
		<a class="popup-close" href="#popup5"><img src="back.png" />
        </a>
<?php
}
?>
</div>
    </div>
</div>    


<script>
	$("#express0").click(function()
		{
			id=$("#id").val();
			$.ajax(
				{
					url:"act/act_charge_tmp.php",
					data:"id="+id+"&charge=0",
					cache:false,
					success:function(msg)
					{
					}
				})
		})

	$("#express191").click(function()
		{
			id=$("#id").val();
			$.ajax(
				{
					url:"act/act_charge_tmp.php",
					data:"id="+id+"&charge=191",
					cache:false,
					success:function(msg)
					{
					}
				})
		})

	$("#express192").click(function()
		{
			id=$("#id").val();
			$.ajax(
				{
					url:"act/act_charge_tmp.php",
					data:"id="+id+"&charge=192",
					cache:false,
					success:function(msg)
					{
					}
				})
		})

	$("#express193").click(function()
		{
			id=$("#id").val();
			$.ajax(
				{
					url:"act/act_charge_tmp.php",
					data:"id="+id+"&charge=193",
					cache:false,
					success:function(msg)
					{
					}
				})
		})
</script>


<div class="popup-wrapper" id="popup9">
	<div class="popup-container">
                                        <div class="form-group just_kiloan">
                                            <label class="control-label col-xs-12">
                                                    Apakah anda ingin memisahkan nota atau potongan?
                                            </label>                                         
                                            <div class="col-xs-12">
                                        	<a href="#popup2">
	                                        <input type="button" class="btn btn-success btkiloan" value="Pisah Nota" style="width:49%; background-color:#FFF; color:#6C0;"/>
	                                        </a>
	                                        <a href="transaksi.php?id=<?php echo $_GET['id'];?>&jenis=Potongan#popup10" class="popup-link">
    	                                    <input type="button" class="btn btn-success btpotongan" value="Potongan" style="width:49%; background-color:#FFF; color:#6C0"/>
        	                                </a>                                            
                                            </div>
                                            <br><br><br>
                                        </div>
		<a class="popup-close" href="#closed">X</a>
    </div>
</div>    

<script type="text/javascript">
function fitem10(){
	var item10 = document.form10.itemklp10.value;	
	var it10 = item10.split("-");
	document.form10.harga10.value = it10[1];
	document.form10.item10.value = it10[0];
}

function fharga10(){
	var item10 = document.form10.itemklp10.value;	
	var it10 = item10.split("-");
	if (document.form10.harga10.value < it10[1]){
		alert("Harga dibawah minimal!");
		document.form10.harga10.value = it10[1];	
	}
}

function fitem102(){
	var item102 = document.form102.itemklp102.value;	
	var it102 = item102.split("-");
	document.form102.harga102.value = it102[1];
	document.form102.item102.value = it102[0];
}

function fharga10(){
	var item10 = document.form10.itemklp10.value;	
	var it10 = item10.split("-");
	if (document.form10.harga10.value < it10[1]){
		alert("Harga dibawah minimal!");
		document.form10.harga10.value = it10[1];	
	}
}


</script>

<div class="popup-wrapper" id="popup10">
	<div class="popup-container">
                        <div class="panel-heading">
                            <b>FORM POTONGAN</b>
                        </div>
							<div id="pilihan_potongan">
							 <?php include "include/pilihan_potongan.php"; ?>
							</div>
							<div id="rincianpotongan">
							 <?php
							  include "include/rincian_potongan.php";
							 ?>							 
                            </div>
							
<a href="#popup4" class="popup-link">
<input type="button" class="btn btn-success btkiloan" value="Save Potongan" style="width:32%; background-color:#FFF; color:#6C0;"/>
</a>  
<br />
		<a class="popup-close" href=""><img src="back.png" />
        </a>
		<br>

										
		
    </div>
</div>  


<script>
/*
var auto_refresh = setInterval(
    function () {
       $("#rincianpotongan").load("include/rincian_potongan2.php?id="+id).fadeIn("slow");       	   
    }, 10); // refresh setiap 100 milliseconds
*/
	$("#buttonpotongan").click(function()
		{
			notanew10=$("#notanew10").val();
			id=$("#id").val();
			jenis=$("#jenis").val();
			item10=$("#item10").val();                       
			harga10=$("#harga10").val();                       
			jumlah10=$("#jumlah10").val();                       
			ket10=$("#ket10").val(); 
			$.ajax(
				{
					url:"act_order_potongan_lanjutan1_tmp.php",
					data:"notanew="+notanew10+"&id="+id+"&jenis="+jenis+"&item="+item10+"&harga="+harga10+"&jumlah="+jumlah10+"&ket1="+ket10,
					cache:false,
					success:function(data)
					{
						$("#pilihan_potongan").load("include/pilihan_potongan2.php?id="+id);			
						$("#rincianpotongan").load("include/rincian_potongan2.php?id="+id);			
					}
				});									
		})
		
	$("#buttonpotongan2").click(function()
		{
			notanew10=$("#notanew10").val();
			id=$("#id").val();
			jenis=$("#jenis").val();
			item10=$("#item10").val();                       
			harga10=$("#harga10").val();                       
			jumlah10=$("#jumlah10").val();                       
			ket10=$("#ket10").val(); 
			$.ajax(
				{
					url:"act_order_potongan_lanjutan1_tmp.php",
					data:"notanew="+notanew10+"&id="+id+"&jenis="+jenis+"&item="+item10+"&harga="+harga10+"&jumlah="+jumlah10+"&ket1="+ket10,
					cache:false,
					success:function(data)
					{
						
					}
				});									
		})
				
</script>
      

<div class="popup-wrapper" id="popup11">
	<div class="popup-container">
                        <div class="panel-heading">
                          Voucher
                        </div>
<form method="get" action="act_voucher_tmp.php">
  <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
  <input type="hidden" name="jenis" value="<?php echo $_GET['jenis']; ?>" />
                                                <div class="form-group">
                                                        <label class="control-label col-xs-3" for="voucher">
                                                                Kode Voucher
                                                        </label>
                                                        <div class="col-xs-9" >
                                                                <input autocomplete="off" type="text" class="form-control" name="voucher" id="voucher"  onkeydown="return tabOnEnter(this,event)" />                                                        </div>
                                                        <span id="pesan">
                                                        </span><br><br>
                                                </div>

                                        <input type="submit" class="btn btn-success btkiloan" value="Preview" style="width:49%; background-color:#FFF; color:#6C0;"/>
                                        <a href="batal_order.php?id=<?php echo $_GET['id'];?>&no_nota=<?php  echo $_GET['nota']; ?>" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Batal" style="width:49%; background-color:#FFF; color:#6C0"/>
                                        </a>
										</form>
<br />
		<a class="popup-close" href="#popup19"><img src="back.png" />
        </a>
<br />
    </div>
</div>    


<div class="popup-wrapper" id="popupaudit">
	<div class="popup-container">
                        <div class="panel-heading" align="center">
                          <strong>QUALITY AUDIT</strong>
                        </div>
<form method="get" action="act_quality_audit.php">
  <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
  <?php
   $audit = mysqli_query($con, "select * from reception where id_customer='$_GET[id]' and ambil='1' order by id desc limit 0,1");
   $raudit = mysqli_fetch_array($audit);
  ?>
                                                <div class="form-group">
                                                        <label class="control-label col-xs-4" for="voucher">
                                                                Nama Customer
                                                        </label>
                                                        <div class="col-xs-6" >
                                                                <input type="text" class="form-control" name="nama_customer" id="nama_customer" value="<?php echo $raudit['nama_customer']; ?>" readonly="readonly"/>                                                       
                                                                 </div>
                                                        
                                                </div>
                                                <div class="form-group">
                                                        <label class="control-label col-xs-4" for="voucher">
                                                                No Nota
                                                        </label>
                                                        <div class="col-xs-6" >
                                                                <input type="text" class="form-control" name="no_nota" id="no_nota" value="<?php echo $raudit['no_nota']; ?>" readonly="readonly"/>                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                        <label class="control-label col-xs-4" for="voucher">
                                                                Tanggal Ambil
                                                        </label>
                                                        <div class="col-xs-6" >
                                                                <input type="text" class="form-control" name="tgl_ambil" id="tgl_ambil" value="<?php echo $raudit['tgl_ambil']; ?>" readonly="readonly"/>                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                        <label class="control-label col-xs-4" for="voucher">
                                                                Kebersihan
                                                        </label>
                                                        <div class="col-xs-6" for="voucher" >
                                                             <input type="radio" value="1" name="kebersihan" id="kebersihan" checked="checked"/> 1
                                                             <input type="radio" value="2" name="kebersihan" id="kebersihan"/> 2
                                                             <input type="radio" value="3" name="kebersihan" id="kebersihan"/> 3
                                                             <input type="radio" value="4" name="kebersihan" id="kebersihan"/> 4
                                                             <input type="radio" value="5" name="kebersihan" id="kebersihan"/> 5
                                                         <br /><br />
                                                         </div>
                                                </div>
                                                <div class="form-group">
                                                        <label class="col-xs-4" for="voucher">
                                                                Keharuman
                                                        </label>
                                                        <div class="control-label col-xs-6" for="voucher" >
                                                                <input type="radio" value="1" name="keharuman" id="keharuman" checked="checked"/> 1
                                                                <input type="radio" value="2" name="keharuman" id="keharuman"/> 2
                                                                <input type="radio" value="3" name="keharuman" id="keharuman"/> 3
                                                                <input type="radio" value="4" name="keharuman" id="keharuman"/> 4
                                                                <input type="radio" value="5" name="keharuman" id="keharuman"/> 5
                                                         <br /><br />
                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                        <label class="control-label col-xs-4" for="voucher">
                                                                Kerapian
                                                        </label>
                                                        <div class="col-xs-6" >
                                                                <input type="radio" value="1" name="kerapian" id="kerapian" checked="checked"/> 1
                                                                <input type="radio" value="2" name="kerapian" id="kerapian"/> 2
                                                                <input type="radio" value="3" name="kerapian" id="kerapian"/> 3
                                                                <input type="radio" value="4" name="kerapian" id="kerapian"/> 4
                                                                <input type="radio" value="5" name="kerapian" id="kerapian"/> 5
                                                         <br /><br />
                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                        <label class="control-label col-xs-4" for="voucher">
                                                                Ketepatan Waktu
                                                        </label>
                                                        <div class="col-xs-6" >
                                                                <input type="radio" value="Ya" name="waktu" id="waktu" checked="checked"/> Ya
                                                                <input type="radio" value="Tidak" name="waktu" id="waktu"/> Tidak
                                                         <br /><br />
                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                        <label class="control-label col-xs-4" for="voucher">
                                                                Ketepatan Jumlah
                                                        </label>
                                                        <div class="col-xs-6" >
                                                                <input type="radio" value="Ya" name="jumlah" id="jumlah" checked="checked"/> Ya
                                                                <input type="radio" value="Tidak" name="jumlah" id="jumlah"/> Tidak
                                                         <br /><br />
                                                        </div>
                                                </div>
                                                <br /><br />
                                                <div class="form-group">
                                                        <label class="control-label col-xs-4">
                                                                Kritik dan Saran
                                                        </label>
                                                        <div class="control-label col-xs-6">
                                                                <textarea name="kritik" id="kritik" class="form-control"></textarea>
                                                         <br />
                                                        </div>
                                                </div>
                                                <br /><br />

                                        <input type="submit" class="btn btn-success btkiloan" value="Simpan" style="width:49%; background-color:#FFF; color:#6C0;"/>
                                        <a href="#" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Batal" style="width:49%; background-color:#FFF; color:#6C0"/>
                                        </a>
										</form>
    </div>
</div>    

<div class="popup-wrapper" id="popup12">
	<div class="popup-container">
                        
<?php
if (isset($_GET['nota'])){
?>
<label class="control-label col-xs-3" for="jumlahitem">
  <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
</label>
<div class="col-xs-9" >
</div>
<?php	
}
$qcustomer = mysqli_query($con, "select * from customer where id='$_GET[id]'");
$rcustomer = mysqli_fetch_array($qcustomer);
$nama_customer = $rcustomer['nama_customer'];
$qtmp = mysqli_query($con, "select * from order_tmp where id_customer='$_GET[id]'");
$ntmp = mysqli_num_rows($qtmp);
if($ntmp<1){
	$qtmp = mysqli_query($con, "select * from order_potongan_tmp where id_customer='$_GET[id]'");
}
$rtmp = mysqli_fetch_array($qtmp);
$no_nota = $rtmp['no_nota'];
?>                                
	      <table style="width:100%;">
	         <tr>
	            <?php
	                echo '<td>Nama</td> <td>:</td> <td>'.$nama_customer.'</td>
					<td rowspan=2 align=right>
					</td>
					</tr>';
	                echo '<tr><td>No Order</td> <td>:</td> <td>'.$no_nota.'</td>';
	            ?>
	         </tr>
     	  </table>     
<?php
	 $qview = mysqli_query($con, "select * from reception where id_customer='$id' and lunas='0' and no_nota='$no_nota'");
	 $nview = mysqli_num_rows($qview);
	  if ($nview > 0){
	   $to = 0;
	   $no = 1;
	   echo "<table width='100%'>";
		  while ($rview = mysqli_fetch_array($qview)){
	      ?>
		<table style="font-size:9pt;border-top: 1px dotted #000;width:100%;">
			<?php

			$diskon = 0;
			$sdiskon=mysqli_query($con,"SELECT sum(total) as totaldisk FROM detail_penjualan WHERE no_nota='$no_nota' and item like '%Voucher%'");			
			$rdiskon = mysqli_fetch_array($sdiskon);
			$diskon = $rdiskon['totaldisk'];
				
				$totalall = 0;
				$sql2=mysqli_query($con,"SELECT * FROM detail_penjualan a, item_spk b WHERE a.no_nota='$no_nota' and a.item=b.nama_item and b.ket='0' and item not like '%Voucher%'");			
				while ($data2 = mysqli_fetch_array($sql2)){
                            ?>
							<tr>
                                <td><?php echo $data2['jumlah'];?></td>
                                <td colspan="2"><?php echo ucwords($data2['item']);?></td>
                                <td>Rp.</td>
                                <td style="text-align:right;"><?php echo number_format($data2['total'],0,',','.');?>
                                </td>
                                <td><a href="batal_transaksi.php?no_nota=<?php echo $no_nota; ?>&id=<?php echo $data2['item']; ?>"><button type="button" class="btn btn-warning btn-circle"><i class="fa fa-times"></i>
                            </button></a></td>                                
                            </tr>			
			<?php
			$total =  $data2['total'];
			$totalall = $totalall+$total;
			}
			$sql2=mysqli_query($con,"SELECT * FROM detail_penjualan a, item_spk b WHERE a.no_nota='$no_nota' and a.item=b.nama_item and b.ket='1'");			
			$totalexpress = 0;
			while ($data2 = mysqli_fetch_array($sql2)){
                            ?>
							<tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><a href="#popup8"><?php echo ucwords($data2['item']);?></a></td>
                                <td>Rp.</td>
                                <td style="text-align:right;"><?php echo number_format($data2['total'],0,',','.');?>
                                </td>
                                <td><a href="batal_transaksi.php?no_nota=<?php echo $no_nota; ?>&id=<?php echo $data2['item']; ?>"><button type="button" class="btn btn-warning btn-circle"><i class="fa fa-times"></i>
                            </button></a></td>
                            </tr>			
<?php
			$totalexpress = $totalexpress+$data2['total'];
			}
			$sql2=mysqli_query($con,"SELECT * FROM cris_icon_details WHERE id_reception='$no_nota'");			
			$data2 = mysqli_fetch_array($sql2);
			if ($data2['parfum']=='extra'){
                            ?>
							<tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><a href="#popup5">Ekstra Parfum</a></td>
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
                                <td><a href="#popup5">Tanpa Parfum</a></td>
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
                                <td><a href="#popup4">Parfum Normal</a></td>
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
                                <td><a href="#popup5">Hanger Own</a></td>
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
                                <td><a href="#popup5">Hanger</a></td>
                                <td>Rp.</td>
                                <td style="text-align:right;"><?php echo number_format($data2['hanger']*2500,0,',','.');
								$totalall = $totalall+($data2['hanger']*2500);
								?>
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
                                <td><a href="#popup5">Hanger Plastik</a></td>
                                <td>Rp.</td>
                                <td style="text-align:right;"><?php echo number_format($data2['hanger_plastic']*2000,0,',','.');
								$totalall = $totalall+($data2['hanger_plastic']*2000);
								?>
                                </td>
                                <td><a href="batal_transaksi1.php?no_nota=<?php echo $no_nota; ?>&kode=hp"><button type="button" class="btn btn-warning btn-circle"><i class="fa fa-times"></i>
                            </button></a></td>
                            </tr>			
			<?php		}	
      

				$sql2=mysqli_query($con,"SELECT * FROM detail_penjualan  WHERE no_nota='$no_nota' and item like '%Voucher%'");			
				while ($data2 = mysqli_fetch_array($sql2)){
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
                                <td><a href="batal_transaksi.php?no_nota=<?php echo $no_nota; ?>&id=<?php echo $data2['item']; ?>"><button type="button" class="btn btn-warning btn-circle"><i class="fa fa-times"></i>
                            </button></a></td>

			</tr>		
            <?php
				}
				?>
			
					<tr>
                                <td>&nbsp;</td>
                                <td style="width:50px;"></td>            
				<td>Total</td>
                                <td>Rp.</td><td style="text-align:right;">
				<?php
				$totalall = $totalall+$totalexpress-$diskon;
				if ($totalall<0){
				$totalall = 0;
				}
				$uptotal = mysqli_query($con, "update reception set total_bayar='$totalall', diskon='$diskon' where no_nota='$no_nota'");
echo str_replace('Rp.','',rupiah($totalall, true));
				?>				</td>
                                <td></td>
			</tr>
<?php
	  echo "</table>";
	  }
     }
	  ?>
                                        <a href="transaksi.php?id=<?php echo $_GET['id'];?>" onclick="window.open('struk.php?id=<?php echo $_GET['id'];?>&no_nota=<?php  echo $no_nota; ?>')">
                                        <input type="button" class="btn btn-success btpotongan" value="Simpan" style="width:49%; background-color:#FFF; color:#6C0"/>
                                        </a>
                                        <a href="batal_order.php?id=<?php echo $_GET['id'];?>&no_nota=<?php  echo $no_nota; ?>" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Batal" style="width:49%; background-color:#FFF; color:#6C0"/>
                                        </a>                                     
		
<br/>
		<a class="popup-close" href="#popup11"><img src="back.png" />
        </a>
<br/>
    </div>
</div> 

