<?php
include "../config.php";
?>
<div  class="container-fluid" style="width:850px;
   margin:0 auto; 
   position:relative; 
   border:3px solid rgba(0,0,0,0); 
   -webkit-border-radius:5px; 
   -moz-border-radius:5px;
   border-radius:5px;
   -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4);
   -moz-box-shadow:0 0 18px rgba(0,0,0,0.4);
   box-shadow:0 0 18px rgba(0,0,0,0.4);
   color:#000000;
   margin-bottom: 10px;">
<fieldset>
<legend align="center"><strong>Detail Setrika Hotel</strong></legend> 
<table id="rinciancuci" class="display">
		<thead>
		<tr>
			
			<th>Tgl Setrika</th>
			<th>No Nota</th>
			<th>Nama Customer</th>
			<th>Setrika</th>
			<th>berat</th>
			<th>ket</th>
		</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT * FROM setrika_hotel ORDER BY tgl_setrika DESC" ;
			$tampil = mysqli_query($con, $query);
			$no = 1;
			while($data = mysqli_fetch_array($tampil)){
				echo "<tr>
						
						<td>$data[tgl_setrika]</td>
						
						<td>$data[no_nota]</td>
						<td>$data[nama_hotel]</td>
						<td>$data[user_setrika]</td>
						<td>$data[berat]</td>
						<td>$data[ket]</td>
						
						 </tr>";
		
			}
			?>
		</tbody>
	</table>



</fieldset>
</div>
<script type="text/javascript">
$(document).ready(function(){
 $('#rinciancuci').dataTable({
	  			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
	  			 "aaSorting": [[ 0, "desc" ]],
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				"iDisplayLength": 10
				
			}).yadcf([
	    {
	    	column_number : 0,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },
	   
	    {column_number : 2}
	    
	    ]);
	    	});
	</script>