<?php 
include '../../config.php';


$startDate = $_GET['start'];
$endDate = $_GET['end'];

?>


<legend></legend>
<div class="table-responsive" style="overflow-x:auto">
	<table class="table table-bordered table-striped table-condensed" id="" style="font-size: 12px; width: 800px; margin:0 auto; margin-bottom: 50px">
		<thead>
			<tr>
				<th>Nama Outlet</th>
				<th>Kiloan</th>
				<th>Potongan</th>
				<th>Membership</th>
				<th>Jumlah</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			
				$tKiloan = 0;
				$tPotongan = 0;
				$tmember = 0 ;
				$sql = $con-> query("SELECT * FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND b.Kota='".$_GET['jar']."' AND cara_bayar<>'Void' AND cara_bayar<>'Reject' AND DATE_FORMAT(a.tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' GROUP BY a.nama_outlet ASC ");
			
			while($rs = $sql->fetch_array()){
				echo '
				<tr>
					<td>'.$rs['nama_outlet'].'</td>';

					$kiloan = mysqli_fetch_array(mysqli_query($con, "SELECT SUM(total_bayar) FROM reception WHERE jenis='k' AND nama_outlet='$rs[nama_outlet]' AND cara_bayar<>'Void' AND cara_bayar<>'Reject' AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'"))[0];
					$potongan = mysqli_fetch_array(mysqli_query($con, "SELECT SUM(total_bayar) FROM reception WHERE jenis='p' AND nama_outlet='$rs[nama_outlet]' AND cara_bayar<>'Void' AND cara_bayar<>'Reject' AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'"))[0];
					$membership = mysqli_fetch_array(mysqli_query($con, "SELECT SUM(total) FROM faktur_penjualan WHERE jenis_transaksi='membership' AND nama_outlet='$rs[nama_outlet]' AND DATE_FORMAT(tgl_transaksi, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'"))[0];

					$tKiloan += $kiloan;
					$tPotongan += $potongan;
					$tmember += $membership;
					$jumlah = $kiloan+$potongan+$membership;

					echo '

					<td align="center">'.number_format($kiloan,0,',','.').'</td>

					<td align="center">'.number_format($potongan,0,',','.').'</td>
					<td align="center">'.number_format($membership,0,',','.').'</td>
					<td align="center">'.number_format($jumlah,0,',','.').'</td>
				</tr>
				';
			}

			?>
		</tbody>
		<tfoot>
            <tr>
                <th style="text-align:right; background-color: #00A8FF">Total:</th>
                <th style="background-color: #00A8FF"><?= number_format($tKiloan,0,',','.') ?></th>
                <th style="background-color: #00A8FF"><?= number_format($tPotongan,0,',','.') ?></th>
                <th style="background-color: #00A8FF"><?= number_format($tmember,0,',','.') ?></th>
                <th style="background-color: #00A8FF"><?= number_format($tKiloan+$tPotongan+$tmember,0,',','.') ?></th>
            </tr>
        </tfoot>
	</table>
</div>

<legend></legend>
<div class="table-responsive" style="overflow-x:auto">
	<table class="table table-bordered table-striped table-condensed" id="result" style="font-size: 11px">
		<thead>
			<tr>
				<th>Tanggal</th>
				<th>Nama Outlet</th>
				<th class="hide">ID Customer</th>
				<th>Nama Customer</th>
				<th>Nomor Order</th>
				<th>Harga</th>
				<th>Diskon</th>
				<th>Kode Promo</th>
				<th>Lunas</th>
				<th>Nomor Faktur</th>
				<th>Dibuat Oleh</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			
				$total = 0;
				$diskon =0;
				$sql = $con-> query("SELECT * FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND b.Kota='".$_GET['jar']."' AND cara_bayar<>'Void' AND cara_bayar<>'Reject' AND DATE_FORMAT(a.tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
			
			while($rs = $sql->fetch_array()){
				$total += $rs['total_bayar'];
				$diskon += $rs['diskon'];
				echo '
				<tr>
					<td>'.date('Y-m-d', strtotime($rs['tgl_input'])).'</td>
					<td>'.$rs['kode'].'</td>
					<td class="hide">'.$rs['id_customer'].'</td>
					<td>'.$rs['nama_customer'].'</td>
					<td>'.$rs['no_nota'].'</td>
					<td>'.$rs['total_bayar'].'</td>
					<td>'.$rs['diskon'].'</td>
					<td>'.$rs['voucher'].'</td>
					<td>'.$rs['lunas'].'</td>
					<td>'.$rs['no_faktur'].'</td>
					<td>'.$rs['nama_reception'].'</td>
				</tr>
				';
			}

			?>
		</tbody>
		<tfoot>
            <tr>
                <th colspan="4" style="text-align:right">Total:</th>
                <th><?= number_format($total,0,',','.') ?></th>
                <th><?= number_format($diskon,0,',','.') ?></th>
                <th colspan="4"></th>
            </tr>
        </tfoot>
	</table>
</div>


<script type="text/javascript">
	$('#result').dataTable({
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
				"iDisplayLength": 10,"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],					
			}).yadcf([				   
			    {column_number : 1},  {column_number : 9},	    
    
    		]);
</script>