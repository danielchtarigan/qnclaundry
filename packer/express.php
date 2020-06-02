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
				 "iDisplayLength": 50
				
			});
			
			oTable = $('#express').dataTable({
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 50
				
			});

			
		});
	</script>
	<div class="container-container" style="width:900px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);   margin-bottom:70px; color:#000000;">
	<fieldset>
<legend align="center" ><strong>EXPRES</strong></legend> 
<table id="express" class="display">
		<thead>
		<tr>
			<th>No</th>
			<th>Tanggal Masuk</th>
			<th>No Nota</th>
			<th>Nama Customer</th>
			<th>Tgl Cuci</th>
			<th>Tgl Setrika</th>
			<th>Tgl Pakcing</th>
			
		</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT * FROM reception  WHERE express<>0 and kembali=false ORDER BY tgl_input" ;
			$tampil = mysqli_query($con, $query);
			
			$no = 1;
			while($data = mysqli_fetch_array($tampil)){
				echo "<tr>
						<td>$no</td>
						<td>$data[tgl_input]</td>
						<td>$data[no_nota]</td>
						<td>$data[nama_customer]</td>
						<td>$data[tgl_cuci]</td>
						<td>$data[tgl_setrika]</td>
						<td>$data[tgl_packing]</td>
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