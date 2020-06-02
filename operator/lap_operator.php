<head>
<?php 
include "header.php";
include "../config.php"; 
$op=$_SESSION['user_id'];
?>
	
</head>
<body>

<div class="container-fluid" style="width:750px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin-bottom:20px; color:#000000;">
<fieldset>
<legend align="center"><strong>Cuci</strong></legend> 
	<table id="cuci" class="display">
		<thead>
		<tr>
			<th>Tgl Cuci</th>
			<th >Operator</th>
			<th>Jumlah</th>
		</tr>
		</thead>
		<tfoot>
            <tr>
                <th colspan="2" style="text-align:right">Total:</th>
                <th></th>
            </tr>
        </tfoot>
		<tbody>
			<?php
			$query = "SELECT DATE_FORMAT(tgl_cuci, '%Y/%m/%d') as tgl_cuci,op_cuci,count(no_nota) as jumlah FROM cuci group by op_cuci,DATE_FORMAT(tgl_cuci, '%Y%m%d') ORDER BY tgl_cuci ASC" ;
			$tampil = mysqli_query($con, $query);
			
			while($data = mysqli_fetch_array($tampil)){
				echo "<tr>
						<td>$data[tgl_cuci]</td>
						<td>$data[op_cuci]</td>
						<td>$data[jumlah]</td>
						 </tr>";
						}
			?>
		</tbody>
	</table>
	</fieldset>
	<fieldset>

<legend align="center"><strong>Pengering</strong></legend> 
	<table id="pengering" class="display">
		<thead>
		<tr>
			<th>Tgl Pengering</th>
			<th>Operator</th>
			<th>Jumlah</th>
		</tr>
		</thead>
		<tfoot>
            <tr>
                <th colspan="2" style="text-align:right">Total:</th>
                <th></th>
            </tr>
        </tfoot>
		<tbody>
			<?php
			$query = "SELECT DATE_FORMAT(tgl_pengering, '%Y/%m/%d') as tgl_pengering,op_pengering,count(no_nota) as jumlah FROM pengering group by op_pengering,DATE_FORMAT(tgl_pengering, '%Y%m%d')" ;
			$tampil = mysqli_query($con, $query);
			$no = 1;
			while($data = mysqli_fetch_array($tampil)){
				echo "<tr>
						
						<td>$data[tgl_pengering]</td>
						<td>$data[op_pengering]</td>
						<td>$data[jumlah]</td>
						 </tr>";
		
			}
			?>
		</tbody>
	</table>
	</fieldset>

<fieldset>
<legend align="center"><strong>Setrika</strong></legend> 
	<table id="setrika" class="display">
		<thead>
		<tr>
			<th>Tgl Setrika</th>
			<th>Setrika</th>
			<th>Berat</th>
			<th>jumlah nota</th>
		</tr>
		</thead>
		<tfoot>
            <tr>
                <th colspan="2" style="text-align:right">Total:</th>
                <th></th>
            </tr>
        </tfoot>
		<tbody>
			<?php
			$query = "SELECT DATE_FORMAT(tgl_setrika, '%Y/%m/%d') as tgl_setrika,user_setrika, FORMAT(sum(berat),2) as berat,count(no_nota) as jumlah FROM setrika group by user_setrika,DATE_FORMAT(tgl_setrika, '%Y%m%d') ORDER BY tgl_setrika DESC" ;
			$tampil = mysqli_query($con, $query);
			
			while($data = mysqli_fetch_array($tampil)){
				echo "<tr>
						<td>$data[tgl_setrika]</td>
						<td>$data[user_setrika]</td>
						<td>$data[berat]</td>
						<td>$data[jumlah]</td>
						 </tr>";
						}
			?>
		</tbody>
	</table>
	</fieldset>
	
