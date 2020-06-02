<head>
<?php 

include "../config.php"; 

 function rupiah($angka){
           $jadi="Rp.".number_format($angka,0,',','.');
            return $jadi;
     }
$tgl     = $_POST['tgl'];
	$date    = new DateTime($tgl);
	$newDate = $date->format('Y-m-d');

	$tgl2    = $_POST['tgl2'];
	$date2   = new DateTime($tgl2);
	$newDate2= $date2->format('Y-m-d');
?>
<script type="text/javascript">

	$(document).ready(function()
	{
		$('table#rinciancash td a.delete').click(function()
		{
			if (confirm("Are you sure you want to delete this row?"))
			{
				var id = $(this).parent().parent().attr('id');
				var data = 'id=' + id ;
				var parent = $(this).parent().parent();

				$.ajax(
				{
					   type: "POST",
					   url: "del_lap_cash.php",
					   data: data,
					   cache: false,
					
					   success: function()
					   {
							parent.fadeOut('slow', function() {$(this).remove();});
					   }
				 });				
			}
		});
		
		// style the table with alternate colors
		// sets specified color for every odd row
		$('table#rinciancash tr:odd').css('background',' #FFFFFF');
	});
	
</script>
	

</head>
<body>

<div class="container-fluid" style="width:95%; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin-bottom:20px; color:#000000;">
<fieldset>
<legend align="center"><strong>Cash</strong></legend> 
	<table id="cuci" class="display">
		<thead>
		<tr>
			<th>Tgl</th>
			<th>Cash</th>
			
			<th>rcp</th>
			<th>Outlet</th>
		</tr>
		</thead>
		
			
		<tbody>
			<?php
			$query = "SELECT a.nama_outlet,DATE_FORMAT(a.tgl_input, '%Y-%m-%d') as tgl_input,sum(a.total_bayar) as jumlah,a.nama_reception FROM reception a left join tutup_kasir b ON (a.nama_reception=b.reception and DATE_FORMAT(a.tgl_input, '%Y-%m-%d')= DATE_FORMAT(b.tanggal, '%Y-%m-%d'))  where b.reception is null and a.cara_bayar='cash' and (DATE_FORMAT(a.tgl_input, '%Y-%m-%d') between '$newDate' and '$newDate2')  group by a.nama_reception,a.nama_outlet,DATE_FORMAT(a.tgl_input, '%Y%m%d') ORDER BY a.tgl_input ASC" ;

			$tampil = mysqli_query($con, $query);
			
			while($data = mysqli_fetch_array($tampil)){
		
				?>
				
					<tr>
					<td><?php echo $data['tgl_input'];?></td>
					<td><?php echo $data['jumlah'];?></td>
					<td><?php echo $data['nama_reception'];?></td>
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
                            "mColumns": [0,1,2],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1,2],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },
                        
                        {
                            'sExtends': 'print',
                            "mColumns": [0,1,2],
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
                .column(1)
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                } );
 
            // Total over this page
            pageTotal = api
                .column( 1, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 1 ).footer() ).html(
                ''+pageTotal +' ( '+ total +' total)'
            );
        },
        		"aaSorting": [[ 0, "desc" ]],
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 5}).yadcf([
	    
	   
	    {column_number : 2}
	    
	    ]);
	    
	   
	    
	    });
	</script>