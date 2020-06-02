<?php 
$user = $_SESSION['user_id'];
$date = date('Y-m-d');


$sql = mysqli_query($con, "SELECT * FROM purchase_order_data WHERE submit=false ORDER BY id ASC");

?>	


<div class=" panel panel-default">
	<div class="panel-heading data-cetak">
		<h3 class="panel-title" align="center">Requisition Form</h3>
	</div>
	<div class="panel-body">
		
		<div>	
			<a data-toggle="tooltip" data-placement="top" title="Tambah RF" href="?menu=requisition_form"><img src="icon/plus.ico"></a>						
			<a id="cetak" class="btn pull-right" title="Cetak RF"><img src="icon/cetak.ico"></a>
		</div>
		<?php 
		if(mysqli_num_rows($sql)>0) {
			$row = mysqli_fetch_array($sql); ?>
			<div class="data-cetak" style="font-family: arial;">	
				
				<br>
				<img src="../logo.png" width="8%">
		 		<div style="font-size: 14px; font-weight: bolder">Quick & Clean Laundry</div><br>
				<div align="left">
					<table style="font-size:9pt">
						<tr>							
							<td>No</td>
							<td>&nbsp; :&nbsp; &nbsp; </td>
							<td><?php echo $row['nomor_rf'] ?></td>
						</tr>
						<tr>
							<td>Delivery To</td>
							<td>&nbsp; :&nbsp; &nbsp; </td>
							<td style="vertical-align: top;">
								Gudang Toddopuli 
							</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td style="vertical-align: top;">
								Jl. Toddopuli Raya No. 8, Makassar
							</td>
						</tr>
						<tr>
							<td style="font-weight: bold; padding-top: 8px">Date</td>
							<td style="font-weight: bold; padding-top: 8px">&nbsp; :&nbsp; &nbsp; </td>
							<td style="font-weight: bold; padding-top: 8px"><?= date('d F Y', strtotime($row['tanggal_rf'])) ?></td>
						</tr>
					</table>
				</div>
				<br>
				<div>
					<table class="table table-bordered" style="font-size: 9pt">
						<thead>
							<tr>
								<th width="8%" style="vertical-align: middle">No</th>
								<th style="vertical-align: middle">Item Description</th>
								<th width="" style="vertical-align: middle">Qty</th>
								<th style="vertical-align: middle">UOM</th>
								<th width="8%">Last Stock Balance <br><?= date('d/m/Y', strtotime($row['tanggal_rf'])) ?> </th>
								<th width="10%" style="vertical-align: middle">Date Delivery Required</th>
								<th width="20%" style="vertical-align: middle">Recommended Vendor</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$no = 1;
							$query = mysqli_query($con, "SELECT * FROM purchase_order_data WHERE nomor_rf='$row[nomor_rf]' ");
							while($data = mysqli_fetch_array($query)){ ?>
							<tr>
								<td style="text-align: center"><?= $no ?></td>
								<td class="remove-item" data-id="<?= $data['id'] ?>"><?php echo $data['item'] ?></td>
								<td style="text-align: center"><?php echo $data['qty'] ?></td>
								<td style="text-align: center"><?php echo $data['uom'] ?></td>
								<td style="text-align: center"><?php if($data['last_stock_balance']=="0") echo "-"; else echo $data['last_stock_balance'].' '.$data['uom_lsb'] ?></td>
								<td style="text-align: center"><?php if($data['date_delivery_required']=="") echo "-"; else echo date('d-F', strtotime($data['date_delivery_required']))  ?></td>
								<td><?php echo $data['vendor'] ?></td>
							</tr>

							<?php
							$no++;
							 }
							?>
							
						</tbody>
					</table>
				</div>

				<div align="center" class="col-md-3 col-xs-3">
				 	<table class="tab">
					 	<tr>
					 		<th width="30%" style="text-align: center">Prepared by</th>
					 	</tr>
					 	<tr>
					 		<td style="padding-top: 65px; text-decoration: underline; text-align: center"><?php echo $user ?></td>
					 	</tr>
					 	<tr>
					 		<td style="text-align: center">Warehouse Staff</td>
					 	</tr>
					 </table>
				 </div>

			</div>
			<?php
		} 
		else {
			echo "<div align='center'>Daftar requisition baru belum dibuat!</div>";
		}

		?>
			

				

				

	</div>
</div>

<script type="text/javascript">
	(function($) {
    	$(document).ready(function(e) {
        	$("#cetak").bind("click", function(event) {
        		$('.data-cetak').printArea();
            });
        });

    	$('.remove-item').on('click', function(e){
    		var id = $(this).data('id');
    		if(confirm("Anda ingin menghapus item ini?")){
    			$.ajax({
    				method	: 'POST',
	    			url 	: 'action/remove_item_rf.php',
	    			data 	: 'id='+id,
	    			success : function(data){
	    				alert(data);
	    				window.location="";
	    			}
	    		});
    		}
	    		
    	})


    }) (jQuery);
</script>


