<?php 
$sql = mysqli_query($con, "SELECT * FROM faktur_penjualan a, customer b WHERE a.id_customer=b.id AND a.no_faktur='$_GET[id]'");
$rData = mysqli_fetch_array($sql);

?>

<legend align=""><?= $_GET['id'] ?></legend>

<div align="" class="col-xs-6 col-xs-offset-3">

	<table class="" style="font-size: 10pt">
		<tr>
			<td>Nama Customer</td>	
			<td>:</td>
			<td><?php echo $rData['nama_customer'] ; ?></td>	
		</tr>
		<tr>
			<td>Total</td>	
			<td>:</td>	
			<td><?php echo number_format($rData['total']) ; ?></td>
		</tr>
	</table>

	<table class="rincian">
		<?php 
			$query = mysqli_query($con, "SELECT * FROM reception WHERE no_faktur='$_GET[id]' AND cara_bayar<>'Void' ");
			while($data = mysqli_fetch_array($query)){ ?>

			<tr>
				<td style="font-weight: bold; text-decoration: underline;"><a title="Klik untuk melihat info order" href="#" class="act-detail" data-toggle="modal" data-target="#rincian_order" id="<?= $data['no_nota'] ?>"><?php echo $data['no_nota'] ?></a></td>
				<td style="font-weight: bold; text-decoration: underline;">:</td>
				<td width="5%" style="font-weight: bold; text-decoration: underline;">Rp </td>
				<td align="right" style="font-weight: bold; text-decoration: underline;"><?php echo number_format($data['total_bayar']) ?></td>
			</tr> 

			<?php 
			$qitem = mysqli_query($con, "SELECT * FROM detail_penjualan WHERE no_nota='$data[no_nota]'");
			while($ditem = mysqli_fetch_array($qitem)){ ?>
			<tr>
				<td align="right"><?= $ditem['item'] ?></td>
				<td>:</td>
				<td align="">Rp </td>
				<td align="right"><?= number_format($ditem['total']) ?></td>
			</tr>

				<?php
				}
				?>
			<tr>
				<td style="margin-bottom: 20px"></td>
				<td style="margin-bottom: 20px"></td>
				<td style="margin-bottom: 20px"></td>
				<td style="margin-bottom: 20px"></td>
			</tr>

				<?php
			}
		?>
	</table>	
</div>

<style type="text/css">
	.rincian{
		border: 1px inset;
		font : 9pt arial;
		background-color: #EEFDD7;
		height: 26px;
		width: 280px;
		margin-bottom: 15px
	}

	td{
		padding: 3px;
	}
</style>

<div class="modal fade" id="rincian_order" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="rincianN" align="center">
				
			</div>
		</div>
	</div>
</div>


<script src = "../../lib/js/jquery-2.1.3.min.js"></script>
<script type="text/javascript">
	$('.act-detail').on('click', function(){
		var order = $(this).attr('id');
		$.ajax({
			url 	: '../../admin/rincian_order.php',
			data 	: 'order='+order,
			beforeSend : function(data){
				$('.rincianN').html("Sedang memuat ...");
			},
			success : function(data){
				$('.rincianN').html(data);
			}
		})		
	})
</script>