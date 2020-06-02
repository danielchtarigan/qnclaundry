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
			$('#rijeck').dataTable({
				dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "../swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1,2,3,4,5,6,7,8,9],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1,2,3,4,5,6,7,8,9],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },
                        
                        {
                            'sExtends': 'print',
                            "mColumns": [0,1,2,3,4,5,6,7,8,9],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        }
                        
                    ]
                },
                "columnDefs": [
                    {
                        "targets": [0],
                        "visible": true,
                        "searchable": true,"width":"1%",
                    },  { "width": "30%", "targets": [6] }
                ],
				 "aaSorting": [[ 0, "desc" ]],
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 25,
				 "aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
				
			}).yadcf([
	    {
	    	column_number : 0,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },{
	    	column_number : 3
	    	
	    }
	    ]);
	    });
	</script>
<fieldset>
<legend align="center"><strong>Report Reject</strong></legend> 
<table id="rijeck" class="display">
		<thead>
		<tr>			
			<th>Tanggal Reject</th>
			<th>No Nota</th>
			<th>Nama Customer</th>
			<th>Harga</th>
			<th>Rcp SPK</th>					
			<th>Op Reject</th>
			<th>Alasan</th>
			<th>Rcp SPK Edit</th>			
		</tr>
		</thead>
		<tbody>
		<?php $sql = $con->query("select reception.nama_customer as nama_customer,reception.total_bayar as total_bayar,reception.rcp_spk as rcp_spk,reception.rcp_spk_edit as rcp_spk_edit,rijeck.tgl_rijeck as tgl_rijeck,rijeck.user_rijeck as user_rijeck,rijeck.alasan as alasan,rijeck.no_nota as no_nota from reception INNER JOIN rijeck where reception.no_nota=rijeck.no_nota"); ?>
			
					<?php while ( $data = $sql->fetch_assoc() ) { ?>
					<tr>
						<td><?php echo $data['tgl_rijeck']?></td>
						<td><?php echo $data['no_nota']?></td>
						<td><?php echo $data['nama_customer']?></td>
						<td><?php echo $data['total_bayar']?></td>
						<td><?php echo $data['rcp_spk']?></td>						
						<td><?php echo $data['user_rijeck']?></td>
						<td><?php echo $data['alasan']?></td>
						<td><?php echo $data['rcp_spk_edit']?></td>
											
					  </tr>
		<?php } ?>
		</tbody>
	</table>
	</fieldset>


<script type="text/javascript" language="javascript" src="../admin/js/dataTables.tableTools.js"></script>
 <script type="text/javascript" language="javascript" src="../lib/js/jquery-ui.js"></script>
</body>

</html>