<?php 

function cash_order($tgl,$outlet,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) AS jumlah FROM cara_bayar WHERE outlet<>'mojokerto' AND cara_bayar='Cash' AND tanggal_input LIKE '%$tgl%' AND outlet='$outlet' AND resepsionis='$reception'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function bri_order($tgl,$outlet,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) AS jumlah FROM cara_bayar WHERE outlet<>'mojokerto' AND cara_bayar='BRI' AND tanggal_input LIKE '%$tgl%' AND outlet='$outlet' AND resepsionis='$reception'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function bni_order($tgl,$outlet,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) AS jumlah FROM cara_bayar WHERE outlet<>'mojokerto' AND cara_bayar='BNI' AND tanggal_input LIKE '%$tgl%' AND outlet='$outlet' AND resepsionis='$reception'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function mandiri_order($tgl,$outlet,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) AS jumlah FROM cara_bayar WHERE outlet<>'mojokerto' AND (cara_bayar='Mandiri' OR cara_bayar='MANDIRI') AND tanggal_input LIKE '%$tgl%' AND outlet='$outlet' AND resepsionis='$reception'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function bca_order($tgl,$outlet,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) AS jumlah FROM cara_bayar WHERE outlet<>'mojokerto' AND cara_bayar='BCA' AND tanggal_input LIKE '%$tgl%' AND outlet='$outlet' AND resepsionis='$reception'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function cashback_order($tgl,$outlet,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(jumlah),0) AS jumlah FROM cara_bayar WHERE outlet<>'mojokerto' AND cara_bayar='Cashback' AND tanggal_input LIKE '%$tgl%' AND outlet='$outlet' AND resepsionis='$reception'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function cash_langganan($tgl,$outlet,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(total),0) AS jumlah FROM faktur_penjualan WHERE nama_outlet<>'mojokerto' AND cara_bayar='cash' AND tgl_transaksi LIKE '%$tgl%' AND (jenis_transaksi='deposit' OR jenis_transaksi='membership') AND nama_outlet='$outlet' AND rcp='$reception'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function bri_langganan($tgl,$outlet,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(total),0) AS jumlah FROM faktur_penjualan WHERE nama_outlet<>'mojokerto' AND (cara_bayar='edcbri' OR cara_bayar='BRI') AND tgl_transaksi LIKE '%$tgl%' AND (jenis_transaksi='deposit' OR jenis_transaksi='membership') AND nama_outlet='$outlet' AND rcp='$reception'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function bni_langganan($tgl,$outlet,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(total),0) AS jumlah FROM faktur_penjualan WHERE nama_outlet<>'mojokerto' AND (cara_bayar='edcbni' OR cara_bayar='BNI') AND tgl_transaksi LIKE '%$tgl%' AND (jenis_transaksi='deposit' OR jenis_transaksi='membership') AND nama_outlet='$outlet' AND rcp='$reception'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function mandiri_langganan($tgl,$outlet,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(total),0) AS jumlah FROM faktur_penjualan WHERE nama_outlet<>'mojokerto' AND (cara_bayar='edcmandiri' OR cara_bayar='Mandiri') AND tgl_transaksi LIKE '%$tgl%' AND (jenis_transaksi='deposit' OR jenis_transaksi='membership') AND nama_outlet='$outlet' AND rcp='$reception'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function bca_langganan($tgl,$outlet,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(total),0) AS jumlah FROM faktur_penjualan WHERE (cara_bayar='edcbca' OR cara_bayar='BCA') AND tgl_transaksi LIKE '%$tgl%' AND (jenis_transaksi='deposit' OR jenis_transaksi='membership') AND nama_outlet='$outlet' AND rcp='$reception'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function pengeluaran($tgl,$outlet,$reception){
	global $con;
	$sql = mysqli_query($con, "SELECT COALESCE(SUM(pengeluaran),0) AS jumlah FROM tutup_kasir WHERE outlet<>'mojokerto' AND tanggal LIKE '%$tgl%' AND outlet='$outlet' AND reception='$reception'");
	$row = mysqli_fetch_row($sql);
	return $row[0];
}

