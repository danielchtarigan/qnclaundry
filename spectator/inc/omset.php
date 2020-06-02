<?php 
if(isset($_POST['cari'])){
	$startDate = $_POST['start'];
	$endDate = $_POST['end'];
} else {
	$startDate = date('Y/m/d', strtotime('-7 days', strtotime(date('Y-m-d'))));
	$endDate = date('Y/m/d');
}
?>

<script type="text/javascript">
		$(document).ready(function(){
			$('#omset').dataTable({
				"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
			dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "../admin/swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1,2,3,4],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1,2,3,4],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },
                        
                        {
                            'sExtends': 'print',
                            "mColumns": [0,1,2,3,4],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        }
                        
                    ]
                },
                "columnDefs": [
                    {
                        "targets": [0],
                        "visible": true,
                        "searchable": true,"width":"4px",
                    },  { "width": "5px", "targets": [0] },{ "width": "5px", "targets": 1 },
                ],
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				"iDisplayLength": 50,"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
						"footerCallback": function ( row, data, start, end, display ) {
	            var api = this.api(), data;
	 
	            // Remove the formatting to get integer data for summation
	            var intVal = function ( i ) {
	                return typeof i === 'string' ?
	                    i.replace(/[\$,]/g, '')*1 :
	                    typeof i === 'number' ?
	                        i : 0;
	            };
	 
	            // Total over all pages
	            total = api
	                .column( 4 )
	                .data()
	                .reduce( function (a, b) {
	                    return intVal(a) + intVal(b);
	                } );
	 
	            // Total over this page
	            pageTotal = api
	                .column( 4, { page: 'current'} )
	                .data()
	                .reduce( function (a, b) {
	                    return intVal(a) + intVal(b);
	                }, 0 );
	 
	            // Update footer
	            $( api.column( 4 ).footer() ).html(
	                ''+pageTotal +' ( '+ total +' total)'
	            );
	        }
		
				}).yadcf([
		    {
		    	column_number : 0,
		    	filter_type: 'range_date',
		    	date_format: "yyyy-mm-dd"
		    },

		   
		    {column_number : 1}
		    
		    
		    ]);					
	});
</script>

<?php include 'cari.php'; ?>

<div class="col-md-4 col-md-offset-4">
<legend align="center"><marquee behavior=alternate  width="300"><strong>Laporan Omset/Order</strong></marquee></legend>
</div>
<div class="table-responsive">
	<table class="table table-bordered table-hover table-striped" id="omset">
		<thead>
			<tr>
				<th>Tanggal</th>
				<th>Reception</th>
				<th>Kiloan</th>
				<th>Potongan</th>
				<th>Jumlah</th>
			</tr>
		</thead>
		<tfoot>
            <tr>
                <th colspan="4" style="text-align:right">Total:</th>
                <th></th>
            </tr>
        </tfoot>
		<tbody>
			<?php 
			$query = mysqli_query($con, "SELECT SUM(total_bayar) AS omset, DATE_FORMAT(tgl_input, '%Y/%m/%d') AS tanggal, nama_reception FROM reception WHERE DATE_FORMAT(tgl_input, '%Y/%m/%d') BETWEEN '$startDate' AND '$endDate' AND nama_outlet='$_SESSION[outlet]' AND cara_bayar<>'Void' GROUP BY tanggal ORDER BY tanggal ASC");
			while($data = mysqli_fetch_array($query)){?>
				<tr>
					<td><?php echo $data['tanggal'] ?></td>
					<td><?php echo $data['nama_reception'] ?></td>
				    <td>
				        <?php 
				        $kiloan = mysqli_query($con, "SELECT COALESCE(SUM(total_bayar),0) AS omset FROM reception WHERE DATE_FORMAT(tgl_input, '%Y/%m/%d') = '$data[tanggal]' AND nama_outlet='$_SESSION[outlet]' AND jenis='k'");
				        $datakiloan = mysqli_fetch_row($kiloan);
				        echo $datakiloan[0];
				        ?>
				    </td>
				    <td>
				        <?php 
				        $potongan = mysqli_query($con, "SELECT COALESCE(SUM(total_bayar),0) AS omset FROM reception WHERE DATE_FORMAT(tgl_input, '%Y/%m/%d') = '$data[tanggal]' AND nama_outlet='$_SESSION[outlet]' AND jenis='p'");
				        $datapotongan = mysqli_fetch_row($potongan);
				        echo $datapotongan[0];
				        ?>
				    </td>
					<td><?php echo $data['omset'] ?></td>
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
</div>
	