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
<legend align="center"><strong>Log Workshop</strong></legend> 
	<table id="absen" class="display">
		<thead>
		<tr>
			<th>Tanggal</th>			
			<th>Workshop</th>
			<th>Nama User</th>
			<th>Posisi</th>
			<th>Start Log</th>	
			<th>End Log</th>
			<th>Durasi Kerja</th>
		</tr>
		</thead>		
			
		<tbody>	
		<?php
			$tglbaru = date("Y-m-d", strtotime("-3 Days"));
			$query = "SELECT id_user,id_workshop,DATE_FORMAT(tgl_log, '%Y-%m-%d') as tgl_log,TIME_FORMAT (tgl_log, '%H:%i:%s') as masuk FROM log_workshop group by id_workshop,DATE_FORMAT(tgl_log, '%Y-%m-%d'),id_user order by tgl_log DESC" ;
			$tampil = mysqli_query($con, $query);			
			while($data = mysqli_fetch_array($tampil)){
			$tgl=$data['tgl_log'];
				?>
				
					<tr><td><?php echo $data['tgl_log'] ?></td>						
						<td><?php echo $data['id_workshop'] ?></td>
						<td><?php echo $data['id_user'] ?></td>
						<td><?php 
	$sql4 = mysqli_query($con,"SELECT level FROM user WHERE name='$data[id_user]'" );	
	$data2=mysqli_fetch_array($sql4); echo $data2['level'] ?></td>						
						<td><?php echo $data['masuk'] ?></td>
						<td><?php
	$sql5 = mysqli_query($con, "SELECT MAX(TIME_FORMAT(tgl, '%H:%i:%s')) as pulang FROM log_pulang WHERE DATE_FORMAT(tgl,'%Y-%m-%d')='$tgl' and id_user='$data[id_user]' and id_workshop='$data[id_workshop]'" );
	$data3=mysqli_fetch_array ($sql5); echo $data3['pulang'] ?></td>
						<td><?php
		$time1 = $data['masuk'];
		$time2 = $data3['pulang'];
		$sql6 = mysqli_query ($con,"SELECT TIMEDIFF ('$time2', '$time1') as durasi");
		$s3 = mysqli_fetch_array ($sql6); echo $s3['durasi']
		?></td>
													

					</tr>
			
				<?php } 
 ?>						
	
		</tbody>	
		
			
	</table>
	</fieldset>

</body>

<script type="text/javascript">
$(document).ready(function(){
			oTable = $('#absen').dataTable({
				"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],

                dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "../swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        
                        {
                            'sExtends': 'xls',
                            
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        }
                        
                        
                    ]
                },
                
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
		 {column_number : 2},{column_number : 1},
	    
	    ]);
});
</script>
</html>