function laporan_pembayaran($tgl,$outlet,$reception){
	global $con;
	$row['cash_order'] = cash_order($tgl,$outlet,$reception);
	$row['bri_order'] = bri_order($tgl,$outlet,$reception);
	$row['bni_order'] = bni_order($tgl,$outlet,$reception);
	$row['mandiri_order'] = mandiri_order($tgl,$outlet,$reception);
	$row['bca_order'] = bca_order($tgl,$outlet,$reception);
	$row['cashback_order'] = cashback_order($tgl,$outlet,$reception);

	$row['cash_lgn'] = cash_langganan($tgl,$outlet,$reception);
	$row['bri_lgn'] = bri_langganan($tgl,$outlet,$reception);
	$row['bni_lgn'] = bni_langganan($tgl,$outlet,$reception);
	$row['mandiri_lgn'] = mandiri_langganan($tgl,$outlet,$reception);
	$row['bca_lgn'] = bca_langganan($tgl,$outlet,$reception);
	$row['pengeluaran'] = pengeluaran($tgl,$outlet,$reception);
	$row['cash_wajib_setor'] = $row['cash_order']+$row['cash_lgn']-$row['pengeluaran'];

	return $row;
}

if(isset($_POST['submit'])){
	$startDate = $_POST['start'];
	$endDate   = $_POST['end'];

} else{
	$startDate = date('Y-m', strtotime('-1 months', strtotime(date('Y-m-d')))).'-26';
	$endDate   = date('Y-m').'-25';
}

?>
<style type="text/css">
	th{
		text-align: center;
	}
</style>

<script type="text/javascript">
		$(document).ready(function(){
			$('#tampil').dataTable({
			"order": [[ 0,"desc" ]],
				dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [ 'copy',
                        {
                            'sExtends': 'xls',
                            'sFileName': 'laporan_pembayaran.xls',
                            'sButtonText': 'Simpan Ke Excel'
                            
                        }

                    ]
                },
	                "columnDefs": [
	                    {
	                        "targets": [0],
	                        "visible": true,
	                        "searchable": true,"width":"4px",
	                    },
	                ],
	                "bAutoWidth": false,
					"bJQueryUI" : true,
					"sPaginationType" : "full_numbers",
					"iDisplayLength": 50,"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],					
				}).yadcf([				   
				    {column_number : 2},  {column_number : 3},	    
	    
	    		]);
		});
	</script>


<legend align="center">Laporan Pembayaran</legend>
<?php include 'cari2.php'; ?>
<div class="table-responsive" style="overflow-x:auto">
	<table class="table table-bordered table-striped table-hover table-condensed" style="font-size: 10px" id="tampil">
		<thead>
			<tr>
				<th rowspan="2" class="hidden">Tanggal</th>
				<th rowspan="2">Tanggal Lunas</th>
				<th rowspan="2">Outlet</th>
				<th rowspan="2">Resepsionis</th>
				<th colspan="6">Pembayaran Order</th>
				<th colspan="5">Pembayaran Membership dan Deposit Langganan</th>
				<th rowspan="2">Pengeluaran</th>
				<th rowspan="2">Cash Wajib Setor</th>
			</tr>
			<tr>
				<th>Cash</th>
				<th>BRI</th>
				<th>BNI</th>
				<th>Mandiri</th>
				<th>BCA</th>
				<th>Cashback</th>
				<th>Cash</th>
				<th>BRI</th>
				<th>BNI</th>
				<th>Mandiri</th>
				<th>BCA</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$query = mysqli_query($con, "SELECT DISTINCT DATE_FORMAT(tanggal_input, '%Y-%m-%d') AS tanggal, outlet, resepsionis FROM cara_bayar WHERE outlet<>'mojokerto' AND DATE_FORMAT(tanggal_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
			while($data = mysqli_fetch_row($query)){
				$tgl = $data[0]; 
				$outlet = $data[1];
				$reception = $data[2];
				$row = laporan_pembayaran($tgl,$outlet,$reception);
				?>
				<tr>
					<td class="hidden"><?php echo $tgl ?></td>
					<td><?php echo date('d/m/Y', strtotime($tgl)) ?></td>
					<td><?php echo $outlet ?></td>
					<td><?php echo $reception ?></td>
					<td><?php echo $row['cash_order'] ?></td>
					<td><?php echo $row['bri_order'] ?></td>
					<td><?php echo $row['bni_order'] ?></td>
					<td><?php echo $row['mandiri_order'] ?></td>
					<td><?php echo $row['bca_order'] ?></td>
					<td><?php echo $row['cashback_order'] ?></td>
					<td><?php echo $row['cash_lgn'] ?></td>
					<td><?php echo $row['bri_lgn'] ?></td>
					<td><?php echo $row['bni_lgn'] ?></td>
					<td><?php echo $row['mandiri_lgn'] ?></td>
					<td><?php echo $row['bca_lgn'] ?></td>
					<td><?php echo $row['pengeluaran'] ?></td>
					<td><?php echo $row['cash_wajib_setor'] ?></td>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>
</div>
</div>