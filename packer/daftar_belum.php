<?php
include "../config.php";
?>
<fieldset>
<legend align="center" ><strong>Belum di packing</strong></legend>
<table id="databelum" class="display">
		<thead>
		<tr>
		
			<th>Tanggal Masuk</th>
			<th>No Nota</th>
			<th>Nama Customer</th>
			<th>Tgl Cuci</th>
			<th>Tgl Setrika</th>
			
		</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT tgl_input,no_nota,nama_customer,tgl_cuci,tgl_setrika,packing,kembali,ambil FROM reception  WHERE packing=false and kembali=false  and ambil=false ORDER BY tgl_input" ;
			$tampil = mysqli_query($con, $query);
			
			
			while($data = mysqli_fetch_array($tampil)){?>
				<tr>
						
						<td><?php echo $data['tgl_input'];?></td>
						<td><?php echo $data['no_nota'];?></td>
						<td><?php echo $data['nama_customer'];?></td>
						
						<td><?php		       if($data['tgl_cuci']<>"0000-00-00 00:00:00")
		       {
			   echo ''.$data['tgl_cuci'].'';
		       }
		       else
			   {
			   echo 'belum';
		       };
			  ?>
		       
		      
                                                </td>
                                                <td><?php		       if($data['tgl_setrika']<>"0000-00-00 00:00:00")
		       {
			   echo ''.$data['tgl_setrika'].'';
		       }
		       else
			   {
			   echo 'belum';
		       };
			  ?></td>
						
						</tr>
			
						<?php  } 
 ?> 
					  
				</tbody>
	</table>
	</fieldset>
	<script type="text/javascript">
		$(document).ready(function(){
			 $('#databelum').dataTable({
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				"iDisplayLength": 50,
				"scrollY": 300,
				"scrollX": 300,
				"paging": false,
			    "info": false
				
			   
			   
				
			});
			
			});
	</script>