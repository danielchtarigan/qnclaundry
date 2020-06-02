<?php 
include '../config.php';
session_start();
include 'auth.php';


$idkey = $_GET['idtrx']; 

$sql = mysqli_query($con, "SELECT * FROM customer WHERE id='$idkey'");
$data = mysqli_fetch_assoc($sql);

if($data['lgn']=='1'){
	$status = "langganan";
} else if($data['member']=='1') {
	$status = "member";
} else {
	$status = "normal";
} 

?>

<div class="border-info" id="daftar_order">
	<h4><strong><span class="glyphicon glyphicon-info-sign"></span> Daftar Order</strong></h4>
	<div id="up_daftar">
		<?php 
		$sqld = mysqli_query($con, "SELECT * FROM reception WHERE id_customer='$idkey' AND lunas=false ORDER BY id DESC ");
		if(mysqli_num_rows($sqld)>0) {
			while($rdata = mysqli_fetch_assoc($sqld)) {
				echo '
				<table>
				<tr>
					<td style="width: 50%"><a href="#" class="btshow" id="'.$rdata['jenis'].'-'.$rdata['id_customer'].'-'.$rdata['no_nota'].'"><b>'.$rdata['no_nota'].'</b></a></td>
					<td>&nbsp;</td>
					<td style="text-align: right; width: 30%"><b>'.number_format($rdata['total_bayar'],0,',','.').'</b></td>
					<td style="text-align: right; width: 20%"><b><a href="#" class="btn btn-xs btn-default btn-batal" id="'.$rdata['no_nota'].'"> <i class="fa fa-times" aria-hidden="true"></a></b></td>
				</tr>
				</table>';				
			}
		} else {
			echo "Belum ada transaksi";
		}

		?>
	</div>		
	<?php 
	echo '<br><a href="#" class="btn btn-success btn-selesai">Bayar Order</a>';
	?>
	
</div>

<script type="text/javascript">
	$(document).on('click', '.btn-batal', function(){
		var nota = $(this).attr('id');
		var idkey = '<?= $idkey ?>';
		
		$.ajax({
			url 	: 'action/hapus_order.php',
			data 	: 'nota='+nota+'&idkey='+idkey,			
			success : function(data) {
				$('#up_daftar').html(data);
			}
		})			
	});

	$(document).on('click', '.btshow', function(){		
		var idj = $(this).attr('id').split('-');
		var nota = idj[2,2];
		var jenis = idj[2,0];
		var idcst = idj[2,1];

		if(jenis=='k') {
			$('#pro-previewp').removeClass('hidden').load('rincian_order.php?show=show&nota='+nota+'&idcst='+idcst);
		} else if(jenis=='p') {
			$('#pro-previewp').removeClass('hidden').load('rincian_order_potongan.php?show=show&nota='+nota+'&idcst='+idcst);
		}
	})

</script>

