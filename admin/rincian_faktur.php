<?php 
include '../config.php';
?>

<div>
	<h4 align="center">Rincian Faktur</h4>
</div>
<div align="center">

	<table class="rincian1">
		<?php 
			$query = mysqli_query($con, "SELECT no_nota, total_bayar FROM reception WHERE no_faktur='$_GET[faktur]'");
			while($data = mysqli_fetch_array($query)){ ?>

			<tr>
				<td><?php echo $data['no_nota'] ?></td>
				<td>:</td>
				<td align="right"><?php echo "Rp.". number_format($data['total_bayar'],0,',','.') ?></td>
			</tr> <?php
			}

		?>
	</table>
	<table class="rincian1">
		<?php 
			$carabayar = mysqli_query($con, "SELECT * FROM cara_bayar WHERE no_faktur='$_GET[faktur]'");
			if(mysqli_num_rows($carabayar)>0){
				while($bayar = mysqli_fetch_array($carabayar)){ ?>
				<tr>
					<td class="td1"><?php echo $bayar['cara_bayar'] ?></td>
					<td class="td1">:</td>
					<td class="td1" align="right"><?php echo "Rp.". number_format($bayar['jumlah'],0,',','.') ?></td>
				</tr>
				<?php  
				} 
			}
			else { ?>
				<tr>
					<td colspan="3" align="center">....</td>
				</tr>	
			<?php 				
			}
			 ?>		

		
		</table>
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

	td{
		padding: 3px;
	}
</style>