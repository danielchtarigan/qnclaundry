<?php
include "../config.php";
?>
<fieldset>
<legend align="center"><strong>Detail Packing</strong></legend> 
	<table id="rincianpacking" class="display">
		<thead>
		<tr>
			
			<th>TglPakc</th>
			<th>No Nota</th>
			<th>Cst</th>
			<th>Packer</th>
			<th>Jumlah</th>
			<th>Ket</th>
			<th>print</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$query = "SELECT tgl_packing,no_nota,user_packing,jumlah,ket,nama_customer FROM reception WHERE packing='1' ORDER BY tgl_packing asc" ;
			$tampil = mysqli_query($con, $query);
			while($data = mysqli_fetch_array($tampil)){
			?>
		
				<tr>
						<td><?php echo $data ['tgl_packing'];?></td>
						<td><?php echo $data['no_nota'];?></td>
						<td><?php echo $data['nama_customer'];?></td>
						<td><?php echo $data['user_packing'];?></td>
						<td><?php echo $data['jumlah'];?></td>
						<td><?php echo $data['ket'];?></td>
						<td><a  href="">pilih</a></td>
						</tr>
						<?php  } 
 ?> 
		</tbody>
	</table>
	</fieldset>
	
	<script type="text/javascript">
		$(document).ready(function(){
			 $('#rincianpacking').dataTable({
				"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
				 "aaSorting": [[ 0, "desc" ]],
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 5,
				 "scrollX": 300
				 
				
			}).yadcf([
	    {
	    	column_number : 0,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },
	   
	    {column_number : 3}
	    
	    ]);
	    
		});
	</script>