<div id="proses_kiloan" class="border-info hidden">
	<h3>Proses Kiloan</h3>
	<b style="color: red;" id="i"></b>
	<form class="form-horizontal">
		<div class="form-group">
			<div class="col-xs-12">
				<select class="form-control" id="outlet_pilihan">
					<option value="0">--Outlet Pilihan--</option>
					<?php 
					$outlets = mysqli_query($con, "SELECT * FROM outlet WHERE Kota='Makassar'");
					while($outlet = mysqli_fetch_assoc($outlets)){
						echo '<option value="'.$outlet['nama_outlet'].'">'.$outlet['nama_outlet'].'</option>';
					}

					?>
				</select>
			</div>			
		</div>
		<div class="form-group">
			<div class="col-xs-12">
				<input class="form-control" type="text" name="" id="nomor_nota" placeholder="Nomor Nota (Auto)">
			</div>			
		</div>
		<div class="form-group">
			<div class="col-xs-12">
				<select class="form-control" id="nama_item">
					<option value="">--Pilih Item--</option>
					<?php 
					$sql = mysqli_query($con, "SELECT * FROM item_spk WHERE jenis_item='k' AND ket<>'1'");
					while($rk = mysqli_fetch_array($sql)){
						if($status=="langganan") {
							if(substr($rk['nama_item'], 0,7)=="Setrika") {

								$hlgn = $rk['berat']*6400;
							} else {
								$hlgn = $rk['berat']*8800;
							}
							?>
							<option value="<?= $rk['nama_item'].'-'.$hlgn.'-'.$rk['berat'] ?>"><?= $rk['nama_item'] ?>

							<?php
						} else if($status=="member") {
							?>
							<option value="<?= $rk['nama_item'].'-'.$rk['harga']*0.8.'-'.$rk['berat'] ?>"><?= $rk['nama_item'] ?></option>

							<?php
						}
						else {
							?>
							<option value="<?= $rk['nama_item'].'-'.$rk['harga'].'-'.$rk['berat'] ?>"><?= $rk['nama_item'] ?></option>

							<?php
						}
					}
					?>
				</select>
			</div>			
		</div>
		<div class="form-group hidden">
			<div class="col-xs-12">
				<input class="form-control hidden" type="text" name="" readonly="true" id="item">
			</div>
		</div>
		<div class="form-group hidden">
			<div class="col-xs-12">
				<input class="form-control hidden" type="text" name="" readonly="true" id="berat">
			</div>
		</div>
		<div class="form-group">
			<div class="col-xs-12">
				<input class="form-control" type="text" name="" readonly="true" id="harga">
			</div>
		</div>
		<div class="form-group">
			<div class="col-xs-12">
				<a href="#" class="btn btn-danger btn-cancel">Batal</a>
				<a href="#" class="btn btn-success btn-next">Berikutnya <span class="glyphicon glyphicon-step-forward"></span></a>
			</div>
		</div>
	</form>
</div>

<div class="border-info hidden" id="pro-express">
	<h4>Pilihan Express</h4>
	<div id="a"></div>
	<form class="form-horizontal">
		<div class="form-group">
			<input type="text" class="hidden" name="" id="no_nota">
			<div class="col-xs-12">
				<label><input type="checkbox" name="" value="1" id="charge"> Express</label>
				<label><input type="checkbox" name="" value="2" id="charge"> Double Express</label>
				<label><input type="checkbox" name="" value="3" id="charge"> Super Express</label>
			</div>			
		</div>
		<div class="form-group">
			<div class="col-xs-12">
				<a href="#" class="btn btn-info btn-back"><span class="glyphicon glyphicon-step-backward"></span> Kembali</a>
				<a href="#" class="btn btn-success btn-next2">Berikutnya <span class="glyphicon glyphicon-step-forward"></span></a>
			</div>
		</div>
	</form>		
</div>

<div class="border-info hidden" id="pro-parfum">
	<h4>Pilihan Parfum</h4>
	<form class="form-horizontal">
		<div class="form-group">
			<div class="col-xs-12">
				<label><input type="checkbox" name="" value="extra" id="parf"> Extra Parfum</label>
				<label><input type="checkbox" name="" value="0" id="parf"> Tanpa Parfum</label>
			</div>			
		</div>
		<div class="form-group">
			<div class="col-xs-12">
				<a href="#" class="btn btn-info btn-back2"><span class="glyphicon glyphicon-step-backward"></span> Kembali</a>
				<a href="#" class="btn btn-success btn-next3">Berikutnya <span class="glyphicon glyphicon-step-forward"></span></a>
			</div>
		</div>
	</form>		
</div>

