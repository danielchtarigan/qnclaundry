<?php 
$id = $_GET['id'];

$query = mysqli_query($con, "SELECT * FROM customer WHERE id='$id'");
$row = mysqli_fetch_assoc($query);

function rp($angka) {
	$jadi = 'Rp '.number_format($angka,0,',','.');
	return $jadi;
}

//cek status berlangganan
if($row['lgn']=='1'){
	$status = "langganan";
} else if($row['member']=='1') {
	$status = "member";
} else {
	$status = "normal";
} 


?>
<style type="text/css">
	.btn-success, .btn-danger, .btn-default, .btn-primary{
		border : 1px solid white;
	}

	#faktur{
		font-size: 9pt;
	}
	#faktur tr th{
		text-align: center;
	}
	
	@media only screen and (max-width: 720px) {
		.sm-hide {
			display: none;
		}
	} 

	

</style>


<div class="row">
	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-body">
				<table style="margin-bottom: 15px">
					<tr>
						<td class="black lighter smaller" colspan="3" style="font-weight: bold; font-size: 12pt"><i class="ace-icon fa fa-list-alt smaller-90"></i> Data Pelanggan</td>
					</tr>
					<tr>
						<td><?php echo $row['nama_customer'] ?></td>
						<td> | </td>
						<td><?php echo $row['no_telp'] ?></td>
					</tr>
					<tr>
						<td colspan="3"><?php echo ucwords($row['alamat']) ?></td>
					</tr>
					<?php 
					if($status=="normal"){
						echo '
						<tr>
							<td colspan="3"><a href="#" onclick="freeMember()" style="color:red; font-weight: bolder">Free Membership</a></td>
						</tr>';
					}

					?>
				</table>
				<?php 
				$langganan = mysqli_query($con, "SELECT * FROM langganan WHERE id_customer='$id'");
				$lgn = mysqli_fetch_assoc($langganan);

				if($row['lgn']=="1"){ ?>
				<table style="margin-bottom: 8px">
					<tr>
						<td style="font-weight: bold;" width="100%">Langganan</td>
						<td class="pull-right"><button type="button" class="btn btn-white btn-danger btn-sm no-border" id="offlgn"> <i class="fa fa-times" aria-hidden="true"></i></button></td>
					</tr>
					<tr>
						<td><?php echo number_format($lgn['kilo_cks'],2,',','.').' Kg' ?> (Cuci Kering Setrika)</td>
						<td></td>
					</tr>
					<tr>
						<td><?php echo rp($lgn['potongan']) ?> (Potongan)</td>
						<td></td>
					</tr>
				</table>
				<?php
				} 
				if($row['member']=="1"){ ?>
				<table style="margin-bottom: 15px">
					<tr>
						<td style="font-weight: bold;" width="100%">Membership</td>
						<td class="pull-right"><button type="button" class="btn btn-white btn-danger btn-sm no-border"> <i class="fa fa-times" aria-hidden="true"></i></button></td>
					</tr>
					<tr>
						<td style="font-style: oblique;color: #6878CC; font-weight: bolder"><?php echo $row['jenis_member'] ?></td>
						<td></td>
					</tr>
					<tr>
						<td style="font-size: 12pt; font-style: oblique; font-weight: bolder; color: #6878CC"><a href=""><?php echo $row['poin'].' Poin Rewards' ?></a></td>
						<td></td>
					</tr>
				</table>
				<?php
				}

				$qlock = $con->query("SELECT * FROM member_locker WHERE id_customer='$id' AND tgl_berakhir>'$nowDate'");
				$clock = mysqli_num_rows($qlock);

				if($clock>0) {
					$dlock = $qlock->fetch_array();
					?>
				<table style="margin-bottom: 15px">
					<tr>
						<td style="font-weight: bold;" width="100%">Member Locker</td>
						<td class="pull-right"><button type="button" class="btn btn-white btn-danger btn-sm no-border"> <i class="fa fa-times" aria-hidden="true"></i></button></td>
					</tr>
					<tr>
						<td style="font-style: oblique;color: #6878CC; font-weight: bolder"><?php echo $dlock['paket'] ?></td>
						<td></td>
					</tr>
					<tr>
						<td style="font-size: 12pt; font-style: oblique; font-weight: bolder; color: #6878CC"><a href=""><?php echo 'Valid '.date('d/m/Y', strtotime($dlock['tgl_berakhir'])) ?></a></td>
						<td></td>
					</tr>
				</table>
					<?php
					
				} else {
					?>
				<a href="#" class="btn btn-white btn-primary btn-sm btdeposit" name="btdeposit" id="btdeposit" style="width:49%">Deposit</a>
				<a href="#" class="btn btn-white btn-primary btn-sm btdeposit" name="btmember" id="btmember" style="width:49%">Membership</a>
				<a href="#" class="btn btn-white btn-primary btn-sm btlocker" name="btlocker" id="btlocker" style="width:100%; margin-top: 2px">Paket Locker</a>
					<?php
				}
				?>
				<hr>
				<h5><strong>Pemesanan</strong></h5>
				<a href="#" class="btn btn-success btn-sm btdeposit" name="btkiloan" id="btkiloan" style="width:49%">Kiloan</a>
				<a href="#" class="btn btn-success btn-sm btdeposit" name="btdeposit" id="btpotongan" style="width:49%">Potongan</a>
				<hr>
				<h5><strong>Pengambilan &amp; Audit</strong></h5>
				<a href="#" class="btn btn-success btn-sm btdeposit" name="btdeposit" id="btdeposit" style="width:49%">Ambil Barang</a>
				<a href="#" class="btn btn-success btn-sm btdeposit" name="btdeposit" id="btdeposit" style="width:49%">Komplain</a>
				<a href="#" class="btn btn-block btn-success btn-sm btdeposit" name="btdeposit" id="btdeposit">Quality Audit</a>
			</div>			
		</div>
	</div>
	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-body">				
				<table style="width: 100%">
					<tr>
						<td class="black" colspan="3" style="font-size: 12pt; font-weight: bold"><i class="ace-icon fa fa-list-alt smaller-90"></i> Daftar Pemesanan :</td>
					</tr>
					<?php 
					$order = mysqli_query($con, "SELECT * FROM reception WHERE lunas=false AND cara_bayar='' AND id_customer='$id' AND nama_outlet='$outlet' ORDER BY id DESC");
					if(mysqli_num_rows($order)>0){
						while($res = mysqli_fetch_array($order)){
							?>
							<tr>
								<td id="tgl_order" tgl="<?= date('Y-m-d', strtotime($res['tgl_input'])) ?>" count="<?= mysqli_num_rows($order) ?>"><a href="" style="color: black"><?php echo $res['no_nota'] ?></a></td>
								<td width="5%"><button class="btn btn-white btn-info btn-sm cetak_order no-border" id="<?php echo $res['no_nota'] ?>"> <i class="fa fa-print" aria-hidden="true"></i></button></td>
								<td width="5%"> <?= ($res['spk']=="0") ? '<button type="button" class="btn btn-white btn-danger removeOrder btn-sm no-border" id="'.$res['no_nota'].'"> <i class="fa fa-trash-o" aria-hidden="true"></i></button>' : '<button type="button" class="btn btn-white btn-success btn-sm no-border"> <i class="fa fa-check" aria-hidden="true"></i></button>' ?> </td>
							</tr>
							<?php
						}

						if($_SESSION['cabang']=="Mojokerto" || ($_SESSION['cabang']=="Jakarta" && $_SESSION['outlet']!="Gading Serpong")){
							echo '<tr><td colspan="3" style="color: red"><marquee scrollamount="5">Order harus lunas agar bisa diproses di Operasional!</marquee></td></tr>';
						}

							
					} else { ?>
						<tr>
							<td><br><br></td>
						</tr>
						
						<?php
					}
					?>
						
				</table>
			</div>

			<div class="panel-footer">
				<table style="font-weight: bold; width: 100%">
					<tr>
						<td>Jumlah Item <?php echo mysqli_num_rows($order);	?> </td>
						<?php if(mysqli_num_rows($order)>0) {
							?>
							<td align="right"><a href="#" class="btn btn-success btn-sm" name="btdeposit" id="btselesai" style="width:100%">Selesai</a></td>
							<?php
						} ?>
						
					</tr>
				</table>
			</div>
			
		</div>
	</div>


	<?php 
	if(isset($_GET['preview'])){ ?>
		<div class="col-md-6" id="preview">
			<div class="panel panel-default">
				<div class="panel-body" style="background: #d9ffd9">
					<div id="a"></div>
					<table>
						<tr>
							<td class="black" colspan="3" style="font-size: 12pt; font-weight: bold"><i class="ace-icon fa fa-list-alt smaller-90"></i> Nota Preview</td>
						</tr>
					</table>
					<?php 
					$reception = mysqli_query($con, "SELECT * FROM reception WHERE id_customer='$id' ORDER BY id DESC LIMIT 0,1");
					$rrec = mysqli_fetch_assoc($reception);

					$order = mysqli_query($con, "SELECT * FROM detail_penjualan WHERE id_customer='$id' AND no_nota='$rrec[no_nota]' AND harga<>'0' ");
					?>
					<table style="width: 100%; font-weight: bold; border-bottom: 1px dotted #000">
						<tr>
							<td>Nama</td>
							<td>:</td>
							<td><?php echo $row['nama_customer']; ?></td>
						</tr>
						<tr>
							<td>No Nota</td>
							<td> : </td>
							<td><?php echo $rrec['no_nota']  ?></td>
						</tr>
					</table>

					<table style="font-size:9pt; width:100%; margin-top: 5px; margin-bottom: 15px; border-bottom: 1px dotted #000">
						<?php 
						while($data2 = mysqli_fetch_array($order)){
						?>
						<tr>
							<td>&nbsp;</td>
							<td><?php echo $data2['jumlah'] ?></td>
							<td><?php echo $data2['item'] ?></td>
							<td width="5%">Rp.</td>
							<td align="right" style="width: 10%"><?php echo number_format($data2['total'],0,',','.') ?></td>
							<td>&nbsp;</td>
							<td><a href="#" class="hapus-item" id="<?php echo $data2['item'] ?>"> <i class="fa fa-times" aria-hidden="true"></i></a></td>
						</tr>
						<?php 
						} 
						?>	
						<tr style="font-size:9pt;border-top: 3px double #b4b4b4; font-weight: bold;">
							<td colspan="3">Total</td>
							<td width="5%">Rp.</td>
							<td align="right" style="width: 10%"><?php echo number_format($rrec['total_bayar'],0,',','.') ?></td>
							<td>&nbsp;</td>
						</tr>	
					</table>
					<table align="right">
						<tr>
							<td><button class="btn btn-danger btn-sm btn-batal"> Batal</i></button></td>
							<td><a href="#" id="cetak_order" class="btn btn-primary btn-sm"> <i class="fa fa-print" aria-hidden="true"></i></a></td>
						</tr>
					</table>

					<script type="text/javascript">
						$("#cetak_order").click(function(){
					  		var nota = "<?php echo $rrec['no_nota'] ?>";
					  		var id = "<?php echo $id ?>";
					  		window.open('document/cetak_order.php?nota='+nota,'page','toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=750,height=600,left=50,top=50,titlebar=yes');
					  		window.location = '?transaksi&id='+id;
					  	});

					  	$(".hapus-item").on('click',function() {
					  		var item = $(this).attr("id");
					  		var nota = "<?php echo $rrec['no_nota'] ?>";
					  		$.ajax({
					  			url 	: 'action/hapus_item.php',
					  			data 	: 'hapus_item=hapus_item&nota='+nota+'&item='+item,
					  			success : function(data) {
					  				window.location="";
					  			}
					  		})
					  	});

					  	$(".btn-batal").click(function(){
					  		var id = "<?php echo $id ?>";
					  		var nota = "<?php echo $rrec['no_nota'] ?>";
					  		if(confirm("Order Dihapus?")) {
					  			$.ajax({
						  			url 	: 'action/batal_order.php',
						  			data 	: 'remove=remove&nota='+nota,
						  			success : function(data){
						  				window.location="?transaksi&id="+id;
						  			}
						  		})
					  		}
						  		
					  	});


					</script>

				</div>
			</div>

		</div> <?php
	} else { ?>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-body">
					<table>
						<tr>
							<td class="black" colspan="3" style="font-size: 12pt; font-weight: bold"><i class="ace-icon fa fa-list-alt smaller-90"></i> Pembayaran Terakhir</td>
						</tr>
					</table>
					<table class="table table-bordered table-striped table-condensed" id="faktur">
						<thead>
							<tr>
								<th>NO</th>
								<th>No Faktur</th>
								<th>Tanggal</th>
								<th class="sm-hide">Nilai Transaksi</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$no = 1;
							$query = mysqli_query($con, "SELECT * FROM faktur_penjualan WHERE id_customer='$id' ORDER BY id DESC LIMIT 10");
							while ($data = mysqli_fetch_assoc($query)){
								?>	
								<tr>
									<td align="center"><?php echo $no ?></td>
									<td><?php echo $data['no_faktur'] ?></td>
									<td align="right"><?php echo date('d/m/Y H:i', strtotime($data['tgl_transaksi'])) ?></td>
									<td class="sm-hide" align="right"><?php echo rp($data['total']) ?></td>
									<td align="center"><button class="btn btn-white btn-sm btn-info cetak-faktur" id="<?php echo $data['no_faktur'] ?>"><i class="ace-icon fa fa-print  align-top bigger-125 icon-on-right" aria-hidden="true"></i></button></td>
								</tr>
								<?php
								$no++;
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
					
		</div>

		<?php
		}
	?>

		
</div>


<div id="dialog-message" class="hide">
	<p class="bolder col-md-12">Pastikan tidak ada cucian yang berbahan sutera, pakaian berenda, bermanik, dan cucian yang tidak bisa dicuci di Kiloan!!</p>	
</div>

<div class="form-horizontal hide" id="form_kiloan">	
	<p class="bolder blue col-md-12">Jika menggunakan nota manual, isi sesuai barcode nota manualnya</p>
	<div class="form-group">
		<div class="col-md-12 col-xs-12">
			<input class="form-control" type="text" name="" id="nota_orderkl" placeholder="No Nota (Auto)">
			<input class="hidden" type="text" name="" id="nota_orderkl2" autocomplete="off">
		</div>
	</div>
	<?php 
	if($_SESSION['cabang']=="Jakarta") {
		echo '
		<div class="form-group" id="jenis_kiloan">
			<div class="radio" align="center">
				<label>
					<input name="form-field-radio" type="radio" class="ace" value="ck" id="jenis" />
					<span class="lbl blue bolder"> Cuci Kering</span>
				</label>
				<label>
					<input name="form-field-radio" type="radio" class="ace" value="ckl" id="jenis" />
					<span class="lbl blue bolder"> Cuci Kering Lipat</span>
				</label>
				<label>
					<input name="form-field-radio" type="radio" class="ace" value="cks" id="jenis"/>
					<span class="lbl blue bolder"> Cuci Kering Setrika</span>
				</label>
				<label>
					<input name="form-field-radio" type="radio" class="ace" value="ss" id="jenis" />
					<span class="lbl blue bolder"> Setrika &nbsp; &nbsp;</span>
				</label>
			</div>		
		</div>';
	}
	else {
		echo '
		<div class="form-group" id="jenis_kiloan">
			<div class="checkbox" align="center">
				<label>
					<input name="form-field-radio" type="radio" class="ace" value="cks" id="jenis"/>
					<span class="lbl blue bolder"> Cuci Kering Setrika</span>
				</label>
				<label>
					<input name="form-field-radio" type="radio" class="ace" value="ckl" id="jenis" />
					<span class="lbl blue bolder"> Cuci Kering Lipat</span>
				</label>
				<label>
					<input name="form-field-radio" type="radio" class="ace" value="ss" id="jenis" />
					<span class="lbl blue bolder"> Setrika Saja</span>
				</label>
			</div>		
		</div>
		';
	}
	?>	

	<div class="form-group" id="pilihan_item">		
		<label class="control-label col-md-4 col-xs-3">Item</label>
		<div class="col-md-6 col-xs-9">
			<select class="form-control" id="item" disabled="true">
				<option>--Pilih Item--</option>				
			</select>
		</div>	
	</div>

	<div class="form-group">
		<label class="control-label col-md-4 col-xs-3">Harga</label>
		<div class="col-md-6 col-xs-9">
			<input class="hidden" type="text" name="" id="it">
			<input class="form-control" type="text" name="" id="harga">
		</div>
	</div>	

	<div class="form-group">
		<label class="control-label col-md-4 col-xs-3">Ket Item</label>
		<div class="col-md-6 col-xs-9">
			<input class="form-control" type="text" name="" id="ket" placeholder="keterangan item">
			<span class="pesan-item"></span>
		</div>
	</div>		
</div>



<div class="form-horizontal hide" id="form_potongan" style="background: #d9ffd9">
	<div id="pilihan_potongan">
		<?php include 'include/pilihan_potongan.php'; ?>
	</div>	

	<div id="rincian_potongan">
		<table class="table table-condensed table-striped table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Item</th>
					<th>Harga Satuan</th>
					<th>Jumlah</th>
					<th>Keterangan</th>
				</tr>
			</thead>
			<tbody id="data_potongan">
				<?php 
				$no = 1;
				$query = mysqli_query($con, "SELECT *FROM order_potongan_tmp WHERE id_customer='$id' AND new_nota='' ORDER BY id DESC LIMIT 0,1");
				if(mysqli_num_rows($query)>0){
					while($result = mysqli_fetch_assoc($query)){		
					?>
					<tr>
						<td class="hidden" id="no_nota"><?php echo $result['no_nota'] ?></td>
						<td align="center"><?php echo $no ?></td>
						<td><?php echo $result['item'] ?></td>
						<td><?php echo $result['harga'] ?></td>
						<td align="center"><?php echo $result['jumlah'] ?></td>
						<td><?php echo $result['ket'] ?></td>
					</tr>
					<?php
					$no++;
					}				
				} else {
				?>
				<tr>
					<td colspan="5" align="center">..Data tidak ada..</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>


<form class="form-horizontal hide" id="parfum" style="background: #d9ffd9">
	<div class="control-group">
		<div class="radio">
			<label>
				<input name="form-field-radio" type="radio" class="ace actived" value="normal" id="parf" checked="checked" />
				<span class="lbl"> Normal</span>
			</label>
			<label>
				<input name="form-field-radio" type="radio" class="ace" value="extra" id="parf" />
				<span class="lbl"> Extra</span>
			</label>
			<label>
				<input name="form-field-radio" type="radio" class="ace" value="0" id="parf" />
				<span class="lbl"> Tanpa Parfum</span>
			</label>
		</div>		
	</div>
</form>

<form class="form-horizontal hide" id="hanger" style="background: #d9ffd9">
	<div class="form-group">
		<div class="checkbox">
			<label>
				<input name="form-field-checkbox" type="checkbox" class="ace" id="hang" value="1" />
				<span class="lbl"> Ada Hangernya Sendiri</span>
			</label>
		</div>
	</div>
	<div class="form-group">
		<p class="bolder col-md-12">Hanger yang dibawa sendiri hanya mendapatkan satu plastik hanger per nota.<br>Beli plastik hanger jika membutuhkan plastik tambahan</p>
	</div>
	<div class="form-group">
		<label class="control-label col-md-5 smaller">Hanger</label>
		<div class="col-md-3">
			<input class="form-control" type="number" name="" value="" id="hangers" placeholder=" @ Rp 2,500">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-5 smaller">Plastik Hanger</label>
		<div class="col-md-3">
			<input class="form-control" type="number" name="" value="" id="plastik_hangers" placeholder=" @ Rp 2,000">
		</div>
	</div>
	<div id="f"></div>
</form>

<form class="form-horizontal hide" id="voucher_promo" style="background: #d9ffd9">
	
	<div class="form-group">
		<p class="bolder col-md-12">Abaikan jika tidak ada voucher atau kode promonya!</p>
	</div>
	<div class="form-group">
		<div class="col-md-12">
			<input class="form-control" type="text" name="" value="" id="kode_voucher" placeholder="Input kode di sini..!">
		</div>
	</div>
	<div id="pesan_voucher"></div>
</form>

<form class="form-horizontal hide" id="express" style="background: #d9ffd9">
	<div class="control-group">
		<div class="radio">
			<label>
				<input name="form-field-radio" type="radio" class="ace actived" id="exp" value="0" checked="checked" />
				<span class="lbl"> Normal</span>
			</label>
			<label>
				<input name="form-field-radio" type="radio" class="ace" id="exp" value="1" />
				<span class="lbl"> Express</span>
			</label>
			<label>
				<input name="form-field-radio" type="radio" class="ace" id="exp" value="2" />
				<span class="lbl"> Double Express</span>
			</label>
			<label>
				<input name="form-field-radio" type="radio" class="ace" id="exp" value="3" />
				<span class="lbl"> Super Express</span>
			</label>
		</div>		
	</div>
</form>

<div class="hide" id="form_pembayaran" style="background: #d9ffd9">
	<div id="p"></div>
	<table class="col-md-12" style="margin-top: 15px; margin-left: 0; margin-bottom: 10px; width: 360px">
		<?php 
		$total = mysqli_query($con, "SELECT SUM(total_bayar) AS total FROM reception WHERE id_customer='$id' AND lunas=false AND cara_bayar=''");
		$rtotal = mysqli_fetch_row($total);
		$tagihan = $rtotal[0];
		?>
		<tr>
			<td width="45%" class="bolder">Total Tagihan</td>
			<td width="5%">&nbsp; :</td>
			<td class="bolder"><input class="form-control" type="number" name="" value="<?php echo $tagihan ?>" readonly id="tagihan" onfocus="startHitung()" onblur="endHitung()"></td>
		</tr>
		<?php 
		$tagihankiloan = mysqli_query($con, "SELECT COALESCE(SUM(detail_penjualan.berat),0) AS berat FROM detail_penjualan INNER JOIN reception ON detail_penjualan.no_nota=reception.no_nota WHERE reception.lunas=false AND reception.cara_bayar='' AND detail_penjualan.item LIKE 'Cuci Kering Setrika%' AND detail_penjualan.id_customer='$id'");
		$rtagihankiloan = mysqli_fetch_row($tagihankiloan);
		$cks = $rtagihankiloan[0];

		$tagihansetrika = mysqli_query($con, "SELECT COALESCE(SUM(a.berat),0) AS berat FROM detail_penjualan AS a INNER JOIN reception AS b ON a.no_nota=b.no_nota WHERE b.lunas=false AND b.cara_bayar='' AND a.item LIKE 'Setrika%' AND a.id_customer='$id'");
		$rtagihansetrika = mysqli_fetch_row($tagihansetrika);
		$ss = $rtagihansetrika[0];

		$totaltagihankuota = $cks*8800+$ss*6400;

		if($status=="langganan"){ ?>
			<tr>
				<td class="bolder">Kuota Kiloan</td>
				<td>&nbsp; :</td>
				<td>
					<div class="input-group" style="width: 100%">
						<input class="form-control" style="width: 100%" type="" value="" name="" id="cks" placeholder="Berat CKS" onfocus="startHitung()" onblur="endHitung()">
						<input class="form-control" type="" name="" value="" id="ss" style="width: 50%" placeholder="Berat SS" onfocus="startHitung()" onblur="endHitung()">
						<input class="form-control" type="" name="" value="" id="ckl" style="width: 50%" placeholder="Berat CKL" onfocus="startHitung()" onblur="endHitung()">
					</div>				
				</td>
			</tr>
			<tr>
				<td class="bolder">Kuota Potongan</td>
				<td>&nbsp; :</td>
				<td><input class="form-control" type="" name="" value="0" id="kuota_potongan" onfocus="startHitung()" onblur="endHitung()"></td>
			</tr>
			<?php
		} else {
			?>
			<tr>
				<td class="bolder"><input type="text" disabled="" name="" id="voucher" placeholder="Kode Voucher Di sini!!" onfocus="startHitung()" onblur="endHitung()"></td>
				<td>&nbsp; :</td>
				<td><input class="form-control" type="number" name="" id="diskon" value="0" readonly="" onfocus="startHitung()" onblur="endHitung()">
				</td>
			</tr>
			<?php
		}
		?>			
		<tr>
			<td class="bolder">Pembayaran Cash</td>
			<td>&nbsp; :</td>
			<td><input class="form-control" type="number" name="" value="0" id="bayar_cash" onfocus="startHitung()" onblur="endHitung()"></td>
		</tr>
		<tr>
			<td>
				<select class="form-control no-border" placeholder="Click to Choose..." id="edc" onfocus="startHitung()" onblur="endHitung()">
					<option class="bolder">--Pilih EDC--</option>
					<option value="BCA">BCA</option>
					<option value="BNI">BNI</option>
					<option value="BRI">BRI</option>
					<option value="Mandiri">Mandiri</option>
					<option value="OVO">OVO</option>
					<option value="Go-Pay">Go-Pay</option>			
				</select>
			</td>
			<td>&nbsp; :</td>
			<td><input class="form-control" type="number" name="" value="0" disabled="disabled" id="bayar_edc" onfocus="startHitung()" onblur="endHitung()"></td>
		</tr>
		<tr>
			<td class="bolder">Sisa Tagihan</td>
			<td>&nbsp; :</td>
			<td class="bolder"><input class="form-control" type="number" name="" value="0" readonly="" id="sisa" onfocus="startHitung()" onblur="endHitung()"></td>
		</tr>		
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="3"><input class="btn btn-block btn-success" type="submit" name="" id="simpan" value="Simpan" disabled=""></td>
		</tr>
	</table>
	
</div>

<script type="text/javascript">

	$("#offlgn").on('click', function(e){
		e.preventDefault();
		if(confirm("<?php echo 'Customer '. $row['nama_customer'] ?> akan Berhenti Berlangganan? Sisa kuota akan hangus")){
			var id = "<?php echo $id ?>";
			$.ajax({
				url 	: 'action/matikan_langganan.php',
				data 	: 'id='+id,
				success : function(){
					window.location="";
				}
			})
		}		
	});



	

	function startHitung(){
		interval=setInterval("Hitung()",5);
	}

	function Hitung(){
		var edc = $("#edc").val();
		if(edc!='--Pilih EDC--'){
			$("#bayar_edc").prop('disabled', false);
		} else {
			$("#bayar_edc").prop('disabled', true);
			$("#bayar_edc").val("0");
		}

		var cks = $("#cks").val();
		var ss = $("#ss").val();
		var ckl = $("#ckl").val();

		var cabang = '<?= $cabang ?>';
		var outlet = '<?= $outlet ?>';
		if(cabang=="Medan"){
			var hkcks = 7000;
			var hss = 4000;
			var hckl = 5000;
		} else if(cabang=="Jakarta"){
			if(outlet=="Gading Serpong") {
				var hkcks = 8000;
				var hss = 6000;
				var hckl = 6000;
			}
			else {
				var hkcks = 8800;
				var hss = 6400;
				var hckl = 7400;
			}
				
		} else {
			var hkcks = 7000;
			var hss = 4000;
			var hckl = 5000;
		}

		var totsisakuota = "<?php echo $lgn['kilo_cks'] ?>"*hkcks;
		var bayarkiloan = (cks*hkcks+ss*hss+ckl*hckl).toFixed();
		var totsisapotongan = "<?php echo $lgn['potongan'] ?>";
		var bayar_potongan = $("#kuota_potongan").val();
		if(bayarkiloan>totsisakuota){
			alert("kuota kiloan tidak mencukupi");
			$("#cks").val("0");
			$("#ss").val("0");
		};

		if(bayar_potongan>totsisapotongan){
			alert("kuota potongan tidak mencukupi");
			$("#kuota_potongan").val(0);
		}
		
		var tagihan = $("#tagihan").val();
		var voucher = $("#voucher").val();	
		var diskon  = $("#diskon").val();
		
		if(voucher!='' && diskon==0) {
			$.ajax({
				url 	: 'include/kode_promo.php',
				data 	: 'voucher='+voucher+'&tagihan='+tagihan,
				success : function(data){
					var json_data = data,
					objek = JSON.parse(json_data);
					$("#diskon").val(objek.diskon);
				}
			});			
		} else if(voucher!='' && diskon>0){
			$("#diskon").val();
		} else {
			$("#diskon").val(0);
		};

		
		var cash = $("#bayar_cash").val();
		var edc = $("#bayar_edc").val();
		var status = "<?php echo $status ?>";
		if(status=="langganan"){
			var sisa = tagihan-cash-edc-bayarkiloan-bayar_potongan;
		} else {
			var sisa = tagihan-diskon-cash-edc;
		}
		
		$("#sisa").val(sisa);

		var bayar_kuota = bayarkiloan+bayar_potongan;
		if(bayar_kuota>0 && cash>0 && edc>0){
			alert("Tidak boleh 3 cara bayar!!");
			$("#bayar_cash").val(0);
			$("#bayar_edc").val(0);
		} else if(diskon>0 && cash>0 && edc>0){
			alert("Tidak boleh 3 cara bayar!!");
			$("#bayar_edc").val(0);
			$("#bayar_cash").val(0);
		}
		
		if(sisa=='0'){
			$("#simpan").prop('disabled', false);
		} else if(sisa!='0') {
			$("#simpan").prop('disabled', true);
		}
	}

	function endHitung(){
	clearInterval(interval);
	}


	$("#simpan").on('click', function(){
		var total = $("#tagihan").val();
		var id = "<?php echo $id ?>";
		var voucher = $("#voucher").val();
		var diskon = $("#diskon").val();
		var bayar_cash = $("#bayar_cash").val();
		var edc = $("#edc").val();
		var bayar_edc = $("#bayar_edc").val();
		var cks = $("#cks").val();
		var ss = $("#ss").val();
		var ckl = $("#ckl").val();
		var kuota_potongan = $("#kuota_potongan").val();

		var cabang = '<?= $cabang ?>';
		var outlet = '<?= $outlet ?>';
		if(cabang=="Medan"){
			var hkcks = 7000;
			var hss = 4000;
			var hckl = 5000;
		} else if(cabang=="Jakarta"){
			if(outlet=="Gading Serpong") {
				var hkcks = 8000;
				var hss = 6000;
				var hckl = 6000;
			}
			else {
				var hkcks = 8800;
				var hss = 6400;
				var hckl = 7400;
			}
				
		} else {
			var hkcks = 7000;
			var hss = 4000;
			var hckl = 5000;
		}

		var kuota = cks*hkcks+ss*hss+ckl*hckl+kuota_potongan*1;
		$.ajax({
			url 	: 'action/simpan_pembayaran_order.php',
			data 	: 'id='+id+'&total_tagihan='+total+'&bayar_cash='+bayar_cash+'&edc='+edc+'&bayar_edc='+bayar_edc+'&kuota='+kuota+'&cks='+cks+'&ss='+ss+'&ckl='+ckl+'&kuota_potongan='+kuota_potongan+'&voucher='+voucher+'&diskon='+diskon,
			success : function(data){
				window.location="?transaksi&id="+id;
			}
		})
	})

	$("#voucher").blur(function(){
		var voucher = $("#voucher").val();
		var diskon = $("#diskon").val();
		if(voucher != '' && diskon==0) {
			alert("Voucher tidak dapat digunakan!!");
		}
	});


</script>

<form class="form-horizontal hide" id="form_deposit" style="background: #d9ffd9">
	<div class="col-md-10 col-md-offset-1" id="peringatan" style="font-size: 12px; color: red"></div>
					
	<div class="form-group">
		<label class="control-label col-xs-12 col-md-5 "> Pilih Paket</label>
		<div class="col-md-7">
			<select class="form-control" placeholder="Click to Choose..." id="paket">
				<option></option>
				<option value="all_kiloan">All Kiloan</option>
				<option value="single">Single</option>
				<option value="double">Double</option>
				<option value="custom">Custom</option>			
			</select>
		</div>
	</div>

	<div class="form-group" id="aktifa">
		<label class="control-label col-md-5"> Masa aktif</label>
		<div class="checkbox col-md-7">
			<label>
				<input name="form-field-checkbox" type="radio" class="ace" id="masa_aktif" value="1" />
				<span class="lbl"> 1 Bulan</span>
			</label>
			<label>
				<input name="form-field-checkbox" type="radio" class="ace" id="masa_aktif" value="2" />
				<span class="lbl"> 2 Bulan</span>
			</label>			
		</div>		
	</div>

	<div class="form-group">
		<label class="control-label col-md-5"> Harga Paket</label>
		<div class="col-md-7">
			<input class="form-control" type="number" name="" value="0" id="hargapaket">
		</div>
	</div> 

	<div class="form-group" id="pembayaran">
		<label class="control-label col-xs-12 col-md-5 "> Pembayaran</label>
		<div class="radio col-md-7">
			<label>
				<input name="form-field-radio" type="radio" class="ace" id="bayar" value="Cash" checked="checked" />
				<span class="lbl"> Cash</span>
			</label><br>
			<label>
				<input name="form-field-radio" type="radio" class="ace" id="bayar" value="edc" />
				<span class="lbl"> EDC</span>
			</label><br>
			<label>
				<input name="form-field-radio" type="radio" class="ace" id="bayar" value="transfer" />
				<span class="lbl"> Transfer</span>
			</label>
		</div>
	</div>

	<div class="form-group" id="cara_bayar">		
	</div> 
</form>


<form class="form-horizontal hide" id="form_membership" style="background: #d9ffd9; ">
	<div class="col-md-10 col-md-offset-1" id="peringatan2" style="font-size: 12px; color: red"></div>
		
	<div class="form-group" id="pilih_level">
		<label class="control-label col-md-5"> Level</label>
		<div class="checkbox col-md-7">
			<label>
				<input name="form-field-checkbox" type="checkbox" class="ace" id="level" value="red" />
				<span class="lbl"> RED</span>
			</label>
			<label>
				<input name="form-field-checkbox" type="checkbox" class="ace" id="level" value="blue" />
				<span class="lbl"> BLUE</span>
			</label>		
		</div>		
	</div>

	<div class="form-group" id="hargamember">				
	</div>

	<div class="form-group" id="pembayaran2">
		<label class="control-label col-xs-12 col-md-5 "> Pembayaran</label>
		<div class="radio col-md-7">
			<label>
				<input name="form-field-radio" type="radio" class="ace" id="bayar2" value="Cash" checked="checked" />
				<span class="lbl"> Cash</span>
			</label><br>
			<label>
				<input name="form-field-radio" type="radio" class="ace" id="bayar2" value="edc" />
				<span class="lbl"> EDC</span>
			</label><br>
			<label>
				<input name="form-field-radio" type="radio" class="ace" id="bayar2" value="transfer" />
				<span class="lbl"> Transfer</span>
			</label>
		</div>
	</div>

	<div class="form-group" id="cara_bayar2">		
	</div> 
</form>

<form class="form-horizontal laundrylocker hide">
	<div class="form-group">
		<div class="radio" align="center">
			<label>
				<input name="form-field-radio locker" type="radio" class="ace" value="slock" id="locker" onchange="clocker()" />
				<span class="lbl blue bolder"> Small Locker</span>
			</label>
			<label>
				<input name="form-field-radio locker" type="radio" class="ace" value="mlock" id="locker" onchange="clocker()" />
				<span class="lbl blue bolder"> Medium Locker</span>
			</label>
		</div>
	</div>
	<div class="form-group">		
		<div class="" align="center">
			<input class="" type="text" readonly="" name="" id="hargalocker" value="0" onchange="clocker()">
		</div>
	</div>
	
	<div class="form-group" id="pembayaran3">
		<label class="control-label col-xs-12 col-md-5 "> Pembayaran</label>
		<div class="radio col-md-7">
			<label>
				<input name="form-field-radio" type="radio" class="ace" id="bayar3" value="Cash" onchange="clocker()" />
				<span class="lbl"> Cash</span>
			</label><br>
			<label>
				<input name="form-field-radio" type="radio" class="ace" id="bayar3" value="edc" onchange="clocker()" />
				<span class="lbl"> EDC</span>
			</label><br>
			<label>
				<input name="form-field-radio" type="radio" class="ace" id="bayar3" value="transfer" onchange="clocker()" />
				<span class="lbl"> Transfer</span>
			</label>
		</div>
	</div>

	<div class="form-group" id="cara_bayar3">
	</div> 
</form>

<script type="text/javascript">
	function clocker(){
		paket = $('#locker:checked').val();
		harga = $('#hargalocker').val();
		if(paket=="slock"){
			$('#hargalocker').val(250000);
		}
		else if(paket=="mlock") {
			$('#hargalocker').val(325000);
		}

		pembayaran = $("#bayar3:checked").val();
      	$("#cara_bayar3").load("include/pembayaran_deposit.php?pembayaran="+pembayaran);	
	};
</script>

					

<script type="text/javascript">
  $(document).ready(function(){  	

  	$("#jenis_kiloan").change(function(){
  		var id = "<?php echo $id ?>";
  		var jenis = $("#jenis:checked").val();
  		$('#harga').val(0);
  		$("#pilihan_item").load("include/pilihan_jenis_item.php?jenis="+jenis+"&id="+id);
  	});

  	$(".cetak_order").click(function(){
  		var nota = $(this).attr("id");
  		window.open('document/cetak_order.php?nota='+nota,'page','toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=750,height=600,left=50,top=50,titlebar=yes');
  	});

  	$(".cetak-faktur").click(function(){
  		var faktur = $(this).attr("id");
  		window.open('document/cetak_faktur.php?faktur='+faktur,'page','toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=750,height=600,left=50,top=50,titlebar=yes');
  	});

  	
  	$(".removeOrder").click(function(){
  		var nota = $(this).attr('id');
  		if(confirm("Order Dihapus?")) {
  			$.ajax({
	  			url 	: 'action/batal_order.php',
	  			data 	: 'remove=remove&nota='+nota,
	  			success : function(data){
	  				window.location="";
	  			}
	  		})
  		}
	  		
  	}); 	

  	$('#item').on('change', function(e){
		var item = $(this).val().split('-');
		$('#it').val(item[0]);
		$("#harga").val(item[1]);
	});	

	$("#item2").change(function(){
		var item = $(this).val().split('-');
		$('#it2').val(item[0]);
		$("#harga2").val(item[1]);
	});

	$("#save_item").click(function(){
		var id = "<?php echo $id ?>";
		var no_nota = $("#nota_order").val();
		var item = $("#it2").val();
		var harga = $("#harga2").val();
		var jumlah = $("#jumlah2").val();
		var ket = $("#ket2").val();
		$.ajax({
			url 	: 'action/simpan_item_sementara.php',
			data 	: 'id='+id+'&no_nota='+no_nota+'&item='+item+'&harga='+harga+'&ket='+ket+'&jumlah='+jumlah,
			success : function(data){
				$("#data_potongan").html(data);
				$("#pilihan_potongan").load("include/pilihan_potongan2.php?id="+id);
				$("#rincian_potongan").load("include/rincian_potongan.php?id="+id);
			}
		})
	});

    $.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
        _title: function(title) {
          var $title = this.options.title || '&nbsp;'
          if( ("title_html" in this.options) && this.options.title_html == true )
            title.html($title);
          else title.text($title);
        }
    }));

    $( "#btlocker" ).on('click', function(e) {
      e.preventDefault(); 
      	locker();     	      
    });	

    $( "#btkiloan" ).on('click', function(e) {
      e.preventDefault(); 
      	var nowDate = '<?= date('Y-m-d') ?>';
		var tgl = $('#tgl_order').attr('tgl');
		var count = $('#tgl_order').attr('count');
		if(count>0 && tgl != nowDate) {
			alert('Masih ada order kemarin belum dibayar, lunaskan dulu sebelum bertransaksi');
		}
		else {
			warning();
		} 
     	      
    });	

    $( "#btpotongan" ).on('click', function(e) {
      e.preventDefault();  
      	var nowDate = '<?= date('Y-m-d') ?>';
		var tgl = $('#tgl_order').attr('tgl');
		var count = $('#tgl_order').attr('count');
		if(count>0 && tgl != nowDate) {
			alert('Masih ada order kemarin belum dibayar, lunaskan dulu sebelum bertransaksi');
		}
		else {
			potongan();	 
		}
           
    });	

    $( "#btdeposit" ).on('click', function(e) {
      e.preventDefault();  
      deposit();	      
    });	

    $( "#btmember" ).on('click', function(e) {
      e.preventDefault();  
      membership();	      
    });	

    function warning(){
      	var dialog = $( "#dialog-message" ).removeClass('hide').dialog({ 
	      	resizable: false,
	      	height: "auto",
	      	width: "auto",    	
	        modal: true,
		      show: {
		        effect: "blind",
		        duration: 500
		      },
	        title: "<div class='widget-header widget-header-small'><h4 class='smaller bolder blue'><i class='ace-icon fa fa-info-circle'></i> Warning!!</h4></div>",
	        title_html: true,
	        buttons: [ 
				{
					text: "Batal",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				},
				{
					text: "OK",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						$( this ).dialog("close");
						kiloan();	
					} 
				}
			]
	        
	      });
      }  

      
    function kiloan(){

		var dialog = $( "#form_kiloan" ).removeClass('hide').dialog({ 
	      	resizable: false,
	      	height: "auto",
	      	width: "auto",  	
	        modal: true,
		      show: {
		        effect: "blind",
		        duration: 500
		      },
	        title: "<div class='widget-header widget-header-small'><h4 class='smaller bolder blue'><i class='ace-icon fa fa-check'></i> Kiloan</h4></div>",
	        title_html: true,
	        buttons: [ 
				{
					text: "Prev",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
						warning();
					} 
				},
				{
					text: "Next",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						if($("#harga").val()!=0){
							$('.pesan-item').html("");
							$( this ).dialog( "close" );
							var nota = $("#nota_orderkl").val();
							var item = $("#it").val();
							var harga = $("#harga").val();
							var ket = $("#ket").val();
							var idcst = "<?php echo $id ?>";
							$.ajax({
								url 	: 'action/simpan_order.php',
								data 	: 'nota='+nota+'&item='+item+'&harga='+harga+'&ket='+ket+'&idcst='+idcst,
								success: function(data){
									$("#nota_orderkl2").val(data);
									parfum();
								}
							})
						}

						else {
							$('.pesan-item').html("Item belum dipilih").css('color', 'red');
						}
							
						
					} 
				},
			]
	    })
    	  	
    }

    function potongan(){
    	var dialog = $( "#form_potongan" ).removeClass('hide').dialog({ 
	      	resizable: false,
	      	height: "auto",
	      	width: "auto",  	
	        modal: true,
		      show: {
		        effect: "blind",
		        duration: 500
		      },
	        title: "<div class='widget-header widget-header-small'><h4 class='smaller bolder blue'><i class='ace-icon fa fa-check'></i> Potongan</h4></div>",
	        title_html: true,
	        buttons: [
				{
					text: "Close",
					"class" : "btn btn-minier",
					click: function() {
						var potongan = "potongan"; 
						var id = "<?php echo $id ?>";
						$.ajax({
							url 	: 'action/batal_order.php',
							data 	: 'potongan='+potongan+'&id='+id,
								success: function(data){
								window.location="";
							}
						})
					} 
				},
				{
					text: "Next",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
						parfum2();						
					} 
				},
			]
	    })
    }

    function parfum(){
      	var dialog = $( "#parfum" ).removeClass('hide').dialog({ 
	      	resizable: false,
	      	height: "auto",
	      	width: "auto",
	      	color: "red",     	
	        modal: true,
		      show: {
		        effect: "blind",
		        duration: 500
		      },
	        title: "<div class='widget-header widget-header-small'><h4 class='smaller bolder blue'><i class='ace-icon fa fa-check'></i> Parfum</h4></div>",
	        title_html: true,
	        buttons: [ 
				{
					text: "Prev",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
						kiloan();
					} 
				},
				{
					text: "Next",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						$( this ).dialog("close");
						var kiloan = "kiloan";
						var parfum = $("#parf:checked").val();
						var nota = $("#nota_orderkl2").val();
						$.ajax({
							url 	: 'action/parfum.php',
							data 	: 'kiloan='+kiloan+'&parfum='+parfum+'&nota='+nota,
							success : function(data){
								hanger();
							}
						})
					} 
				}
			]
	        
	      });
      }  

      function hanger(){
      	var dialog = $( "#hanger" ).removeClass('hide').dialog({ 
	      	resizable: false,
	      	height: "auto",
	      	width: "auto",
	      	color: "red",     	
	        modal: true,
		      show: {
		        effect: "blind",
		        duration: 500
		      },
	        title: "<div class='widget-header widget-header-small'><h4 class='smaller bolder blue'><i class='ace-icon fa fa-check'></i> Hanger</h4></div>",
	        title_html: true,
	        buttons: [ 
				{
					text: "Prev",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
						parfum();
					} 
				},
				{
					text: "Next",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
						var kiloan ="kiloan";
						var id = "<?php echo $id ?>";
						var hanger = $("#hang:checked").val();
						var nota = $("#nota_orderkl2").val();
						var hangers = $("#hangers").val();
						var p_hangers = $("#plastik_hangers").val();
						$.ajax({
							url 	: 'action/hanger.php',
							data 	: 'kiloan='+kiloan+'&hanger='+hanger+'&nota='+nota+'&hangers='+hangers+'&p_hangers='+p_hangers+'&id='+id,
							success : function(data){
								voucher_promo();
							}
						})		
					} 
				}
			]
	        
	      });
      }  

      function voucher_promo(){
      	var dialog = $( "#voucher_promo" ).removeClass('hide').dialog({ 
	      	resizable: false,
	      	height: "auto",
	      	width: "auto",
	      	color: "red",     	
	        modal: true,
		      show: {
		        effect: "blind",
		        duration: 500
		      },
	        title: "<div class='widget-header widget-header-small'><h4 class='smaller bolder blue'><i class='ace-icon fa fa-check'></i> Voucher Promo</h4></div>",
	        title_html: true,
	        buttons: [ 
				{
					text: "Prev",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
						hanger();
					} 
				},
				{
					text: "Next",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						var id = "<?php echo $id ?>";
						var kode_voucher = $("#kode_voucher").val();
						var nota = $("#nota_orderkl2").val();
						$.ajax({
							url 	: 'action/voucher_promo.php',
							data 	: 'kode_voucher='+kode_voucher+'&nota='+nota+'&id='+id,
							success : function(data){
								if(data=="X"){
									$('#pesan_voucher').html("Voucher tidak bisa digunakan..!").css("color", "red");
								} else {
									$('#voucher_promo').dialog("close");
									express();
								}
							}
						})		
					} 
				}
			]
	        
	      });
      } 

      function express(){
      	var dialog = $( "#express" ).removeClass('hide').dialog({ 
	      	resizable: false,
	      	height: "auto",
	      	width: "auto",
	      	color: "red",     	
	        modal: true,
		      show: {
		        effect: "blind",
		        duration: 500
		      },
	        title: "<div class='widget-header widget-header-small'><h4 class='smaller bolder blue'><i class='ace-icon fa fa-check'></i> Express</h4></div>",
	        title_html: true,
	        buttons: [ 
				{
					text: "Prev",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
						voucher_promo();
					} 
				},
				{
					text: "Next",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						$( this ).dialog("close");
						var kiloan = "kiloan";
						var id = "<?php echo $id ?>";
						var express = $("#exp:checked").val();
						var nota = $("#nota_orderkl2").val();
						$.ajax({
							url 	: 'action/express.php',
							data 	: 'kiloan='+kiloan+'&express='+express+'&nota='+nota+'&id='+id,
							success : function(data){
								window.location="?transaksi&id="+id+"&preview";
							}
						})			
					} 
				}
			]
	        
	      });
      }  

      function parfum2(){
      	var dialog = $( "#parfum" ).removeClass('hide').dialog({ 
	      	resizable: false,
	      	height: "auto",
	      	width: "auto",
	      	color: "red",     	
	        modal: true,
		      show: {
		        effect: "blind",
		        duration: 500
		      },
	        title: "<div class='widget-header widget-header-small'><h4 class='smaller bolder blue'><i class='ace-icon fa fa-check'></i> Parfum</h4></div>",
	        title_html: true,
	        buttons: [ 
				{
					text: "Prev",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
						potongan();
					} 
				},
				{
					text: "Next",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
						var potongan = "potongan";
						var parfum = $("#parf:checked").val();
						var nota = $("#no_nota").html();
						$.ajax({
							url 	: 'action/parfum.php',
							data 	: 'potongan='+potongan+'&parfum='+parfum+'&nota='+nota,
							success : function(data){
								voucher_promo2();
							}
						})
						
					} 
				}
			]
	        
	      });
      }  

      function hanger2(){
      	var dialog = $( "#hanger" ).removeClass('hide').dialog({ 
	      	resizable: false,
	      	height: "auto",
	      	width: "auto",
	      	color: "red",     	
	        modal: true,
		      show: {
		        effect: "blind",
		        duration: 500
		      },
	        title: "<div class='widget-header widget-header-small'><h4 class='smaller bolder blue'><i class='ace-icon fa fa-check'></i> Hanger</h4></div>",
	        title_html: true,
	        buttons: [ 
				{
					text: "Prev",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
						parfum2();
					} 
				},
				{
					text: "Next",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
						var potongan ="potongan";
						var id = "<?php echo $id ?>";
						var hanger = $("#hang:checked").val();
						var nota = $("#no_nota").html();
						var hangers = $("#hangers").val();
						var p_hangers = $("#plastik_hangers").val();
						$.ajax({
							url 	: 'action/hanger.php',
							data 	: 'potongan='+potongan+'&hanger='+hanger+'&nota='+nota+'&hangers='+hangers+'&p_hangers='+p_hangers+'&id='+id,
							success : function(data){
								voucher_promo2();
							}
						})		
					} 
				}
			]
	        
	      });
      }  



      function voucher_promo2(){
      	var dialog = $( "#voucher_promo" ).removeClass('hide').dialog({ 
	      	resizable: false,
	      	height: "auto",
	      	width: "auto",
	      	color: "red",     	
	        modal: true,
		      show: {
		        effect: "blind",
		        duration: 500
		      },
	        title: "<div class='widget-header widget-header-small'><h4 class='smaller bolder blue'><i class='ace-icon fa fa-check'></i> Voucher Promo</h4></div>",
	        title_html: true,
	        buttons: [ 
				{
					text: "Prev",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
						parfum2();
					} 
				},
				{
					text: "Next",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						
						var id = "<?php echo $id ?>";
						var kode_voucher = $("#kode_voucher").val();
						var nota = $("#no_nota").html();
						$.ajax({
							url 	: 'action/voucher_promo.php',
							data 	: 'kode_voucher='+kode_voucher+'&nota='+nota+'&id='+id,
							success : function(data){
								if(data=="X"){
									$('#pesan_voucher').html("Voucher tidak bisa digunakan..!").css("color", "red");
								} else if(data=="Z"){
									$('#pesan_voucher').html("Kode ini hanya berlaku untuk kiloan..!").css("color", "red");
								} else {
									$('#voucher_promo').dialog("close");
									express2();
								}
							}
						})		
					} 
				}
			]
	        
	      });
      } 

      function express2(){
      	var dialog = $( "#express" ).removeClass('hide').dialog({ 
	      	resizable: false,
	      	height: "auto",
	      	width: "auto",
	      	color: "red",     	
	        modal: true,
		      show: {
		        effect: "blind",
		        duration: 500
		      },
	        title: "<div class='widget-header widget-header-small'><h4 class='smaller bolder blue'><i class='ace-icon fa fa-check'></i> Express</h4></div>",
	        title_html: true,
	        buttons: [ 
				{
					text: "Prev",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
						voucher_promo2();
					} 
				},
				{
					text: "Preview",
					"class" : "btn btn-success btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
						var potongan = "potongan";
						var id = "<?php echo $id ?>";
						var express = $("#exp:checked").val();
						var nota = $("#no_nota").html();
						$.ajax({
							url 	: 'action/express.php',
							data 	: 'potongan='+potongan+'&express='+express+'&nota='+nota+'&id='+id,
							success : function(data){
								window.location="?transaksi&id="+id+"&preview";
							}
						})							
					} 
				}
			]
	        
	      });
      } 

      function deposit(){
      	var dialog = $( "#form_deposit" ).removeClass('hide').dialog({ 
	      	resizable: false,
	      	height: "auto",
	      	width: "auto",    	
	        modal: true,
		      show: {
		        effect: "blind",
		        duration: 500
		      },
	        title: "<div class='widget-header widget-header-small'><h4 class='smaller bolder blue'><i class='ace-icon fa fa-check'></i> Form Deposit Langganan</h4></div>",
	        title_html: true,
	        buttons: [ 
				{
					text: "Batal",
					"class" : "btn btn-default btn-minier btn-sm",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				},
				{
					text: "Simpan",
					"class" : "btn btn-success btn-sm radius-4 btn-minier",
					click: function() {
						
						var id = "<?php echo $id ?>";
						var paket = $("#paket").val();
						var hargapaket = $("#hargapaket").val();
						var masa_aktif = $("#masa_aktif:checked").val();
						var pembayaran = $("#bayar:checked").val();
						var carabayar = $("#carabayar").val();
						if(pembayaran=="Cash") carabayar="Cash";

						if(paket=="" || hargapaket=="0"){
							$("#peringatan").html("Silahkan lengkapi dulu");
						} 
						else {
							$.ajax({
								url 	: 'action/pembayaran_deposit.php',
								data 	: 'paket='+paket+'&hargapaket='+hargapaket+'&masa_aktif='+masa_aktif+'&Pembayaran='+pembayaran+'&carabayar='+carabayar+'&id='+id,
								success : function(data){
									$("#peringatan").html(data);
									dialog.dialog( "close" ); 
								}
							})
						}
					} 
				}
			]
	        
	      });
      }; 

      $("#pembayaran").change(function(){
      	var pembayaran = $("#bayar:checked").val();
      	$("#cara_bayar").load("include/pembayaran_deposit.php?pembayaran="+pembayaran);
      });

      $("#pembayaran2").change(function(){
      	var pembayaran = $("#bayar2:checked").val();
      	$("#cara_bayar2").load("include/pembayaran_deposit.php?pembayaran="+pembayaran);
      });

      $('#paket').click(function(){
      	$('#hargapaket').val("0");
      	$('#masa_aktif').attr('checked', false);
      })

      $("#aktifa").change(function(){
      	var paket = $("#paket").val();
      	var aktif = $("#masa_aktif:checked").val();

      	if(paket==''){
      		$("#peringatan").html("Silahkan pilih paket terlebih dahulu");
      		$("#hargapaket").prop('disabled', true);
      	} else {
      		$("#peringatan").html("");
      		var cabang = "<?php echo $cabang ?>";
      		var outlet = "<?php echo $outlet ?>";
      		if(cabang=="Medan") {
  				var a = "210000";
  				var b = "239000";
  				var c = "643000"
  			} else if(cabang=="Jakarta") {
  				if(outlet=="Gading Serpong") {
  					var a = "240000";
	  				var b = "275000";
	  				var c = "715000";
  				} else {
  					var a = "265000";
	  				var b = "275000";
	  				var c = "715000";
  				}	  				
  			} else {
  				var a = "210000";
  				var b = "239000";
  				var c = "643000";
  			}
      		if(aktif=='1'){  
	      		if(paket=='all_kiloan'){      		
		      		$("#hargapaket").val(a);
		      		$("#hargapaket").prop('readonly', true);
		      	}
		      	else if(paket=='single'){
		      		$("#hargapaket").val(b);
		      		$("#hargapaket").prop('readonly', true);
		      	}
		      	else if(paket=='double'){
		      		$("#hargapaket").val(c);
		      		$("#hargapaket").prop('readonly', true);
		      	} else if(paket=='custom'){
		      		$("#hargapaket").val("");
		      		$("#hargapaket").prop('readonly', false);
		      	}
		      } else if(aktif=='2'){
	      		if(paket=='all_kiloan'){      		
		      		$("#hargapaket").val(2*a);
		      		$("#hargapaket").prop('readonly', true);
		      	}
		      	else if(paket=='single'){
		      		$("#hargapaket").val(2*b);
		      		$("#hargapaket").prop('readonly', true);
		      	}
		      	else if(paket=='double'){
		      		$("#hargapaket").val(2*c);
		      		$("#hargapaket").prop('readonly', true);
		      	} else if(paket=='custom'){
		      		$("#hargapaket").val("");
		      		$("#hargapaket").prop('readonly', false);
		      	}
		      }		      	
      	}
	      	
      });

      function membership(){
      	var dialog = $( "#form_membership" ).removeClass('hide').dialog({ 
	      	resizable: false,
	      	height: "auto",
	      	width: 350,    	
	        modal: true,
		      show: {
		        effect: "blind",
		        duration: 500
		      },
	        title: "<div class='widget-header widget-header-small'><h4 class='smaller bolder blue'><i class='ace-icon fa fa-check'></i> Registrasi Membership</h4></div>",
	        title_html: true,
	        buttons: [ 
				{
					text: "Batal",
					"class" : "btn btn-default btn-minier btn-sm",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				},
				{
					text: "Simpan",
					"class" : "btn btn-success btn-sm radius-4 btn-minier",
					click: function() {	
						$( this ).dialog( "close" ); 	
						var id = "<?php echo $id ?>";				
						var level = $("#level:checked").val();
						var harga = $("#harga3").val();
						var pembayaran = $("#bayar2:checked").val();
						var carabayar = $("#carabayar").val();
						$.ajax({
							url 	: 'action/pembayaran_membership.php',
							data 	: 'level='+level+'&harga='+harga+'&pembayaran='+pembayaran+'&carabayar='+carabayar+'&id='+id,
							success : function(data){
								$("#peringatan2").html(data);
							}
						})

					} 
				}
			]
	        
	      });
      }; 

	  $("#btselesai").on('click', function(e) {
	      e.preventDefault();  
	      var dialog = $( "#form_pembayaran" ).removeClass('hide').dialog({ 
	      	resizable: false,
	      	height: "auto",
	      	width: "auto",    	
	        modal: true,
		      show: {
		        effect: "blind",
		        duration: 500
		      },
	        title: "<div class='widget-header widget-header-small'><h4 class='smaller bolder blue'><i class='ace-icon fa fa-check'></i> Form Pembayaran</h4></div>",
	        title_html: true,
	                
	      });    
	    });	

	  $("#pilih_level").change(function(){
	  	var level = $("#level:checked").val();
	  		$("#hargamember").load("include/form_lanjutan_membership.php?level="+level);	  	
	  });

	  function locker(){
      	var dialog = $( ".laundrylocker" ).removeClass('hide').dialog({ 
	      	resizable: false,
	      	height: "auto",
	      	width: 350,    	
	        modal: true,
		      show: {
		        effect: "blind",
		        duration: 500
		      },
	        title: "<div class='widget-header widget-header-small'><h4 class='smaller bolder blue'><i class='ace-icon fa fa-check'></i> Paket Locker</h4></div>",
	        title_html: true,
	        buttons: [ 
				{
					text: "Batal",
					"class" : "btn btn-default btn-minier btn-sm",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				},
				{
					text: "Simpan",
					"class" : "btn btn-success btn-sm radius-4 btn-minier",
					click: function () {	
						$('.laundrylocker').dialog( "close" );
						var id = "<?php echo $id ?>";				
						var paket = $("#locker:checked").val();
						var harga = $("#hargalocker").val();
						var pembayaran = $('#bayar3:checked').val();
						var carabayar = $("#carabayar").val();
						$.ajax({
							url 	: 'action/bayar_paket_locker.php',
							method	: 'POST',
							data 	: { id:id, paket:paket, harga:harga, pembayaran:pembayaran, carabayar:carabayar },
							success : function(data){
								window.location = "";
							}
						})


					} 
				}
			]
	        
	      });
      }; 


  });
</script>

<script type="text/javascript">
	function freeMember(){
		if(confirm("Anda mengizinkan Customer menjadi Membership gratis 1 bulan, Diskon 20% setiap pemesanan"))
		{
			var id = '<?= $id ?>';
			$.ajax({
				url 	: 'action/membership_free.php',
				data 	: 'id='+id,
				method	: 'POST',
				success : function(data)
				{
					alert(data);
					location.href = "";
				}
			})
		}
	};
	
	statusc = "<?= $status ?>";
	if(statusc=="member" || statusc=="langganan") {
	    $("#kode_voucher").prop('disabled', true);
	    $('#pesan_voucher').html("Membership tidak berlaku voucher..!").css("color", "red");
	} 
</script>
