<style type="text/css">
	td{
		padding-left: 15px;
		padding: 5px;
	}
	.rincian1{
		border: 1px inset;
		font : 10pt arial;
		background-color: #EEFDD7;
		height: 26px;
		width: 270px;
		margin-bottom: 15px
	}
</style>

<?php
include '../../config.php';
include '../zonawaktu.php';


$query = mysqli_query($con, "SELECT * FROM reception WHERE no_nota='$_GET[nota]'");
$data = mysqli_fetch_array($query);

$jumlspk = mysqli_query($con, "SELECT SUM(jumlah) AS jumlah FROM detail_spk WHERE no_nota='$_GET[nota]'");
$jumspk = mysqli_fetch_row($jumlspk)[0];


if(isset($_GET['cuci'])){ ?>
		<div class="widget-header">	        
	        <h4 class="widget-title" id="myModalLabel">Form Cuci</h4>
	        <div class="widget-toolbar">
				<a href="#" data-action="close">
					<i class="ace-icon fa fa-times" data-dismiss="modal"></i>
				</a>
			</div>
	    </div>
	    <div class="widget-body">
	    	<div class="widget-main form-reject">
		     	<div class="form-horizontal">
					<div class="form-group">
						<label class="col-md-4 control-label">No Nota</label>
						<div class="col-md-6">
							<input type="text" class="form-control" id="nota" name="" readonly="" value="<?php echo $_GET['nota'] ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">Nama Customer</label>
						<div class="col-md-6">
							<input type="text" class="form-control" id="nama_customer" name="" readonly="" value="<?php echo $data['nama_customer'] ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">Jumlah</label>
						<div class="col-md-6">
							<input type="number" class="form-control" id="jumlah" name="" min="1">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">No Mesin</label>
						<div class="col-md-6">
							<input type="text" class="form-control" id="no_mesin" name="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">Keterangan</label>
						<div class="col-md-6">
							<textarea class="form-control" id="ket"></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<input class="btn btn-success btn2" type="submit" name="" value="Simpan">
						</div>
					</div>
							
				</div>
	    	</div>
		     	
	    </div>

			
		
<?php
} else if(isset($_GET['kering'])){ ?>
	<div class="widget-header">	        
        <h4 class="widget-title" id="myModalLabel">Form Pengering</h4>
        <div class="widget-toolbar">
			<a href="#" data-action="close">
				<i class="ace-icon fa fa-times" data-dismiss="modal"></i>
			</a>
		</div>
    </div>
    <div class="widget-body">
    	<div class="widget-main">
			<div class="form-horizontal" action="">
				<div class="form-group">
					<label class="col-md-4 control-label">No Nota</label>
					<div class="col-md-6">
						<input type="text" class="form-control" id="nota" name="" readonly="" value="<?php echo $_GET['nota'] ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Nama Customer</label>
					<div class="col-md-6">
						<input type="text" class="form-control" id="nama_customer" name="" readonly="" value="<?php echo $data['nama_customer'] ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Jumlah</label>
					<div class="col-md-6">
						<input type="number" class="form-control" id="jumlah" name="">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">No Mesin</label>
					<div class="col-md-6">
						<input type="text" class="form-control" id="no_mesin" name="">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Keterangan</label>
					<div class="col-md-6">
						<textarea class="form-control" id="ket"></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6 col-md-offset-4">
						<input class="btn btn-success btn3" type="submit" name="" value="Simpan">
					</div>
				</div>
						
			</div>
		</div>
	</div>

<?php
} else if(isset($_GET['setrika'])){ ?>
	<div class="widget-header">	        
        <h4 class="widget-title" id="myModalLabel">Form Setrika</h4>
        <div class="widget-toolbar">
			<a href="#" data-action="close">
				<i class="ace-icon fa fa-times" data-dismiss="modal"></i>
			</a>
		</div>
    </div>
    <div class="widget-body">
    	<div class="widget-main">
			<div class="form-horizontal print-spk" action="">
				<div class="form-group">
					<label class="col-md-4 control-label">No Nota</label>
					<div class="col-md-6">
						<input type="text" class="form-control" id="nota" name="" readonly="" value="<?php echo $_GET['nota'] ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Nama Customer</label>
					<div class="col-md-6">
						<input type="text" class="form-control" id="nama_customer" name="" readonly="" value="<?php echo $data['nama_customer'] ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Berat</label>
					<div class="col-md-6">
						<input type="number" class="form-control" id="berat" name="" value="<?php echo $data['berat'] ?>" readonly>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Jumlah</label>
					<div class="col-md-6">
						<input type="number" class="form-control" id="jumlah" name="" value="<?php echo $jumspk ?>" readonly>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Keterangan</label>
					<div class="col-md-6">
						<textarea class="form-control" id="ket"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">User Setrika</label>
					<div class="col-md-6">
						<select class="form-control" id="user_setrika">
							<option>--Nama Setrika--</option>
							<?php 

							if($data['jenis']=="p"){
								$jenis = "potongan";
							} else {
								$jenis = "kiloan";
							}

							$query = mysqli_query($con, "SELECT name FROM user WHERE level<>'admin2' AND izinkan='setrika' AND aktif='Ya' AND cabang='$_SESSION[cabang]' ORDER BY name ASC");
							while($data = mysqli_fetch_row($query)){
								echo '<option>'.$data[0].'</option>';
							}

							?>
						</select>
					<div id="cek"></div>
						
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6 col-md-offset-4">
						<input class="btn btn-success btn4" type="submit" name="" value="Simpan">
					</div>
				</div>	
			</div>
		</div>
	</div>
	<?php
} else if(isset($_GET['packing'])){ ?>
	<div class="widget-header">	        
        <h4 class="widget-title" id="myModalLabel">Form Packing</h4>
        <div class="widget-toolbar">
			<a href="#" data-action="close">
				<i class="ace-icon fa fa-times" data-dismiss="modal"></i>
			</a>
		</div>
    </div>
    <div class="widget-body">
    	<div class="widget-main">
	     	<div class="hidden" id="jenis"><?php echo $data['jenis'] ?></div>
			<div class="form-horizontal" action="">
				<div class="form-group">
					<label class="col-md-4 control-label">Nama Outlet</label>
					<div class="col-md-6">
						<input type="text" class="form-control" id="outlet" name="" readonly="" value="<?php echo $data['nama_outlet'] ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">No Nota</label>
					<div class="col-md-6">
						<input type="text" class="form-control" id="nota" name="" readonly="" value="<?php echo $_GET['nota'] ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Nama Customer</label>
					<div class="col-md-6">
						<input type="text" class="form-control" id="nama_customer" name="" readonly="" value="<?php echo $data['nama_customer'] ?>">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Jumlah</label>
					<div class="col-md-6">
						<input type="number" class="form-control" id="jumlah" name="">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">harga</label>
					<div class="col-md-6">
						<input type="number" class="form-control" id="harga" name="">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-4 control-label">Keterangan</label>
					<div class="col-md-6">
						<textarea class="form-control" id="ket"></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6 col-md-offset-4">
						<input class="btn btn-success btn-xs btn5" type="submit" name="" value="Simpan">
					</div>
				</div>
						
			</div>
		</div>
	</div>
	<?php
} else if(isset($_GET['sementara'])){ ?>
     <div class="modal-body" align="center">
     	<div id="cek"></div>
			<table class="rincian1">
				<?php 
				$query = mysqli_query($con, "SELECT a.nama_customer AS customer, a.jumlah AS jumlah, b.user_setrika AS setrika, a.berat AS berat FROM reception AS a INNER JOIN setrika_sementara AS b ON a.no_nota=b.no_nota WHERE a.no_nota='$_GET[nota]'");
				$data = mysqli_fetch_assoc($query);
				?>

				<tr>
					<td style="text-align: left">No Nota</td>
					<td>:</td>
					<td style="text-align: left" id="nota"><?php echo $_GET['nota'] ?></td>
				</tr>
				<tr>
					<td style="text-align: left">Nama Customer</td>
					<td>:</td>
					<td style="text-align: left"><?php echo $data['customer'] ?></td>
				</tr>
				<tr>
					<td style="text-align: left">Jumlah</td>
					<td>:</td>
					<td style="text-align: left"><?php echo $data['jumlah'] ?></td>
				</tr>
				<tr>
					<td style="text-align: left">Setrika</td>
					<td>:</td>
					<td style="text-align: left" id="user_setrika"><?php echo $data['setrika'] ?></td>
				</tr>
				<tr>
					<td style="text-align: left">Berat</td>
					<td>:</td>
					<td style="text-align: left" id="berat"><?php echo $data['berat'] ?></td>
				</tr>
			</table>
			<button type="" class="btn btn-success btn-md" id="btn6">Selesai</button>
	</div>


	<?php
} else if(isset($_GET['cek_order'])){ 
	$query = mysqli_query($con, "SELECT *FROM reception AS a LEFT JOIN customer AS b ON a.id_customer=b.id WHERE no_nota='$_GET[nota]'");
	?>

	<div><h4 align="center" style="font-size: 11pt"><strong><?php echo $_GET['nota'] ?></strong></h4></div>
		<div align="center">
			<table class="rincian1">
				<?php 
				while($data = mysqli_fetch_array($query)){ 
				?>
				<tr>
					<td style="text-align: left">Nama Customer</td>
					<td style="text-align: left">:</td>
					<td style="text-align: left"><?php echo $data['nama_customer'] ?></td>
				</tr>
				<tr>
					<td style="text-align: left">No Telp</td>
					<td style="text-align: left">:</td>
					<td style="text-align: left"><?php echo $data['no_telp'] ?></td>
				</tr>
				<tr>
					<td style="text-align: left">Harga</td>
					<td style="text-align: left">:</td>
					<td style="text-align: left"><?php echo number_format($data['total_bayar'],0,',','.') ?></td>
				</tr>
				<?php 
				}
				?>
			</table>

			<h5 align="center"><u>Rincian Order</u></h5>
			<table class="rincian1">
				<?php 
				$rincorder = mysqli_query($con, "SELECT * FROM detail_penjualan WHERE no_nota='$_GET[nota]'");
				while($baris = mysqli_fetch_array($rincorder)){
				?>		
				<tr>
					<td style="text-align: left"><?php echo $baris['jumlah'].' '.$baris['item'] ?></td>
					<td align="right">Rp</td>
					<td align="right"><?php echo number_format($baris['harga'],0,',','.') ?></td>
				</tr>
				<?php 
				}
				?>
			</table>

			<h5 align="center"><u>Rincian SPK</u></h5>
			<table class="rincian1">
				<?php 
				$rincspk = mysqli_query($con, "SELECT * FROM detail_spk WHERE no_nota='$_GET[nota]'");
				while($baris = mysqli_fetch_array($rincspk)){
				?>		
				<tr>
					<td>&nbsp;</td>
					<td style="text-align: left"><?php echo $baris['jenis_item'] ?></td>
					<td style="text-align: right"><?php echo $baris['jumlah'] ?></td>
					<td>&nbsp;</td>
				</tr>
				<?php 
				}
				?>
			</table>
		</div>

<?php 
}
?>



