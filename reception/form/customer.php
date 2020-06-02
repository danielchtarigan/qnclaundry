<?php
include "popup.php";
date_default_timezone_set('Asia/Makassar');
$jam1 = date("Y-m-d");
$id   = $_GET['id'];
$sql  = $con->query("select * from customer WHERE id = '$id'");
$r    = $sql->fetch_assoc();


$orderLama = mysqli_query($con, "SELECT * FROM reception WHERE id_customer='$id' AND (nama_reception<>'$_SESSION[user_id]' OR tgl_input NOT LIKE '%$jam1%') AND lunas=false");

//Langganan
$sqll = $con->query("select *from langganan where id_customer='$id'");
$l = $sqll->fetch_assoc();

$ot   = $_SESSION['nama_outlet'];

$qharga = $con->query("SELECT * FROM outlet_harga a, outlet b WHERE a.id_outlet=b.id_outlet AND b.nama_outlet='$ot'");
$hargaot = $qharga->fetch_array();

$idoutlet = $hargaot['id_outlet'];
$levelharga = $hargaot['level_harga'];


	if($r['jenis_member'] <> 'Red' && $r['tgl_akhir'] >= $jam1) {
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
			$hargakonversi = $l['harga_satuan'];
		}
		else
		{
			$lg         = "0";
			$sisa_kuota = "";
		}
