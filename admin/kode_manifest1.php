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
				   
			$('#kode').dataTable({
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1, 2,3,4,5,6,7],
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
	   
	    {column_number : 2},	    {column_number : 3}

	    
	    ]);
			
		 
			
						
		});
	</script>
<fieldset>
<div class="container" style="padding:20px; margin:100px auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin-bottom:20px; color:#000000;">
        <center><h2>Kode Manifest</h2></center>
    	<table id="kode" class="display">
		<thead>
		<tr>			
			<th>Tanggal Masuk</th>
			<th>No Nota</th>
			<th>Rcp SPK</th>
			<th>Outlet</th>
			<th>Kode MSW</th>			
			<th>Kode MTW</th>
			<th>Kode MSO</th>
			<th>Kode MTO</th>			
		</tr>
		</thead>
		<tbody>
		<?php $sql = $con->query("select a.no_nota,a.tgl_input,a.rcp_spk,a.nama_outlet,b.kd_serah,b.kd_terima,b.kd_serah3,b.kd_terima3 from reception a join manifest b on a.no_nota=b.no_nota"); ?>
			
					<?php while ( $data = $sql->fetch_assoc() ) { ?>
					<tr>
						<td><?php echo $data['tgl_input']?></td>
						<td><?php echo $data['no_nota']?></td>
						<td><?php echo $data['rcp_spk']?></td>
						<td><?php echo $data['nama_outlet']?></td>
						<td><?php echo $data['kd_serah']?></td>
						<td><?php echo $data['kd_terima']?></td>
						<td><?php echo $data['kd_serah3']?></td>	
						<td><?php echo $data['kd_terima3']?></td>							
						
					  </tr>
		<?php } ?>
		</tbody>
	</table>
	</fieldset>


<script type="text/javascript" language="javascript" src="../admin/js/dataTables.tableTools.js"></script>
 <script type="text/javascript" language="javascript" src="../lib/js/jquery-ui.js"></script>
</body>

</html>