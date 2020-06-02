<html>
<head>
	<link rel="stylesheet" type="text/css" href="../lib/css/jquery-ui.css">	
<link rel="stylesheet" type="text/css" href="../admin/css/dataTables.tableTools.css">
<?php 
include "header.php";
include "../config.php"; 
$op=$_SESSION['user_id']; 
?>
</head>
<body>
<script type="text/javascript">
		$(document).ready(function(){
			$('#qa').dataTable({
				dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "../swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1, 2,3,4,5,6,7,8,9,10,11,12,13,14],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1, 2,3,4,5,6,7,8,9,10,11,12,13,14],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },
                        
                        {
                            'sExtends': 'print',
                            "mColumns": [0,1, 2,3,4,5,6,7,8,9,10,11,12,13,14],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        }
                        
                    ]
                },
                "columnDefs": [
                    {
                        "targets": [0],
                        "visible": true,
                        "searchable": true,"width":"1%",
                    },  { "width": "50%", "targets": [2] }
                ],
				 "aaSorting": [[ 0, "desc" ]],
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 10,
				 "aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
				
			}).yadcf([
	    {
	    	column_number : 0,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },{
	    	column_number : 1
	    	
	    }
	    ]);
	    });
	</script>
<fieldset>
<legend align="center"><strong>Data Quality Audit</strong></legend> 
<table id="qa" class="display">
		<thead>
		<tr>
			<th>Tanggal</th>
			<th>Supervisor</th>
			<th>No nota</th>
			<th>ID Cust</th>
			<th>Nama Customer</th>
			<th>Bersih</th>
			<th>Harum</th>
			<th>Rapi</th>
			<th>Waktu</th>		
			<th>Jumlah</th>
			<th>Kritik dan saran</th>
			<th>cuci</th>
			<th>pengering</th>
			<th>setrika</th>
			<th>packing</th>			
		</tr>
		</thead>
		<tbody>
		<?php $sql = $con->query("select reception.op_cuci as cuci,reception.op_pengering as pengering,reception.id_customer as id_cst,reception.user_setrika as setrika,reception.user_packing as packing,quality_audit.tgl_input as tgl_input,quality_audit.user_input as user_input,quality_audit.nama_customer as nama_customer,quality_audit.bersih as bersih,quality_audit.harum as harum,quality_audit.rapi as rapi,quality_audit.waktu as waktu,quality_audit.jumlah as jumlah,quality_audit.ket as ket,quality_audit.no_nota as no_nota from reception INNER JOIN quality_audit where reception.no_nota=quality_audit.no_nota"); ?>
			
					<?php while ( $data = $sql->fetch_assoc() ) { ?>
					<tr>
						<td><?php echo $data['tgl_input']?></td>
						<td><?php echo $data['user_input']?></td>
						<td><?php echo $data['no_nota']?></td>
						<td><?php echo $data['id_cst']?></td>
						<td><?php echo $data['nama_customer']?></td>
						<td><?php echo $data['bersih']?></td>
						<td><?php echo $data['harum']?></td>
						<td><?php echo $data['rapi']?></td>
						<td><?php echo $data['waktu']?></td>
						<td><?php echo $data['jumlah']?></td>
						<td><?php echo $data['ket']?></td>
						<td><?php echo $data['cuci']?></td>
						<td><?php echo $data['pengering']?></td>
						<td><?php echo $data['setrika']?></td>
						<td><?php echo $data['packing']?></td>
					
					  </tr>
		<?php } ?>
		</tbody>
	</table>
	</fieldset>


<script type="text/javascript" language="javascript" src="../admin/js/dataTables.tableTools.js"></script>
 <script type="text/javascript" language="javascript" src="../lib/js/jquery-ui.js"></script>
</body>

</html>