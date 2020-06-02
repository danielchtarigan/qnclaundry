<html>
<head>
	<link rel="stylesheet" type="text/css" href="../lib/css/jquery-ui.css">	
<link rel="stylesheet" type="text/css" href="../admin/css/dataTables.tableTools.css">
<?php 
include "header.php";
include "../config.php"; 
$op=$_SESSION['user_id']; 
?>
</head>
<body>
<script type="text/javascript">
		$(document).ready(function(){
				   
			$('#kotor').dataTable({
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1,2,3,4,5,6,7],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1,2,3,4,5,6,7],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },
                        
                        {
                            'sExtends': 'print',
                            "mColumns": [0,1,2,3,4,5,6,7],
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
            $( api.column(3 ).footer() ).html(
                ''+pageTotal +' ( '+ total +' total)'
            );
        },	

	
				 "aaSorting": [[ 0, "desc" ]],
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 10
				
			}).yadcf([
	    {
	    	column_number : 0,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },
	   
	    {column_number : 4}, {column_number : 1},	    {column_number : 7}

	    
	    ]);
			
		 
			
						
		});
	</script>
<fieldset>
<legend align="center"><strong>Manifest ke Workshop</strong></legend> 
<table id="kotor" class="display">
		<thead>
		<tr>			
			<th>Tanggal Kirim</th>
			<th>Dari Outlet</th>
			<th>Kode Serah</th>
			<th>No Nota</th>
			<th>Pengirim</th>
			<th>Nama Driver</th>
			<th>Kode Terima</th>
			<th>Penerima</th>			
		</tr>
		</thead>
		<tbody>
		<?php $sql = $con->query("select a.no_nota,a.kd_terima,b.tempat,b.kode_serah,b.tgl,b.pemberi,b.driver from manifest a join man_serah b on a.kd_serah=b.kode_serah"); ?>
			
					<?php while ( $data = $sql->fetch_assoc() ) { ?>
					<tr>
						<td><?php echo $data['tgl']?></td>
						<td><?php echo $data['tempat']?></td>
						<td><?php echo $data['kode_serah']?></td>
						<td><?php echo $data['no_nota']?></td>
						<td><?php echo $data['pemberi']?></td>
						<td><?php echo $data['driver']?></td>
						<td><?php 
				$sql2 = mysqli_query($con, "SELECT kode_terima,penerima FROM man_terima WHERE kode_terima='$data[kd_terima]'");
				$s2 = mysqli_fetch_array($sql2); echo $s2['kode_terima'];?></td>					
						<td><?php echo $s2['penerima']?></td>												
					  </tr>
		<?php } ?>
		</tbody>
	</table>
	</fieldset>


<script type="text/javascript" language="javascript" src="../admin/js/dataTables.tableTools.js"></script>
 <script type="text/javascript" language="javascript" src="../lib/js/jquery-ui.js"></script>
</body>

</html>