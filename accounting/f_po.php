<?php 
include 'akses.php';
$date = date('Y-m-d');

?>	
<div class=" panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Form Purchase Order</h3>
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
						$query = mysqli_query($con, "SELECT MAX(nomor) AS nomor FROM purchase_order WHERE submit=true ");
						$row = mysqli_fetch_row($query);
						$lastNoUrut = (int)substr($row[0], 7, 5);
						$th = substr(date('Y'), 2) ;
						$bl = date('m');
						$nomor = 'PO'.$th.$bl.'-'.sprintf('%05s', $lastNoUrut+1);
						?>
						<td colspan="2"><input class="form-control" type="text" name="nomor" id="nomor" value="<?php echo $nomor ?>" readonly></td>
					</tr>
					<tr>
						<td><label class="" for="vendor">Company</label></td>
						<td>:</td>
						<td>&nbsp;</td>
						<td colspan="2">
      						<select class="form-control" id="nama_vendor">
								<option value="">--Vendor Recommended--</option>
								<?php 
								$query = mysqli_query($con, "SELECT DISTINCT nama_supplier FROM supplier a, requisition b WHERE a.nama_supplier=b.recomended_vendor AND b.submit=false ");
								while($row = mysqli_fetch_assoc($query)){ ?>
								<option value="<?= $row['nama_supplier'] ?>"><?php echo $row['nama_supplier'] ?></option> <?php
								}
								?>
							</select>								
						</td>
					</tr>
					<tr>
						<td><label class="" for="tanggal">Item</label></td>
						<td>:</td>
						<td>&nbsp;</td>
						<td colspan="2" id="load_item">
							<select class="form-control" id="item">
								<option value="">--Choose Item--</option>
								<?php 
								$query = mysqli_query($con, "SELECT item FROM requisition WHERE submit=false ");
								while($row = mysqli_fetch_assoc($query)){ ?>
								<option value="<?php echo $row['item'] ?>"><?php echo $row['item'] ?></option> <?php
								}
								?>
							</select>						
						</td>
					</tr>	
					<tr>
						<td><label class="" for="harga_satuan">Price</label></td>
						<td>:</td>
						<td>&nbsp;</td>
						<td colspan="2">
							<div class="input-group">
      							<div class="input-group-addon">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Rp</div>
      							<input type="text" class="form-control" id="unit_price" name="unit_price" placeholder=""/>
    						</div>
	    				</td>
					</tr>					
					<tr>
						<td><label for="quantity">Quantity</label></td>
						<td>:</td>
						<td>&nbsp;</td>
						<td id="load_qty">
							<div class="input-group my-group">
								<input class="form-control" type="number" name="quantity" id="quantity" value="" min="1">
								<select class="form-control" name="qty_satuan" id="qty_satuan">
									<option value="">UOM</option>
									<?php 
									$query = mysqli_query($con, "SELECT uom FROM requisition WHERE submit=false ORDER BY id ASC");
									while($row = mysqli_fetch_assoc($query)){ 
										echo '<option value="'.$row['uom'].'">'.$row['uom'].'</option>';
									}
									?>
								</select>	
							</div>
						</td>
					</tr>				
					<tr>
						<td><label class="" for="total">Total</label></td>
						<td>:</td>
						<td>&nbsp;</td>
						<td colspan="2">
							<div class="input-group">
      							<div class="input-group-addon">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Rp</div>
      							<input type="text" class="form-control" id="total" name="total" placeholder="" readonly="">
    						</div>
	    				</td>
					</tr>				
					<tr>
						<td colspan="5"><textarea  disabled="" class="form-control" placeholder="Keterangan (optional)"></textarea></td>
					</tr>
					<tr>
						<td colspan="5"><input class="btn btn-primary" type="submit" name="submit" id="submit" value="Order Now"></td>
					</tr>
				</table>
			</div>
			

		</div>
	</div>
</div>




<script type="text/javascript">

	$("#nama_vendor").on('change', function(){
		var vendor = $(this).val().split(' ');
		$('#load_item').load('inc/load_item_po.php?vendor='+vendor[0]);
	});

	$("#quantity").keyup(function(){
		var harga = $("#unit_price").val();
		var qty = $("#quantity").val();
		var total = parseInt(harga)*parseInt(qty);
		$("#total").val(total);
	});


    $("#unit_price").keypress(function(e){       
        var harga = $(this).val();
        if(e.which!=8 && e.which!=0 && (e.which<48 || e.which>57)) {
           alert("Kolom harga harus diisi dengan angka!");
             return false;
        } 
    });

    // $('#quantity').focusout(function(){
    // 	alert('Sesuaikan dengan jumlah yang akan dipesan!');
    // 	return false;
    // })

	$("#submit").click(function(){
		var date = $("#tanggal").val();
		var nomor = $("#nomor").val();
		var vendor = $("#nama_vendor").val();
		var item = $("#item").val();
		var quantity = $("#quantity").val();
		var harga = $('#unit_price').val();


		if(quantity=="" || vendor=="" || item=="" || harga==""){
			alert("Gagal! Periksa kembali inputan Anda!");
		}
		else {
			$.ajax({
				type	: 'GET',
				url		: 'action/p_purchase_order.php',
				data	: {date : date, nomor : nomor, vendor : vendor, item : item, quantity : quantity, harga : harga},
				success	: function(data){
					alert(data);
					window.location = "index.php?menu=purchase_order";
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
