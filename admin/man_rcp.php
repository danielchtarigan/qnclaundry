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
				   
			$('#man_rcp').dataTable({
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1, 2,3,4],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1, 2,3,4],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },
                        
                        {
                            'sExtends': 'print',
                            "mColumns": [0,1, 2,3,4],
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
	   
	    {column_number : 2},	    {column_number : 4}

	    
	    ]);
			
		 
									
	
$('#terima_rcp').dataTable({
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1, 2,3,4],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1, 2,3,4],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },
                        
                        {
                            'sExtends': 'print',
                            "mColumns": [0,1, 2,3,4],
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
	   
	    {column_number : 2},	    {column_number : 4}

	    
	    ]);
			
		 
			
						
		});
	</script>
<fieldset>
<legend align="center"><strong>Manifest Serah Resepsionis</strong></legend> 
<table id="man_rcp" class="display">
		<thead>
		<tr>			
			<th>Tanggal Manifest</th>
			<th>Manifest Serah</th>
			<th>Resepsionis</th>'
			<th>Driver</th>
			<th>Outlet</th>
			<th>No Nota</th>			
		</tr>
		</thead>
		<tbody>
		<?php $sql = $con->query("select a.no_nota,a.kd_serah,b.pemberi,b.driver,a.outlet,b.tgl from manifest a join man_serah b on a.kd_serah=b.kode_serah"); ?>
			
					<?php while ( $data = $sql->fetch_assoc() ) { ?>
					<tr>
						<td><?php echo $data['tgl']?></td>
						<td><?php echo $data['kd_serah']?></td>
						<td><?php echo $data['pemberi']?></td>
						<td><?php echo $data['driver']?></td>
						<td><?php echo $data['outlet']?></td>
						<td><?php echo $data['no_nota']?></td>						
						</tr>
		<?php } ?>
		</tbody>
	</table>
	</fieldset>
	
<fieldset>
<legend align="center"><strong>Manifest Terima Resepsionis</strong></legend> 
<table id="terima_rcp" class="display">
		<thead>
		<tr>			
			<th>Tanggal Manifest</th>
			<th>Manifest Terima</th>
			<th>Resepsionis</th>
			<th>Driver</th>	
			<th>Outlet</th>			
			<th>No Nota</th>	
			</tr>
		</thead>
		<tbody>
		<?php $sql = $con->query("select a.no_nota,a.kd_terima3,a.outlet,b.penerima,b.tgl,b.driver from manifest a join man_terima b on a.kd_terima3=b.kode_terima"); ?>
			
					<?php while ( $data = $sql->fetch_assoc() ) { ?>
					<tr>
						<td><?php echo $data['tgl']?></td>
						<td><?php echo $data['kd_terima3']?></td>
						<td><?php echo $data['penerima']?></td>
						<td><?php echo $data['driver']?></td>
						<td><?php echo $data['outlet']?></td>						
						<td><?php echo $data['no_nota']?></td>						
						</tr>
		<?php } ?>
		</tbody>
	</table>
	</fieldset>

<script type="text/javascript" language="javascript" src="../admin/js/dataTables.tableTools.js"></script>
 <script type="text/javascript" language="javascript" src="../lib/js/jquery-ui.js"></script>

</body>


</html>