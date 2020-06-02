<?php 
include '../config.php';
include 'head.php';

date_default_timezone_set('Asia/Makassar');
$date = date('Y-m-d');
$date2 = date('Y-m').'-25';
$date3 = date('Y-m', strtotime('-1 months', strtotime(date('Y-m-d')))).'-25';

if(isset($_POST['submit'])){
	$startDate = $_POST['start'];
	$endDate   = $_POST['end'];
	
} else{
	$startDate = date('Y-m', strtotime('-2 months', strtotime(date('Y-m-d')))).'-26';
	$endDate   = date('Y-m', strtotime('-1 months', strtotime(date('Y-m-d')))).'-25';
}
	

	$pastStartDate = date('Y-m-d', strtotime('-1 months', strtotime($startDate)));
	$pastEndDate = date('Y-m-d', strtotime('-1 months', strtotime($endDate)));

	$pastStartDate2 = date('Y-m-d', strtotime('-2 months', strtotime($startDate)));
	$pastEndDate2 = date('Y-m-d', strtotime('-2 months', strtotime($endDate)));

$extraop = mysqli_query($con, "SELECT tgl_update FROM extra_operasional WHERE id_user='397' ");
$datatambah = mysqli_fetch_row($extraop);
$tglupdate = $datatambah[0];

$nowDate = date('Y-m-d');

$qbatasdate = mysqli_query($con, "SELECT DATEDIFF('$nowDate', '$tglupdate') AS selisih");
$databatas = mysqli_fetch_row($qbatasdate);
$selisih = $databatas[0];



?>
<script type="text/javascript">
		$(document).ready(function(){
			$('#jaga').dataTable({
			"order": [[ 1,"asc" ]],
				dom: 'T<"clear">lfrtip',
			});
		});
</script>

