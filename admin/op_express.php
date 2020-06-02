<html>
<head>
	
<?php 
include "header.php";
include "../config.php"; 

?>
</head>
<body>

<div class="container" style="width:1000px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);   margin-bottom:20px; color:#000000;">
	<script type="text/javascript">
		$(document).ready(function(){
			
			$('#express').dataTable({
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1, 2,3,4,5,6,7,8,9],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1, 2,3,4,5,6,7,8,9],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },
                        
                        {
                            'sExtends': 'print',
                            "mColumns": [0,1, 2,3,4,5,6,7,8,9],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        }
                        
                    ]
                },
                "columnDefs": [
                    {
                        "targets": [0],
                        "visible": true,
                        "searchable": true,"width":"100%",
                    },  { "width": "50px", "targets": [2] },{ "width": "60%", "targets": 1 },
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
	    	date_format: "yyyy-mm-dd"
	    },
	   
	    {column_number : 1}, {column_number : 5}, {column_number : 6}, {column_number : 7}, {column_number : 8}
	    
	    ]);    
	   
			
			
			
		});
	</script>
	
<fieldset>
<legend align="center" ><strong><h1>LAP OPERATIONAL EXPRES</h1></strong></legend> 
<table id="express" class="display">
		<thead>
		<tr>
			
			<th>Tanggal Masuk</th>
			<th>Outlet</th>
			<th>No Nota</th>
			<th>Jenis</th>
			<th>Nama Customer</th>
			<th>Cuci</th>
			<th>Kering</th>
			<th>Setrika</th>
			<th>Packing</th>
			<th>Express</th>
		</tr>
		</thead>
		<tbody>
			<?php
			
			$query = "SELECT * FROM reception WHERE express<>0  and kembali=false and ambil=false and rcp_so='' ORDER BY tgl_input" ;
			$tampil = mysqli_query($con, $query);
			
			$no = 1;
			while($data = mysqli_fetch_array($tampil)){?>
				<tr>
						
						<td><?php echo $data['tgl_input'];?></td>
						<td><?php echo $data['nama_outlet'];?></td>
						<td><?php echo $data['no_nota'];?></td>
						<td><?php echo $data['jenis'];?></td>
						<td><?php echo $data['nama_customer'];?></td>
						<td><?php		       if($data['op_cuci']<>"0000-00-00 00:00:00")
		       {
			   echo ''.$data['op_cuci'].'';
		       }
		       else
			   {
			   echo 'belum';
		       };
			  ?></td>
                                                <td><?php		       if($data['op_pengering']<>"0000-00-00 00:00:00")
		       {
			   echo ''.$data['op_pengering'].'';
		       }
		       else
			   {
			   echo 'belum';
		       };
			  ?>
			  </td>
			  <td><?php		       if($data['user_setrika']<>"0000-00-00 00:00:00")
		       {
			   echo ''.$data['user_setrika'].'';
		       }
		       else
			   {
			   echo 'belum';
		       };
			  ?></td>
			  			<td><?php		       if($data['tgl_packing']<>"0000-00-00 00:00:00")
		       {
			   echo ''.$data['user_packing'].'';
		       }
		       else
			   {
			   echo 'belum';
		       };
			  ?></td>
				<td><?php if ($data['express']==1) echo 'Express'; else if ($data['express']==2) echo 'Double Express'; else if ($data['express']==3) echo 'Super Express'; ?></td>	
						
						</tr>
			
						<?php  } 
 ?> 
		</tbody>
	</table>
	</fieldset>
</div>
	
</body>
</html>