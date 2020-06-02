<?php 


if(isset($_POST['cari'])){
	$startDate = $_POST['start'];
	$endDate = $_POST['end'];
} else {
	$startDate = "0000/00/00";
	$endDate = "0000/00/00";
}
	

?>

<style type="text/css">	
	.tabel {
		font-size: 9px;

	}
	.valign-center {
		vertical-align: center;
		text-align: center;	
	}
</style>

<script type="text/javascript">
    $(function(){
        $("#startDate").datepicker({
            dateFormat:'yy/mm/dd',
            minDate: '2018/01/01',
        });
        
        $("#endDate").datepicker({
            dateFormat:'yy/mm/dd',
            minDate: '2018/01/01',
            maxDate: 0,
        });

        $('.pencarian').click(function(){
        	$('.p_tanggal').removeClass('hidden');
        	$(this).addClass('hidden');
        });
    });
</script>

<button class="pencarian">
	Pencarian
</button>

<div class="p_tanggal hidden">
	<form action="" method="POST" style="font-size: 9pt">
		<label>dari</label>
		<input type="text" name="start" id="startDate" placeholder="Dari Tanggal" autocomplete="off">
		<label>sampai</label>
		<input type="text" name="end" id="endDate" placeholder="Sampai Tanggal" autocomplete="off">
		<button type="submit" class="btn btn-default btn-xs" name="cari" value="Cari">Submit</button>
</form>
</div>

<div style="overflow-x: auto; margin-top: 15px">
	<table class="table tabel table-bordered table-condensed table-striped" id="tampil">
		<thead>
			<tr>
				<th class="valign-center" rowspan="2">Tanggal</th>
				<th class="valign-center" rowspan="2">Outlet</th>
				<th class="valign-center" rowspan="2">Resepsionis</th>
				<th colspan="8">Pendapatan Laundry</th>
				<th colspan="7">Cara Bayar Pendapatan Laundry</th>
			</tr>
			<tr>
				<th>Laundry Kiloan</th>
				<th>Laundry Potongan</th>
				<th>Total Laundry Order</th>
				<th>Order Sudah Lunas</th>
				<th>Order Belum Lunas</th>
				<th>Pendapatan Member</th>
				<th>Pendapatan Laundry Berlangganan</th>
				<th>Setoran Delivery</th>
				<th>Cash</th>
				<th>BRI</th>
				<th>BNI</th>
				<th>Mandiri</th>
				<th>BCA</th>
				<th>Kuota</th>
				<th>Cashback</th>
			</tr>
				
		</thead>

		<tbody>
			<?php 
			if($startDate=="0000/00/00") {
				?>
				<tr>
					<td colspan="18" class="valign-center"> Data tidak tersedia </td>
				</tr>
				<?php
			} else {
				require 'fungsi/pendapatan_x.php';
				$sql = mysqli_query($con, "SELECT DISTINCT DATE_FORMAT(a.tgl_input, '%Y-%m-%d') AS tanggal, a.nama_outlet AS outlet, a.nama_reception AS resepsionis FROM reception a, user b WHERE a.nama_reception=b.name AND b.level='Reception' AND a.cara_bayar<>'Void' AND a.cara_bayar<>'Reject' AND DATE_FORMAT(a.tgl_input, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate' UNION SELECT DISTINCT DATE_FORMAT(tgl_transaksi, '%Y-%m-%d') AS tanggal, nama_outlet AS outlet, rcp AS resepsionis FROM faktur_penjualan WHERE jenis_transaksi<>'ritel' AND DATE_FORMAT(tgl_transaksi, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate' ORDER BY tanggal,outlet,resepsionis DESC ");
				while($data = mysqli_fetch_array($sql)) {
					$tgl = $data['tanggal'];
					$outlet = $data['outlet'];
					$reception = $data['resepsionis'];
					$row = laporan_pendapatan($tgl,$outlet,$reception);
					?>
					<tr>
						<td><?= date('Y/m/d', strtotime($data['tanggal'])) ?></td>
						<td><?= $data['outlet'] ?></td>
						<td><?= $data['resepsionis'] ?></td>
						<td><?php echo $row['laundry_kiloan'] ?></td>
						<td><?php echo $row['laundry_potongan'] ?></td>
						<td><?php echo $row['total_laundry_order'] ?></td>
						<td><?php echo $row['order_sudah_lunas'] ?></td>
						<td><?php echo $row['order_belum_lunas'] ?></td>
						<td><?php echo $row['pendapatan_member'] ?></td>
						<td><?php echo $row['pendapatan_deposit'] ?></td>
						<td><?php echo $row['setoran_delivery'] ?></td>
						<td><?php echo $row['bayar_cash'] ?></td>
						<td><?php echo $row['bayar_bri'] ?></td>
						<td><?php echo $row['bayar_bni'] ?></td>
						<td><?php echo $row['bayar_mandiri'] ?></td>
						<td><?php echo $row['bayar_bca'] ?></td>
						<td><?php echo $row['bayar_kuota'] ?></td>
						<td><?php echo $row['bayar_cashback'] ?></td>
					</tr>

					<?php
				}

				
			}
			?>
				
		</tbody>
	</table>
</div>

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
	                    'sFileName': 'master_order.xls',
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
			    {column_number : 2},  {column_number : 1},	    

			]);
	});
	</script>