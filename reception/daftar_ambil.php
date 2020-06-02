<html>
<head>
	
<?php 
include "header.php";
include "../config.php"; 
$tgl=$_POST['tgl'];
	   $date = new DateTime($tgl);
	   $newDate = $date->format('Y-m-d');
	   
$tgl2=$_POST['tgl2'];
	   $date2= new DateTime($tgl2);
	   $newDate2 = $date2->format('Y-m-d');
$op=$_SESSION['user_id']; 
?>
</head>
<body>

<fieldset>
<legend align="center"><strong>Data Pengambilan Customer</strong></legend> 
dari tanggal <?php echo $newDate ;?> sampai <?php echo $newDate2; ?>
<table id="cuci" class="display">
		<thead>
		<tr>
			<th>Tgl Ambil</th>
			<th>Outlet</th>
			<th>No Nota</th>
			<th>Nama Customer</th>
			<th>Reception</th>
					
			
		</tr>
		</thead>
		<tbody>
			<?php
			
			
			$query = "SELECT tgl_ambil,no_nota,reception_ambil,nama_outlet,nama_customer FROM reception  WHERE (DATE_FORMAT(tgl_ambil, '%Y-%m-%d') between '$newDate' and '$newDate2')";
			$tampil = mysqli_query($con, $query);
			
			
			while($data = mysqli_fetch_array($tampil)){
				echo "<tr>
				
						<td>$data[tgl_ambil]</td>
						<td>$data[nama_outlet]</td>
						<td>$data[no_nota]</td>
						<td>$data[nama_customer]</td>
						<td>$data[reception_ambil]</td>
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
			column_number :1
		}
	    ]);
	    });
	</script>
</html>