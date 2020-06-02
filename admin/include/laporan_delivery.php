<?php 
if(isset($_POST['cari'])){
	$startDate = $_POST['start'];
	$endDate   = $_POST['end'];
} else{
	$startDate = date('Y/m', strtotime('-1 months', strtotime(date('Y/m/d')))).'/26';
	$endDate   = date('Y/m').'/25';
}

?>

<style type="text/css">
	th{
		text-align: center
	}
</style>

<?php include 'cari.php'; ?><br>
<legend align="center">
	Laporan Delivery
	<br><font style="font-size:12pt"><?php echo date('d M Y', strtotime($startDate)).' sampai '.date('d M Y', strtotime($endDate)) ?></font>
</legend>
<div class="col-md-6 col-xs-6 col-md-offset-3" style="overflow-x: auto">
	<table class="table table-bordered table-hover table-condensed" style="background-color: #e2e8ff; font-family: arial">
		<thead>
			<tr>
				<th>Nama Delivery</th>
			    <th>Antar</th>
			    <th>Jemput</th>
				<th>Jumlah Alamat</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$kurirs = mysqli_query($con, "SELECT name FROM user WHERE level='delivery' AND aktif='Ya' AND subagen=''");
			while($kurir = mysqli_fetch_row($kurirs)){ ?>
			<tr>
				<td><?php echo $kurir[0] ?></td>
				<td>
				    <?php 
					$counts1 = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM delivery WHERE (DATE_FORMAT(tgl_ok, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate') AND nama_pengantar='$kurir[0]' AND jenis_permintaan='Antar'");
					$count1 = mysqli_fetch_row($counts1);
					echo $count1[0];
					?>
				</td>
				<td>
				    <?php 
					$counts2 = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM delivery WHERE (DATE_FORMAT(tgl_ok, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate') AND nama_pengantar='$kurir[0]' AND jenis_permintaan='Jemput'");
					$count2 = mysqli_fetch_row($counts2);
					echo $count2[0];
					?>
				</td>
				<td>
					<?php 
					$counts = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM delivery WHERE (DATE_FORMAT(tgl_ok, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate') AND nama_pengantar='$kurir[0]'");
					$count = mysqli_fetch_row($counts);
					echo $count[0];
					?>
				</td>
			</tr>
			<?php }
			?>
			<tr>
				<td style="font-weight: bold; text-align: right" colspan="3">Total</td>
				<td>
					<?php 
					$counts = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM delivery WHERE (DATE_FORMAT(tgl_ok, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate')");
					$count = mysqli_fetch_row($counts);
					echo $count[0];
					?>
				</td>
			</tr>
		</tbody>
	</table>
</div>

<div class="col-md-12">
    <legend align="center">Rincian Delivery<br><font style="font-size:9pt"><?php echo date('d M Y', strtotime($startDate)).' sampai '.date('d M Y', strtotime($endDate)) ?></legend>
    <div style="overflow-x: auto;">
    	<table class="table table-bordered table-condensed table-hover" id="rincian" style="font-size:9pt">
    		<thead>
    			<tr>
    			    <th>Tanggal Delivery</th>
    			    <th>Waktu Delivery</th>
    				<th>Tanggal Permintaan</th>
    				<th>No Faktur</th>
    				<th>Waktu Permintaan</th>
    				<th>Jenis Permintaan</th>
    				<th>Nama Customer</th>
    				<th>Alamat</th>
    				<th>Delivery</th>
    				<th>Penerima</th>
    				<th>Gateway</th>
    				<th>Charge</th>
    			</tr>
    		</thead>
    		<tbody>
    			<?php 
    			$query = mysqli_query($con, "SELECT *FROM delivery WHERE (DATE_FORMAT(tgl_ok, '%Y/%m/%d') BETWEEN '$startDate' AND  '$endDate') AND status='Sukses'");
    			while($data = mysqli_fetch_array($query)){ ?>
    			<tr>
    				<td><?php echo date('Y/m/d', strtotime($data['tgl_ok'])); ?></td>
    				<td><?php echo date('H:i:s', strtotime($data['tgl_ok'])); ?></td>
    				<td><?php echo date('Y/m/d', strtotime($data['tgl_permintaan'])); ?></td>
    				<td><?php echo $data['no_faktur'] ?></td>
    				<td><?php echo $data['waktu_permintaan'] ?></td>
    				<td><?php echo $data['jenis_permintaan'] ?></td>
    				<td><?php echo $data['nama_customer'] ?></td>
    				<td><?php echo $data['alamat'] ?></td>
    				<td><?php echo $data['nama_pengantar'] ?></td>
    				<td><?php echo $data['nama_penerima'] ?></td>
    				<td><?php echo $data['gateway'] ?></td>
    				<td><?php echo $data['charge'] ?></td>
    			</tr>
    			<?php }
    
    			?>
    		</tbody>
    	</table>
    </div>
</div>


<script type="text/javascript">
		$(document).ready(function(){
			$('#rincian').dataTable({
			"order": [[ 0,"asc" ]],
				dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [ 
                        {
                            'sExtends': 'xls',
                            'sFileName': 'Rincian Delivery.xls',
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
				    {column_number : 10},  {column_number : 8},
	    
	    
	    ]);

		});
	</script>