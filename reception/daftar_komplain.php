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
<legend align="center"><strong>Data Komplain</strong></legend> 
<table id="cuci" class="display">
		<thead>
		<tr>
			<th>Tgl Complain</th>
			<th>No Komplain</th>
			<th>No Nota</th>
			<th>Nama Customer</th>
			<th>Jenis Komplain</th>
			<th>ket</th>
<th>k/p</th>
			<th>cuci</th>
			<th>setrika</th>
			<th>packing</th>		
			
		</tr>
		</thead>
		<tbody>
			<?php
			
			
			$query = "SELECT * FROM komplain";
			$tampil = mysqli_query($con, $query);
			
			
			while($data = mysqli_fetch_array($tampil)){
				$sql4=mysqli_query($con,"SELECT op_cuci,user_setrika,user_packing,jenis FROM reception where no_nota='$data[no_nota]' ");
$s2=mysqli_fetch_array($sql4);
				?>
			<tr>
				
						<td><?php echo $data['tgl_komplain'];?></td>
						<td><?php echo $data['no_komplain'];?></td>
						<td><?php echo $data['no_nota'];?></td>
						<td><?php echo $data['nama_customer'];?></td>
						<td><?php echo $data['jenis_komplain'];?></td>
						<td><?php echo $data['ket'];?></td>
<td><?php echo $s2['jenis'];?></td>
						<td><?php echo $s2['op_cuci'];?></td>
						<td><?php echo $s2['user_setrika'];?></td>
						<td><?php echo $s2['user_packing'];?></td>
						
					
					  </tr>
					<?php } 
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
	    	column_number : 4
	    	
	    }
	    ]);
	    });
	</script>
</html>