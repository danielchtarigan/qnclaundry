<?php 
date_default_timezone_set('Asia/Makassar');
$date = date('Y-m-d');

include 'fungsi/kas_rcp.php';


?>
<div class="panel-body">
    <div class="list-group">
    <?php                      
    $qrcp = mysqli_query($con, "SELECT * from user where level='reception' AND aktif='Ya' AND cabang='makassar' order by name asc");
    while ($rrcp = mysqli_fetch_array($qrcp)){
    	$nama = $rrcp['name'];
    	$tanggal_mulai = '2017-01-01'; 
    	$endDate = date('Y-m-d');
    	$data = lap_sisa_saldo($nama,$tanggal_mulai,$endDate);
    ?> 
    
     <a href="#" class="list-group-item"><i class="fa fa-tasks fa-fw"></i> <?php echo $nama; ?>
    	<span class="pull-right text-muted small"><em><?php echo rupiah($data['non_cash']).' &nbsp; <i class="fa fa-arrow-left" aria-hidden="true"></i> <i class="fa fa-arrow-right" aria-hidden="true"></i> &nbsp; '.rupiah($data['sisa_saldo']); ?></em></span>
	</a> 

	<?php 
	}
	?>

</div>