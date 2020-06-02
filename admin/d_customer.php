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

<div class="container-fluid" style="width:1000px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin-bottom:20px; color:#000000;">
<fieldset>
<legend align="center"><strong>Customer</strong></legend> 
	<table id="customer" class="display">
		<thead>
		<tr>
					<th>ID</th>
					<th>Nama Customer</th>
					<th>Alamat</th>
					<th>No Telp</th>
					<th>Sejak</th>
					<th>Outlet</th>
		</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT * FROM customer" ;
			$tampil = mysqli_query($con, $query);
			
			while($r= mysqli_fetch_array($tampil)){
			
				?>
				<tr>
							<td><?php echo $r['id'] ?></td>
							<td><?php echo $r['nama_customer'] ?></td>
							<td><?php echo $r['alamat'] ?></td>
							<td><?php echo $r['no_telp'] ?></td>
							<td><?php echo $r['tgl_input'] ?></td>
							<td><?php echo $r['outlet'] ?></td>
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
		    
	    $('#customer').dataTable({
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1,2,3,4,5],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1,2,3,4,5],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },
                        
                        {
                            'sExtends': 'print',
                            "mColumns": [0,1,2,3,4,5],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        }
                        
                    ]
                },
               
        		"aaSorting": [[ 0, "asc" ]],
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 5
				 
				 })
	    
	    });
	</script>