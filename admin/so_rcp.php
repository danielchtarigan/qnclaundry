<html>
<head>
	
<?php 
include "header.php";
include "../config.php"; 
$op=$_SESSION['user_id'];
$tgl=$_POST['tgl'];
	   $date = new DateTime($tgl);
	   $newDate = $date->format('Y-m-d');
	   
$tgl2=$_POST['tgl2'];
	   $date2= new DateTime($tgl2);
	   $newDate2 = $date2->format('Y-m-d');
?>
</head>
<body>

<fieldset>
<legend align="center"><strong>STOCK OPNAME</strong></legend>
<p align="center">Jika Kolom SO kosong, berarti Resepsionis tidak SO</p>
	<table id="so" class="display">
		<thead>
		<tr>
			<th>Tanggal</th>			
			<th>Outlet</th>
			<th>Resepsionis</th>			
			<th>Cabang</th>
			<th>Stock Opname</th>
		</tr>
		</thead>		
			
		<tbody>	
		<?php
			$tglbaru = date("Y-m-d", strtotime("-3 Days"));
			$query = "SELECT nama_reception,nama_outlet,DATE_FORMAT(tgl_input, '%Y-%m-%d') as tgl_input,cabang FROM reception WHERE (DATE_FORMAT (tgl_input, '%Y-%m-%d') between '$newDate' and '$newDate2') group by nama_outlet,DATE_FORMAT(tgl_input, '%Y-%m-%d'),cabang,nama_reception order by tgl_input desc" ;
			$tampil = mysqli_query($con, $query);			
			while($data = mysqli_fetch_array($tampil)){
			$tgl=$data['tgl_input'];
				?>
				
					<tr><td><?php echo $data['tgl_input'] ?></td>						
						<td><?php echo $data['nama_outlet'] ?></td>
						<td><?php echo $data['nama_reception'] ?></td>
						<td><?php echo $data['cabang'] ?></td>							
<td><?php
	$sql4 = mysqli_query($con,"SELECT rcp_so,DATE_FORMAT(tgl_so, '%Y-%m-%d') as tgl_so,outlet FROM detail_so WHERE DATE_FORMAT(tgl_so,'%Y-%m-%d')='$tgl' and rcp_so='$data[nama_reception]' and outlet='$data[nama_outlet]'" );
	
	$s2=mysqli_fetch_array($sql4);
$nama=$s2['rcp_so'];
echo $nama ;?>
	</td>
					
					</tr>
			
				<?php } 
 ?>						
	
		</tbody>	
		
			
	</table>
	</fieldset>

</body>

<script type="text/javascript">
$(document).ready(function(){
			oTable = $('#so').dataTable({
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