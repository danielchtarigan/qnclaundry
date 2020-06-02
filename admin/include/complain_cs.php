<!--<h3>Santai Santai.... Mending main Game dulu sampai buka puasa </h3>-->


<?php 
$op=$_SESSION['user_id']; 
?>

<fieldset>
<legend align="center"><strong>Data Komplain</strong></legend> 
<div class="table-responsive">
    <table id="cmp" class="display">
		<thead>
    		<tr>
    			<th>Tgl Complain</th>
    			<th>No Komplain</th>
    			<th>No Nota</th>
    			<th>Nama Customer</th>
    			<th>Jenis Komplain</th>
    			<th width="30%">ket</th>
                <th>Jenis</th>	
    			
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
					
				
				  </tr>
				<?php } 
				?>
		</tbody>
	</table>
	</div>
	</fieldset>

<script type="text/javascript">
	$(document).ready(function(){
		$('#cmp').dataTable({
			
			 "aaSorting": [[ 0, "desc" ]],
			    "bJQueryUI" : true,
			"sPaginationType" : "full_numbers",
			 "iDisplayLength": 10,
		}).yadcf([
    	    {
    	    	column_number : 0,
    	    	filter_type: 'range_date',
    	    	date_format: "yyyy-mm-dd"
    	    },
    	    {
    	    	column_number : 4
    	    	
    	    }
	    ]);
    });
</script>