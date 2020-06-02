<html>
<head>
	
<?php 
include "header.php";
include "../config.php"; 

?>
</head>
<body>
<?php 
$op=$_SESSION['user_id']; ?>
	<script type="text/javascript">
		$(document).ready(function(){
			oTable = $('#semua').dataTable({
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 10
				
			}).yadcf([
	    {
	    	column_number : 1,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },
 {column_number : 5}
	    
	    ]);
	    
	    
	    
			oTable = $('#cuci').dataTable({
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 10
				
			}).yadcf([
	    {
	    	column_number : 1,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },
	   
	    {column_number : 3}
	    
	    ]);
			
			
			
			oTable = $('#pengering').dataTable({
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 10
				
			}).yadcf([
	    {
	    	column_number : 1,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },
	   
	    {column_number : 3}
	    
	    ]);
			oTable = $('#setrika').dataTable({
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 10
				
			}).yadcf([
	    {
	    	column_number : 1,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },
	   
	    {column_number : 3}
	    
	    ]);
			oTable = $('#packing').dataTable({
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 10
				
			}).yadcf([
	    {
	    	column_number : 1,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },
	   
	    {column_number : 3}
	    
	    ]);
			
		});
	</script>
<div  style="margin-bottom:50px; color:#000000;">
<fieldset>

<legend align="center"><strong>Semua</strong></legend> 
<table id="semua" class="display">
		<thead>
		<tr>
			<th>No</th>
			<th>Tgl So</th>
			<th>Reception</th>
			<th>No Nota</th>
		</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT * FROM so" ;
			$tampil = mysqli_query($con, $query);
			$no = 1;
			while($data = mysqli_fetch_array($tampil)){
                        ?>
				<tr>
						<td><?php echo $no ;?></td>
						<td><?php echo $data['tgl_so'] ; ?></td>
						<td><?php echo $data['user_so']; ?></td>
						<td><?php echo $data['no_nota']; ?></td>
						
</tr>
							<?php $no++; } 
 ?>   
		</tbody>
	</table>
	</fieldset>
	
</div>
</body>
</html>