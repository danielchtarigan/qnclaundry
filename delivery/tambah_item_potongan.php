<?php 
include '../config.php';
$idkey = $_GET['idkey']; 
$no_nota = $_GET['nota'];

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


<h3>Proses Potongan</h3>
<b style="color: red;" id="in"></b>
<form class="form-horizontal">	
	<div class="form-group">
		<div class="col-xs-12">
			<select class="form-control" id="nama_itemp2">
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
			<input class="form-control hidden" type="text" name="" readonly="true" id="itemp2">
		</div>
	</div>
	<div class="form-group">
		<div class="col-xs-12">
			<input class="form-control" type="text" name="" readonly="true" id="hargap2">
		</div>
	</div>
	<div class="form-group">
		<div class="col-xs-12">
			<input class="form-control" type="text" name="" id="jumlahp2" placeholder="Jumlah item">
		</div>
	</div>
	<div class="form-group">
		<div class="col-xs-12">
			<a href="#" class="btn btn-danger btn-cancelp">Batal</a>
			<a href="#" class="btn btn-savep2" style="background: grey; color: #fff">Simpan <span class="glyphicon glyphicon-step-forward"></span></a>
		</div>
	</div>
</form>


<script type="text/javascript">
	$('#nama_itemp2').change(function(){
		var item = $(this).val().split('-');
		$('#itemp2').val(item[0]);
		$('#hargap2').val(item[1]);
	});

	$('.btn-savep2').on('click', function(){
		var nama_item = $('#itemp2').val();
		var harga = $('#hargap2').val();
		var jumlah = $('#jumlahp2').val();
		var idkey = '<?= $idkey ?>';
		var nota = '<?= $no_nota ?>';
		if(jumlah=='' || nama_item=='') {
			$('#in').html("<span class='glyphicon glyphicon-remove-sign'></span> Item/jumlah item belum dipilih");
		}
		else {
			$.ajax({
				url 	: 'rincian_potongan.php',
				data 	: 'nama_item='+nama_item+'&harga='+harga+'&jumlah='+jumlah+'&idkey='+idkey+'&nota='+nota,
				success : function (data){
					$('#rincian_potongan').html(data).removeClass('hidden');
				}
			})	
		}
				
	});
</script>