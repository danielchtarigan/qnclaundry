<html>
<head>
<link rel="stylesheet" type="text/css" href="../lib/css/jquery-ui.css">	
<link rel="stylesheet" type="text/css" href="../admin/css/dataTables.tableTools.css">
<?php 
include "header.php";
include "../config.php"; 
$tgl=$_POST['tgl'];
	   $date = new DateTime($tgl);
	   $newDate = $date->format('Y-m-d');
	   
$tgl2=$_POST['tgl2'];
	   $date2= new DateTime($tgl2);
	   $newDate2 = $date2->format('Y-m-d');
?>
</head>
<body>
<?php 
$op=$_SESSION['user_id']; ?>

<script type="text/javascript">
$(document).ready(function(){
			oTable = $('#semua').dataTable({
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
                
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 10
				
			}).yadcf([
	    {
	    	column_number : 1,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },
		 {column_number : 2},{column_number : 0}, {column_number : 3, text_data_delimiter: ",", filter_type: "auto_complete"}
	    
	    ]);
});
</script>
<div class="container-fluid" style="width:850px; margin:0 auto; position:relative; border:3px solid rgba(0,0,0,0); -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; -webkit-box-shadow:0 0 18px rgba(0,0,0,0.4); -moz-box-shadow:0 0 18px rgba(0,0,0,0.4); box-shadow:0 0 18px rgba(0,0,0,0.4);  margin-bottom:70px; color:#000000;">
<fieldset>

<legend align="center"><strong>Laporan Stok Opname</strong></legend> 
dari tanggal <?php echo $newDate ;?> sampai <?php echo $newDate2; ?>
<table id="semua" class="display">
		<thead>
		<tr>
			<th>Outlet</th>
			<th>Tgl So</th>
			<th>Reception</th>
			<th>No Nota</th>
		</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT * FROM detail_so WHERE (DATE_FORMAT(tgl_so, '%Y-%m-%d') between '$newDate' and '$newDate2')" ;
			$tampil = mysqli_query($con, $query);
			
			while($data = mysqli_fetch_array($tampil)){
                        ?>
				<tr>
						
						<td><?php echo $data['outlet'] ; ?></td>
						<td><?php echo $data['tgl_so'] ; ?></td>
						<td><?php echo $data['rcp_so']; ?></td>
						<td><?php echo $data['no_nota']; ?></td>
						
</tr>
							<?php } 
 ?>   
		</tbody>
	</table>
	</fieldset>
	
</div>
<script type="text/javascript" language="javascript" src="../admin/js/dataTables.tableTools.js"></script>
 <script type="text/javascript" language="javascript" src="../lib/js/jquery-ui.js"></script>
</body>
</html>