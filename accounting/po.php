<?php
include 'akses.php';
?>

<div class=" panel panel-primary">
	<div class="panel-heading data-cetak">
		<h3 class="panel-title" align="center">Purchase Order</h3>
	</div>
	<div class="panel-body">		
		<div>	
			<a data-toggle="tooltip" data-placement="top" title="Tambah/Buat PO" href="?menu=form_po"><img src="icon/plus.ico"></a>			
			<a id="cetak" class="btn pull-right" title="Cetak"><img src="icon/cetak.ico"></a>
		</div>
		<div class="data-cetak" style="font-family: arial;">	
			<span>
				<h4>Quick & Clean Laundry</h4>
			</span>

		<!-- 	<div align="right">
				<table style="font-size:9pt">
					<tr>
						<td>No</td>
						<td>&nbsp; :&nbsp; &nbsp; </td>
						<td>PO1804-018</td>
					</tr>
					<tr>
						<td>Date</td>
						<td>&nbsp; :&nbsp; &nbsp; </td>
						<td>16 April 2018</td>
					</tr>
				</table>
			</div> -->
			<br>
			<div class="row">
				<div class="col-md-6 col-xs-6" align="left">
					<table style="font-size:9pt">
						<tr>
							<td></td>
							<td>&nbsp; &nbsp; &nbsp; </td>
							<td></td>
						</tr>
						<tr>
							<td style="padding-bottom: 15px"></td>
							<td style="padding-bottom: 15px">&nbsp; &nbsp; &nbsp; </td>
							<td style="padding-bottom: 15px"></td>
						</tr>
						<tr>
							<td>Company</td>
							<td>&nbsp; :&nbsp; &nbsp; </td>
							<td>PT SWADAYA INA PRATAMA</td>
						</tr>
						<tr>
							<td>Address</td>
							<td>&nbsp; :&nbsp; &nbsp; </td>
							<td>Jl. Ir Sutami SPBU Parangloe</td>
						</tr>
						<tr>
							<td>Phone</td>
							<td>&nbsp; :&nbsp; &nbsp; </td>
							<td>082291389153</td>
						</tr>
						<tr>
							<td>Contact</td>
							<td>&nbsp; :&nbsp; &nbsp; </td>
							<td>Syamsul</td>
						</tr>
					</table>
				</div>

				<div class="col-md-6 col-xs-6" align="right">
					<table style="font-size:9pt">
						<tr>
							<td>No</td>
							<td>&nbsp; :&nbsp; &nbsp; </td>
							<td>PO1804-018</td>
						</tr>
						<tr>
							<td style="padding-bottom: 15px">Date</td>
							<td style="padding-bottom: 15px">&nbsp; :&nbsp; &nbsp; </td>
							<td style="padding-bottom: 15px">16 April 2018</td>
						</tr>
						<tr>
							<td>Bill to</td>
							<td>&nbsp; :&nbsp; &nbsp; </td>
							<td>Quck &' Clean Laundry</td>
						</tr>
						<tr>
							<td>Address</td>
							<td>&nbsp; :&nbsp; &nbsp; </td>
							<td>Jl. Toddopuli Raya No. 8, Makassar</td>
						</tr>
						<tr>
							<td>Phone</td>
							<td>&nbsp; :&nbsp; &nbsp; </td>
							<td>082291389153</td>
						</tr>
						<tr>
							<td>Contact</td>
							<td>&nbsp; :&nbsp; &nbsp; </td>
							<td>Laura Fany</td>
						</tr>
					</table>
				</div>	
			</div>

				

				
			<br>
			<div>
				<table class="table table-bordered" style="font-size: 9pt">
					<thead>
						<tr>
							<th width="5%" style="vertical-align: middle">No</th>
							<th style="vertical-align: middle">Item Description</th>
							<th width="" style="vertical-align: middle">Qty</th>
							<th style="vertical-align: middle">UOM</th>
							<th width="8%">Last Stock Balance <br><?= date('d/m/Y', strtotime($row['tanggal'])) ?> </th>
							<th width="10%" style="vertical-align: middle">Date Delivery Required</th>
							<th width="" style="vertical-align: middle">Recommended Vendor</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$no = 1;
						$query = mysqli_query($con, "SELECT * FROM requisition WHERE nomor='$row[nomor]' ");
						while($data = mysqli_fetch_array($query)){ ?>
						<tr>
							<td style="text-align: center"><?= $no ?></td>
							<td><?php echo $data['item'] ?></td>
							<td style="text-align: center"><?php echo $data['qty'] ?></td>
							<td style="text-align: center"><?php echo $data['uom'] ?></td>
							<td style="text-align: center"><?php if($data['last_stock_balance']=="0") echo "-"; else echo $data['last_stock_balance'].' '.$data['uom_by_lsb'] ?></td>
							<td style="text-align: center"><?php if($data['date_delivery_required']=="") echo "-"; else echo date('d-F', strtotime($data['date_delivery_required']))  ?></td>
							<td><?php echo $data['recomended_vendor'] ?></td>
						</tr>

						<?php
						$no++;
						 }
						?>
						
					</tbody>
				</table>
			</div>

			<div class="col-md-4 col-md-offset-1">
				<span><strong>Prepared By,</strong></span>
				<p style="margin-top: 40px; margin-bottom: -5px;">(<?= $_SESSION['user_id'] ?>)</p>
				<span>Warehouse Staff</span>
			</div>

		</div>

	</div>
</div>

<script type="text/javascript">
	(function($) {
    	$(document).ready(function(e) {
        	$("#cetak").bind("click", function(event) {
        		$('.data-cetak').printArea();
            });
        });
    }) (jQuery);
</script>
