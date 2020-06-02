<?php 
include '../config.php';
date_default_timezone_set('Asia/Makassar');
$nowDate = date('Y-m-d H:i:s');

$no_nota = $_GET['nota'];
$id = $_GET['idcst'];

?>

<h4><strong>Rincian Order</strong></h4>	
	<?php 
	$order = mysqli_query($con, "SELECT * FROM detail_penjualan WHERE id_customer='$id' AND no_nota='$no_nota' AND harga<>'0'");
	
    $delete = mysqli_query($con, "DELETE FROM order_potongan_tmp WHERE no_nota='$no_nota'");

	$ncustomer = mysqli_query($con, "SELECT * FROM customer WHERE id='$id'");
	$row = mysqli_fetch_assoc($ncustomer);
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
			<td><?php echo $no_nota ?></td>
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
			<td><a href="#" class="hapus-itemp" id="<?php echo $data2['item'] ?>"> <i class="fa fa-times" aria-hidden="true"></i></a></td>
		</tr>
		<?php 
		} 
		?>	
		<tr style="font-size:9pt;border-top: 3px double #b4b4b4; font-weight: bold;">
			<td colspan="3">Total</td>
			<td width="5%">Rp.</td>
			<td align="right" style="width: 10%">
				<?php 
				$total_harga = mysqli_query($con, "SELECT SUM(total) AS total FROM detail_penjualan WHERE no_nota='$no_nota' AND id_customer='$id'");
				$jadi_t = mysqli_fetch_row($total_harga)[0];
				echo number_format($jadi_t,0,',','.') 
				?>
					
			</td>
			<td>&nbsp;</td>
		</tr>	
	</table>

	<?php 
	if(!isset($_GET['show'])) {
		?>
		<table>
			<tr>
				<td style="padding-right: 10px"><a href="#" class="btn btn-danger btn-batalp"> Batal</i></a></td>
				<td style="padding-right: 10px"><a href="#" class="btn btn-info btn-backp4"><span class="glyphicon glyphicon-step-backward"></span> Kembali</a></td>			
				<td><a href="#" id="cetak_orderp" class="btn btn-primary"> Simpan Order</i></a></td>
			</tr>
		</table>

		<?php
	}

	?>	


	<script type="text/javascript">
		$('.btn-backp4').on('click', function(){	
			$('#pro-previewp').addClass('hidden');	
			$('#pro-kodepromop').removeClass('hidden');
		});

		$('#cetak_orderp').on('click', function(){			
			var nota = '<?= $no_nota ?>';
			var idcst = '<?= $id ?>';
			var tot = '<?= $jadi_t ?>';
			$.ajax({
				url 	: 'cetak_order.php',
				data 	: 'nota='+nota+'&idcst='+idcst+'&total='+tot,
				success : function (data) {
					$('#daftar_order').removeClass('hidden');
					$('#pro-previewp').addClass('hidden');
					$('#up_daftar').html(data);
				}
			})
		});
		

	</script>

