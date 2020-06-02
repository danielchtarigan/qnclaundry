<?php
include 'header.php';
include '../config.php';
$tgl=$_POST['tgl'];
	   $date = new DateTime($tgl);
	   $newDate = $date->format('Y-m-d');
	   
$tgl2=$_POST['tgl2'];
	   $date2= new DateTime($tgl2);
	   $newDate2 = $date2->format('Y-m-d');
?>

dari tanggal <?php echo $newDate ;?> sampai <?php echo $newDate2; ?>
<table id="tbl_cst" class="display">
	<thead>
		<tr>
			<th>Tgl</th>
			<th>nama</th>
			<th>Total</th>
			<th>id customer</th>
			<th>Lunas</th>
			
		</tr>
		</thead>
		
		<tbody>
			<?php
			$query = "SELECT id_customer,lunas,DATE_FORMAT(tgl_input, '%Y-%m-%d') as tgl_input,sum(total_bayar) as jumlah FROM reception where (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newDate' and '$newDate2')  group by DATE_FORMAT(tgl_input, '%Y-%m-d'),id_customer,lunas ORDER BY tgl_input ASC";
			$tampil = mysqli_query($con, $query);
				while($r = mysqli_fetch_array($tampil)){
					$id_cs=$r['id_customer'];
				?>
				<tr >
				<td><?php echo $r['tgl_input']; ?></td>	
				<td><?php
				$sql4=mysqli_query($con,"SELECT * from customer WHERE id='$id_cs'");
$s2=mysqli_fetch_array($sql4);
$nama=$s2['nama_customer'];
echo $nama ;?>
					</td>	
				<td><?php echo $r['jumlah']; ?></td>	
				<td><?php echo $r['id_customer']; ?></td>
				<td><?php echo $r['lunas']; ?></td>	
				
				</tr>
					<?php } 
					?>
		</tbody>
		</table>
	
	
<script> 
$(document).ready(function() { 
	    	$('#tbl_cst').dataTable({
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "../swf/copy_csv_xls_pdf.swf",
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
                    },  { "width": "5px", "targets": [2] },{ "width": "10%", "targets": 1 },
                ],

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
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );
 
            // Total over this page
            pageTotal = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 3 ).footer() ).html(
                ''+pageTotal +' ( '+ total +' total)'
            );
        },	
        		"aaSorting": [[ 2, "desc" ]],
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 10}).yadcf([
	    {
	    	column_number : 0,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },
	   
	    {column_number : 4}
	    
	    ]);    

} );
</script>
