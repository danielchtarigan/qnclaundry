<?php
include "popup.php";
$jam1 = date("Y-m-d");
$id   = $_GET['id'];
$sql  = $con->query("select * from customer WHERE id = '$id'");
$r    = $sql->fetch_assoc();
$ot   = $_SESSION['nama_outlet'];
	if($r['member'] == '1' && $r['tgl_akhir'] >= $jam1  ){
			$mb = "1";
			$kl = "0.00004";
			$status="member";
		}   
		else
		{
			$mb = "0";
			$kl = "0";
		}
		if($r['lgn'] == '1'){
			$lg         = "1";
			$sisa_kuota = $r['sisa_kuota'];
		}
		else
		{
			$lg         = "0";
			$sisa_kuota = "";
		}
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
elseif($ot == "support"){
	$char = "FSPT";
}elseif($ot == "mojokerto"){
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
                                                <a href="index.php?id=<?php echo $_GET['id'];?>&no_nota=<?php echo $rkeranjang['no_nota']; ?>&jenis=<?php echo $rkeranjang['jenis']; ?>">
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
                                        <a href="index.php?id=<?php echo $id; ?>&status=<?php echo $_GET['status']; ?>&selesai=ya">
                                        <input type="button" class="btn btn-success btkiloan" value="Selesai" style="width:100%; background-color:#6C0;"/>
                                        <?php
										   }
										   else{
										   ?>
                                        <a href="index.php?id=<?php echo $id; ?>&selesai=ya">
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
                                        <a href="index.php?id=<?php echo $id; ?>&status=<?php echo $_GET['status']; ?>">
                                        <input type="button" class="btn btn-success btkiloan" value="New" style="width:100%; background-color:#6C0;"/>
                                        <?php
										   }
										   else{
										   ?>
                                        <a href="index.php?id=<?php echo $id; ?>">
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
                                        <a href="index.php?id=<?php echo $_GET['id']; ?>&menu=ambil">
                                        <input type="button" class="btn btn-success btkiloan" value="Ambil Barang" style="width:49%; background-color:#6C0;"/>
                                        </a>
                                        <a href="cari_complain.php" target="_blank">
                                        <input type="button" class="btn btn-success btpotongan" value="Komplain" style="width:49%; background-color:#6C0;"/>
                                        </a>
                                        <a href="index.php?id=<?php echo $id; ?>&jenis=Kiloan#popup" class="popup-link">
                                        <input type="button" class="btn btn-success btkiloan" value="Kiloan" style="width:49%; background-color:#6C0;"/>
                                        </a>
                                        <a href="index.php?id=<?php echo $id; ?>&jenis=Potongan#popup10">
                                        <input type="button" class="btn btn-success btpotongan" value="Potongan" style="width:49%; background-color:#6C0;"/>
                                        </a>
                                        <a href="index.php?id=<?php echo $id; ?>&jenis=setrika#popup20">
                                        <input type="button" class="btn btn-success btpotongan" value="Setrika" style="width:49%; background-color:#6C0;"/>
                                        </a>
                                        <?php
											$cek = mysqli_query($con, "select * from customer where id='$_GET[id]'");											
											$rsql = mysqli_fetch_array($cek);
											if (($rsql['member']==1) and ($rsql['lgn']==1)){
											 echo "Member : ".$rsql['jenis_member']."<br>";
											 echo "Tanggal Join : ".$rsql['tgl_join']."<br>";
											 echo "Tanggal Akhir : ".$rsql['tgl_akhir']."<br>";
											 echo "Jumlah POIN : ".$rsql['poin']." POIN<br><br>";
											 echo "Langganan<br>";
											 echo "Sisa Kuota : ".rupiah($rsql['sisa_kuota'])."<br>";
	                                         ?>
	                                         <a href="index.php?id=<?php echo $id; ?>&tipe=deposit" class="btn btn-success btdeposit" name="btdeposit" id="btdeposit" style="width:100%;">
	                                                Deposit Langganan
	                                         </a>
                                            <?php
											}
											else if ($rsql['member']==1){
											 echo "Member : ".$rsql['jenis_member']."<br>";
											 echo "Tanggal Join : ".$rsql['tgl_join']."<br>";
											 echo "Tanggal Akhir : ".$rsql['tgl_akhir']."<br>";
											 echo "Jumlah POIN : ".$rsql['poin']." POIN<br><br>";
											}
											else if ($rsql['lgn']==1){
											 echo "Langganan<br>";
											 echo "Sisa Kuota : ".rupiah($rsql['sisa_kuota'])."<br>";
	                                         ?>
	                                         <a href="index.php?id=<?php echo $id; ?>&tipe=deposit" class="btn btn-success btdeposit" name="btdeposit" id="btdeposit" style="width:100%;">
	                                                Deposit Langganan
	                                         </a>
											 <?php	 
											}
											else {
												echo "<b>Ket : Bukan Langganan / Member</b>";
												}
												$tgl = date('Y-m-d');
												if (isset($_GET['nota'])){
												 $nota = $_GET['nota'];
												}
												$id = $_GET['id'];
												if (isset($_GET['luntur'])){
												$qquery = mysqli_query($con, "delete from order_tmp where id_customer='$id'");
												$qquery = mysqli_query($con, "insert into order_tmp (id, tgl, no_nota, id_customer) values ('', '$tgl', '$nota', '$id')");
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
	else if ($tipe=='deposit'){
		include "form/deposit.php";
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
	                                        <a href="index.php?id=<?php echo $_GET['id'];?>&luntur=ya&jenis=Kiloan&nota=<?php echo $nofaktur; ?>#popup9" class="popup-link">
	                                        <input type="button" class="btn btn-success btkiloan" value="Ya" style="width:32%; background-color:#FFF; color:#6C0"/>
	                                        </a>
	                                        <a href="#popup1" class="popup-link">
	                                        <input type="button" class="btn btn-success btpotongan" value="Tidak" style="width:32%; background-color:#FFF; color:#6C0"/>
    	                                    </a>
	                                        <a href="index.php?id=<?php echo $_GET['id'];?>" class="popup-link">
	                                        <input type="button" class="btn btn-success btpotongan" value="Batal" style="width:32%; background-color:#FFF; color:#6C0"/>
	                                        </a>
                                            </div>
                                            <br>
                                            <br>      
		<a class="popup-close" href="index.php?id=<?php echo $_GET['id'];?>"><img src="back.png" />
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
	                                        <a href="index.php?id=<?php echo $_GET['id'];?>" class="popup-link">
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
														if ($status=="member"){
													?>
                                                     <option value="<?php echo $ritem['nama_item']."-".$ritem['disk']; ?>"><?php echo $ritem['nama_item']; ?></option>
                                                    <?php
														}
														else{
													?>
                                                     <option value="<?php echo $ritem['nama_item']."-".$ritem['harga']; ?>"><?php echo $ritem['nama_item']; ?></option>
                                                    <?php
														}
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
                                        <a href="index.php?id=<?php echo $_GET['id'];?>" class="popup-link">
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



<div class="popup-wrapper" id="popup20">
	<div class="popup-container">
                        <div class="panel-heading">
                            Form Setrika
                        </div>
<script type="text/javascript">
function itemyy(){
	var itemK = document.form20.itemklp.value;	
	var it = itemK.split("-");
	document.form20.harga.value = it[1];
	document.form20.item.value = it[0];
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
                                                   <select name="itemklp" id="itemklp" class="form-control" onchange="itemyy()">
                                                    <?php
                                                    $qitem = mysqli_query($con, "select * from item_spk where jenis_item='k' and nama_item like 'Setrika%'");
													while($ritem = mysqli_fetch_array($qitem)){
														if ($status=="member"){
													?>
                                                     <option value="<?php echo $ritem['nama_item']."-".$ritem['disk']; ?>"><?php echo $ritem['nama_item']; ?></option>
                                                    <?php
														}
														else{
													?>
                                                     <option value="<?php echo $ritem['nama_item']."-".$ritem['harga']; ?>"><?php echo $ritem['nama_item']; ?></option>
                                                    <?php
														}
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
                                                <input type="hidden" name="item" id="item"/>
                                                <input type="text" id="harga" name="harga" class="form-control" placeholder="0" width="100%">
                                                </div><br /><br>
                                        </div>
                                        <div class="form-group">
                                                <label class="control-label col-xs-3" for="jumlahitem">
                                                        Ket Item
                                                </label>
                                                <div class="col-xs-9" >
                                                        <input type="text" id="ket1" name="ket1" class="form-control" placeholder="keterangan item" width="100%">
                                                </div><br /><br />
                                        </div>
                                       <input type="submit" class="btn btn-success btkiloan" value="Next" style="width:49%; background-color:#FFF; color:#6C0"/>
                                        <a href="index.php?id=<?php echo $_GET['id'];?>" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Batal" style="width:49%; background-color:#FFF; color:#6C0"/>
                                        </a>
        </form>
		<a class="popup-close" href="index.php?id=<?php echo $_GET['id'];?>"><img src="back.png" />
        </a>
        <br />
    </div>
</div>    


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
                                        <a href="act/act_parfum.php?id=<?php echo $_GET['id'];?>&nota=<?php echo $_GET['nota']; ?>&jenis=<?php echo $_GET['jenis']; ?>&parfum=0" class="popup-link">
                                        <input type="button" class="btn btn-success btkiloan" value="Normal" style="width:24%; background-color:#FFF; color:#6C0"/>
                                        </a>
                                        <a href="act/act_parfum.php?id=<?php echo $_GET['id'];?>&nota=<?php echo $_GET['nota']; ?>&jenis=<?php echo $_GET['jenis']; ?>&parfum=extra" class="popup-link">
                                        <input type="button" class="btn btn-success btkiloan" value="Ekstra" style="width:24%; background-color:#FFF; color:#6C0"/>
                                        </a>
                                        <a href="act/act_parfum.php?id=<?php echo $_GET['id'];?>&nota=<?php echo $_GET['nota']; ?>&jenis=<?php echo $_GET['jenis']; ?>&parfum=no" class="popup-link">
                                        <input type="button" class="btn btn-success btkiloan" value="No Parfum" style="width:24%; background-color:#FFF; color:#6C0"/>
                                        </a>
                                        <a href="batal_order.php?id=<?php echo $_GET['id'];?>&no_nota=<?php  echo $_GET['nota']; ?>" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Batal" style="width:24%; background-color:#FFF; color:#6C0"/>
                                        </a>
		<a class="popup-close" href="#popup3"><img src="back.png" />
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


<div class="popup-wrapper" id="popup5">
	<div class="popup-container">
<form action="act/act_hanger.php" method="get">
<?php
if (isset($_GET['nota'])){
?>
<label class="control-label col-xs-20" for="jumlahitem">
  No. Nota : <?php echo $_GET['nota']; ?>
  <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
  <input type="hidden" name="nota" value="<?php echo $_GET['nota']; ?>" />
  <input type="hidden" name="jenis" value="Kiloan" />
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
		<a class="popup-close" href="#popup4"><img src="back.png" />
        </a>
<br />
    </div>
</div>    


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
                                        <a href="act/act_delivery.php?id=<?php echo $_GET['id'];?>&nota=<?php  echo $_GET['nota']; ?>&jenis=<?php echo $_GET['jenis']; ?>&deliver=on" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Diantar" style="width:32%; background-color:#FFF; color:#6C0"/>
                                        </a>
                                        <a href="act/act_delivery.php?id=<?php echo $_GET['id'];?>&nota=<?php  echo $_GET['nota']; ?>&jenis=<?php echo $_GET['jenis']; ?>&deliver=off" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Ambil Sendiri" style="width:32%; background-color:#FFF; color:#6C0"/>
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

<div class="popup-wrapper" id="popup8">
	<div class="popup-container">
                        <div class="panel-heading">
                            Pilih Express
                        </div>
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
</div><br /><br><br>
<?php	
}
?>
                                        <div class="form-group just_kiloan">
													<?php
													 if (($_GET['jenis']=="Kiloan") or ($_GET['jenis']=="setrika")){
        	                                         $qitem1 = mysqli_query($con, "select * from item_spk where jenis_item='k' and nama_item like '%express%'");
														 }
													 else{
        	                                         $qitem1 = mysqli_query($con, "select * from item_spk where jenis_item='p' and nama_item like '%express%'");
													 }
?>                                                                        
                                        <a href="act/act_charge.php?id=<?php echo $_GET['id'];?>&nota=<?php echo $_GET['nota']; ?>&jenis=<?php echo $_GET['jenis']; ?>&charge=" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Normal" style="width:15%; background-color:#FFF; color:#6C0"/>
                                        </a>
                                        <a href="act/act_charge.php?id=<?php echo $_GET['id'];?>&nota=<?php  echo $_GET['nota']; ?>&jenis=<?php echo $_GET['jenis']; ?>&charge=191" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Express (+ Rp. 15.000)" style="width:35%; background-color:#FFF; color:#6C0"/>
                                        </a>
                                        <a href="act/act_charge.php?id=<?php echo $_GET['id'];?>&nota=<?php  echo $_GET['nota']; ?>&jenis=<?php echo $_GET['jenis']; ?>&charge=192" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Double Express (+ Rp. 30.000)" style="width:45%; background-color:#FFF; color:#6C0"/>
                                        </a>
                                        <a href="act/act_charge.php?id=<?php echo $_GET['id'];?>&nota=<?php  echo $_GET['nota']; ?>&jenis=<?php echo $_GET['jenis']; ?>&charge=193" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Super Express (+ Rp. 45.000)" style="width:45%; background-color:#FFF; color:#6C0"/>
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
	                                        <a href="index.php?id=<?php echo $_GET['id'];?>&jenis=Potongan#popup10" class="popup-link">
    	                                    <input type="button" class="btn btn-success btpotongan" value="Potongan" style="width:49%; background-color:#FFF; color:#6C0"/>
        	                                </a>
                                            
                                            </div>
                                            <br><br><br>
                                        </div>
		<a class="popup-close" href="#closed">X</a>
    </div>
</div>    



<script type="text/javascript">
function itemzz(){
	var item22 = document.form22.itemklp.value;	
	var it22 = item22.split("-");
	document.form22.harga.value = it22[1];
	document.form22.item.value = it22[0];
}

function harga22(){
	var item22 = document.form22.itemklp.value;	
	var it22 = item22.split("-");
	if (document.form22.harga.value < it22[1]){
		alert("Harga dibawah minimal!");
		history.back();
	}
}
</script>

<div class="popup-wrapper" id="popup10">
	<div class="popup-container">
                        <div class="panel-heading">
                            <b>FORM POTONGAN</b>
                        </div>
                        		<form action="act_order_potongan_lanjutan1.php" method="get" name="form22" id="form22">

                                        <div class="form-group">                                        
                                               <?php
											   if (isset($_GET['nota'])){
                                                $no_nota = $_GET['nota'];
											   ?>
                                                <label class="control-label col-xs-3" for="jumlahitem">
                                                        No. Nota : 
												</label>
                                                <div class="col-xs-9" >
                                                </div><br />
		                                     <input type="text" name="notanew" value="<?php echo $_GET['nota']; ?>" class="form-control" placeholder="No Nota (Auto)"/>
      <br />
											   <?php	
                                                $qre = mysqli_query($con, "select * from detail_penjualan where no_nota = '$no_nota' order by id desc limit 0,1");
												$rre = mysqli_fetch_array($qre);
												$carikat = mysqli_query($con, "select * from item_spk where nama_item = '$rre[item]'");
												$rcariket = mysqli_fetch_array($carikat);											
											   }
											   else{
?>
		                                     <input type="text" name="notanew" value="" class="form-control" placeholder="No Nota (Auto)"/>
      <br />
      <?php
											   }
											   ?>
                                        </div>
                                        <div class="form-group">                                        
                                                <label class="control-label col-xs-3" for="Kiloan">
                                                   Item
                                                </label>
                                                <div class="col-xs-9" >
<?php
											$cek = mysqli_query($con, "select * from customer where id='$_GET[id]'");											
											$rsql = mysqli_fetch_array($cek);
												if ($rsql['member']==1 && $rsql['tgl_akhir'] >= $jam1  ){
												?>
                                                 <select name="itemklp" class="form-control" id="itemklp" onchange="itemzz()">
                                                 	<option value="">Pilih Item</option>
<?php
													if (isset($_GET['nota'])){
$qitem = mysqli_query($con, "select * from item_spk where jenis_item='p' and kategory='$rcariket[kategory]'");														
														}
													else{
$qitem = mysqli_query($con, "select * from item_spk where jenis_item='p'");														
														}
		  											 while ($ritem = mysqli_fetch_array($qitem)){
                		                            ?>
                                                     <option value="<?php echo $ritem['nama_item']."-".$ritem['disk']; ?>">
                                                       <?php echo $ritem['nama_item']; ?>
                                                     </option>
												<?php 
												 }
												?>
                                                 </select>
                                                <?php	
												}
												else
												{ 
												?>
                                                 <select name="itemklp" class="form-control" id="itemklp" onchange="itemzz()">
                                                 	<option value="">Pilih Item</option>													<?php
													if (isset($_GET['nota'])){
$qitem = mysqli_query($con, "select * from item_spk where jenis_item='p' and kategory='$rcariket[kategory]'");														
														}
													else{
$qitem = mysqli_query($con, "select * from item_spk where jenis_item='p'");														
														}
		  											 while ($ritem = mysqli_fetch_array($qitem)){
                		                            ?>
                                                     <option value="<?php echo $ritem['nama_item']."-".$ritem['harga']; ?>">
                                                       <?php echo $ritem['nama_item']; ?>
                                                     </option>
												<?php 
												 }
												?>
                                                </select>
<?php
												}																							
?>
                                                </div><br><br>
                                        </div>
                                        <div class="form-group">
                                                <label class="control-label col-xs-3" for="jumlahitem">
                                                        Harga Satuan
                                                </label>
                                                <div class="col-xs-9" >
                                                <input type="hidden" name="item" id="item"/>
                                                        <input type="text" id="harga" name="harga" class="form-control" placeholder="0" width="100%" required="required">
                                                </div><br /><br>
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
                                        <input type="hidden" name="jenis" value="potongan" />
										<input type="hidden" class="form-control" name="id_cs" id="id_cs" value="<?php echo $r['id'] ?>" />
                                        
                                        <input type="submit" class="btn btn-success btkiloan" value="Save Item" style="width:32%; background-color:#FFF; color:#6C0;" onclick="harga22()"/>

<a href="act_order_potongan_lanjutan2.php?id=<?php echo $_GET['id']; ?>&nota=<?php echo $no_nota; ?>&jenis=Potongan">
<input type="button" class="btn btn-success btkiloan" value="Save Potongan" style="width:32%; background-color:#FFF; color:#6C0;"/>
</a>  
                                        <a href="index.php?id=<?php echo $_GET['id'];?>" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Batal" style="width:32%; background-color:#FFF; color:#6C0"/>
                                        </a>                                      
                        		</form>
		
    </div>
</div>    
    


<div class="popup-wrapper" id="popup11">
	<div class="popup-container">
                        <div class="panel-heading">
                          Voucher
                        </div>
<form action="act/act_voucher.php" method="get">
  <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
  <input type="hidden" name="nota" value="<?php echo $_GET['nota']; ?>" />
  <input type="hidden" name="jenis" value="<?php echo $_GET['jenis']; ?>" />
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

                                        <input type="submit" class="btn btn-success btkiloan" value="Preview" style="width:33%; background-color:#FFF; color:#6C0;"/>
                                        <a href="#popup7" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Back" style="width:32%; background-color:#FFF; color:#6C0"/>
                                        </a>
                                        <a href="batal_order.php?id=<?php echo $_GET['id'];?>&no_nota=<?php  echo $_GET['nota']; ?>" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Batal" style="width:33%; background-color:#FFF; color:#6C0"/>
                                        </a>
    </div>
</div>    

</form>




<div class="popup-wrapper" id="popup12">
	<div class="popup-container">
                        <div class="panel-heading">
                          Preview
                        </div>
<?php
if (isset($_GET['nota'])){
?>
<label class="control-label col-xs-3" for="jumlahitem">
  <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
  <input type="hidden" name="nota" value="<?php echo $_GET['nota']; ?>" />
  <input type="hidden" name="jenis" value="<?php echo $_GET['jenis']; ?>" />
</label>
<div class="col-xs-9" >
</div>
<?php	
}
?>
<?php
$qcustomer = mysqli_query($con, "select * from customer where id='$id'");
$rcustomer = mysqli_fetch_array($qcustomer);
$nama_customer = $rcustomer['nama_customer'];
?>                                
	      <table style="width:100%;">
	         <tr>
	            <?php
	                echo '<td>Nama</td> <td>:</td> <td>'.$nama_customer.'</td>
					<td rowspan=2 align=right>
					</td>
					</tr>';
	                echo '<tr><td>No Order</td> <td>:</td> <td>'.$_GET['nota'].'</td>';
	            ?>
	         </tr>
     	  </table>     
 

									<?php
	 $qview = mysqli_query($con, "select * from reception where id_customer='$_GET[id]' and lunas='0' and no_nota='$_GET[nota]'");
	 $nview = mysqli_num_rows($qview);
	  if ($nview > 0){
	   $to = 0;
	   $no = 1;
	   echo "<table width='100%'>";
		  while ($rview = mysqli_fetch_array($qview)){
			  $no_nota = $rview['no_nota'];
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
                                <td><?php echo ucwords($data2['item']);?></td>
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
                                <td>Hanger Plastik</td>
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
				$uptotal = mysqli_query($con, "update reception set total_bayar='$totalall', diskon='$diskon' where no_nota='$_GET[nota]'");
echo str_replace('Rp.','',rupiah($totalall, true));
				?>				</td>
                                <td></td>
			</tr>
<?php
	  echo "</table>";
	  }
     }
	  ?>
                                        <a href="struk.php?id=<?php echo $_GET['id'];?>&no_nota=<?php  echo $_GET['nota']; ?>" target="_blank">
                                        <input type="button" class="btn btn-success btpotongan" value="Cetak" style="width:32%; background-color:#FFF; color:#6C0"/>
                                        </a>
                                        <a href="#popup11" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Back" style="width:32%; background-color:#FFF; color:#6C0"/>
                                        </a>
                                        <a href="batal_order.php?id=<?php echo $_GET['id'];?>&no_nota=<?php  echo $_GET['nota']; ?>" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Batal" style="width:33%; background-color:#FFF; color:#6C0"/>
                                        </a>
                                        <a href="" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Selesai" style="width:100%; background-color:#FFF; color:#6C0"/>
                                        </a>
		
    </div>
</div>    
</div>