<div class="border-info hidden" id="pro-kodepromo">
	<h4>Kode Promo dan Voucher</h4>
	<form class="form-horizontal">
		<div class="form-group">
			<div class="col-xs-12">
				<input class="form-control" type="text" name="" id="kodepromo" placeholder="Kode Promo">
			</div>
		</div>
		<div class="form-group"> 
			<div class="col-xs-12">
				<input class="form-control" type="text" name="" id="diskon" readonly="true">
			</div>		
		</div>
		<div class="form-group">
			<div class="col-xs-12">
				<a href="#" class="btn btn-info btn-back3"><span class="glyphicon glyphicon-step-backward"></span> Kembali</a>
				<a href="#" class="btn btn-success btn-preview">Tampilkan</a>
			</div>
		</div>
	</form>		
</div>

<div class="border-info hidden" style="margin-top: 15px" id="pro-preview">		
</div>


<div id="proses_potongan" class="border-info hidden">
	<h3>Proses Potongan</h3>
	<b style="color: red;" id="inf"></b>
	<form class="form-horizontal">
		<div class="form-group">
			<div class="col-xs-12">
				<select class="form-control" id="outlet_pilihanp">
					<option value="0">--Outlet Pilihan--</option>
					<?php 
					$outlets = mysqli_query($con, "SELECT * FROM outlet WHERE Kota='Makassar'");
					while($outlet = mysqli_fetch_assoc($outlets)){
						echo '<option value="'.$outlet['nama_outlet'].'">'.$outlet['nama_outlet'].'</option>';
					}

					?>
				</select>
			</div>			
		</div>
		<div class="form-group">
			<div class="col-xs-12">
				<input class="form-control" type="text" name="" id="nomor_notap" placeholder="Nomor Nota (Auto)">
			</div>			
		</div>
		<div class="form-group">
			<div class="col-xs-12">
				<select class="form-control" id="nama_itemp">
					<option value="">--Pilih Item--</option>
					<?php 
					$order_tmp = mysqli_query($con, "SELECT * FROM order_potongan_tmp WHERE id_customer='$idkey' AND new_nota='' ORDER BY id DESC LIMIT 0,1");
					if(mysqli_num_rows($order_tmp)>0){
						$tmp = mysqli_fetch_assoc($order_tmp);

						$rkat = mysqli_query($con, "SELECT kategory FROM item_spk WHERE jenis_item='p' AND kategory<>'' AND nama_item='$tmp[item]' GROUP BY kategory ORDER BY kategory ASC");
					}
					else {
						$rkat = mysqli_query($con, "SELECT kategory FROM item_spk WHERE jenis_item='p' AND kategory<>'' GROUP BY kategory ORDER BY kategory ASC");
					}
					
					while($kat = mysqli_fetch_row($rkat)){
						switch ($kat[0]) {
							case '5':
								$katnew = "Bedding";
								break;

							case '6':
								$katnew = "Clothes";
								break;
							
							case '7':
								$katnew = "Doll";
								break;
							case '8':
								$katnew = "Gordyn";
								break;
							case '9':
								$katnew = "Karpet";
								break;
							default :
								$katnew = "Lain";
								break;
						}

						echo '<option disabled>'.$katnew.'</option>';
						$ritem = mysqli_query($con, "SELECT *FROM item_spk WHERE kategory='$kat[0]'");
						while($item = mysqli_fetch_assoc($ritem)){							
							$harga = $item['harga'];

							if($status=="langganan"){
								$harga = $harga*0.8;
								echo '<option value="'.$item['nama_item'].'-'.$harga.'">&nbsp;&nbsp;&nbsp;&nbsp;'.$item['nama_item'].'</option>';
							} else if($status=="member") {
								$harga = $harga*0.8;
								echo '<option value="'.$item['nama_item'].'-'.$harga.'">&nbsp;&nbsp;&nbsp;&nbsp;'.$item['nama_item'].'</option>';
							} else {
								echo '<option value="'.$item['nama_item'].'-'.$harga.'">&nbsp;&nbsp;&nbsp;&nbsp;'.$item['nama_item'].'</option>';
							}
							
						}
					}
					?>
				</select>
			</div>			
		</div>
		<div class="form-group hidden">
			<div class="col-xs-12">
				<input class="form-control hidden" type="text" name="" readonly="true" id="itemp">
			</div>
		</div>
		<div class="form-group">
			<div class="col-xs-12">
				<input class="form-control" type="text" name="" readonly="true" id="hargap">
			</div>
		</div>
		<div class="form-group">
			<div class="col-xs-12">
				<input class="form-control" type="text" name="" id="jumlahp" placeholder="Jumlah item">
			</div>
		</div>
		<div class="form-group">
			<div class="col-xs-12">
				<a href="#" class="btn btn-danger btn-cancelp">Batal</a>
				<a href="#" class="btn btn-savep" style="background: grey; color: #fff">Simpan <span class="glyphicon glyphicon-step-forward"></span></a>
			</div>
		</div>
	</form>
