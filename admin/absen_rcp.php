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
<legend align="center"><strong>Data Masuk dan Pulang Resepsionis</strong></legend> 
	<table id="absen" class="display">
		<thead>
		<tr>
			<th>Tanggal Masuk</th>			
			<th>Outlet</th>
			<th>Resepsionis</th>	
			<th>Masuk</th>
			<th>Pulang</th>
			<th>Durasi Kerja</th>
			
		</tr>
		</thead>		
			
		<tbody>	
		<?php
			$tglbaru = date("Y-m-d", strtotime("-3 Days"));
			$query = "SELECT id_user,id_outlet,DATE_FORMAT(tgl_log, '%Y-%m-%d') as tgl_log,TIME_FORMAT (tgl_log, '%H:%i:%s') as masuk FROM log_rcp group by id_outlet,DATE_FORMAT(tgl_log, '%Y-%m-%d'),id_user order by tgl_log DESC" ;
			$tampil = mysqli_query($con, $query);			
			while($data = mysqli_fetch_array($tampil)){
			$tgl=$data['tgl_log'];
			$sql4 = mysqli_query($con,"SELECT reception,DATE_FORMAT(tanggal, '%Y-%m-%d') as tanggal,MAX(TIME_FORMAT (tanggal , '%H:%i:%s')) as pulang, outlet FROM tutup_kasir WHERE DATE_FORMAT(tanggal,'%Y-%m-%d')='$tgl' and reception='$data[id_user]' and outlet='$data[id_outlet]'" );
            $s2=mysqli_fetch_array($sql4);
            $time1 = $data['masuk'];
            $time2 = $s2['pulang'];
            $sql5 = mysqli_query ($con,"SELECT TIMEDIFF ('$time2', '$time1') as durasi");
            $s3 = mysqli_fetch_array ($sql5); 
				?>
				
					<tr><td><?php echo $data['tgl_log'] ?></td>						
						<td><?php echo $data['id_outlet'] ?></td>
						<td><?php echo $data['id_user'] ?></td>
						<td><?php echo $data['masuk'] ?></td>
                        <td><?php echo $s2['pulang'] ?></td>
                        <td><?php if($time2<>"") echo $s3['durasi']; else echo "Tidak absen";?></td>
	
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
		 {column_number : 2},{column_number : 1}, {column_number : 5}, {column_number : 6},
	    
	    ]);
});
</script>
</html>