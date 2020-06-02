<?php 
include '../config.php';
date_default_timezone_set('Asia/Makassar');
$nowDate = date('Y-m-d H:i:s');

$query = mysqli_query($con, "SELECT *FROM reception AS a LEFT JOIN customer AS b ON a.id_customer=b.id WHERE no_nota='$_GET[order]'");


?>


<div><h4 align="center" style="font-size: 11pt"><strong><?php echo $_GET['order'] ?></strong></h4></div>
<div align="center" id="cat"></div>
<div align="center">
	<table class="rincian1">
		<?php 
		while($data = mysqli_fetch_array($query)){ 
		?>
		<tr>
			<td>Nama Customer</td>
			<td>:</td>
			<td><?php echo $data['nama_customer'] ?></td>
		</tr>
		<tr>
			<td>No Telp</td>
			<td>:</td>
			<td><?php echo $data['no_telp'] ?></td>
		</tr>
		<tr>
			<td>Harga</td>
			<td>:</td>
			<td><?php echo number_format($data['total_bayar'],0,',','.') ?></td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<?php 
		}
		?>
	</table>

	<h5 align="center"><u>Rincian Order</u></h5>
	<table class="rincian2">
		<?php 
		$rincorder = mysqli_query($con, "SELECT * FROM detail_penjualan WHERE no_nota='$_GET[order]'");
		while($baris = mysqli_fetch_array($rincorder)){
		?>		
		<tr>
			<td><?php echo $baris['jumlah'].' '.$baris['item'] ?></td>
			<td align="right">Rp</td>
			<td align="right"><?php echo number_format($baris['harga'],0,',','.') ?></td>
		</tr>
		<?php 
		}
		?>
	</table>

	<h5 align="center"><u>Rincian SPK</u></h5>
	<table class="rincian2">
		<?php 
		$rincspk = mysqli_query($con, "SELECT * FROM detail_spk WHERE no_nota='$_GET[order]'");
		if(mysqli_num_rows($rincspk)>0){
			while($baris = mysqli_fetch_array($rincspk)){
			?>		
			<tr>
				<td>&nbsp;</td>
				<td><?php echo $baris['jenis_item'] ?></td>
				<td><?php echo $baris['jumlah'] ?></td>
			</tr>
			<?php 
			}
			
		} else{
			echo '<td colspan="3" style="color: red; text-align: center">Belum SPK</td>';
		}
		?>

	</table>

	<?php 
	$qq = mysqli_query($con, "SELECT *FROM order_batal WHERE no_order='$_GET[order]'");

	if(mysqli_num_rows($qq)<1){ ?>
		<table class="rincian2">
			<?php 
			$catatans = mysqli_query($con, "SELECT catatan FROM catatan_order_terlambat WHERE no_order='$_GET[order]'");
			$cats = mysqli_fetch_row($catatans)[0];
			$times = mysqli_query($con, "SELECT DATEDIFF('$nowDate', tgl_input) AS jeda FROM reception WHERE no_nota='$_GET[order]'");
			$jeda = mysqli_fetch_row($times)[0];
			if($jeda>='2' && mysqli_num_rows($catatans)<1){ ?>
			<tr>
				<td><textarea class="form-control" id="catatan" placeholder="Catatan Terlambat" rows="3" cols="34"></textarea></td>			
			</tr>
			<tr>
				<td align="center"><input class="btn btn-xs btn-default" type="submit" name="" id="btn-ff" value="Simpan"></td>
			</tr>
			<?php
			} else { ?>
			<tr>
				<td>Catatan</td>
				<td>:</td>
				<td><?php echo $cats; ?></td>			
			</tr>		
			<?php
			}
			?>
		</table>
	<?php
	} 

	?>

		
	
</div>


<style type="text/css">
	.rincian1{
		border: 1px inset;
		font : 10pt arial;
		background-color: #EEFDD7;
		height: 26px;
		width: 280px;
		margin-bottom: 15px
	}
	.rincian2{
		border: 1px inset;
		font : 10pt arial;
		background-color: #EEFDD7;
		height: 26px;
		width: 280px;
		margin-bottom: 15px
	}
	td{
		padding: 3px;
	}
</style>

<script type="text/javascript">
	$('#btn-ff').click(function(){
		var order = '<?php echo $_GET['order']; ?>';
		var cat = $('#catatan').val();
		$.ajax({
			url 	: 'act/catatan_terlambat.php',
			data 	: 'order='+order+'&cat='+cat,
			success : function(data){
				$('#cat').html(data);
			}
		})
	})
</script>