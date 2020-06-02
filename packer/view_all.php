<html>
<head>
	
<?php 
include "header.php";
include "../config.php"; 
$op=$_SESSION['user_id'];
?>
</head>
<body>
<div  style="margin-bottom:50px; color:#000000;">
<fieldset>

<legend align="center"><strong>Semua</strong></legend> 
<table id="semua" class="display">
		<thead>
		<tr>
			
			<th>Tgl Masuk</th>
			<th>No Nota</th>
			<th>Nama Customer</th>
			<th>Tgl Cuci</th>
			<th>OP</th>
			<th>Tgl Setrika</th>
			<th>Setrika</th>
			<th>Tgl Packing</th>
			<th>Packer</th>
			<th>Tgl Kembali</th>
			<th>Rcp Kembali</th>
			<th>Tgl ambil</th>
			<th>Rcp ambil</th>
		</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT tgl_input,no_nota,nama_customer,tgl_cuci,op_cuci,tgl_setrika,user_setrika,tgl_packing,user_packing,tgl_kembali,reception_kembali,tgl_ambil,reception_ambil FROM reception ORDER BY tgl_input" ;
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
						<td>$data[tgl_packing]</td>
						<td>$data[user_packing]</td>
						<td>$data[tgl_kembali]</td>
						<td>$data[reception_kembali]</td>
						<td>$data[tgl_ambil]</td>
						<td>$data[reception_ambil]</td>
						 </tr>";
			
			}
			?>
		</tbody>
	</table>
	</fieldset>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#semua').dataTable({
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 10
				
			}).yadcf([
	    {
	    	column_number : 0,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    }
	    
	    ]);
	    
	    
	    
			
			
		});
	</script>

</body>
</html>