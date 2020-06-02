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
			<th>cara bayar</th>
		
			<th>outlet</th>
			
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
			$query = "SELECT nama_outlet,cara_bayar,DATE_FORMAT(tgl_transaksi, '%Y/%m/%d') as tgl_transaksi,rcp,sum(total) as jumlah FROM faktur_penjualan  group by rcp,DATE_FORMAT(tgl_transaksi, '%Y%m%d'),cara_bayar,nama_outlet ORDER BY tgl_transaksi ASC" ;
			$tampil = mysqli_query($con, $query);
			
			while($data = mysqli_fetch_array($tampil)){
			
				?>
				
					<tr>
					<td><?php echo $data['tgl_transaksi'];?></td>
					
					<td><?php echo $data['rcp'];?></td>
					<td><?php echo rupiah($data['jumlah']);?></td>
					<td hidden="true"><?php echo $data['jumlah'];?></td>

					<td><?php echo $data['cara_bayar'];?></td>
					<td><?php echo $data['nama_outlet'];?></td>
					
				</tr>
			
				<?php } 
 ?>
		</tbody>
		
		
		
		
		
		
		
			
	</table>
	</fieldset>



<fieldset>
<legend align="center"><strong>Rincian Cash</strong></legend> 
	<table id="rinciancash" class="display">
		<thead>
		<tr>
			<th>Tgl</th>
			<th >rcp</th>
			<th>Jumlah</th>
			<th hidden="true"></th>

			<th>cara bayar</th>
			<th>outlet</th>
			
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
			$query = "SELECT nama_outlet,cara_bayar, tgl_transaksi,rcp,total as jumlah FROM faktur_penjualan ORDER BY tgl_transaksi ASC" ;
			$tampil = mysqli_query($con, $query);
			
			while($data = mysqli_fetch_array($tampil)){
			
				?>
				
					<tr>
					<td><?php echo $data['tgl_transaksi'];?></td>
					
					<td><?php echo $data['rcp'];?></td>
					<td><?php echo rupiah($data['jumlah']);?></td>
					<td hidden="true"><?php echo $data['jumlah'];?></td>

					<td><?php echo $data['cara_bayar'];?></td>
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
                    "sSwfPath": "../swf/copy_csv_xls_pdf.swf",
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
                    "sSwfPath": "../swf/copy_csv_xls_pdf.swf",
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
	    	date_format: "yyyy-mm-dd"
	    },
	   
	    {column_number : 1}, {column_number : 4},{column_number : 5}
	    
	    ]);
	    
	    });
	</script>