<fieldset>
<legend align="center"><strong>Packing</strong></legend> 
	<table id="packing" class="display">
		<thead>
		<tr>
			<th>Tgl Packing</th>
			<th>Packer</th>
			<th>jumlah nota</th>
		</tr>
		</thead>
		<tfoot>
            <tr>
                <th colspan="2" style="text-align:right">Total:</th>
                <th></th>
            </tr>
        </tfoot>
		<tbody>
			<?php
			$query = "SELECT DATE_FORMAT(tgl_packing, '%Y/%m/%d') as tgl_packing,user_packing,count(no_nota) as jumlah FROM packing group by user_packing,DATE_FORMAT(tgl_packing, '%Y%m%d')" ;
			$tampil = mysqli_query($con, $query);
			
			while($data = mysqli_fetch_array($tampil)){
				echo "<tr>
						<td>$data[tgl_packing]</td>
						<td>$data[user_packing]</td>
						<td>$data[jumlah]</td>
						 </tr>";
						}
			?>
		</tbody>
	</table>
	</fieldset>
	
</div>
<div class="container-fluid" style="width:800px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  color:#000000;">

<fieldset>
<legend align="center"><strong>Rincian Cuci</strong></legend> 
<table id="rinciancuci" class="display">
		<thead>
		<tr>
			
			<th>Tgl Cuci</th>
			<th>No Nota</th>
			<th>Operator</th>
			<th>Jumlah</th>
			<th>No Mesin</th>
	<th>Ket</th>
		</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT * FROM cuci ORDER BY tgl_cuci DESC" ;
			$tampil = mysqli_query($con, $query);
			$no = 1;
			while($data = mysqli_fetch_array($tampil)){
				echo "<tr>
						
						<td>$data[tgl_cuci]</td>
						<td>$data[no_nota]</td>
						<td>$data[op_cuci]</td>
						<td>$data[jumlah]</td>
						<td>$data[no_mesin]</td>
<td>$data[ket]</td>
						
						 </tr>";
		
			}
			?>
		</tbody>
	</table>



</fieldset>


<fieldset>

<legend align="center"><strong>Rincian Pengering</strong></legend> 
	<table id="rincianpengering" class="display">
		<thead>
		<tr>
		
			<th>Tgl Pengering</th>
			<th>No Nota</th>
			<th>Operator</th>
			<th>Jumlah</th>
			<th>No Mesin</th>
		</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT * FROM pengering ORDER BY tgl_PENGERING DESC" ;
			$tampil = mysqli_query($con, $query);
			
			while($data = mysqli_fetch_array($tampil)){
				echo "<tr>
						
						<td>$data[tgl_pengering]</td>
						<td>$data[no_nota]</td>
						<td>$data[op_pengering]</td>
						<td>$data[jumlah]</td>
						<td>$data[no_mesin]</td>
						 </tr>";
		
			}
			?>
		</tbody>
	</table>
	</fieldset>
	<fieldset>

<legend align="center"><strong>Detail Setrika</strong></legend>
<div id="konfirm-box"> Apakah Anda yakin akan menghapus ini?</div> 
	<table id="rinciansetrika" class="display">
		<thead>
		<tr>
			
			<th>Tgl Setrika</th>
			
			<th>No Nota</th>
			<th>Setrika</th>
			<th>Berat</th>
		</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT * FROM setrika ORDER BY tgl_setrika DESC" ;
			$tampil = mysqli_query($con, $query);
			
			while($data = mysqli_fetch_array($tampil)){?>
				
					<tr id="<?php echo $data['id'];?>" >
					<td><?php echo $data['tgl_setrika'];?></td>
					
					<td><?php echo $data['no_nota'];?></td>
					<td><?php echo $data['user_setrika'];?></td>
					<td><?php echo $data['berat'];?></td>
				</tr>
			
				<?php } 
 ?>
		</tbody>
	</table>
	
	</fieldset>
	<fieldset>

