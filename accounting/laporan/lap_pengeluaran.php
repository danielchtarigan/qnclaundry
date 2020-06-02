<?php 

$input = filter_input_array(INPUT_POST);

$mysqli = $con;


if ($input['action'] == 'edit') {
    $mysqli->query("UPDATE pengeluaran_pety_cash SET vendor='" . $input['vendor'] . "', bill_value='" . $input['bill_value'] . "', ket='" . $input['ket'] . "', payment='".$input['payment']."' WHERE id='" . $input['id'] . "'");
} else if ($input['action'] == 'delete') {
    $mysqli->query("UPDATE pengeluaran_pety_cash SET deleted=1 WHERE id='" . $input['id'] . "'");
} else if ($input['action'] == 'restore') {
    $mysqli->query("UPDATE pengeluaran_pety_cash SET deleted=0 WHERE id='" . $input['id'] . "'");
}

?>

<div style="overflow-x: auto">
	<table class="table table-bordered" style="font-size: 7pt" width="1000px" id="tableEdit">
		<thead>
			<tr>
				<th>Trx Date</th>
				<th>Beneficiary</th>
				<th width="10%">Pax</th>
				<th>Category</th>
				<th width="10%">Vendor</th>
				<th>Bill Value</th>
				<th>Approved Value</th>
				<th width="20%">Remarks</th>
				<th>Payment</th>
				<th>Nota</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$query = mysqli_query($con, "SELECT * FROM pengeluaran_pety_cash");
			while($data = mysqli_fetch_array($query)){ ?>
			<tr>				
				<td class="hidden"><?php echo $data['id'] ?></td>
				<td><?php echo date('d/m/Y', strtotime($data['tanggal'])) ?></td>
				<td><?php echo $data['pay_to'] ?></td>
				<td><?php echo $data['quantity'].' '.$data['satuan'] ?></td>
				<td><?php echo $data['nama_barang'] ?></td>
				<td><?php echo strtoupper($data['vendor']) ?></td>
				<td><?php echo $data['bill_value'] ?></td>
				<td><?php echo $data['harga']*$data['quantity'] ?></td>
				<td><?php echo $data['ket'] ?></td>
				<td><?php echo ucwords($data['payment']) ?></td>
				<td><?php echo '<a href="doc/image/'.$data['nota'].'" alt="doc/image/'.$data['nota'].'" rel="'.$data['nama_barang'].'">'.$data['nota'].'</a>'; ?>
				</td>
			</tr>
			<?php
			}

			?>
		</tbody>
	</table>
</div>
<p id="large"></p>


<script type="text/javascript" language="javascript">
	$(document).ready(function() {			
		$("td a").hover(function(){
			$("#large").html("<img src="+ $(this).attr("alt") +" alt='Large Image'  width='460px' height='260px' /><br/>"+$(this).attr("rel"))
				 .fadeIn("slow");
		}, function(){
			$("#large").fadeOut("fast");
		});



	});
</script>

<style type="text/css">
	#large {
		position:absolute;	
		background:#eee;
		display:none;
		color:#333;	
		padding: 5px;
		top: 50px;
		right: 160px;
</style>

<script type="text/javascript">
	$('#tableEdit').Tabledit({
		editButton: true,
		deleteButton: false,
	    columns: {
	        identifier: [0, 'id'],
	        editable: [[5, 'vendor'], [6, 'bill_value'], [8, 'ket'], [9, 'payment']]
	    }
	});
</script>

