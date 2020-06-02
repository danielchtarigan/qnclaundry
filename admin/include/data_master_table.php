<?php 
include '../../config.php';

date_default_timezone_set('Asia/Makassar');
?>

<div class="table-responsive" style="overflow-x: auto" id="rincian_table">
	<table class="table table-bordered table-condendsed table-striped" style="font-family: arial; font-size: 7pt" id="transaksi">
		<thead>
			<tr>
				<th rowspan="2">Tanggal</th>
				<th rowspan="2">Outlet</th>				
				<th rowspan="2">Rcp Order</th>
				<th colspan="7">Pendapatan Laundry</th>
				<th colspan="7">Cara Bayar Pendapatan Laundry</th>
				<th colspan="6">Tutup Kasir</th>
				<th colspan="6">Verifikasi</th>
			</tr>
			<tr>
				<th>Laundry Kiloan</th>
				<th>Laundry Potongan</th>
				<th>Total Laundry Order</th>
				<th style="color: #285be7">Order Sudah Lunas</th>
				<th style="color: #e55a37">Order Belum Lunas</th>
				<th>Pendapatan Member</th>
				<th>Deposit Laundry Berlangganan</th>
				<th>Cash</th>
				<th>BRI</th>
				<th>BNI</th>
				<th>Mandiri</th>
				<th>BCA</th>
				<th>Kuota</th>
				<th>Cashback</th>
				<th>Setoran Bersih</th>
				<th>EDC BRI</th>
				<th>EDC BNI</th>
				<th>EDC Mandiri</th>
				<th>EDC BCA</th>
				<th>Total EDC</th>
				<th>Apotik</th>
				<th>BCA</th>
				<th>Permata</th>
				<th>BRI</th>
				<th>BNI</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$date = date('Y-m-d');			
				$startDate = $_POST['startDate'];
				$endDate   = $_POST['endDate'];

			require '../fungsi/pendapatan.php';
			$query = mysqli_query($con, "SELECT DISTINCT DATE_FORMAT(tgl_input, '%Y-%m-%d') AS tanggal, nama_outlet AS nama_outlet, nama_reception AS reception FROM reception WHERE nama_outlet<>'mojokerto' AND cara_bayar<>'Void' AND (DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate') ORDER BY tanggal ASC");
			while($data = mysqli_fetch_array($query)){
				$tgl = $data['tanggal'];
				$outlet = $data['nama_outlet'];
				$reception = $data['reception'];
				$row = laporan_pendapatan($tgl,$outlet,$reception);
			?>
			<tr>
				<td><?php echo date('d/m/Y', strtotime($tgl)) ?></td>
				<td><?php echo $outlet ?></td>
				<td><?php echo $reception ?></td>
				<td><?php echo $row['laundry_kiloan'] ?></td>
				<td><?php echo $row['laundry_potongan'] ?></td>
				<td><?php echo $row['total_laundry_order'] ?></td>
				<td><?php echo $row['order_sudah_lunas'] ?></td>
				<td><?php echo $row['order_belum_lunas'] ?></td>
				<td><?php echo $row['pendapatan_member'] ?></td>
				<td><?php echo $row['pendapatan_deposit'] ?></td>
				<td><?php echo $row['bayar_cash'] ?></td>
				<td><?php echo $row['bayar_bri'] ?></td>
				<td><?php echo $row['bayar_bni'] ?></td>
				<td><?php echo $row['bayar_mandiri'] ?></td>
				<td><?php echo $row['bayar_bca'] ?></td>
				<td><?php echo $row['bayar_kuota'] ?></td>
				<td><?php echo $row['bayar_cashback'] ?></td>
				<td><?php echo $row['setoran_bersih'] ?></td>
				<td><?php echo $row['edc_bri'] ?></td>
				<td><?php echo $row['edc_bni'] ?></td>
				<td><?php echo $row['edc_mandiri'] ?></td>
				<td><?php echo $row['edc_bca'] ?></td>
				<td><?php echo $row['total_edc'] ?></td>
				<td><?php echo 0 ?></td>
				<td><?php echo 0 ?></td>
				<td><?php echo 0 ?></td>
				<td><?php echo 0 ?></td>
				<td><?php echo 0 ?></td>
			</tr>
			<?php 
			
			}
			$query = mysqli_query($con, "SELECT DISTINCT tanggal AS tanggal, ket2 AS nama_outlet, nama AS reception FROM setoran_bank_sebenarnya WHERE tanggal BETWEEN '$startDate' AND '$endDate' ORDER BY tanggal ASC");
			while($data = mysqli_fetch_array($query)){
				$tgl = $data['tanggal'];
				$outlet = $data['nama_outlet'];
				$reception = $data['reception'];
				$row = laporan_pendapatan($tgl,$outlet,$reception);
			?>
			<tr>
				<td><?php echo date('d/m/Y', strtotime($tgl)) ?></td>
				<td><?php echo $outlet ?></td>
				<td><?php echo $reception ?></td>
				<td><?php echo 0 ?></td>
				<td><?php echo 0 ?></td>
				<td><?php echo 0 ?></td>
				<td><?php echo 0 ?></td>
				<td><?php echo 0 ?></td>
				<td><?php echo 0 ?></td>
				<td><?php echo 0 ?></td>
				<td><?php echo 0 ?></td>
				<td><?php echo 0 ?></td>
				<td><?php echo 0 ?></td>
				<td><?php echo 0 ?></td>
				<td><?php echo 0 ?></td>
				<td><?php echo 0 ?></td>
				<td><?php echo 0 ?></td>
				<td><?php echo 0 ?></td>
				<td><?php echo 0 ?></td>
				<td><?php echo 0 ?></td>
				<td><?php echo 0 ?></td>
				<td><?php echo 0 ?></td>
				<td><?php echo 0 ?></td>
				<td><?php echo $row['apotik'] ?></td>
				<td><?php echo $row['bca'] ?></td>
				<td><?php echo $row['permata'] ?></td>
				<td><?php echo $row['bri'] ?></td>
				<td><?php echo $row['bni'] ?></td>
			</tr>
			<?php 
			
			}
			?>

		</tbody>
	</table>
</div>

<style type="text/css">
	th{
		text-align: center;
	}
</style>

<script type="text/javascript">
	$(document).ready(function(){
		$('#transaksi').dataTable({
			"order" : [[ 0,"asc"]],
			dom : 'T<"clear">lfrtip',
			tableTools: {
                "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                "aButtons": [ 
                    {
                        'sExtends': 'xls',
                        'sFileName': 'Master Tabel.xls',
                        'sButtonText': 'Export'
                        
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
				"iDisplayLength": 25,"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],			
		}).yadcf([				   
		    {column_number : 2},
		])
		
	})
</script>