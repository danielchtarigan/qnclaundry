<?php
include '../config.php';
include 'head.php';
include 'charthc.php';
date_default_timezone_set('Asia/Makassar');
	$date = date('Y-m-d');
	$newDate = strtotime('-9 day', strtotime($date));
	$newDate2 = strtotime('-3 day', strtotime($date));
	$newDate = date('Y-m-d', $newDate);
	$newDate2 = date('Y-m-d', $newDate2);	
	$minggu_ini = 'dari '.date('d-m-Y', strtotime($newDate)).' sd '.date('d-m-Y', strtotime($newDate2));
	
	$llDate = strtotime('-16 day', strtotime($date));
	$llDate2 = strtotime('-10 day', strtotime($date));
	$llDate = date('Y-m-d', $llDate);
	$llDate2 = date('Y-m-d', $llDate2);
	$minggu_lalu = 'dari '.date('d-m-Y', strtotime($llDate)).' sd '.date('d-m-Y', strtotime($llDate2));		

?>	
<script src="js/sand-signika.js"></script>

<!--<div class="col-lg-12">-->
<!--    <form class="form-inline" role="form">-->
<!--        <div class="form-group">-->
            
<!--        </div>-->
<!--    </form>-->
<!--</div>-->

<div class="row">	
	<div class="col-lg-6">	
	<div id="container" style="min-width: 310px; height: 500px; margin: 0 auto"></div>
		<div class="hidden">
			<table id="datatable" class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>KATEGORI</th>
						<th style="text-align:center">MINGGU INI (<?php echo $minggu_ini;?>)</th>
						<th style="text-align:center">MINGGU LALU (<?php echo $minggu_lalu;?>)</th>
					</tr>
				</thead>
				<tbody>				
					<tr>
						<th>Cashback</th>
						<td style="text-align:center">
						<?php
				// 		$qcbk = $con->query("select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal, voucher, lunas, COUNT(DISTINCT id_customer) as cashback from reception where (voucher like '%50RB%' or voucher like '%25RB%') and lunas = true and (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newDate' and '$newDate2')");
				// 		$cbk = $qcbk->fetch_assoc();
				// 		echo $cbk['cashback'];
						
						$voucher = $con->query("select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal, voucher, lunas, COUNT(DISTINCT id_customer) as cashback from reception where voucher like 'CASH%' and lunas = true and (cabang<>'Jakarta' OR cabang<>'Medan') AND (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newDate' and '$newDate2')");
                        $qc = mysqli_fetch_array($voucher);
                        echo $qc['cashback'];
						?>
						</td>
						<td style="text-align:center">
						<?php
				// 		$qcbk = $con->query("select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal, voucher, lunas, COUNT(DISTINCT id_customer) as cashback from reception where (voucher like '%50RB%' or voucher like '%25RB%') and lunas = true and (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$llDate' and '$llDate2')");
				// 		$cbk = $qcbk->fetch_assoc();
				// 		echo $cbk['cashback'];
						
						$voucher =$con->query("select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal, voucher, lunas, COUNT(DISTINCT id_customer) as cashback from reception where voucher like 'CASH%' and lunas = true and (cabang<>'Jakarta' OR cabang<>'Medan') AND (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$llDate' and '$llDate2') ");
                        $qc = mysqli_fetch_array($voucher);
                        echo $qc['cashback'];
						?>
						</td>
					</tr>
					<tr>
						<th>Recovery</th>
						<td style="text-align:center">
						<?php
				// 		$qcbk = $con->query("select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal, voucher, lunas, COUNT(DISTINCT id_customer) as cashback from reception where (voucher like '%RCV%' or voucher like '%00RB%' or voucher like '%RCRB%') and lunas = true and (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newDate' and '$newDate2')");
				// 		$cbk = $qcbk->fetch_assoc();
				// 		echo $cbk['cashback'];
						
						$voucher = mysqli_query($con, "SELECT COUNT(DISTINCT id_customer) as jumlah FROM using_voucher WHERE kode_voucher LIKE '%RCV%' AND DATE_FORMAT(tgl_penggunaan, '%Y-%m-%d') between '$newDate' and '$newDate2' ");
                        $qc = mysqli_fetch_array($voucher);
                        echo $qc['jumlah'];
						?>
						</td>
						<td style="text-align:center">
						<?php
				// 		$qcbk = $con->query("select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal, voucher, lunas, COUNT(DISTINCT id_customer) as cashback from reception where (voucher like '%RCV%' or voucher like '%00RB%' or voucher like '%RCRB%') and lunas = true and (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$llDate' and '$llDate2')");
				// 		$cbk = $qcbk->fetch_assoc();
				// 		echo $cbk['cashback'];
						
						$voucher = mysqli_query($con, "SELECT COUNT(DISTINCT id_customer) as jumlah FROM using_voucher WHERE kode_voucher LIKE '%RCV%' AND DATE_FORMAT(tgl_penggunaan, '%Y-%m-%d') between '$llDate' and '$llDate2' ");
                        $qc = mysqli_fetch_array($voucher);
                        echo $qc['jumlah'];
						?>
						</td>
					</tr>					
					<tr>
						<th>BNI</th>
						<td style="text-align:center">
						<?php
						$qcbk = $con->query("select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal, voucher, lunas, COUNT(DISTINCT id_customer) as cashback from reception where (voucher like '%KKBNI%' or voucher like '%DBBNI%' or voucher like '%BNILAUNDRY%') and lunas = true and (cabang<>'Jakarta' OR cabang<>'Medan') AND (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newDate' and '$newDate2')");
						$cbk = $qcbk->fetch_assoc();
						echo $cbk['cashback'];
						?>
						</td>
						<td style="text-align:center">
						<?php
						$qcbk = $con->query("select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal, voucher, lunas, COUNT(DISTINCT id_customer) as cashback from reception where (voucher like '%KKBNI%' or voucher like '%DBBNI%' or voucher like '%BNILAUNDRY%') and lunas = true and (cabang<>'Jakarta' OR cabang<>'Medan') AND (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$llDate' and '$llDate2')");
						$cbk = $qcbk->fetch_assoc();
						echo $cbk['cashback'];
						?>
						</td>
					</tr>
					<tr>
						<th>Mega</th>
						<td style="text-align:center">
						<?php
						$qcbk = $con->query("select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal, voucher, lunas, COUNT(DISTINCT id_customer) as cashback from reception where voucher like '%KKMEGA%' and lunas = true and (cabang<>'Jakarta' OR cabang<>'Medan') AND (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newDate' and '$newDate2')");
						$cbk = $qcbk->fetch_assoc();
						echo $cbk['cashback'];
						?>
						</td>
						<td style="text-align:center">
						<?php
						$qcbk = $con->query("select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal, voucher, lunas, COUNT(DISTINCT id_customer) as cashback from reception where voucher like '%KKMEGA%' and lunas = true and (cabang<>'Jakarta' OR cabang<>'Medan') AND (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$llDate' and '$llDate2')");
						$cbk = $qcbk->fetch_assoc();
						echo $cbk['cashback'];
						?>
						</td>
					</tr>
					<tr>
						<th>Cucian Telat</th>
						<td style="text-align:center">
						<?php 
						$qrcp = $con->query("select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal, voucher, lunas, COUNT(DISTINCT id_customer) as berkala from reception where (voucher like '%D15%' or voucher like '%D25%' or voucher like '%D35%' or voucher LIKE 'DISC15') and lunas = true and (cabang<>'Jakarta' OR cabang<>'Medan') AND (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newDate' and '$newDate2')");
						$rcp = $qrcp->fetch_assoc();
						echo $rcp['berkala'];
						?>
						</td>
						<td style="text-align:center">
						<?php
						$qcbk = $con->query("select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal, voucher, lunas, COUNT(DISTINCT id_customer) as cashback from reception where (voucher like '%D15%' or voucher like '%D25%' or voucher like '%D35%' or voucher LIKE 'DISC15') and lunas = true and (cabang<>'Jakarta' OR cabang<>'Medan') AND (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$llDate' and '$llDate2')");
						$cbk = $qcbk->fetch_assoc();
						echo $cbk['cashback'];
						?>
						</td>
					</tr>
					<tr>
						<th>SMS BC</th>
						<td style="text-align:center">
						<?php 
						$qrcp = $con->query("select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal, voucher, lunas, COUNT(DISTINCT id_customer) as berkala from reception where (voucher like '%SATUAN%' or voucher like '%HEMAT%' OR voucher LIKE '%BC%' or voucher LIKE 'LIKEANTANG' or voucher LIKE 'DISC20' or voucher LIKE 'SPC20' or voucher LIKE 'MAAF%' or voucher LIKE 'HD7000' or voucher LIKE 'SEPTCERIA' or voucher LIKE 'OKTFEST') and lunas = true and (cabang<>'Jakarta' OR cabang<>'Medan') AND (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newDate' and '$newDate2')");
						$rcp = $qrcp->fetch_assoc();
						echo $rcp['berkala'];
						?>
						</td>
						<td style="text-align:center">
						<?php
						$qcbk = $con->query("select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal, voucher, lunas, COUNT(DISTINCT id_customer) as cashback from reception where (voucher like '%SATUAN%' or voucher like '%HEMAT%' OR voucher LIKE '%BC%' or voucher LIKE 'LIKEANTANG' or voucher LIKE 'DISC20' or voucher LIKE 'SPC20' or voucher LIKE 'MAAF%' or voucher LIKE 'HD7000' or voucher LIKE 'SEPTCERIA' or voucher LIKE 'OKTFEST') and lunas = true and (cabang<>'Jakarta' OR cabang<>'Medan') AND (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$llDate' and '$llDate2')");
						$cbk = $qcbk->fetch_assoc();
						echo $cbk['cashback'];
						?>
						</td>
					</tr>
					<tr>
						<th>MEDSOS</th>
						<td style="text-align:center">
						<?php 
						$qrcp = $con->query("select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal, voucher, lunas, COUNT(DISTINCT id_customer) as berkala from reception where (voucher = 'LIKEFB' OR voucher = 'IGOFF20' OR voucher = 'FOL10') and lunas = true and  (cabang<>'Jakarta' OR cabang<>'Medan') AND(DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newDate' and '$newDate2')");
						$rcp = $qrcp->fetch_assoc();
						echo $rcp['berkala'];
						?>
						</td>
						<td style="text-align:center">
						<?php
						$qcbk = $con->query("select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal, voucher, lunas, COUNT(DISTINCT id_customer) as cashback from reception where (voucher = 'LIKEFB' OR voucher = 'IGOFF20' OR voucher = 'FOL10') and lunas = true and (cabang<>'Jakarta' OR cabang<>'Medan') AND (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$llDate' and '$llDate2')");
						$cbk = $qcbk->fetch_assoc();
						echo $cbk['cashback'];
						?>
						</td>
					</tr>
					<tr>
						<th>Brosur</th>
						<td style="text-align:center">
						<?php 
						$qrcp = $con->query("select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal, voucher, lunas, COUNT(DISTINCT id_customer) as berkala from reception where (voucher like '%1017%' OR voucher LIKE '%MIDI50%' OR voucher LIKE '%COBA%') and lunas = true and (cabang<>'Jakarta' OR cabang<>'Medan') AND (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newDate' and '$newDate2')");
						$rcp = $qrcp->fetch_assoc();
						echo $rcp['berkala'];
						?>
						</td>
						<td style="text-align:center">
						<?php
						$qcbk = $con->query("select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal, voucher, lunas, COUNT(DISTINCT id_customer) as cashback from reception where (voucher like '%1017%' OR voucher LIKE '%MIDI50%' OR voucher LIKE '%COBA%') and lunas = true and (cabang<>'Jakarta' OR cabang<>'Medan') AND (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$llDate' and '$llDate2')");
						$cbk = $qcbk->fetch_assoc();
						echo $cbk['cashback'];
						?>
						</td>
					</tr>
					<tr>
						<th>Trans dan Carrefour</th>
						<td style="text-align:center">
						<?php 
						$voucher = mysqli_query($con, "SELECT COUNT(DISTINCT id_customer) as jumlah FROM using_voucher WHERE (kode_voucher LIKE 'QTR%' OR kode_voucher LIKE 'QCR') AND DATE_FORMAT(tgl_penggunaan, '%Y-%m-%d') between '$newDate' and '$newDate2' ");
                        $qc = mysqli_fetch_array($voucher);
                        echo $qc['jumlah'];
						?>
						</td>
						<td style="text-align:center">
						<?php
						$voucher = mysqli_query($con, "SELECT COUNT(DISTINCT id_customer) as jumlah FROM using_voucher WHERE (kode_voucher LIKE 'QTR%' OR kode_voucher LIKE 'QCR') AND DATE_FORMAT(tgl_penggunaan, '%Y-%m-%d') between '$llDate' and '$llDate2' ");
                        $qc = mysqli_fetch_array($voucher);
                        echo $qc['jumlah'];
						?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		
		<script text="text/javascript">
			Highcharts.chart('container', {
			  data: {
				table: 'datatable'
			  },
			  chart: {
				type: 'column'
			  },
			  title: {
				text: 'Pengguna Voucher dan Kode Promo'
			  },
			  yAxis: {
				allowDecimals: false,
				title: {
				  text: 'Jumlah'
				}
			  },
			  tooltip: {
				formatter: function() {
				  return '<b>' + this.series.name + '</b><br/>' +
					this.point.y + ' ' + this.point.name.toLowerCase();
				}
			  }
			});
		</script>
	</div>
	
	<div class="col-lg-6">
	<div id="container2" style="min-width: 310px; height: 500px; margin: 0 auto"></div>
		<div class="hidden">
			<table id="datatable2" class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>KATEGORI</th>
						<th style="text-align:center">MINGGU INI (<?php echo $minggu_ini;?>)</th>
						<th style="text-align:center">MINGGU LALU (<?php echo $minggu_lalu;?>)</th>
					</tr>
				</thead>
				<tbody>				
					<tr>
						<th>Cashback</th>
						<td style="text-align:center">
						<?php
				// 		$qcbk = $con->query("select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal, voucher, lunas, COUNT(voucher) as cashbacku from reception where (voucher like '%50RB%' or voucher like '%25RB%') and lunas = true and (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newDate' and '$newDate2')");
				// 		$cbk = $qcbk->fetch_assoc();
				// 		echo $cbk['cashbacku'];
						
						$voucher = $con->query("select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal, lunas, COUNT(voucher) as cashback from reception where voucher like 'CASH%' and lunas = true and (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newDate' and '$newDate2')");
                        $qc = mysqli_fetch_array($voucher);
                        echo $qc['cashback'];
						?>
						</td>
						<td style="text-align:center">
						<?php
				// 		$qcbk = $con->query("select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal, voucher, lunas, COUNT(voucher) as cashback from reception where (voucher like '%50RB%' or voucher like '%25RB%') and lunas = true and (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$llDate' and '$llDate2')");
				// 		$cbk = $qcbk->fetch_assoc();
				// 		echo $cbk['cashback'];
						
						$voucher = $con->query("select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal, lunas, COUNT(voucher) as cashback from reception where voucher like 'CASH%' and lunas = true and (cabang<>'Jakarta' OR cabang<>'Medan') AND (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$llDate' and '$llDate2')");
                        $qc = mysqli_fetch_array($voucher);
                        echo $qc['cashback'];
						?>
						</td>
					</tr>
					<tr>
						<th>Recovery</th>
						<td style="text-align:center">
						<?php
				// 		$qcbk = $con->query("select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal, voucher, lunas, COUNT(voucher) as cashback from reception where (voucher like '%RCV%' or voucher like '%00RB%' or voucher like '%RCRB%') and lunas = true and (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newDate' and '$newDate2')");
				// 		$cbk = $qcbk->fetch_assoc();
				// 		echo $cbk['cashback'];
						
						$voucher = mysqli_query($con, "SELECT COUNT(DISTINCT kode_voucher) as jumlah FROM using_voucher WHERE kode_voucher LIKE 'RCV%' AND DATE_FORMAT(tgl_penggunaan, '%Y-%m-%d') between '$newDate' and '$newDate2' ");
                        $qc = mysqli_fetch_array($voucher);
                        echo $qc['jumlah'];
						?>
						</td>
						<td style="text-align:center">
						<?php
				// 		$qcbk = $con->query("select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal, voucher, lunas, COUNT(voucher) as cashback from reception where (voucher like '%RCV%' or voucher like '%00RB%' or voucher like '%RCRB%') and lunas = true and (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$llDate' and '$llDate2')");
				// 		$cbk = $qcbk->fetch_assoc();
				// 		echo $cbk['cashback'];
						
						$voucher = mysqli_query($con, "SELECT COUNT(DISTINCT kode_voucher) as jumlah FROM using_voucher WHERE kode_voucher LIKE 'RCV%' AND DATE_FORMAT(tgl_penggunaan, '%Y-%m-%d') between '$llDate' and '$llDate2' ");
                        $qc = mysqli_fetch_array($voucher);
                        echo $qc['jumlah'];
						?>
						</td>
					</tr>
					<tr>
						<th>BNI</th>
						<td style="text-align:center">
						<?php
						$qcbk = $con->query("select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal, lunas, COUNT(voucher) as cashback from reception where (voucher like '%KKBNI%' or voucher like '%DBBNI%' or voucher like '%BNILAUNDRY%') and lunas = true and (cabang<>'Jakarta' OR cabang<>'Medan') AND (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newDate' and '$newDate2')");
						$cbk = $qcbk->fetch_assoc();
						echo $cbk['cashback'];
						?>
						</td>
						<td style="text-align:center">
						<?php
						$qcbk = $con->query("select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal, lunas, COUNT(voucher) as cashback from reception where (voucher like '%KKBNI%' or voucher like '%DBBNI%' or voucher like '%BNILAUNDRY%') and lunas = true and (cabang<>'Jakarta' OR cabang<>'Medan') AND (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$llDate' and '$llDate2')");
						$cbk = $qcbk->fetch_assoc();
						echo $cbk['cashback'];
						?>
						</td>
					</tr>
					<tr>
						<th>MEGA</th>
						<td style="text-align:center">
						<?php
						$qcbk = $con->query("select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal, lunas, COUNT(voucher) as cashback from reception where voucher like '%KKMEGA%' and lunas = true and (cabang<>'Jakarta' OR cabang<>'Medan') AND (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newDate' and '$newDate2')");
						$cbk = $qcbk->fetch_assoc();
						echo $cbk['cashback'];
						?>
						</td>
						<td style="text-align:center">
						<?php
						$qcbk = $con->query("select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal, lunas, COUNT(voucher) as cashback from reception where voucher like '%KKMEGA%' and lunas = true and (cabang<>'Jakarta' OR cabang<>'Medan') AND (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$llDate' and '$llDate2')");
						$cbk = $qcbk->fetch_assoc();
						echo $cbk['cashback'];
						?>
						</td>
					</tr>
					<tr>
						<th>Cucian Telat</th>
						<td style="text-align:center">
						<?php 
						$qrcp = $con->query("select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal, voucher, lunas, COUNT(voucher) as berkala from reception where (voucher like '%D15%' or voucher like '%D25%' or voucher like '%D35%' or voucher LIKE 'DISC15') and lunas = true and (cabang<>'Jakarta' OR cabang<>'Medan') AND (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newDate' and '$newDate2')");
						$rcp = $qrcp->fetch_assoc();
						echo $rcp['berkala'];
						?>
						</td>
						<td style="text-align:center">
						<?php
						$qcbk = $con->query("select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal, voucher, lunas, COUNT(voucher) as cashback from reception where (voucher like '%D15%' or voucher like '%D25%' or voucher like '%D35%' or voucher LIKE 'DISC15') and lunas = true and (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$llDate' and '$llDate2')");
						$cbk = $qcbk->fetch_assoc();
						echo $cbk['cashback'];
						?>
						</td>
					</tr>
					<tr>
						<th>SMS BC</th>
						<td style="text-align:center">
						<?php 
						$qrcp = $con->query("select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal, voucher, lunas, COUNT(voucher) as berkala from reception where (voucher like '%SATUAN%' or voucher like '%HEMAT%' OR voucher LIKE '%BC%' or voucher LIKE 'LIKEANTANG' or voucher LIKE 'DISC20' or voucher LIKE 'SPC20' or voucher LIKE 'MAAF%' or voucher LIKE 'HD7000' or voucher LIKE 'SEPTCERIA' or voucher LIKE 'OKTFEST') and lunas = true and (cabang<>'Jakarta' OR cabang<>'Medan') AND (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newDate' and '$newDate2')");
						$rcp = $qrcp->fetch_assoc();
						echo $rcp['berkala'];
						?>
						</td>
						<td style="text-align:center">
						<?php
						$qcbk = $con->query("select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal, voucher, lunas, COUNT(voucher) as cashback from reception where (voucher like '%SATUAN%' or voucher like '%HEMAT%' OR voucher LIKE '%BC%' or voucher LIKE 'LIKEANTANG' or voucher LIKE 'DISC20' or voucher LIKE 'SPC20' or voucher LIKE 'MAAF%' or voucher LIKE 'HD7000' or voucher LIKE 'SEPTCERIA' or voucher LIKE 'OKTFEST') and lunas = true and (cabang<>'Jakarta' OR cabang<>'Medan') AND (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$llDate' and '$llDate2')");
						$cbk = $qcbk->fetch_assoc();
						echo $cbk['cashback'];
						?>
						</td>
					</tr>
					<tr>
						<th>MEDSOS</th>
						<td style="text-align:center">
						<?php 
						$qrcp = $con->query("select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal, voucher, lunas, COUNT(voucher) as berkala from reception where (voucher = 'LIKEFB' OR voucher = 'IGOFF20' OR voucher = 'FOL10') and lunas = true and (cabang<>'Jakarta' OR cabang<>'Medan') AND (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newDate' and '$newDate2')");
						$rcp = $qrcp->fetch_assoc();
						echo $rcp['berkala'];
						?>
						</td>
						<td style="text-align:center">
						<?php
						$qcbk = $con->query("select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal, voucher, lunas, COUNT(voucher) as cashback from reception where (voucher = 'LIKEFB' OR voucher = 'IGOFF20' OR voucher = 'FOL10') and lunas = true and (cabang<>'Jakarta' OR cabang<>'Medan') AND (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$llDate' and '$llDate2')");
						$cbk = $qcbk->fetch_assoc();
						echo $cbk['cashback'];
						?>
						</td>
					</tr>
					<tr>
						<th>Brosur</th>
						<td style="text-align:center">
						<?php 
						$qrcp = $con->query("select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal, voucher, lunas, COUNT(voucher) as berkala from reception where (voucher like '%1017%' OR voucher LIKE '%MIDI50%' OR voucher LIKE '%COBA%') and lunas = true and (cabang<>'Jakarta' OR cabang<>'Medan') AND (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$newDate' and '$newDate2')");
						$rcp = $qrcp->fetch_assoc();
						echo $rcp['berkala'];
						?>
						</td>
						<td style="text-align:center">
						<?php
						$qcbk = $con->query("select DATE_FORMAT(tgl_input, '%Y-%m-%d') as tanggal, voucher, lunas, COUNT(voucher) as cashback from reception where (voucher like '%1017%' OR voucher LIKE '%MIDI50%' OR voucher LIKE '%COBA%') and lunas = true and (cabang<>'Jakarta' OR cabang<>'Medan') AND (DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$llDate' and '$llDate2')");
						$cbk = $qcbk->fetch_assoc();
						echo $cbk['cashback'];
						?>
						</td>
					</tr>
					<tr>
						<th>Trans dan Carrefour</th>
						<td style="text-align:center">
						<?php 
						 $voucher = mysqli_query($con, "SELECT COUNT(DISTINCT kode_voucher) as jumlah FROM using_voucher WHERE (kode_voucher LIKE 'QTR%' OR kode_voucher LIKE 'QCR') AND DATE_FORMAT(tgl_penggunaan, '%Y-%m-%d') between '$newDate' and '$newDate2' ");
                        $qc = mysqli_fetch_array($voucher);
                        echo $qc['jumlah'];
						?>
						</td>
						<td style="text-align:center">
						<?php
						 $voucher = mysqli_query($con, "SELECT COUNT(DISTINCT kode_voucher) as jumlah FROM using_voucher WHERE (kode_voucher LIKE 'QTR%' OR kode_voucher LIKE 'QCR') AND DATE_FORMAT(tgl_penggunaan, '%Y-%m-%d') between '$llDate' and '$llDate2' ");
                        $qc = mysqli_fetch_array($voucher);
                        echo $qc['jumlah'];
						?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		
		<script text="text/javascript">
			Highcharts.chart('container2', {
			  data: {
				table: 'datatable2'
			  },
			  chart: {
				type: 'column'
			  },
			  title: {
				text: 'Penggunaan Voucher dan Kode Promo'
			  },
			  yAxis: {
				allowDecimals: false,
				title: {
				  text: 'Jumlah'
				}
			  },
			  tooltip: {
				formatter: function() {
				  return '<b>' + this.series.name + '</b><br/>' +
					this.point.y + ' ' + this.point.name.toLowerCase();
				}
			  }
			});
		</script>
	</div>
</div>