include 'code.php';
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
											 $express = false;
											 $struk = "newstruk.php";
											 while ($rkeranjang = mysqli_fetch_array($qkeranjang)){
												 if ($rkeranjang['express']>0) $express = true;
												?>
                                                <font color="#009900">
                                                <a href="index.php?id=<?php echo $_GET['id'];?>&no_nota=<?php echo $rkeranjang['no_nota']; ?>&jenis=<?php echo $rkeranjang['jenis']; ?>">
												<?php
												echo $rkeranjang['no_nota'];
												?>
                                                </a>
                                                <a href="<?= $struk ?>?id=<?php echo $_GET['id'];?>&no_nota=<?php echo $rkeranjang['no_nota']; ?>" target="_blank">
                                                 <button type="submit" class="btn btn-default">Cetak</button>
                                                </a>
                                                <?php 
                                                if($rkeranjang['spk']=="0"){
                                                    ?>
                                                    <a href="batal_order.php?id=<?php echo $_GET['id'];?>&no_nota=<?php echo $rkeranjang['no_nota']; ?>">
                                                 <button type=submit class=btn btn-default>Batal</button>
                                                </a>
                                               
                                                    <?php
                                                }
                                                ?>
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
                                        <a href="#popupdelivery">
                                        <input type="button" id="selesai-button" class="btn btn-success btkiloan" value="Selesai" style="width:100%; background-color:#6C0;"/>
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
                                          <tr>
                                           <td valign="top" colspan="3" style="font-size: 14px; padding-bottom: 5px"><a href="#popupeditdatacs">Edit Data</a></td>
                                          </tr>
                                          <?php 
											if($r['member']==0){
												echo '
												<tr>
													<td colspan="3"><a href="#" onclick="freeMember()" style="color:red; font-weight: bolder">Free Membership</a></td>
												</tr>';
											}

											?>
                                         </table>
                                         <br />
                                        <a href="index.php?id=<?php echo $_GET['id']; ?>&menu=ambil">
                                        <input type="button" class="btn btn-success btkiloan" value="Ambil Barang" style="width:49%; background-color:#6C0;"/>
                                        </a>
                                        <a href="cari_complain.php" target="_blank">
                                        <input type="button" class="btn btn-success btpotongan" value="Komplain" style="width:49%; background-color:#6C0;"/>
                                        </a>
                                        <?php 
                                        if(mysqli_num_rows($orderLama)>0){ 

                                        	?>
                                        	<a href="index.php?id=<?php echo $id; ?>&jenis=Kiloan#popup23" class="popup-link">
	                                        <input type="button" class="btn btn-success btkiloan" value="Kiloan" style="width:49%; background-color:#6C0;"/>
	                                        </a>
	                                        <a href="index.php?id=<?php echo $id; ?>&jenis=Potongan#popup23">
	                                        <input type="button" class="btn btn-success btpotongan" value="Potongan" style="width:49%; background-color:#6C0;"/>
	                                        </a>
	                                        <?php 
                                        }
                                        else { 
                                        	$linkkiloan = '<a href="index.php?id='.$id.'&jenis=Kiloan#layanan" class="popup-link"><input type="button" class="btn btn-success btkiloan" value="Kiloan" style="width:49%; background-color:#6C0;"/>
	                                        </a>';
                                        	$linkpotongan = '<a href="index.php?id='.$id.'&jenis=Potongan#potongan"><input type="button" class="btn btn-success btpotongan" value="Potongan" style="width:49%; background-color:#6C0;"/>
	                                        </a>';

	                                        echo $linkkiloan.$linkpotongan;
                                        }

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
                                        <?php
											$cek = mysqli_query($con, "select * from customer where id='$_GET[id]'");
											$rsql = mysqli_fetch_array($cek);
											if (($rsql['member']==1) and ($rsql['lgn']==1)){
											 echo "<br>"."Member : ".$rsql['jenis_member']."<br>";
											 echo "Tanggal Join : ".$rsql['tgl_join']."<br>";
											 echo "Tanggal Akhir : ".$rsql['tgl_akhir']."<br>";
											 echo "Jumlah POIN : ".$rsql['poin']." POIN<br><br>";
											 echo "CKS &nbsp &nbsp &nbsp &nbsp&nbsp: ".$l['kilo_cks']." Kg<br>";
											 echo "Potongan : ".rupiah($l['potongan'])."<br>";
	                                        ?>
	                                         <a href="#popup13" class="btn btn-success btdeposit" name="btdeposit" id="btdeposit" style="width:49%; background-color:#6C0;">
	                                                Deposit
	                                         </a>
											 <a href="#popup14" class="btn btn-success btdeposit" name="btdeposit" id="btdeposit" style="width:49%; background-color:#6C0;">
	                                                Membership
	                                         </a>
                                            <?php
											}
											else if ($rsql['member']==1){
											 echo "<br>"."Member : ".$rsql['jenis_member']."<br>";
											 echo "Tanggal Join : ".$rsql['tgl_join']."<br>";
											 echo "Tanggal Akhir : ".$rsql['tgl_akhir']."<br>";
											 echo "Jumlah POIN : ".$rsql['poin']." POIN -----------> <a href='#popup98' class='btn btn-default btn-xs' id='tpoin' name='tpoin' >Tukar Poin?</a><br><br>";
											 ?>
											 <a href="#popup15" class="btn btn-success btdeposit" name="jdlgn" id="jdlgn" style="width:49%; background-color:#6C0;">
	                                                Berlangganan
	                                        </a>
											<a href="#popup14" class="btn btn-success btdeposit" name="btdeposit" id="btdeposit" style="width:49%; background-color:#6C0;">
	                                                Membership
	                                         </a>
											 <?php
											}
											else if ($rsql['lgn']==1){
											 echo "<br>Kuota Langganan<br>";
											 echo "CKS &nbsp &nbsp &nbsp &nbsp&nbsp: ".$l['kilo_cks']." Kg<br>";
											 echo "Potongan : ".rupiah($l['potongan'])."<br>";
	                                        ?>
	                                         <a href="#popup13" class="btn btn-success btdeposit" name="btdeposit" id="btdeposit" style="width:49%; background-color:#6C0;">
	                                                Deposit
	                                         </a>
											 <a href="#popup14" class="btn btn-success btdeposit" name="btdeposit" id="btdeposit" style="width:49%; background-color:#6C0;">
	                                                Membership
	                                         </a>
                                            <?php
											}
											else {
												echo "<br><b>Ket : Bukan Langganan / Member</b>";
											?>
											<a href="#popup15" class="btn btn-success btdeposit" name="jdlgn" id="jdlgn" style="width:49%; background-color:#6C0;">
	                                                Berlangganan
	                                        </a>
											<a href="#popup14" class="btn btn-success btdeposit" name="btdeposit" id="btdeposit" style="width:49%; background-color:#6C0;">
	                                                Membership
	                                        </a>
											<?php
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

<script>
	$("#jdlgn").click(function()
		{
			if (confirm("Yakin jadikan Langganan?"))
			{
				var id_cs=$("#id_cs").val();
				var data = "id_cs=" + id_cs ;
				$.ajax(
					{
						type: "POST",
						url: "update_lgn.php",
						data: data,
						cache: false,
						success: function()
						{
							location.reload();
						}
					})
			}
		})
</script>


<?php
 if (isset($_GET['tipe'])){
	$tipe = $_GET['tipe'];
	if ($tipe=="Kiloan"){
//		include "form/kiloan.php";
		}
	else if ($tipe=='potongan'){
//		include "form/potongan.php";
		}
//	else if ($tipe=='deposit'){
//		include "form/deposit.php";
//		}
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

<script>
function deliveryform() {
	$('#tombol-delivery').css('background-color','#ddf8c2');
	$('#form-delivery').show();
}
function closedeliverypopup() {
	$('#popupdelivery').css('display','none');
}
$('#selesai-button').click(function() {
	$('#popupdelivery').css('display','block');
});
$(function(){
		$("#tglantar").datepicker({
	format:'dd/mm/yyyy',
	autoclose: true,
<?php if ($express) echo "startDate: '+1d'"; else echo "startDate: '+3d'"; ?>
		});
			});
</script>
<?php
$qdelivery = mysqli_query($con,"SELECT no_telp,alamat,DATE_FORMAT(tgl_permintaan,'%d/%m/%Y') AS tgl_permintaan,waktu_permintaan,catatan FROM delivery WHERE id_customer='$_GET[id]' AND no_faktur IS NULL AND jenis_permintaan='Antar' ORDER BY tgl_input DESC LIMIT 1");
if (mysqli_num_rows($qdelivery)>0) {
  $delivery = mysqli_fetch_array($qdelivery);
} else $delivery=null;
?>

<div class="popup-wrapper" id="popupeditdatacs" style="top: 48px">
	<div class="popup-container">
		<?php include 'data_customer.php'; ?>
    </div>
</div>

<div class="popup-wrapper" id="popupdelivery">
	<div class="popup-container">
		<label class="control-label col-xs-12">
			Pilih Delivery
		</label>
			<input type="button" class="btn btn-success" value="Diantar" style="width:32%; background-color:#FFF; color:#6C0" onclick="deliveryform()" id ="tombol-delivery">
			<a href="act/delete_delivery.php?id=<?php echo $id ?>" class="popup-link">
			<input type="button" class="btn btn-success btpotongan" value="Ambil Sendiri" style="width:32%; background-color:#FFF; color:#6C0"/>
			</a>
			<form method="GET" action="act/act_delivery.php" id="form-delivery" style="display:none">
				<hr>
					<input type="hidden" name="id_customer" value="<?php echo $id; ?>">
					<input type="hidden" name="nama_customer" value="<?php echo $rcustomer1['nama_customer'] ?>">
          <div class="form-group">
						<label class="control-label col-xs-12" for="no_telp_antar">
								No. Telepon (CP Pengantaran)
						</label>
						<input class="form-control" type="text" name="no_telp_antar" value="<?= $delivery!=null ? $delivery['no_telp'] : $rcustomer1['no_telp'] ?>" required/>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-12" for="alamat_antar">
								Alamat Pengantaran (isi dengan alamat lengkap)
						</label>
						<textarea class="form-control" rows="3" name="alamat_antar" required><?= $delivery!=null ? $delivery['alamat'] : $rcustomer1['alamat'] ?></textarea>
          </div>
					<div class="form-group">
						<label class="control-label col-xs-12" for="tanggal_antar">
								Tanggal Pengantaran
						</label>
						<input type="text" autocomplete="off" class="form-control" name="tanggal_antar" id="tglantar" value="<?php if ($delivery!=null) echo $delivery['tgl_permintaan']; else if ($express) echo date('d/m/Y', strtotime('+1 day')); else echo date('d/m/Y', strtotime('+3 days')); ?>" required/>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-12" for="waktu_antar">Waktu Pengantaran</label>
							<select class="form-control" name="waktu_antar">
								<?php if ($delivery!=null) $waktu = $delivery['waktu_permintaan']; else $waktu=null?>
								<option value="Bebas" <?=$waktu == null||"Bebas" ? 'selected="selected"' : '';?>>Bebas</option>
								<option value="Pagi" <?=$waktu == "Pagi" ? 'selected="selected"' : '';?>>Pagi (09.00 - 12.00)</option>
								<option value="Siang" <?=$waktu == "Siang" ? 'selected="selected"' : '';?>>Siang (12.00 - 15.00)</option>
								<option value="Sore" <?=$waktu == "Sore" ? 'selected="selected"' : '';?>>Sore (15.00 - 18.00)</option>
								<option value="Malam" <?=$waktu == "Malam" ? 'selected="selected"' : '';?>>Malam (18.00 - 21.00)</option>
							</select>
					</div>
					<div class="form-group">
						<label class="control-label col-xs-12" for="catatan">
								Catatan Pengantaran (Opsional)
						</label>
						<textarea class="form-control" rows="3" name="catatan"><?= $delivery!=null ? $delivery['catatan'] : '' ?></textarea>
          </div>
          <input type="submit" class="btn btn-success" value="Lanjut" style="width:49%; background-color:#FFF; color:#6C0;"/>
			</form><br />
			<a class="popup-close" href="#" onclick="closedeliverypopup()"><img src="back.png" />
			</a><br/>
    </div>
</div>

<div class="popup-wrapper" id="popup23">
	<div class="popup-container">
        <div class="form-group just_kiloan">
    		<div class="col-xs-12" >
            	<p style="text-align: center; font-weight: bold; font-size: 12px">MAAF, ada order belum lunas sebelum hari ini. Silahkan lunasi sebelum dibuatkan order baru<br>Semua pembayaran harus disetor oleh resepsionis yang telah membuatkan order</p>
        	</div>
            <br>
            <br>
			<a class="popup-close" href="index.php?id=<?php echo $_GET['id'];?>"><img src="back.png" /></a>
      	</div>
    </div>
</div>

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
                                                
															if($r['lgn']==1){ 
															$harga = round($ritem['berat']*round($hargakonversi)) ;
															?>
															<option value="<?php echo $ritem['nama_item']."-".$harga; ?>"><?php echo $ritem['nama_item']; ?></option>
															<?php
															} else if ($r['member']==1){
															?>
															 <option value="<?php echo $ritem['nama_item']."-".$ritem['disk']; ?>"><?php echo $ritem['nama_item']; ?></option>
															<?php
															} else if($r['type_c']==1){
															?>
															<option value="<?php echo $ritem['nama_item']."-".$ritem['harga_c']; ?>"><?php echo $ritem['nama_item']; ?></option>
															<?php
															} else{
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
                                        <a href="index.php?id=<?php echo $_GET['id'];?>" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Batal" style="width:49%; background-color:#FFF; color:#6C0;" />
                                        </a>
        </form>
		<a class="popup-close" href="#popup8"><img src="back.png" />
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
														if ($r['lgn']==1){														
															$harga = round($ritem['berat']*round($hargakonversi*0.7));
													?>
                                                     <option value="<?php echo $ritem['nama_item']."-".$harga; ?>"><?php echo $ritem['nama_item']; ?></option>
                                                    <?php
														}
														elseif ($status=="member"){
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
                                        <a href="index.php?id=<?php echo $_GET['id'];?>" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Batal" style="width:49%; background-color:#FFF; color:#6C0;" />
                                        </a>
        </form>
		<a class="popup-close" href="index.php?id=<?php echo $_GET['id'];?>"><img src="back.png" />
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
<?php /*<div class="popup-wrapper" id="popup7">
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
</div> */ ?>

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
                                        <a href="#popup19" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Normal" style="width:15%; background-color:#FFF; color:#6C0" name="express0" id="express0"/>
                                        </a>
                                        <a href="#popup19" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Express (+ Rp. 15.000)" style="width:35%; background-color:#FFF; color:#6C0" name="express191" id="express191"/>
                                        </a>
                                        <a href="#popup19" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Double Express (+ Rp. 30.000)" style="width:45%; background-color:#FFF; color:#6C0" name="express192" id="express192"/>
                                        </a>
                                        <a href="#popup19" class="popup-link">
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

<div class="popup-wrapper" id="popup10" style="top: 8px">
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

<?php
// $referralquery = mysqli_query($con,"SELECT kode_referral,kode_terpakai,diskon_terpakai FROM customer WHERE id='$id'");
// $referraldata = mysqli_fetch_assoc($referralquery);
$outlets = explode(";",mysqli_fetch_array(mysqli_query($con,"SELECT value FROM settings WHERE name='outlet_referral'"))[0]);
if (in_array($ot,$outlets) && $rcustomer1['kode_terpakai']==true && $rcustomer1['diskon_terpakai']==false) $kode = $rcustomer1['kode_referral_baru'];
?>
<div class="popup-wrapper" id="popup11">
	<div class="popup-container">
                        <div class="panel-heading">
                          Voucher
                        </div>
<form method="get" action="act/act_voucher_tmp.php">
  <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
  <input type="hidden" name="jenis" value="<?php echo $_GET['jenis']; ?>" />
                                                <div class="form-group">
                                                        <label class="control-label col-xs-3" for="voucher">
                                                                Kode Voucher
                                                        </label>
                                                        <div class="col-xs-9" >
                                                                <input autocomplete="off" type="text" class="form-control" name="voucher" id="voucher"  onkeydown="return tabOnEnter(this,event)" <?php if (isset($kode)) echo 'value="'.$kode.'"'; ?>/>                                                        </div>
                                                        <span id="pesan"><?php if (isset($kode)) echo "Customer akan mendapatkan diskon karena customer lain telah menggunakan kode referral-nya"; ?>
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

<div class="popup-wrapper" id="popupaudit" style="top: 20px">
	<div class="popup-container">
                        <div class="panel-heading" align="center">
                          <strong>QUALITY AUDIT</strong>
                        </div>
<form method="get" action="act/act_quality_audit.php">
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


<div class="popup-wrapper" id="popup13">
	<div class="popup-container">
                                <div class="modal-header">
                                        Deposit Langganan
                                </div>
                                <div class="modal-body">
                                <form method="GET" action="javascript:" id="form-input-deposit" class="form-horizontal" target="_blank">
                                <input type="hidden" readonly class="form-control" autocomplete="off" name="kuota_kilo" id="kuota_kilo" value="<?php echo $l['kilo_cks']; ?>"/>   
                                <input type="hidden" readonly class="form-control" autocomplete="off" name="sisa_kuota" id="sisa_kuota" value="<?php echo $l['all_kuota']; ?>"/>
                                <input type="hidden" readonly class="form-control" autocomplete="off" name="kuota_pot" id="kuota_pot" value="<?php echo $l['potongan']; ?>"/> 
                                <input type="hidden" readonly class="form-control" autocomplete="off" name="id" id="sisa_kuota" value="<?php echo $_GET['id']; ?>"/>

                                                <fieldset>
                                                        <div class="form-group">
                                                                <label class="control-label col-xs-3" for="paket">
                                                                        Pilih Paket
                                                                </label>
                                                                <div class="col-xs-6" >
                                                                        <select class="form-control" name="paket" id="paket">
                                                                                <option value="">
                                                                                        --
                                                                                </option>
                                                                                <option value="hemat_50">
                                                                                        Paket Hemat 50Kg
                                                                                </option>
                                                                                <option value="kilo30">
                                                                                        All Kiloan 30kg
                                                                                </option>        
                                                                                <option value="singgle">
                                                                                        Paket Single
                                                                                </option>
                                                                                <option value="family">
                                                                                        Paket Family
                                                                                </option>
                                                                                <option value="custom">
                                                                                        Custom
                                                                                </option>
                                                                        </select>
                                                                </div><br>
                                                        </div>
                                                         <input type="hidden" readonly class="form-control" autocomplete="off" name="npaket" id="npaket"/>
                                                        <div class="form-group">
                                                                <label for="hargapaket" class="control-label col-xs-3">
                                                                        Harga Paket
                                                                </label>
                                                                <div class="col-xs-4" >
                                                                        <input type="text" class="form-control" autocomplete="off" name="hargapaket" id="hargapaket" />
                                                                </div><br>
                                                        </div>
                                                        <div class="form-group">
                                                                <label class="control-label col-xs-3" for="carabayarlgn">
                                                                        Cara Bayar
                                                                </label>
                                                                <div class="col-xs-4" >
                                                                        <select class="form-control" name="carabayarlgn" id="carabayarlgn">
                                                                                <option value="cash">
                                                                                        Cash
                                                                                </option>
                                                                                <option value="edcbca">
                                                                                        Edc BCA
                                                                                </option>
                                                                                <option value="edcmandiri">
                                                                                        Edc Mandiri
                                                                                </option>
                                                                                <option value="edcbri">
                                                                                        Edc BRI
                                                                                </option>
																				<option value="edcbni">
                                                                                        Edc BNI
                                                                                </option>
                                                                        </select>
                                                                </div><br>
                                                        </div>

                                                </fieldset>
                                </div>
                                <div class="modal-footer">
										<input type="submit" class="btn btn-success btkiloan" value="Simpan" style="width:49%; background-color:#FFF; color:#6C0;"/>
										<a href="index.php?id=<?php echo $_GET['id'];?>" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Selesai" style="width:49%; background-color:#FFF; color:#fd2121"/>
                                        </a>
                                </div>
                                        </form>

<script type="text/javascript">


	$("#paket").change(function()
	{
		var paket = $("#paket").val();

		if(paket=="hemat_50")
			{
				$("#hargapaket").val(350000);
				$("#npaket").val(50);

			} 

		else if(paket=="kilo30")
			{
				$("#hargapaket").val(265000);
				$("#npaket").val(30);

			} 
		else if(paket=="singgle")
			{
				$("#hargapaket").val(275000);
				$("#npaket").val(20);
			} 
		else if(paket=="family")
			{
				$("#hargapaket").val(715000);
				$("#npaket").val(50);
			}
	});

	$('#form-input-deposit').on('submit', function(){
		id = "<?= $_GET['id'] ?>";
		hargapaket = $('#hargapaket').val();
		paket = $('#paket').val();
		carabayarlgn = $('#carabayarlgn').val();
		npaket = $('#npaket').val();
		kuota_kilo = $('#kuota_kilo').val();
		sisa_kuota = $('#sisa_kuota').val();
		kuota_pot = $('#kuota_pot').val();

		$.ajax({
			url 	: 'act/act_deposit.php',
			data 	: {
				id 				: id,
				hargapaket 		: hargapaket,
				paket 			: paket,
				carabayarlgn 	: carabayarlgn,
				npaket 			: npaket,
				kuota_kilo 		: kuota_kilo,
				sisa_kuota 		: sisa_kuota,
				kuota_pot 		: kuota_pot
			},
			success : function(msg){
				$(".modal-body").css('display', 'none');
				$('.modal-footer').html(msg);
			}	
		})

	})

</script>
		<a class="popup-close" href=""><img src="back.png" />
        </a>
<br />
    </div>
</div>


<div class="popup-wrapper" id="popup14">
	<div class="popup-container">
                                <div class="modal-header">
                                        Membership
                                </div>
                                <div class="modal-body" width="100%">
                                        <form method="GET" action="javascript:" id="form-input-membership" class="form-horizontal" target="_blank">
										<input type="hidden" name="id_cs" id="id_cs" value="<?php echo $_GET['id']; ?>">
                                                <fieldset>
                                                        <div class="form-group">
                                                                <label class="control-label col-xs-3" for="jenis_member">
                                                                        <p align="left">Jenis</p>
                                                                </label>
                                                                <div class="col-xs-9" >
                                                                        <select class="form-control" name="jenis_member" id="jenis_member">
                                                                                <option value="">
                                                                                        Pilih Membership
                                                                                </option>
                                                                                <option value="blue3bulan">
                                                                                        Blue 3 Bulan
                                                                                </option>
                                                                                <option value="blue6bulan">
                                                                                        Blue 6 Bulan
                                                                                </option>
                                                                                <option value="blue12bulan">
                                                                                        Blue 12 Bulan
                                                                                </option>
                                                                                <option value="Red">
                                                                                        RED
                                                                                </option>
                                                                        </select>
                                                                </div>
                                                        </div>

                                                        <div class="form-group">
                                                                <label for="no_telp" class="control-label col-xs-3">
                                                                        <p align="left">Tgl Akhir</p>
                                                                </label>
                                                                <div class="col-xs-9">
                                                                        <input type="text" readonly required name="tgl_akhir" class="form-control" id="tgl_akhir">
                                                                </div>
                                                        </div>

                                                        <div class="form-group">
                                                                <label for="hargapaket" class="control-label col-xs-3">
                                                                        <p align="left">Harga Paket</p>
                                                                </label>
                                                                <div class="col-xs-9" >
                                                                        <input type="text" class="form-control" autocomplete="off" name="hargamember" id="hargamember" />
                                                                </div><br>
                                                        </div>
                                                        <div class="form-group">
                                                                <label class="control-label col-xs-3" for="carabayarlgn">
                                                                        <p align="left">Cara Bayar</p>
                                                                </label>
                                                                <div class="col-xs-9" >
                                                                        <select class="form-control" name="carabayarmbr" id="carabayarmbr">
                                                                                <option value="cash">
                                                                                        Cash
                                                                                </option>
                                                                                <option value="edcbca">
                                                                                        Edc BCA
                                                                                </option>
                                                                                <option value="edcmandiri">
                                                                                        Edc Mandiri
                                                                                </option>
                                                                                <option value="edcbri">
                                                                                        Edc BRI
                                                                                </option>
                                                                                <option value="edcbni">
                                                                                        Edc BNI
                                                                                </option>
                                                                        </select>
                                                                </div>
                                                        </div>
                                                </fieldset>

                                </div>
                                <div class="modal-footer">
                                        <input type="submit" id="simpanmember" class="btn btn-success btpotongan" style="width:49%; background-color:#FFF; color:#6C0" value="Simpan"/>
                                        <a href="index.php?id=<?php echo $_GET['id'];?>" class="popup-link">
                                         <input type="button" class="btn btn-success btpotongan" value="Batal" style="width:49%; background-color:#FFF; color:#6C0"/>
                                        </a>
                                </div>
								</form>
		<a class="popup-close" href=""><img src="back.png" />
        </a>
		<br />
    </div>
</div>
<div id="printmbr"></div>

<script type="text/javascript">
	$('#form-input-membership').on('submit', function(){
		id_cs = "<?= $_GET['id'] ?>";
		jenis_member = $('#jenis_member').val();
		hargamember=$("#hargamember").val();
		carabayarmbr = $('#carabayarmbr').val();
		tgl_akhir = $('#tgl_akhir').val();

		if ( jenis_member == "" )
		{
			alert("Pilih Paket");
			$("#jenis_member").focus();
			return false;
		}
		if ( hargamember == "" )
		{
			alert("harga Paket masih kosong");
			$("#hargamember").focus();
			return false;
		}

		$.ajax(
		{
			url:"act/act_member.php",
			data:"id_cs="+id_cs+"&hargamember="+hargamember+"&jenis_member="+jenis_member+"&carabayarmbr="+carabayarmbr+"&tgl_akhir="+tgl_akhir,

			success:function(msg)
			{
				$(".modal-body").css('display', 'none');
				$('.modal-footer').html(msg);
			}
		})

	})
</script>

<!--
<script>
	$("#simpanmember").click(function()
		{
			id_cs=$("#id_cs").val();
			jenis_member=$("#jenis_member").val();
			hargamember=$("#hargamember").val();
			tgl_akhir=$("#tgl_akhir").val();
			carabayarmbr=$("#carabayarmbr").val();

			if ( jenis_member == "" )
			{
				alert("Pilih Paket");
				$("#jenis_member").focus();
				return false;
			}
			if ( hargamember == "" )
			{
				alert("harga Paket masih kosong");
				$("#hargamember").focus();
				return false;
			}

			$.ajax(
				{
					url:"input_bayar_member.php",
					data:"id_cs="+id_cs+"&hargamember="+hargamember+"&jenis_member="+jenis_member+"&carabayarmbr="+carabayarmbr+"&tgl_akhir="+tgl_akhir,

					success:function(msg)
					{
						$("#printmbr").html(msg);
						$("#jenis_member").val("");
						$("#hargamember").val("");
						$("#customer").load("pk_customer.php","op=customerspk&id_cs="+id_cs);
						$("#rincian").load("pk_customer.php","op=rincian_penjualan&id_cs="+id_cs+"&no_nota="+no_nota);
						$("#rincianorder").load("rincian_order.php","id_cs="+id_cs+"&no_nota="+no_nota);
						$("#piutang").load("pk_customer.php","op=piutang&id_cs="+id_cs);
						$("#modal-member").modal('hide');
					}
				})
		})
</script>   -->

<script>
	$("#jenis_member").change(function()
		{
			var i = '<?php
			$d=strtotime("+3 Months");
			echo  date("Y-m-d", $d); ?>';
			var d = '<?php
			$s=strtotime("+6 Months");
			echo  date("Y-m-d", $s); ?>';

			var e = '<?php
			$f=strtotime("+12 Months");
			echo  date("Y-m-d", $f); ?>';

			var jenis_member = $("#jenis_member").val();
			if(jenis_member=="blue3bulan")
			{
				$("#tgl_akhir").val(i);
				$("#hargamember").val("100000");

			}else if(jenis_member=="blue6bulan")
			{
				$("#tgl_akhir").val(d);
				$("#hargamember").val("150000");
			}else if(jenis_member=="blue12bulan" || jenis_member=="red")
			{
				$("#tgl_akhir").val(e);
				$("#hargamember").val("250000");
			}else
			{
				$("#tgl_akhir").val("");
				$("#hargamember").val("");
			}



		});
</script>




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
$qtmp = mysqli_query($con, "SELECT * from order_tmp where id_customer='$_GET[id]' AND cabang<>'Delivery'");
$ntmp = mysqli_num_rows($qtmp);
if($ntmp<1){
	$qtmp = mysqli_query($con, "SELECT * from order_potongan_tmp where id_customer='$_GET[id]' AND cabang<>'Delivery'");
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

				//Start Setting voucher_cashback_order

				if(($totalall>=25000 && $totalall<50000) && $diskon==0){

					mysqli_query($con, "UPDATE voucher_cashback_order SET harga_nota='$totalall',nominal='10000' WHERE no_nota='$no_nota'");

				} else if($totalall>=50000 && $diskon==0){

					mysqli_query($con, "UPDATE voucher_cashback_order SET harga_nota='$totalall',nominal='25000' WHERE no_nota='$no_nota'");

				} else {

					mysqli_query($con, "DELETE FROM voucher_cashback_order WHERE no_nota='$no_nota'");
				}

				//End Setting voucher_cashback_order
				

echo str_replace('Rp.','',rupiah($totalall, true));
				?>				</td>
                                <td></td>
			</tr>
<?php
	  echo "</table>";
	  }
     }
     $struk = "newstruk.php";
	  ?>
                                        <a href="index.php?id=<?php echo $_GET['id'];?>" onclick="window.open('<?= $struk; ?>?id=<?php echo $_GET['id'];?>&no_nota=<?php  echo $no_nota; ?>')">
                                        <input type="button" class="btn btn-success btpotongan" value="Simpan" style="width:49%; background-color:#FFF; color:#6C0"/>
                                        </a>
                                        <a href="batal_order.php?id=<?php echo $_GET['id'];?>&no_nota=<?php  echo $no_nota; ?>" class="popup-link">
                                        <input type="button" class="btn btn-success btpotongan" value="Batal" style="width:49%; background-color:#FFF; color:#6C0"/>
                                        </a>

<br />
		<a class="popup-close" href="#popup11"><img src="back.png" />
        </a>
<br />
    </div>
</div>
</div>

<div class="popup-wrapper" id="popup98">
	<div class="popup-container">
                                <div class="modal-header">
                                        Tukar Poin
                                </div>
                                <div class="modal-body" width="100%">
                                    <form method="GET" action="act/tpoin.php" id="form-input1" class="form-horizontal" target="_blank">
										<input type="hidden" name="id_cs" id="id_cs" value="<?php echo $_GET['id']; ?>">
                                                <fieldset>
                                                        <div class="form-group">
                                                                <label class="control-label col-xs-3" for="hadiah">
                                                                        <p align="left">Hadiah</p>
                                                                </label>
                                                                <div class="col-xs-9" >
                                                                        <select class="form-control" name="hadiah" id="hadiah">
                                                                                <option value="">
                                                                                        Pilih Hadiah
                                                                                </option>
                                                                                <option value="Payung">
                                                                                        Payung QnC Laundry - 120 poin
                                                                                </option>
																				<option value="Voucher Rp50000">
                                                                                        Voucher Rp50000 - 40 poin
                                                                                </option>
                                                                                <option value="Voucher 5kg">
                                                                                        Voucher 5Kg - 40 poin
                                                                                </option>
                                                                                <option value="Voucher 3kg">
                                                                                        Voucher 3Kg - 30 poin
                                                                                </option> 
																				<option value="Voucher Carrefour Rp100000">
                                                                                        Voucher Belanja Rp100000 (Carrefour) - 80 poin
                                                                                </option>
                                                                        </select>
                                                                </div>
                                                        </div>
														 <div class="form-group">
                                                                <label for="sisapoin" class="control-label col-xs-3">
                                                                        <p align="left">Poin Terpotong</p>
                                                                </label>
                                                                <div class="col-xs-9">
                                                                        <input type="text" readonly required name="potong" class="form-control" id="potong">
                                                                </div>
                                                        </div>    

                                                        <div class="form-group">
                                                                <label for="sisapoin" class="control-label col-xs-3">
                                                                        <p align="left">Sisa Poin</p>
                                                                </label>
                                                                <div class="col-xs-9">
                                                                        <input type="text" readonly required name="sisapoin" class="form-control" id="sisapoin">
                                                                </div>
                                                        </div>                                                        
                                                </fieldset>
                                
										<div class="modal-footer">
												<input type="submit" id="simpanmember" class="btn btn-success btpotongan" style="width:49%; background-color:#FFF; color:#6C0" value="Simpan"/>
												<a href="index.php?id=<?php echo $_GET['id'];?>" class="popup-link">
												 <input type="button" class="btn btn-success btpotongan" value="Tutup" style="width:49%; background-color:#FFF; color:#6C0"/>
												</a>
										</div>
									</form>
								</div>
		<a class="popup-close" href=""><img src="back.png" /></a>
		<br/>
    </div>
</div>

<script>
	$("#hadiah").change(function()
		{
			var i = '<?php
			$d=$rsql['poin']-120;
			echo  $d; ?>';
			var p = '<?php
			$k=$rsql['poin']-40;
			echo $k; ?>';
			var q = '<?php
			$l=$rsql['poin']-80;
			echo $l; ?>';
			var d = '<?php
			$s=$rsql['poin']-40;
			echo $s; ?>';

			var e = '<?php
			$f=$rsql['poin']-30;
			echo $f; ?>';

			var hadiah = $("#hadiah").val();
			if(hadiah=="Payung")
			{
				$("#sisapoin").val(i);
				$("#potong").val("120");

			}else if(hadiah=="Voucher Rp50000")
			{
				$("#sisapoin").val(q);
				$("#potong").val("40");
			}else if(hadiah=="Voucher Carrefour Rp100000")
			{
				$("#sisapoin").val(d);
				$("#potong").val("80");
			}else if(hadiah=="Voucher 5kg")
			{
				$("#sisapoin").val(d);
				$("#potong").val("40");
			}else if(hadiah=="Voucher 3kg")
			{
				$("#sisapoin").val(e);
				$("#potong").val("30");
			}

		});
</script>

<script type="text/javascript">
	function freeMember(){
		if(confirm("Anda mengizinkan Customer menjadi Membership gratis 1 bulan, Diskon 20% setiap pemesanan"))
		{
			var id = '<?= $id ?>';
			$.ajax({
				url 	: 'act/membership_free.php',
				data 	: 'id='+id,
				method	: 'POST',
				success : function(data)
				{
					alert(data);
					location.href = "";
				}
			})
		}
	}
</script>

<?php 
require 'include/inc_transaksi.php';

?>

