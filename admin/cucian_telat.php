<?php
include '../config.php';
include 'header.php';

date_default_timezone_set('Asia/Makassar');
$date = date('Y-m-d');
$date2 = date('d-m-Y');
$newDate = strtotime('-3 day', strtotime($date));
$newDate = date('Y-m-d', $newDate);
$newDate2 = strtotime('-1 day', strtotime($date));
$newDate2 = date('Y-m-d', $newDate2);


$mdate = strtotime('-3 day', strtotime($date2));
$mdate2 = strtotime('-1 day', strtotime($date2));

echo '<div class="col-xs-offset-3"><strong>Dari tanggal '.date('d-m-Y', $mdate).' Sampai dengan tanggal '.date('d-m-Y', $mdate2).'</strong><br><br>';
?>

<div class="col-xs-12 col-xs-9">
<div class="table-responsive">
<table class="table table-bordered" id="telat"><thead><tr><th>Nama Customer</th><th>Alamat</th><th>Telepon</th><th>Isi Pesan</th></tr></thead>
	<tbody>
		
<?php


$qtelat = mysqli_query($con, "select DISTINCT DATE_FORMAT(tgl_input, '%Y-%m-%d') as masuk, id_customer,nama_customer,no_faktur from reception where (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newDate' and '$newDate2') and no_faktur<>'' and tgl_kembali = '0000-00-00 00:00' and kembali = 0 order by DATE_FORMAT(tgl_input, '%Y-%m-%d')");
if(mysqli_num_rows($qtelat)>0){
while($telat = mysqli_fetch_array($qtelat)){
$qcust = mysqli_query($con, "select *from customer where id = '$telat[id_customer]'");
while($cust = mysqli_fetch_array($qcust)){
$message = 'QNCLAUNDRY<br>
			Krn alasan operasional, cucian Anda dgn no faktur '.$telat['no_faktur'].' akan mengalami keterlambatan. Mohon maaf atas ketidaknyamanan ini. Info 08114443180';
	echo 
		'<tr>			
			<td>'.$telat['nama_customer'].'</td>
			<td>'.$cust['alamat'].'</td>
			<td>'.$cust['no_telp'].'</td>
			<td>'.$message.'</td>	
		</tr>';	
		
}
}
}

?>					
	</tbody>
</table>

<script type="text/javascript">
		$(document).ready(function(){
			$('#telat').dataTable({
        "order": [[ 1,"asc" ]],
dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1, 2,3],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1, 2,3],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },

                        {
                            'sExtends': 'print',
                            "mColumns": [0,1, 2,3],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        }

                    ]
                },
                "columnDefs": [
                    {
                        "targets": [0],
                        "visible": true,
                        "searchable": true,"width":"5%",
                    },  { "width": "25%", "targets": [1] },
					
                ],
                "bAutoWidth": false,


				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				"iDisplayLength": 100,"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],

			}).yadcf([
	    
	    ]);

		});
	</script>