<div class="panel panel-default">
  <div class="panel-body">
  	<h3 align="center">Pilih Range Waktu</h3>
  	<div class="col-md-7 col-md-offset-3">  	
		<form class="form-inline" method="POST">
			<div class="col-md-4 col-xs-6 col-md-offset-0"><input class="form-control" type="date" name="start" value="<?php echo $startDate ?>"></div>
			<div class="col-md-4 col-xs-6 col-md-offset-0"><input class="form-control" type="date" name="end" value="<?php echo $endDate ?>"></div>
			<div class="col-md-4 col-xs-6 col-md-offset-0"><input class="btn btn-default btn-md btn-active" type="submit" name="submit" value="Pilih"></div>
		</form>
	</div><br><br><br>
  
  	<ul class="nav nav-tabs">
		<li class="nav-item active" role="presentation"><a class="nav-link active" role="tab" data-toggle="tab" href="#absen"><strong>Data Absensi</strong></a></li>
		<li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-toggle="tab" href="#kenaikan"><strong>Kenaikan Omset</strong></a></li>		
		<li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-toggle="tab" href="#reception"><strong>Akumulasi Jaga Outlet</strong></a></li>
		<li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-toggle="tab" href="#tambah"><strong>Manual Input Untuk KPI Resepsionis</strong></a></li>
		<?php if($selisih<7) echo '<li class="nav-item"><a href="lihat_kpi_reception.php"><strong>Lihat dan Kunci KPI Resepsionis</strong></a></li>';?>
		
	</ul>

	<div class="tab-content">
		
		<div id="absen" role="tabpanel" class="tab-pane active">			
			<?php require 'include/data_absen_rcp.php'; ?>
		</div>

		<div id="kenaikan" role="tabpanel" class="tab-pane">		
			<div class="">
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th>Nama Outlet</th>
								<th>Omset Bulan Lalu</th>
								<th>Titik Nol Bulan ini</th>
								<th>Omset Bulan ini</th>
								<th>Bonus Kenaikan Bulan ini</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						// $qnamarcp = mysqli_query($con, "SELECT DISTINCT nama_reception FROM reception WHERE DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' ");
						// while($namarcp = mysqli_fetch_array($qnamarcp)){
						// 	$rcp = $namarcp['nama_reception'];

						$qoutlet = mysqli_query($con, "SELECT nama_outlet FROM outlet WHERE Kota='Makassar'");
						while($dataout = mysqli_fetch_array($qoutlet)){
							$outlet = $dataout['nama_outlet'];

						// $qhari = mysqli_query($con, "SELECT COUNT(DISTINCT DATE_FORMAT(tgl_input, '%Y-%m-%d')) AS hari, nama_outlet FROM reception WHERE nama_reception='$rcp' AND nama_outlet='$outlet' AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' ");	
						// 	$hari = mysqli_fetch_array($qhari);
						// 	$jumhari = $hari['hari'];
						// 	$outletrcp = $hari['nama_outlet'];

						// 	if($jumhari>0){

							$qomsetlalu2 = mysqli_query($con, "SELECT SUM(total_bayar) AS omset FROM reception WHERE nama_outlet='$outlet' AND cara_bayar<>'Void' AND cara_bayar<>'Reject' AND cabang<>'Hotel Remcy' AND nama_customer NOT LIKE '%HOTEL REMCY%' AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$pastStartDate2' AND '$pastEndDate2' ");
							$datapmsetlalu2 = mysqli_fetch_row($qomsetlalu2);
							$omsetlalu2 = $datapmsetlalu2[0];


							$qomsetlalu = mysqli_query($con, "SELECT SUM(total_bayar) AS omset FROM reception WHERE nama_outlet='$outlet' AND cara_bayar<>'Void' AND cara_bayar<>'Reject' AND cabang<>'Hotel Remcy' AND nama_customer NOT LIKE '%HOTEL REMCY%' AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$pastStartDate' AND '$pastEndDate' ");
							$datapmsetlalu = mysqli_fetch_row($qomsetlalu);
							$omsetlalu = $datapmsetlalu[0];


							$qomset = mysqli_query($con, "SELECT SUM(total_bayar) AS omset FROM reception WHERE nama_outlet='$outlet' AND cara_bayar<>'Void' AND cara_bayar<>'Reject' AND cabang<>'Hotel Remcy' AND nama_customer NOT LIKE '%HOTEL REMCY%' AND DATE_FORMAT(tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate'");
							$omset = mysqli_fetch_row($qomset);
							$oms = $omset[0];

							// switch ($outlet) {
							// 	case 'Toddopuli': $titiknol = 72000000; break;
							// 	case 'Landak'	: $titiknol = 
								
							// 	default:
							// 		# code...
							// 		break;
							// }

                            $qtitiknol = mysqli_query($con, "SELECT titik_nol,komisi FROM outlet WHERE nama_outlet='$outlet'");
							$datatnol = mysqli_fetch_array($qtitiknol);
							$titiknolot = $datatnol['titik_nol'];
							$komisi = $datatnol['komisi'];

							if($omsetlalu<$omsetlalu2) $titiknol1 = ceil($omsetlalu/2000000)*2000000; else $titiknol1 = floor($omsetlalu/2000000)*2000000;	
							
							if($komisi==0) $titiknol = $titiknolot; else $titiknol = $titiknol1;

							if(($oms-$titiknol)/2000000<=0) $bonus = ceil(($oms-$titiknol)/2000000)*200000; else $bonus = floor(($oms-$titiknol)/2000000)*200000;
							
							if($date>=$date2 || $date<$date3){
							    mysqli_query($con, "UPDATE outlet SET titik_nol='$titiknol', komisi='$bonus' WHERE nama_outlet='$outlet'");
							}
						
									
						?>
							<tr>
								<td><?php echo $outlet ?></td>
								<td><?php echo rupiah($omsetlalu) ?></td>
								<td><?php echo rupiah($titiknol); ?></td>
								<td><?php echo rupiah($oms); ?></td>
								<td><?php echo rupiah($bonus); ?></td>								
							</tr>
						</tbody>
						<?php 
								
						}
						?>
					</table>			
				</div>
			</div>
		</div>

		<div id="reception" role="tabpanel" class="tab-pane">
				
			<div>
				<div class="table-responsive">
					<table class="table table-striped table-hover table-bordered" id="jaga">
						<thead>
							<tr>
								<th>Nama resepsionis</th>
								<th>Nama Outlet</th>
								<th>Jumlah Jaga</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$log = mysqli_query($con, "SELECT DISTINCT id_user, id_outlet FROM log_rcp WHERE DATE_FORMAT(tgl_log, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' ORDER BY id_user,id_outlet ");
							while($datalog = mysqli_fetch_row($log)){?>
							<tr>
								<td><?php echo $datalog[0] ?></td>
								<td><?php echo $datalog[1] ?></td>
								<?php 
								$jumlah = mysqli_query($con, "SELECT COUNT(DISTINCT DATE_FORMAT(tgl_log, '%Y-%m-%d')) AS jumlah FROM log_rcp WHERE DATE_FORMAT(tgl_log, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' AND id_user='$datalog[0]' AND id_outlet='$datalog[1]' "); 
								$datajumlah = mysqli_fetch_row($jumlah);
								?>
								<td><?php echo $datajumlah[0] ?></td>
							</tr>
							<?php 
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div id="tambah" role="tabpanel" class="tab-pane">	
			<?php require 'include/manual_input_kpi_rcp.php'; ?>
		</div>

		
		
	</div>
  </div>
</div>	