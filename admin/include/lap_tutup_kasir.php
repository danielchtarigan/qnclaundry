<?php 

include '../config.php';

$sql = $con->query("SELECT * FROM tutup_shift ORDER BY tanggal_tutup DESC");

?>

<style type="text/css">
	th{ text-align: center }
</style>


<legend>
	<div class="row">
		<div class="col-md-6">
			<h3>Pendapatan Resepsionis</h3>
		</div>
		<div class="col-md-6" align="right">
			<h3><a href="exp_excel_lap_pendapatan.php" class="btn btn-success">Export Excel</a> </h3>
		</div>
	</div>
		

</legend>
<div class="table-responsive">
	<table class="table table-bordered table-condensed table-striped" style="font-size: 12px" id="rincian"> 
		<thead>
			<tr>
				<th rowspan="2">Tanggal Pendapatan</th>
				<th rowspan="2">Nomor</th>
				<th rowspan="2">Resepsionis</th>
				<th colspan="8">Pendapatan Order</th>
				<th colspan="5">Pendapatan Membership</th>
				<th colspan="5">Pendapatan Deposit</th>
				<th colspan="5">Pendapatan Delivery</th>
			</tr>
			<tr>
				<th>Cash</th>
				<th>BNI</th>
				<th>BRI</th>
				<th>BCA</th>
				<th>Mandiri</th>
				<th>Kuota</th>
				<th>Cashback</th>
				<th>Piutang</th>
				<th>Cash</th>
				<th>BNI</th>
				<th>BRI</th>
				<th>BCA</th>
				<th>Mandiri</th>
				<th>Cash</th>
				<th>BNI</th>
				<th>BRI</th>
				<th>BCA</th>
				<th>Mandiri</th>
				<th>Cash</th>
				<th>Kuota</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			while($data=$sql->fetch_array()){
				echo '
				<tr>
					<td>'.$data['tanggal_tutup'].'</td>
					<td>'.$data['nomor'].'</td>
					<td>'.$data['dibuat_oleh'].'</td>
					<td>'.$data['rcp_cash'].'</td>
					<td>'.$data['rcp_bni'].'</td>
					<td>'.$data['rcp_bri'].'</td>
					<td>'.$data['rcp_bca'].'</td>
					<td>'.$data['rcp_mandiri'].'</td>
					<td>'.$data['rcp_kuota'].'</td>
					<td>'.$data['rcp_cashback'].'</td>
					<td>'.$data['rcp_piutang'].'</td>
					<td>'.$data['rcp_cash_membership'].'</td>
					<td>'.$data['rcp_bni_membership'].'</td>
					<td>'.$data['rcp_bri_membership'].'</td>
					<td>'.$data['rcp_bca_membership'].'</td>
					<td>'.$data['rcp_mandiri_membership'].'</td>
					<td>'.$data['rcp_cash_deposit'].'</td>
					<td>'.$data['rcp_bni_deposit'].'</td>
					<td>'.$data['rcp_bri_deposit'].'</td>
					<td>'.$data['rcp_bca_deposit'].'</td>
					<td>'.$data['rcp_mandiri_deposit'].'</td>
					<td>'.$data['delivery_cash'].'</td>
					<td>'.$data['delivery_kuota'].'</td>
				</tr>
				';
			}

			?>
		</tbody>
	</table>
</div>