<legend align="center"><strong>Detail Packing</strong></legend> 
	<table id="rincianpacking" class="display">
		<thead>
		<tr>
			
			<th>Tgl Pakcing</th>
			<th>No Nota</th>
			<th>Packer</th>
			<th>Jumlah</th>
		</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT * FROM packing ORDER BY tgl_packing DESC" ;
			$tampil = mysqli_query($con, $query);
			
			while($data = mysqli_fetch_array($tampil)){
				echo "<tr>
						
						<td>$data[tgl_packing]</td>
						<td>$data[no_nota]</td>
						<td>$data[user_packing]</td>
						<td>$data[jumlah]</td>
						
						 </tr>";
			
			}
			?>
		</tbody>
	</table>
	</fieldset>





</div>
</body>
<script type="text/javascript">
		$(document).ready(function(){
			$('#cuci').dataTable({
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1, 2],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1, 2],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },
                        
                        {
                            'sExtends': 'print',
                            "mColumns": [0,1, 2],
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
                .column( 2 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );
 
            // Total over this page
            pageTotal = api
                .column( 2, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 2 ).footer() ).html(
                ''+pageTotal +' ( '+ total +' total)'
            );
        },
        		"aaSorting": [[ 0, "desc" ]],
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 5}).yadcf([
	    {
	    	column_number : 0,
	    	filter_type: 'range_date',
	    	date_format: "yyyy/mm/dd"
	    },
	   
	    {column_number : 1}
	    
	    ]);
	        
	   
			$('#pengering').dataTable({
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1, 2],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1, 2],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },
                        
                        {
                            'sExtends': 'print',
                            "mColumns": [0,1, 2],
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
                .column( 2 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );
 
            // Total over this page
            pageTotal = api
                .column( 2, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 2 ).footer() ).html(
                ''+pageTotal +' ( '+ total +' total)'
            );
        },
        		"aaSorting": [[ 0, "desc" ]],
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				"iDisplayLength": 5
				

				
			}).yadcf([
	    {
	    	column_number : 0,
	    	filter_type: 'range_date',
	    	date_format: "yyyy/mm/dd"
	    },
	   
	    {column_number : 1}
	    
	    ]);
	   $('#setrika').dataTable({
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
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
                .column( 2 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );
 
            // Total over this page
            pageTotal = api
                .column( 2, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 2 ).footer() ).html(
                ''+pageTotal +' ( '+ total +' total)'
            );
        },	
        		"aaSorting": [[ 0, "desc" ]],
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 5}).yadcf([
	    {
	    	column_number : 0,
	    	filter_type: 'range_date',
	    	date_format: "yyyy/mm/dd"
	    },
	   
	    {column_number : 1}
	    
	    ]);
	        
	    	$('#packing').dataTable({
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1, 2],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1, 2],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },
                        
                        {
                            'sExtends': 'print',
                            "mColumns": [0,1, 2],
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
                .column( 2 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );
 
            // Total over this page
            pageTotal = api
                .column( 2, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 2 ).footer() ).html(
                ''+pageTotal +' ( '+ total +' total)'
            );
        },	
        		"aaSorting": [[ 0, "desc" ]],
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 5}).yadcf([
	    {
	    	column_number : 0,
	    	filter_type: 'range_date',
	    	date_format: "yyyy/mm/dd"
	    },
	   
	    {column_number : 1}
	    
	    ]);    
	   
	  $('#rinciancuci').dataTable({
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
                    },  { "width": "5px", "targets": [2] },{ "width": "10%", "targets": 1 },
                ],
	  			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
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
	   
	    {column_number : 2}
	    
	    ]);
		
		
		$('#rincianpengering').dataTable({
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
                    },  { "width": "5px", "targets": [2] },{ "width": "10%", "targets": 1 },
                ],
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
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
	   
	    {column_number : 2}
	    
	    ]);
			$('#rinciansetrika').dataTable({
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
                    },  { "width": "5px", "targets": [2] },{ "width": "10%", "targets": 1 },
                ],
				"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
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
	   
	    {column_number : 2}
	    
	    ]);
			$('#rincianpacking').dataTable({
				"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
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
	   
	    {column_number : 2}
	    
	    ]);
			
		 
			
						
		});
	</script>