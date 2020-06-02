<?php 

$date = date('Y-m-d');

?>	
<div class=" panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Requisition Form</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-6 order" align="right">
				<table>
					<tr>
						<td><label class="" for="tanggal">Date</label></td>
						<td>:</td>
						<td>&nbsp;</td>
						<td colspan="2"><input class="form-control" type="text" name="" value="<?php echo date('d/m/Y H:i:s') ?>" readonly></td>
					</tr>
					<tr>
						<td><label class="" for="tanggal">No</label></td>
						<td>:</td>
						<td>&nbsp;</td>
						<?php 
						$query = mysqli_query($con, "SELECT MAX(nomor_rf) AS nomor FROM purchase_order_data WHERE submit<>'0'");
						$row = mysqli_fetch_row($query);
						$lastNoUrut = (int)substr($row[0], 7, 3);
						$th = substr(date('Y'), 2) ;
						$bl = date('m');
						$nomor = 'RF'.$th.$bl.'-'.sprintf('%03s', $lastNoUrut+1);

						?>
						<td colspan="2"><input class="form-control" type="text" name="nomor" id="nomor" value="<?php echo $nomor ?>" readonly></td>
					</tr>
					<tr>
						<td><label class="" for="vendor">Vendor</label></td>
						<td>:</td>
						<td>&nbsp;</td>
						<td colspan="2">
      						<select class="form-control" id="nama_vendor">
								<option>--Recommended Vendor--</option>
								<?php 
								$qcek = mysqli_query($con, "SELECT * FROM purchase_order_data WHERE submit='0'");
								if(mysqli_num_rows($qcek)>0) {
									$rcek = mysqli_fetch_assoc($qcek);
									$query = mysqli_query($con, "SELECT nama_supplier FROM supplier WHERE nama_supplier='$rcek[vendor]'");
								} else {
									$query = mysqli_query($con, "SELECT nama_supplier FROM supplier ORDER BY nama_supplier ASC");
								}

								while($row = mysqli_fetch_assoc($query)){ ?>
								<option><?php echo $row['nama_supplier'] ?></option> <?php
								}
								?>
							</select>								
						</td>
					</tr>
					<tr>
						<td><label class="" for="tanggal">Item</label></td>
						<td>:</td>
						<td>&nbsp;</td>
						<td colspan="2">
      						<select class="form-control" id="item">
								<option>--Pilih Nama Item--</option>
								<?php 
								$query = mysqli_query($con, "SELECT nama_item FROM item_bahan_baku ORDER BY nama_item ASC");
								while($row = mysqli_fetch_assoc($query)){ ?>
								<option><?php echo $row['nama_item'] ?></option> <?php
								}
								?>
							</select>								
						</td>
					</tr>					
					<tr>
						<td><label for="quantity">Quantity</label></td>
						<td>:</td>
						<td>&nbsp;</td>
						<td>
							<div class="input-group my-group">
								<input class="form-control" type="number" name="quantity" id="quantity" value="" min="1">
								<select class="form-control" name="qty_satuan" id="qty_satuan">
									<option value="">UOM</option>
									<?php 
									$query = mysqli_query($con, "SELECT satuan FROM satuan_bb ORDER BY id ASC");
									while($row = mysqli_fetch_assoc($query)){ 
										echo '<option value="'.$row['satuan'].'">'.$row['satuan'].'</option>';
									}
									?>
								</select>	
							</div>
						</td>
					</tr>	
					<tr>
						<td><label for="quantity">LSB</label></td>
						<td>:</td>
						<td>&nbsp;</td>
						<td>
							<div class="input-group my-group">
								<input class="form-control" type="number" name="lsb" id="lsb" value="" min="0">
								<select class="form-control" name="lsb_satuan" id="lsb_satuan">
									<option value="">UOM</option>
									<?php 
									$query = mysqli_query($con, "SELECT satuan FROM satuan_bb ORDER BY id ASC");
									while($row = mysqli_fetch_assoc($query)){ 
										echo '<option value="'.$row['satuan'].'">'.$row['satuan'].'</option>';
									}
									?>
								</select>	
							</div>
						</td>
					</tr>
					<tr>
						<td><label class="" for="tanggal">Date Delivery Required</label></td>
						<td>:</td>
						<td>&nbsp;</td>
						<td colspan="2"><input class="form-control" type="text" id="date_d_r" name="" value="" placeholder="">	</td>
					</tr>				
					<tr>
						<td colspan="5"><textarea  disabled="" class="form-control" placeholder="Keterangan (optional)"></textarea></td>
					</tr>
					<tr>
						<td colspan="5"><input class="btn btn-primary" type="submit" name="submit" id="submit" value="Req Add"></td>
					</tr>
				</table>
			</div>
			

		</div>
	</div>
</div>




<script type="text/javascript">


	$("#quantity").keyup(function(){
		var harga = $("#harga").val();
		var qty = $("#quantity").val();
		var total = parseInt(harga)*parseInt(qty);
		$("#total").val(total);
	});

	$("#submit").click(function(){
		var date = $("#tanggal").val();
		var nomor = $("#nomor").val();
		var vendor = $("#nama_vendor").val();
		var item = $("#item").val();
		var quantity = $("#quantity").val();
		var lsb = $("#lsb").val();
		var qty_satuan = $("#qty_satuan").val();
		var lsb_satuan = $("#lsb_satuan").val();
		var date_d_r = $('#date_d_r').val();

		if(quantity=="" || lsb==""){
			alert("qty atau lsb belum diisi !");
		}
		else if(qty_satuan=="" || lsb_satuan==""){
			alert("Anda belum memilih UOM !");
		}
		else {
			$.ajax({
				type	: 'GET',
				url		: 'action/p_requisition_form.php',
				data	: {date : date, nomor : nomor, vendor : vendor, item : item, quantity : quantity, qty_satuan : qty_satuan, lsb : lsb, lsb_satuan : lsb_satuan, date_d_r : date_d_r},
				success	: function(data){
					alert(data);
					window.location = "index.php?menu=requisition_doc";
				}
			})
		}		
			
	});

	$('.remove-data').click(function(){
	    var id = $(this).attr("id");
		$.ajax({
			type : 'post',
		    url : 'action/hapus_pesanan.php',
		    data :  'id='+ id,
		    success : function(data){
		    $('.hapus-item').html(data);//menampilkan data ke dalam modal
		    }
		})
	});

</script>


