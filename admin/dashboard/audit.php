<?php 

$date = date('Y-m-d', strtotime('-7 day', strtotime(date('Y-m-d'))));
$date2 = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));

$day = date('l', strtotime('-7 day', strtotime(date('Y-m-d'))));
$day2 = date('l', strtotime('-1 day', strtotime(date('Y-m-d'))));

switch ($day){
	case "Sunday" : $hari = "Minggu"; break;
	case "Monday" : $hari = "Senin"; break;
	case "Tuesday" : $hari = "Selasa"; break;
	case "Wednesday" : $hari = "Rabu"; break;
	case "Thursday" : $hari = "Kamis"; break;
	case "Friday" : $hari = "Jumat"; break;
	case "Saturday" : $hari = "Sabtu"; break;
}

switch ($day2){
	case "Sunday" : $hari2 = "Minggu"; break;
	case "Monday" : $hari2 = "Senin"; break;
	case "Tuesday" : $hari2 = "Selasa"; break;
	case "Wednesday" : $hari2 = "Rabu"; break;
	case "Thursday" : $hari2 = "Kamis"; break;
	case "Friday" : $hari2 = "Jumat"; break;
	case "Saturday" : $hari2 = "Sabtu"; break;
}

$smp = mysqli_query($con, "select *from quality_audit where DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$date' and '$date2' ");
$sampel = mysqli_num_rows($smp);
if ($sampel>0) {
	$sampel = mysqli_num_rows($smp);
	$s = $sampel;
}else{
	$sampel = 1;
	$s = 0;
}

$query = mysqli_query($con, "select sum(bersih) as bersih from quality_audit where DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$date' and '$date2' ");
	$hasilb = mysqli_fetch_array($query);
	$bersih = $hasilb['bersih'];
	$b = ($bersih/$sampel);
	
$query2 = mysqli_query($con, "select sum(rapi) as rapi from quality_audit where DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$date' and '$date2' ");
	$hasilc = mysqli_fetch_array($query2);
	$rapi = $hasilc['rapi'];
	$c = ($rapi/$sampel);
	

$query3 = mysqli_query($con, "select sum(harum) as harum from quality_audit where DATE_FORMAT(tgl_input, '%Y-%m-%d') between '$date' and '$date2' ");
	$hasild = mysqli_fetch_array($query3);
	$harum = $hasild['harum'];
	$d = ($harum/$sampel);

?>
<script src="js/dark-green.js"></script>	
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
	
		<div id="container4" style="min-width: 170px; height: 180px; margin: 0 auto"></div>

		<script type="text/javascript">
			Highcharts.chart('container4', {
		    chart: {
		        type: 'column'
		    },
		    title: {
		        text: 'Rata-Rata Quality Audit Mingguan'
		    },
		 
		    xAxis: {
		        type: 'category'
		    },
		    yAxis: {
		        title: {
		            text: 'Total'
		        }

		    },
		    legend: {
		        enabled: false
		    },
		    plotOptions: {
		        series: {
		            borderWidth: 0,
		            dataLabels: {
		                enabled: true,
		                format: '{point.y:.2f}'
		            }
		        }
		    },

		    tooltip: {
		        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
		        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b> of total<br/>'
		    },

		    series: [{
		        name: 'Kategori',
		        colorByPoint: true,
		        data: [{
		            name: 'Kebersihan',
		            y: <?php echo $b ?>          
		        }, {
		            name: 'Kerapian',
		            y: <?php echo $c ?>           
		        }, {
		            name: 'Keharuman',
		            y: <?php echo $d ?>              
		        }]
		    }],    
		});
		</script>



		<?php echo '<p style="font-size: 10px; font-weight: bold; text-align: right;">Skala : ' .$hari.', '.date('d M Y', strtotime('-7 day', strtotime(date('Y-m-d')))).' - '.$hari2.', '.date('d M Y', strtotime('-1 day', strtotime(date('Y-m-d')))).'<br>Jumlah sampel : '.$s.'</p>'; ?>

