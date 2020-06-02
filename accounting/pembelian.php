<?php
include 'akses.php';
?>
<div class=" panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Pemesanan</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-4 order" align="right">
				<table>
					<tr>
						<td>Tanggal</td>
						<td>:</td>
						<td>&nbsp;</td>
						<td colspan="2"><input class="form-control" type="text" name="" value="<?php echo date('d/m/Y') ?>" readonly></td>
					</tr>
					<tr>
						<td>No. Nota</td>
						<td>:</td>
						<td>&nbsp;</td>
						<td colspan="2"><input class="form-control" type="text" name=""></td>
					</tr>
					<tr>
						<td>Nama Item</td>
						<td>:</td>
						<td>&nbsp;</td>
						<td colspan="2">
							<select class="form-control">
								<option>--Pilih Nama Item--</option>
								<?php 
								$query = mysqli_query($con, "SELECT nama_item FROM item_bahan_baku");
								while($row = mysqli_fetch_assoc($query)){ ?>
								<option><?php echo $row['nama_item'] ?></option> <?php
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Harga</td>
						<td>:</td>
						<td>Rp</td>
						<td colspan="2"><input class="form-control" type="number" name="harga" id="harga" value="0"></td>
					</tr>
					<tr>
						<td>Quantity</td>
						<td>:</td>
						<td>&nbsp;</td>
						<td><input class="form-control" type="number" name="quantity" id="quantity" value="0"></td>
						<td>
							<select class="form-control" style="font-style: oblique;">
								<option>Ltr</option>
								<option>Kg</option>
								<option>Ton</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Total</td>
						<td>:</td>
						<td>Rp</td>
						<td colspan="2"><input class="form-control" type="text" name="total" id="total" readonly="true" value="0"></td>
					</tr>
					<tr>
						<td colspan="5"><textarea class="form-control"></textarea></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>


<style type="text/css">
	.order{
		border: 1px solid;
		width: 400px;
		padding: 25px;
		margin-left: 25px;
	}
</style>


<script type="text/javascript">
	$("#quantity").keyup(function(){
		var harga = $("#harga").val();
		var qty = $("#quantity").val();
		var total = parseInt(harga)*parseInt(qty);
		$("#total").val(total);
	})
		
</script>