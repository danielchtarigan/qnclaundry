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
			oTable = $('#cuci').dataTable({
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 25,"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
				
			}).yadcf([
	    {
	    	column_number : 1,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    }	    
	    ]);	    			
			oTable = $('#express').dataTable({
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 10,"aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
				
			});

			
			
		});
	</script>
	
<div class="container" style="width:100%; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin-bottom:20px; color:#000000;">
	<fieldset>
<legend align="center" ><strong>EXPRES</strong></legend> 
<table id="express" class="display">
		<thead>
		<tr>
			<th>No</th>
			<th>Tanggal Masuk</th>
			<th>No Nota</th>
			<th>Nama Customer</th>
			
		</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT * FROM reception  WHERE cuci=false and express=true and kembali=false and packing=false ORDER BY tgl_input" ;
			$tampil = mysqli_query($con, $query);
			
			$no = 1;
			while($data = mysqli_fetch_array($tampil)){
				echo "<tr>
						<td>$no</td>
						<td>$data[tgl_input]</td>
						<td>$data[no_nota]</td>
						<td>$data[nama_customer]</td>
						
				      </tr>";
			$no++;
			}
			?>
		</tbody>
	</table>
	</fieldset>
</div>
	
	
<div class="container" style="width:100%; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin-bottom:70px; color:#000000;">
<fieldset>
<legend align="center"><strong>Cuci </strong></legend> 
<table id="cuci" class="display">
		<thead>
		<tr>
			<th>No</th>
			<th>Tanggal cuci</th>
			<th>No Nota</th>
		
			
		</tr>
		</thead>
		<tbody>
			<?php
			
			
			$query = "SELECT tgl_cuci,no_nota FROM cuci where op_cuci='$op' order by tgl_cuci DESC ";
			$tampil = mysqli_query($con, $query);
			
			$no = 1;
			while($data = mysqli_fetch_array($tampil)){
				echo "<tr>
				
						<td>$no</td>
						<td>$data[tgl_cuci]</td>
						<td>$data[no_nota]</td>
					
					  </tr>";
			$no++;
			}
			?>
		</tbody>
	</table>
	</fieldset>
</div>
</body>
</html>