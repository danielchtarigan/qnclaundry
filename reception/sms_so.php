<html>
<head>
	
<?php 
include "header.php";
include "../config.php"; 
$op=$_SESSION['nama_outlet']; 
?>
</head>
<body>

<fieldset>
<legend align="center"><strong>Stok Opname.Jika di kolom so kosong berarti tidak so</strong></legend> 
	<table id="cuci" class="display">
		<thead>
		<tr>
			<th>Tgl</th>
			<th >outlet</th>
			<th >RCP</th>
			
			<th>Jumlah</th>
			
			<th>Cabang</th>
			<th>SO</th>
		</tr>
		</thead>
		<tfoot>
            <tr>
                <th colspan="2" style="text-align:right">Total:</th>
                <th></th>
            </tr>
        </tfoot>
			
		<tbody>
			<?php
			$tglbaru = date("Y-m-d", strtotime("-3 Days"));
			$query = "SELECT nama_reception,nama_outlet,DATE_FORMAT(tgl_input, '%Y-%m-%d') as tgl_input,sum(total_bayar) as jumlah,cabang FROM reception group by nama_outlet,DATE_FORMAT(tgl_input, '%Y-%m-%d'),cabang,nama_reception order by tgl_input desc" ;
			$tampil = mysqli_query($con, $query);
			
			while($data = mysqli_fetch_array($tampil)){
			$tgl=$data['tgl_input'];
				?>
				
					<tr>
					<td><?php echo $data['tgl_input'];?></td>
					
					<td><?php echo $data['nama_outlet'];?></td>
					<td><?php echo $data['nama_reception'];?></td>
					
					<td><?php echo $data['jumlah'];?></td>
					
					<td><?php echo $data['cabang'];?></td>
	<td><?php
	$sql4 = mysqli_query($con,"SELECT rcp_so,DATE_FORMAT(tgl_so, '%Y-%m-%d') as tgl_so,outlet FROM detail_so WHERE DATE_FORMAT(tgl_so,'%Y-%m-%d')='$tgl' and rcp_so='$data[nama_reception]' and outlet='$data[nama_outlet]' group by rcp_so,DATE_FORMAT(tgl_so, '%Y-%m-%d'),outlet" );
	
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



<fieldset>
<legend align="center"><strong>Data SO</strong></legend> 
<table id="sms" class="display">
		<thead>
		<tr>
			
<th>Tanggal SO</th>
<th>no telp</th>
<th>no nota</th>
			
<th>customer</th>			
<th>outlet</th>			
<th>Rcp so</th>	
		</tr>
		</thead>
		<tbody>
			<?php
			$query = "select  * from reception r,customer c where r.id_customer = c.id and tgl_so<>'0000-00-00 00:00:00' order by tgl_so desc";
			$tampil = mysqli_query($con, $query);
			while($r = mysqli_fetch_array($tampil)){
				$tgso = date('Y-m-d', strtotime($r['tgl_so']));
				$tgkb = date('Y-m-d', strtotime($r['tgl_kembali']));
				
				
				?><tr >
				<td><?php echo $r['tgl_so']; ?></td>
				<td><?php echo $r['no_telp']; ?></td>
				<td><?php echo $r['no_nota']; ?></td>
				<td><?php echo $r['nama_customer']; ?></td>
				<td><?php echo $r['nama_outlet']; ?></td>
				<td><?php echo $r['rcp_so']; ?></td>
					
								
			
				</tr>
					<?php } 
					?>
		</tbody>
	</table>
	</fieldset>

</body>
<script> 
$(document).ready(function() { 
	    	$('#sms').dataTable({
			"lengthMenu": [ [5 ,10 , 25, 50, -1], [5,10, 25, 50, "All"] ],
dom: 'T<"clear">lfrtip',
                tableTools: {
                    "sSwfPath": "../swf/copy_csv_xls_pdf.swf",
                    "aButtons": [
                        {
                            "sExtends": "copy",
                            "mColumns": [0,1,2,3,4,5],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            "sExtends": "csv",
                            "mColumns": [0,1,2,3,4,5],
                            "oSelectorOpts": { filter: "applied", order: "current" }
                        },
                        {
                            'sExtends': 'xls',
                            "mColumns": [0,1,2,3,4,5],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        },
                        
                        {
                            'sExtends': 'print',
                            "mColumns": [0,1,2,3,4,5],
                            "oSelectorOpts": { filter: 'applied', order: 'current' }
                        }
                        
                    ]
                },
                "columnDefs": [
                    {
                        "targets": [0],
                        "visible": true,
                        "searchable": true,"width":"5%",
                    },  { "width": "5px", "targets": [1] }
                ],
	
        		"aaSorting": [[ 0, "desc" ]],
				"bJQueryUI" : true,
				"sPaginationType" : "full_numbers",
				 "iDisplayLength": 25}).yadcf([
	    {
	    	column_number : 0,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },{
	    	column_number : 4
	    	
	    }
	   
	   
	    
	    ]);    

} );
</script>
<script type="text/javascript">
		$(document).ready(function(){
			$('#cuci').dataTable({
				
		
	    });
	     });
	</script>
</html>