</div>

<div class="border-info hidden" id="rincian_potongan">	
</div>

<div class="border-info hidden" id="pro-expressp">
	<h4>Pilihan Express</h4>
	<div id="a"></div>
	<form class="form-horizontal">
		<div class="form-group">
			<input type="text" class="hidden" name="" id="no_notap">
			<div class="col-xs-12">
				<label><input type="checkbox" name="" value="1" id="chargep"> Express</label>
				<label><input type="checkbox" name="" value="2" id="chargep"> Double Express</label>
				<label><input type="checkbox" name="" value="3" id="chargep"> Super Express</label>
			</div>			
		</div>
		<div class="form-group">
			<div class="col-xs-12">
				<a href="#" class="btn btn-info btn-backp"><span class="glyphicon glyphicon-step-backward"></span> Kembali</a>
				<a href="#" class="btn btn-success btn-nextp2">Berikutnya <span class="glyphicon glyphicon-step-forward"></span></a>
			</div>
		</div>
	</form>		
</div>

<div class="border-info hidden" id="pro-parfump">
	<h4>Pilihan Parfum</h4>
	<form class="form-horizontal">
		<div class="form-group">
			<div class="col-xs-12">
				<label><input type="checkbox" name="" value="extra" id="parfp"> Extra Parfum</label>
				<label><input type="checkbox" name="" value="0" id="parfp"> Tanpa Parfum</label>
			</div>			
		</div>
		<div class="form-group">
			<div class="col-xs-12">
				<a href="#" class="btn btn-info btn-backp2"><span class="glyphicon glyphicon-step-backward"></span> Kembali</a>
				<a href="#" class="btn btn-success btn-nextp3">Berikutnya <span class="glyphicon glyphicon-step-forward"></span></a>
			</div>
		</div>
	</form>		
</div>

<div class="border-info hidden" id="pro-kodepromop">
	<h4>Kode Promo dan Voucher</h4>
	<form class="form-horizontal">
		<div class="form-group">
			<div class="col-xs-12">
				<input class="form-control" type="text" name="" id="kodepromop" placeholder="Kode Promo">
			</div>
		</div>
		<div class="form-group"> 
			<div class="col-xs-12">
				<input class="form-control" type="text" name="" id="diskonp" readonly="true">
			</div>		
		</div>
		<div class="form-group">
			<div class="col-xs-12">
				<a href="#" class="btn btn-info btn-backp3"><span class="glyphicon glyphicon-step-backward"></span> Kembali</a>
				<a href="#" class="btn btn-success btn-previewp">Tampilkan</a>
			</div>
		</div>
	</form>		
</div>

<div class="border-info hidden" style="margin-top: 15px" id="pro-previewp">		
</div>

<div class="border-info text-center hidden" id="pro-pembayaran" style="background: #d9ffd9"></div>
<div class="border-info text-center hidden" id="faktur-pembayaran" style="background: #d9ffd9"></div>
<br>


