<?php
include 'header.php';
include '../config.php';
$tgl=$_POST['tgl'];
	   $date = new DateTime($tgl);
	   $newDate = $date->format('Y-m-d');
	   
$tgl2=$_POST['tgl2'];
	   $date2= new DateTime($tgl2);
	   $newDate2 = $date2->format('Y-m-d');
$op=$_SESSION['user_id']; 
?>
<legend align="center"><strong>Data Order</strong></legend> 
dari tanggal <?php echo $newDate ;?> sampai <?php echo $newDate2; ?>
<table id="tbl_cst" class="display">
	<thead>
		<tr>
			<th>Outlet</th>
			<th>Tgl Masuk</th>
			<th>No Nota</th>
			<th>Nama</th>
			<th>RCP</th>
			<th>Lunas</th>
			<th>Tgl Ambil</th>
            <th>Jenis</th>
		</tr>
		</thead>

		<tbody>
			<?php
			$query = "SELECT jenis,nama_outlet,tgl_input,no_nota,nama_customer,total_bayar,nama_reception,lunas,tgl_ambil FROM reception  WHERE (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newDate' and '$newDate2') ";
			$tampil = mysqli_query($con, $query);
				while($r = mysqli_fetch_array($tampil)){
				?><tr >
				<td><?php echo $r['nama_outlet']; ?></td>	
				<td><?php echo $r['tgl_input']; ?></td>	
				<td><?php echo $r['no_nota']; ?></td>
				<td><?php echo $r['nama_customer']; ?></td>
				<td><?php echo $r['nama_reception']; ?></td>
				<td><?php echo $r['lunas']; ?></td>
			    <td><?php if($r['tgl_ambil']=="0000-00-00 00:00:00") echo "Belum"; else echo $r['tgl_ambil']; ?></td>
                <td><?php echo $r['jenis']; ?></td>
				</tr>
					<?php } 
					?>
		</tbody>
		</table>
	
	
<script> 
$(document).ready(function() { 
	    	$('#tbl_cst').dataTable({
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "../swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1, 2,3,4,5,6,7],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1, 2,3,4,5,6,7],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },
                        
                        {
                            'sExtends': 'print',
                            "mColumns": [0,1, 2,3,4,5,6,7],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        }
                        
                    ]
                },
                "columnDefs": [
                    {
                        "targets": [0],
                        "visible": true,
                        "searchable": true,"width":"5%",
                    },  { "width": "5px", "targets": [2] },{ "width": "10%", "targets": 1 },
                ],
	
        		"aaSorting": [[ 1, "desc" ]],
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 5}).yadcf([
	    {
	    	column_number : 1,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },
	   
	    {column_number : 0},{column_number : 5},{column_number : 7}, {column_number : 4}
	    
	    ]);    

} );
</script>
