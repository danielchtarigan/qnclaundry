<head>
<?php 
include "header.php";
include "../config.php"; 
$op=$_SESSION['user_id'];
?>	
</head>
<body>
<div class="container-fluid" style="width:1200px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  color:#000000;">
<fieldset>
<legend align="center"><strong>PIUTANG</strong></legend> 
	<table id="rincianpacking" class="display">
		<thead>
		<tr>
			
			<th>Tanggal</th>
			<th>Outlet</th>
			<th>no nota</th>
			<th>nama customer</th>
			<th>rcp</th>
			<th>total</th>
			<th>tgl so</th>
			<th>rcp so</th>
			<th>tgl ambil</th>
			<th>rcp ambil</th>
			<th>cuci</th>
			<th>setrika</th>
			<th>packer</th>
			
	   </tr>
		</thead>
		<tfoot>
            <tr>
                <th colspan="5" style="text-align:right">Total:</th>
                <th></th>
            </tr>
        </tfoot>
	
		<tbody>
		
			<?php
			$query = "SELECT op_cuci,user_setrika,user_packing, nama_outlet,no_nota,nama_customer,tgl_input,nama_reception,total_bayar,tgl_so,rcp_so,tgl_ambil,reception_ambil FROM reception WHERE lunas=false ORDER BY tgl_input asc" ;
			$tampil = mysqli_query($con, $query);
			while($data = mysqli_fetch_array($tampil)){
		
			?>
			<tr>	
			<td><?php echo $data['tgl_input'];?></td>
			<td><?php echo $data['nama_outlet'];?></td>
			<td><?php echo $data['no_nota'];?></td>
			<td><?php echo $data['nama_customer'];?></td>	
						<td><?php echo  $data['nama_reception'];?></td>
						<td><?php echo  $data['total_bayar'];?></td>
						<td><?php echo  $data['tgl_so'];?></td>
						<td><?php echo  $data['rcp_so'];?></td>
						<td><?php echo  $data['tgl_ambil'];?></td>
						<td><?php echo  $data['reception_ambil'];?></td>
							<td><?php echo  $data['op_cuci'];?></td>
								<td><?php echo  $data['user_setrika'];?></td>
									<td><?php echo  $data['user_packing'];?></td>
						
					
						</tr>
					<?php } 
					?>
		</tbody>
	</table>
</fieldset>
</div>
</body>
<script type="text/javascript">
		$(document).ready(function(){
				   
			$('#rincianpacking').dataTable({
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1, 2,3,4,5,6,7,8,9,10,11,12],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1, 2,3,4,5,6,7,8,9,10,11,12],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },
                        
                        {
                            'sExtends': 'print',
                            "mColumns": [0,1, 2,3,4,5,6,7,8,9,10,11,12],
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
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );
 
            // Total over this page
            pageTotal = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column(5 ).footer() ).html(
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
	   
	    {column_number : 4},	    {column_number : 1}

	    
	    ]);
			
		 
			
						
		});
	</script>