<!-- Informasi Umum -->
<div class="border-info">
	<?php echo ucwords($data['nama_customer']) ?><br>
	<?php echo $data['alamat'].' | '.$data['no_telp'] ?><br>
	<?php 
		if($data['lgn']=='1'){
			echo "<b>Langganan</b><br>";
			$lgns = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM langganan WHERE id_customer='$idkey'"));
			echo
			'<b style="background: #73FFFF">CKS : '.number_format($lgns['kilo_cks'],2,',','.').' Kg<br>
			Potongan : Rp '.number_format($lgns['potongan'],2,',','.').'</b><br>			
			';

		} 
		else if($data['member']=='1'){
		    echo '<b style="background: #73FFFF">Member : '.$data['jenis_member'].'<br>
		Poin : '.$data['poin'].'</b><br>			
			';
		}
		else {
			echo "-<br>";
		}
	?>
	<em style="font-size: 8pt">*Cat : Deposit dan membership hanya bisa dibayar di Outlet</em>
		
	
<br>
	<button class="btn btn-success btn-kiloan" style="width: 49%">Kiloan</button>
	<button class="btn btn-success btn-potongan" style="width: 49%">Potongan</button>
</div>


<script type="text/javascript">
	$(document).on('click', '.btn-kiloan', function(){
		$('#proses_kiloan').removeClass('hidden');
		$('#daftar_order').addClass('hidden');	
		$('#proses_potongan').addClass('hidden');
	});

	$(document).on('click', '.btn-potongan', function(){
		$('#proses_potongan').removeClass('hidden');
		$('#daftar_order').addClass('hidden');
		$('#proses_kiloan').addClass('hidden');	
	});

	$('#nama_item').change(function(){
		var item = $(this).val().split('-');
		$('#item').val(item[0]);
		$('#harga').val(item[1]);
		$('#berat').val(item[2]);
	});

	$('#nama_itemp').change(function(){
		var item = $(this).val().split('-');
		$('#itemp').val(item[0]);
		$('#hargap').val(item[1]);
	});

	$('.btn-savep').on('click', function(){
		var outlet = $('#outlet_pilihanp').val();
		var nama_item = $('#itemp').val();
		var harga = $('#hargap').val();
		var jumlah = $('#jumlahp').val();
		var idkey = '<?= $idkey ?>';
		var nota = $('#nomor_notap').val();
		if(outlet=='0' || jumlah=='' || nama_item=='') {
			$('#inf').html("<span class='glyphicon glyphicon-remove-sign'></span> Item/outlet pilihan/jumlah item belum dipilih");
		} else {
			$.ajax({
				url 	: 'rincian_potongan.php',
				data 	: 'outlet='+outlet+'&nama_item='+nama_item+'&harga='+harga+'&jumlah='+jumlah+'&idkey='+idkey+'&nota='+nota,
				success : function (data){
					$('#proses_potongan').addClass('hidden');
					$('#rincian_potongan').html(data).removeClass('hidden');
				}
			})
		}					
	});

	$('.btn-back').on('click', function(){
		$('#pro-express').addClass('hidden');	
		$('#proses_kiloan').removeClass('hidden');
	});

	$('.btn-next').on('click', function(){			
		var item = $('#item').val();
		var harga = $('#harga').val();
		var nota = $('#nomor_nota').val();
		var berat = $('#berat').val();
		var idcst = '<?= $idkey; ?>';
		var outlet = $('#outlet_pilihan').val();
		if(item=='') {
			$('#i').html("<span class='glyphicon glyphicon-remove-sign'></span> Item belum dipilih");
		} else {
			$.ajax({
				url 	: 'action/simpan_order.php',
				data 	: 'kiloan=kiloan&nota='+nota+'&item='+item+'&harga='+harga+'&berat='+berat+'&idcst='+idcst+'&outlet='+outlet,
				success : function(data) {
					$("#no_nota").val(data);
					$('#proses_kiloan').addClass('hidden');
					$('#pro-express').removeClass('hidden');
				}
			});
		}
			
	});

	$('.btn-back2').on('click', function(){	
		$('#pro-parfum').addClass('hidden');	
		$('#pro-express').removeClass('hidden');
	});

	$('.btn-next2').on('click', function(){				
		var charge = $('#charge:checked').val();
		var nota = $('#no_nota').val();
		var idcst = '<?= $idkey ?>';		
		$.ajax({
			url 	: 'action/proses_order.php',
			data 	: 'nota='+nota+'&express='+charge+'&idcst='+idcst,
			success : function() {
				$('#pro-express').addClass('hidden');	
				$('#pro-parfum').removeClass('hidden');
			}
		})
	});

	$('.btn-back3').on('click', function(){	
		$('#pro-kodepromo').addClass('hidden');	
		$('#pro-parfum').removeClass('hidden');
	});

	$('.btn-next3').on('click', function(){				
		var parfum = $('#parf:checked').val();
		var nota = $('#no_nota').val();
		var idcst = '<?= $idkey ?>';
		$.ajax({
			url 	: 'action/proses_order.php',
			data 	: 'nota='+nota+'&parfum='+parfum+'&idcst='+idcst,
			success : function() {
				$('#pro-parfum').addClass('hidden');	
				$('#pro-kodepromo').removeClass('hidden');
			}
		})
	});

	$('.btn-preview').on('click', function(){	
		var nota = $('#no_nota').val();
		var idcst = '<?= $idkey ?>';
		var outlet = $('#outlet_pilihan').val();
		$.ajax({
			url 	: 'rincian_order.php',
			data 	: 'nota='+nota+'&idcst='+idcst+'&outlet='+outlet,
			success : function(data) {
				$('#pro-kodepromo').addClass('hidden');	
				$('#pro-preview').html(data).removeClass('hidden');
			}
		})
	});
	
	//Proses Potongan
	$('.btn-backp').on('click', function(){	
		$('#pro-expressp').addClass('hidden');	
		$('#proses_potongan').removeClass('hidden');
	});

	$('.btn-nextp2').on('click', function(){				
		var charge = $('#chargep:checked').val();
		var nota = $('#no_notap').val();
		var idcst = '<?= $idkey ?>';		
		$.ajax({
			url 	: 'action/proses_order.php',
			data 	: 'nota='+nota+'&express='+charge+'&idcst='+idcst,
			success : function() {
				$('#pro-expressp').addClass('hidden');	
				$('#pro-parfump').removeClass('hidden');
			}
		})
	});

	$('.btn-backp2').on('click', function(){	
		$('#pro-parfump').addClass('hidden');	
		$('#pro-expressp').removeClass('hidden');
	});

	$('.btn-nextp3').on('click', function(){				
		var parfum = $('#parfp:checked').val();
		var nota = $('#no_notap').val();
		var idcst = '<?= $idkey ?>';
		$.ajax({
			url 	: 'action/proses_order.php',
			data 	: 'nota='+nota+'&parfum='+parfum+'&idcst='+idcst,
			success : function() {
				$('#pro-parfump').addClass('hidden');	
				$('#pro-kodepromop').removeClass('hidden');
			}
		})
	});

	$('.btn-backp3').on('click', function(){	
		$('#pro-kodepromop').addClass('hidden');	
		$('#pro-parfump').removeClass('hidden');
	});

	$('.btn-previewp').on('click', function(){	
		var nota = $('#no_notap').val();
		var idcst = '<?= $idkey ?>';
		$.ajax({
			url 	: 'rincian_order_potongan.php',
			data 	: 'nota='+nota+'&idcst='+idcst,
			success : function(data) {
				$('#pro-kodepromop').addClass('hidden');	
				$('#pro-previewp').html(data).removeClass('hidden');
			}
		})
	});


	//Pembayaran_order
	$('.btn-selesai').on('click', function(){
		var idkey = '<?= $idkey ?>';
		var outlet = $('#outlet_pilihan').val();
		$('#pro-pembayaran').removeClass('hidden').load('form_pembayaran.php?idtrx='+idkey);
		$('#daftar_order').addClass('hidden');
	});

</script>