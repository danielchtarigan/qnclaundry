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

<div class="container-fluid" style="width:1200px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin-bottom:20px; color:#000000;">
<fieldset>
<legend align="center"><strong>Rincian Piutang</strong></legend> 
	<table id="rinciancash" class="display">
		<thead>
		<tr>
			<th>Tgl</th>
			<th >outlet</th>
<th >cabang</th>
			<th>no nota</th>
			<th>nama customer</th>
			<th>total</th>
			<th>rcp</th>
			<th>lunas</th>
			<th>Cuci</th>
						<th>packing</th>

			<th>Hapus</th>
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
			$query = "SELECT tgl_input,nama_outlet,no_nota,nama_customer,total_bayar,nama_reception,lunas,id,op_cuci,user_packing,cabang FROM reception WHERE lunas=false ORDER BY tgl_input ASC" ;
			$tampil = mysqli_query($con, $query);
			
			while($data = mysqli_fetch_array($tampil)){
			
				?>
				
				<tr id="<?php echo $data['id'] ; ?>">
					<td><?php echo $data['tgl_input'];?></td>
					<td><?php echo $data['nama_outlet'];?></td>
<td><?php echo $data['cabang'];?></td>
									<td><?php echo $data['no_nota'];?></td>
					<td><?php echo $data['nama_customer'];?></td>
	
					<td><?php echo $data['total_bayar'];?></td>
					
					<td><?php echo $data['nama_reception'];?></td>
					<td><?php echo $data['lunas'];?></td>
					<td><?php echo $data['op_cuci'];?></td>
					<td><?php echo $data['user_packing'];?></td>
					<td>
					<a href="#" class="delete" style="color:#FF0000;"><img alt="" align="absmiddle" border="0"  />hapus</a>
					</td>
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
		
	    
	    $('#rinciancash').dataTable({
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1,2,3,4,5,6,7,8],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1,2,3,4,5,6,7,8],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },
                        
                        {
                            'sExtends': 'print',
                            "mColumns": [0,1,2,3,4,5,6,7,8],
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
	   
	    {column_number : 1}, {column_number : 2},{column_number : 6}
	    
	    ]);
	    
	    });
	</script>