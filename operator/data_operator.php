<html>
<head>
	
<?php 
include "header.php";
include "../config.php"; 
$op=$_SESSION['user_id']; 
?>
</head>
<body>

<fieldset>
<legend align="center"><strong>Data Operator</strong></legend> 
<table id="cuci" class="display">
		<thead>
		<tr>
		<th>Tgl Masuk</th>
			<th>NoNota</th>
			<th>Nama Customer</th>
			<th>Tgl Cuci</th>
			<th>User Cuci</th>
			<th>Tgl Setrika</th>
			<th>User Setrika</th>
		
			
		</tr>
		</thead>
		<tbody>
			<?php
			
			
			$query = "SELECT tgl_input,no_nota,nama_customer,tgl_cuci,op_cuci,tgl_setrika,user_setrika FROM reception";
			$tampil = mysqli_query($con, $query);
			
			
			while($data = mysqli_fetch_array($tampil)){
				echo "<tr>
				
						<td>$data[tgl_input]</td>
						<td>$data[no_nota]</td>
						<td>$data[nama_customer]</td>
						<td>$data[tgl_cuci]</td>
						<td>$data[op_cuci]</td>
						<td>$data[tgl_setrika]</td>
						<td>$data[user_setrika]</td>
					
					  </tr>";
		
			}
			?>
		</tbody>
	</table>
	</fieldset>

</body>
<script type="text/javascript">
		$(document).ready(function(){
			$('#cuci').dataTable({
				
				 "aaSorting": [[ 0, "desc" ]],
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 10,
				 "aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
				
			}).yadcf([
	    {
	    	column_number : 0,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },{
	    	column_number : 3,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },{
	    	column_number : 5,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },{
	    	column_number : 4
	    	
	    },{
	    	column_number : 6
	    	
	    }
	    
	    ]);
	    });
	</script>
</html>