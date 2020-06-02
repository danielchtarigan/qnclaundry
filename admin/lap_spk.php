<head>
<?php 
include "header.php";
include "../config.php"; 
$op=$_SESSION['user_id'];
 function rupiah($angka){
           $jadi="Rp.".number_format($angka,0,',','.');
            return $jadi;
     }
?>
</head>
<body>

<div class="container-fluid" style="width:1000px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin-bottom:20px; color:#000000;">
<fieldset>
<legend align="center"><strong>Cash</strong></legend> 
	<table id="cuci" class="display">
		<thead>
		<tr>
			<th>Tgl</th>
			<th >rcp</th>
			<th>Jumlah</th>
				<th hidden="true"></th>
		
			<th>outlet</th>
			<th>lunas</th>
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
			$query = "SELECT nama_outlet,DATE_FORMAT(tgl_spk, '%Y/%m/%d') as tgl_transaksi,rcp_spk,sum(total_bayar) as jumlah,lunas FROM reception group by rcp_spk,DATE_FORMAT(tgl_spk, '%Y%m%d'),nama_outlet,lunas ORDER BY tgl_input ASC" ;
			$tampil = mysqli_query($con, $query);
			
			while($data = mysqli_fetch_array($tampil)){
			
				?>
				
					<tr>
					<td><?php echo $data['tgl_transaksi'];?></td>
					
					<td><?php echo $data['rcp_spk'];?></td>
					<td><?php echo rupiah($data['jumlah']);?></td>
					<td hidden="true"><?php echo $data['jumlah'];?></td>

					
					<td><?php echo $data['nama_outlet'];?></td>
					<td><?php echo $data['lunas'];?></td>
				</tr>
			
				<?php } 
 ?>
		</tbody>
		
		
		
		
		
		
		
			
	</table>
	</fieldset>



<fieldset>
<legend align="center"><strong>Rincian SPK</strong></legend> 
	<table id="rinciancash" class="display">
		<thead>
		<tr>
			<th>Tgl masuk</th>
			<th >no nota</th>
			<th >Customer</th>
			<th>jumlah</th>
			<th>Lunas</th>
			<th>tgl spk</th>
			<th>rcp spk</th>
			<th>Outlet</th>
			
			
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
			$query = "SELECT tgl_input,no_nota,total_bayar,tgl_spk,rcp_spk,lunas,nama_outlet,nama_customer FROM reception" ;
			$tampil = mysqli_query($con, $query);
			
			while($data = mysqli_fetch_array($tampil)){
			
				?>
				
					<tr>
					<td><?php echo $data['tgl_input'];?></td>
					
					<td><?php echo $data['no_nota'];?></td>
					<td><?php echo $data['nama_customer'];?></td>
					<td><?php echo rupiah($data['total_bayar']);?></td>
					<td><?php echo $data['lunas'];?></td>

					<td><?php echo $data['tgl_spk'];?></td>
					<td><?php echo $data['rcp_spk'];?></td>
					<td><?php echo $data['nama_outlet'];?></td>

					
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
			$('#cuci').dataTable({
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1,2,4,5],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1,3,4,5],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },
                        
                        {
                            'sExtends': 'print',
                            "mColumns": [0,1,2,4,5],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        }
                        
                    ]
                },
                "columnDefs": [
                    {
                        "targets": [0],
                        "visible": true,
                        "searchable": true,"width":"5%",
                    },  { "width": "50%", "targets": [2] }
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
                .column(3)
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
	   
	    {column_number : 1}, {column_number : 4},{column_number : 5}
	    
	    ]);
	    
	    $('#rinciancash').dataTable({
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1,2,4,5,6,7],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1,3,4,5,6,7],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },
                        
                        {
                            'sExtends': 'print',
                            "mColumns": [0,1,2,4,5,6,7],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        }
                        
                    ]
                },
                "columnDefs": [
                    {
                        "targets": [0],
                        "visible": true,
                        "searchable": true,"width":"5%",
                    },  { "width": "50%", "targets": [2] }
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
                .column(3)
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
	    {
	    	column_number : 5,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },
	    {column_number : 4},{column_number : 6},{column_number : 7}
	    
	    ]);
	    
	    });
	</script>