<script type="text/javascript">

	function print(){
		window.open('document/cetak_spk_setrika.php?nota=<?php echo $_GET['nota'] ?>','page','toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=750,height=600,left=50,top=50,titlebar=yes');
	}

	$('.btn2').click(function(){
		var cuci = "cuci";
		var nota = $('#nota').val();
		var jumlah = $('#jumlah').val();
		var mesin = $('#no_mesin').val();
		var ket = $('#ket').val();
		if(jumlah!="<?php echo $jumspk ?>"){
			alert("Jumlah tidak sesuai, coba periksa kembali");
			$(".form-reject").load('form/form_reject.php?nota='+nota+'&jumlah='+jumlah);
		} else{
			$.ajax({
				url 	: 'action/simpan_proses_cucian.php',
				data 	: 'cuci='+cuci+'&nota='+nota+'&jumlah='+jumlah+'&mesin='+mesin+'&ket='+ket,
				success : function(data){
					location.href="";
				}
			})
		}
			
	})

	$('.btn3').click(function(){
		var kering = "kering";
		var nota = $('#nota').val();
		var jumlah = $('#jumlah').val();
		var mesin = $('#no_mesin').val();
		var ket = $('#ket').val();
		if(jumlah!="<?php echo $jumspk ?>"){
			alert("Jumlah tidak sesuai, coba periksa kembali");
		}
		else {
			$.ajax({
				url 	: 'action/simpan_proses_cucian.php',
				data 	: 'kering='+kering+'&nota='+nota+'&jumlah='+jumlah+'&mesin='+mesin+'&ket='+ket,
				success : function(data){
					location.href="";
				}
			})
		} 
			
	})



	$('.btn4').click(function(){
		var setrika = "setrika";
		var nota = $('#nota').val();
		var user_setrika = $('#user_setrika').val();
		var berat = $('#berat').val();
		var jumlah = $('#jumlah').val();
		var mesin = $('#no_mesin').val();
		var ket = $('#ket').val();
		if(user_setrika!='--Nama Setrika--'){
			$.ajax({
				url 	: 'action/simpan_proses_cucian.php',
				data 	: 'setrika='+setrika+'&nota='+nota+'&jumlah='+jumlah+'&mesin='+mesin+'&ket='+ket+'&user_setrika='+user_setrika+'&berat='+berat,
				success : function(data){
					$('.print-spk').html(data).css('margin-bottom', '50px');
				}
			})
		}
		else {
			$('#cek').html('<p style="color: red; text-align: center">Nama Setrika belum dipilih</p>');
		}
		
	})

	$('#btn6').click(function(){
		var sementara = "sementara";
		var nota = $('#nota').html();
		var user_setrika = $('#user_setrika').html();
		var berat = $('#berat').html();
		$.ajax({
			url 	: 'action/simpan_proses_cucian.php',
			data 	: 'sementara='+sementara+'&nota='+nota+'&user_setrika='+user_setrika+'&berat='+berat,
			success : function(data){
				location.href="";
			}
		})
		
	})

	$('.btn5').click(function(){
		var packing = "packing";
		var nota = $('#nota').val();
		var jumlah = $('#jumlah').val();
		var harga = $('#harga').val();
		var ket = $('#ket').val();
		var jenis = "kiloan";
		if(jumlah!="<?php echo $jumspk ?>"){
			alert("Jumlah tidak sesuai, coba periksa kembali");
		}
		else {
			$.ajax({
				url 	: 'action/simpan_proses_cucian.php',
				data 	: 'packing='+packing+'&nota='+nota+'&jumlah='+jumlah+'&harga='+harga+'&ket='+ket+'&jenis='+jenis,
				success : function(data){
					alert("Terima kasih, Cucian siap di kirim!!");
					location.href="";
				}
			})
		} 
			
	})

</script>
