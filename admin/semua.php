<html>
<head>
	
<?php 
include "header.php";
include "../config.php"; 

?>
</head>
<body>
<?php 
$op=$_SESSION['user_id']; ?>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#semua').dataTable({

dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [1, 2,3,4,5,6,7,8,9,10,11,12],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [1, 2,3,4,5,6,7,8,9,10,11,12],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },
                        {
                            'sExtends': 'print',
                            "mColumns": [1, 2,3,4,5,6,7,8,9,10,11,12],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        }
                        
                        
                    ]
                },
                "columnDefs": [
                    {
                        "targets": [0],
                        "visible": false,
                        "searchable": false
                    }
                ],
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 10,
                                "bFilter": true,
"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
				
			}).yadcf([
	    {
	    	column_number : 1,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    }
	    
	    ]);
	    
	    
	    
			oTable = $('#cuci').dataTable({
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 10
				
			}).yadcf([
	    {
	    	column_number : 1,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },
	   
	    {column_number : 3}
	    
	    ]);
			
			
			
			oTable = $('#pengering').dataTable({
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 10
				
			}).yadcf([
	    {
	    	column_number : 1,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },
	   
	    {column_number : 3}
	    
	    ]);
			oTable = $('#setrika').dataTable({
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 10
				
			}).yadcf([
	    {
	    	column_number : 1,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },
	   
	    {column_number : 3}
	    
	    ]);
			oTable = $('#packing').dataTable({
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 10
				
			}).yadcf([
	    {
	    	column_number : 1,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },
	   
	    {column_number : 3}
	    
	    ]);
			
		});
	</script>
	<div style=" color:#000000;">
<div  style="margin-bottom:50px; color:#000000;">
<fieldset>

<legend align="center"><strong>Semua</strong></legend> 
<table id="semua" class="display">
		<thead>
		<tr>
			<th>No</th>
			<th>Tgl Masuk</th>
			<th>No Nota</th>
			<th>Nama Customer</th>
			<th>Tgl Cuci</th>
			<th>OP</th>
			<th>Tgl Setrika</th>
			<th>Setrika</th>
			<th>Tgl Packing</th>
			<th>Packer</th>
			<th>Tgl Kembali</th>
			<th>Rcp Kembali</th>
			<th>Tgl ambil</th>
			<th>Rcp ambil</th>
		</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT * FROM reception ORDER BY tgl_input" ;
			$tampil = mysqli_query($con, $query);
			$no = 1;
			while($data = mysqli_fetch_array($tampil)){
				echo "<tr>
						<td>$no</td>
						<td>$data[tgl_input]</td>
						<td>$data[no_nota]</td>
						<td>$data[nama_customer]</td>
						<td>$data[tgl_cuci]</td>
						<td>$data[op_cuci]</td>
						<td>$data[tgl_setrika]</td>
						<td>$data[user_setrika]</td>
						<td>$data[tgl_packing]</td>
						<td>$data[user_packing]</td>
						<td>$data[tgl_kembali]</td>
						<td>$data[reception_kembali]</td>
						<td>$data[tgl_ambil]</td>
						<td>$data[reception_ambil]</td>
						 </tr>";
			$no++;
			}
			?>
		</tbody>
	</table>
	</fieldset>
	<fieldset>

<legend align="center"><strong>Cuci</strong></legend> 
	<table id="cuci" class="display">
		<thead>
		<tr>
			<th>No</th>
			<th>Tgl Cuci</th>
			<th>No Nota</th>
			<th>Operator</th>
			<th>Jumlah</th>
			<th>No Mesin</th>
		</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT * FROM cuci ORDER BY tgl_cuci DESC" ;
			$tampil = mysqli_query($con, $query);
			$no = 1;
			while($data = mysqli_fetch_array($tampil)){
				echo "<tr>
						<td>$no</td>
						<td>$data[tgl_cuci]</td>
						<td>$data[no_nota]</td>
						<td>$data[op_cuci]</td>
						<td>$data[jumlah]</td>
						<td>$data[no_mesin]</td>
						
						 </tr>";
			$no++;
			}
			?>
		</tbody>
	</table>
	</fieldset>
	<fieldset>

<legend align="center"><strong>Pengering</strong></legend> 
	<table id="pengering" class="display">
		<thead>
		<tr>
			<th>No</th>
			<th>Tgl Pengering</th>
			<th>No Nota</th>
			<th>Operator</th>
			<th>Jumlah</th>
			<th>No Mesin</th>
		</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT * FROM pengering ORDER BY tgl_PENGERING DESC" ;
			$tampil = mysqli_query($con, $query);
			$no = 1;
			while($data = mysqli_fetch_array($tampil)){
				echo "<tr>
						<td>$no</td>
						<td>$data[tgl_pengering]</td>
						<td>$data[no_nota]</td>
						<td>$data[op_pengering]</td>
						<td>$data[jumlah]</td>
						<td>$data[no_mesin]</td>
						 </tr>";
			$no++;
			}
			?>
		</tbody>
	</table>
	</fieldset>
	<fieldset>

<legend align="center"><strong>Setrika</strong></legend> 
	<table id="setrika" class="display">
		<thead>
		<tr>
			<th>No</th>
			<th>Tgl Setrika</th>
			<th>No Nota</th>
			<th>Setrika</th>
			<th>Berat</th>
		</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT * FROM setrika ORDER BY tgl_setrika DESC" ;
			$tampil = mysqli_query($con, $query);
			$no = 1;
			while($data = mysqli_fetch_array($tampil)){
				echo "<tr>
						<td>$no</td>
						<td>$data[tgl_setrika]</td>
						<td>$data[no_nota]</td>
						<td>$data[user_setrika]</td>
						<td>$data[berat]</td>
						
						 </tr>";
			$no++;
			}
			?>
		</tbody>
	</table>
	</fieldset>
	<fieldset>

<legend align="center"><strong>Packing</strong></legend> 
	<table id="packing" class="display">
		<thead>
		<tr>
			<th>No</th>
			<th>Tgl Pakcing</th>
			<th>No Nota</th>
			<th>Packer</th>
			<th>Jumlah</th>
		</tr>
		</thead>
		<tbody>
			<?php
			$query = "SELECT * FROM packing ORDER BY tgl_packing DESC" ;
			$tampil = mysqli_query($con, $query);
			$no = 1;
			while($data = mysqli_fetch_array($tampil)){
				echo "<tr>
						<td>$no</td>
						<td>$data[tgl_packing]</td>
						<td>$data[no_nota]</td>
						<td>$data[user_packing]</td>
						<td>$data[jumlah]</td>
						
						 </tr>";
			$no++;
			}
			?>
		</tbody>
	</table>
	</fieldset>
</div>
</body>
</html>