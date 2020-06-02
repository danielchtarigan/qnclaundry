<?php
include "header.php";
include '../config.php';

$rcp = $_SESSION['user_id'];

date_default_timezone_set('Asia/Makassar');

$datep1 = '2017-04-01';
$datep2 = date('Y-m-d');

function rupiah($angka)
{
	$jadi = "Rp.".number_format($angka,0,',','.');
	return $jadi;
}
     
     
?>
<script type="text/javascript">
$(document).ready(function() {
   		
     var payTable=	$('#semua').dataTable({
    	"bJQueryUI" : true,
		"sPaginationType" : "full_numbers",
		"iDisplayLength": 10,
        "bFilter": true,
        "aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
     }).yadcf([
	    {
	    	column_number : 0,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },{column_number : 2}
	   
	    
	    ]);   
     	
  	
  
  
});

	</script>


<div class="container-fluid">
	<fieldset><legend align="center" ><marquee behavior=alternate  width="650"><strong>Daftar Order oleh <?php echo $rcp ?> yang belum Lunas</strong></marquee></legend> 
	  									<table cellpadding="0" cellspacing="0" border="0" class="display" id="semua">
														
											<thead>
											  <tr>													
													<th>Tanggal Masuk</th>
													<th>Nomor Nota</th>
													<th>Outlet</th>
													<th>Nama Customer</th>
													<th>Harga</th>
													<th style="text-align: center">Ke Data Customer</th>
											   </tr>
											</thead>
											<tbody>
	<?php
	$user_query = mysqli_query($con,"select id,tgl_input,no_nota,nama_outlet,id_customer,nama_customer,total_bayar from reception WHERE lunas='0' and (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$datep1' and '$datep2') and nama_reception='$rcp' and (cabang='Delivery' or cabang='') ")or die(mysql_error());
	while($row = mysqli_fetch_array($user_query)){
	$id = $row['id'];
				
														?>
										
													<tr>													
													<td><?php echo $row['tgl_input']; ?></td>
													<td><?php echo $row['no_nota']; ?></td>
													<td><?php echo $row['nama_outlet']; ?></td>
													<td><?php echo $row['nama_customer']; ?></td>
													<td><?php echo rupiah($row['total_bayar']); ?></td>
													<td style="text-align: center"><a href="index.php?id=<?php echo $row['id_customer'] ?>">Sudah Lunas?</a></td>
													</tr>
													<?php } ?>
											</tbody>
																			
										</table>										
						
	</fieldset>
</div>