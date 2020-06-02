<?php
include "header.php";
include '../config.php';
function set_progress($val=0){

	$data = "<div class='progress-container' style='display:none'>
			
				<div class='progress'>
					  <div class='progress-bar progress-bar-info progress-bar-striped active' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width: ". $val. "%'>
					  </div>
				</div>

			</div>";

	return $data;

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
	    	column_number : 1,
	    	filter_type: 'range_date',
	    	date_format: "yyyy-mm-dd"
	    },{column_number : 3}
	   
	    
	    ]);
     
     
     
     	
  	$('input[value="Check All"]').click(function() { // a button with Check All as its value
    $(':checkbox').prop('checked', true); // all checkboxes, you can narrow with a better selector
});
     
     
  
  
});

	</script>
<div class="container-fluid">


<fieldset><legend align="center" ><marquee behavior=alternate  width="250"><strong>Update Semua</strong></marquee></legend> 
<?php if ( isset( $_SESSION['info'] ) ) { ?>
				<div style="width:320px;background:#eee;border-left:5px solid #46b8da;padding:10px;"> 
					Berhasil <?php echo $_SESSION['info'] ?> Data
				</div>
			<?php unset( $_SESSION['info'] ); } ?>
<form action="update_lunas.php" method="post">

			<div align="center">
			<input name="cuci" class="btn btn-lg btn-danger" type="submit" id="cuci" value="Update Lunas">
			
			</div><br>
  									<table cellpadding="0" cellspacing="0" border="0" class="display" id="semua">
													
										<thead>
										  <tr>
												<th>Select All<input type="checkbox" value="Check All" id="cb" name="select_invoice" /></th>
												<th>tgl masuk</th>
												<th>no_nota</th>
												<th>outlet</th>
												<th>nama customer</th>
												<th>Total Bayar</th>
										   </tr>
										</thead>
										<tbody>
<?php
$user_query = mysqli_query($con,"select id,tgl_input,no_nota,nama_outlet,nama_customer,total_bayar from reception WHERE lunas='0'")or die(mysql_error());
while($row = mysqli_fetch_array($user_query)){
$id = $row['id'];
			
													?>
									
												<tr>
												<td width="30">
												<input id="optionsCheckbox" class="uniform_on" name="selector[]" type="checkbox" value="<?php echo $id; ?>">
												</td>
												<td><?php echo $row['tgl_input']; ?></td>
												<td><?php echo $row['no_nota']; ?></td>
												<td><?php echo $row['nama_outlet']; ?></td>
												<td><?php echo $row['nama_customer']; ?></td>
												<td><?php echo $row['total_bayar']; ?></td>
												</tr>
												<?php } ?>
										</tbody>
																		
									</table>
									
									</form>
</fieldset>
</div>