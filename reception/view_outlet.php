<html>
<head>
	
<?php 
include "header.php";
include "../config.php"; 
$op=$_SESSION['user_id'];
$ot=$_SESSION['nama_outlet'];
$tgl=$_POST['tgl'];
	   $date = new DateTime($tgl);
	   $newDate = $date->format('Y-m-d');
	   
$tgl2=$_POST['tgl2'];
	   $date2= new DateTime($tgl2);
	   $newDate2 = $date2->format('Y-m-d');
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
			<th>Tgl Setrika</th>
			<th>Tgl Packing</th>
			<th>Tgl Kembali</th>
			<th>Rcp Kembali</th>
			<th>Tgl ambil</th>
			<th>Rcp ambil</th>
<th>Tgl SO</th>
<th>Rcp SO</th>
		</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT tgl_input,no_nota,nama_customer,tgl_cuci,tgl_setrika,tgl_packing,tgl_kembali,reception_kembali,tgl_ambil,reception_ambil,tgl_so,rcp_so FROM reception where  (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newDate' and '$newDate2') and nama_outlet='$ot' ORDER BY tgl_input" ;
			$tampil = mysqli_query($con, $query);
			
			while($data = mysqli_fetch_array($tampil)){
                        ?>
				<tr>
						
						<td><?php echo $data['tgl_input'] ; ?></td>
						<td><?php echo $data['no_nota']; ?></td>
						<td><?php echo $data['nama_customer']; ?></td>

						<td><?php		       if($data['tgl_cuci']<>"0000-00-00 00:00:00")
		       {
			   echo ''.$data['tgl_cuci'].'';
		       }
		       else
			   {
			   echo '-';
		       };
			  ?>
		       
		      
                                                </td>
						
						<td><?php		       if($data['tgl_setrika']<>"0000-00-00 00:00:00")
		       {
			   echo ''.$data['tgl_setrika'].'';
		       }
		       else
			   {
			   echo '-';
		       };
			  ?></td>
						
						<td><?php		       if($data['tgl_packing']<>"0000-00-00 00:00:00")
		       {
			   echo ''.$data['tgl_packing'].'';
		       }
		       else
			   {
			   echo '-';
		       };
			  ?></td>
						
			
			<td><?php		       if($data['tgl_kembali']<>"0000-00-00 00:00:00")
		       {
			   echo ''.$data['tgl_kembali'].'';
		       }
		       else
			   {
			   echo '-';
		       };
			  ?></td>
				<td><?php echo $data['reception_kembali']; ?></td>
			
			
				<td><?php		       if($data['tgl_ambil']<>"0000-00-00 00:00:00")
					       {
						   echo ''.$data['tgl_ambil'].'';
					       }
					       else
						   {
						   echo '-';
					       };
						  ?></td>
				<td><?php echo $data['reception_ambil']; ?></td>
			
				<td><?php		       if($data['tgl_so']<>"0000-00-00 00:00:00")
					       {
						   echo ''.$data['tgl_so'].'';
					       }
					       else
						   {
						   echo '-';
					       };
						  ?></td>
				<td><?php echo $data['rcp_so']; ?></td>
				
				
				
				
						 </tr>
							<?php } 
 ?>   
		</tbody>
	</table>
	</fieldset>
	
</div>
</body>
<script type="text/javascript">
		$(document).ready(function(){
			oTable = $('#semua').dataTable({
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 10
				
			}).yadcf([
	    {
	    	column_number : 0,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },
 {column_number : 1, text_data_delimiter: ",", filter_type: "auto_complete"},{column_number : 2, text_data_delimiter: ",", filter_type: "auto_complete"}
	    
	    ]);
	    
	    
	    
			
		});
	</script>
</html>