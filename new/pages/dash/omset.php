<?php 
$date = date('Y-m-d');

$date2 = date('Y-m-d', strtotime('-1 days', strtotime($date)));
$date3 = date('Y-m-d', strtotime('-1 days', strtotime($date2)));
$date4 = date('Y-m-d', strtotime('-1 days', strtotime($date3)));
$date5 = date('Y-m-d', strtotime('-1 days', strtotime($date4)));
$date6 = date('Y-m-d', strtotime('-1 days', strtotime($date5)));
$date7 = date('Y-m-d', strtotime('-1 days', strtotime($date6)));
$date8 = date('Y-m-d', strtotime('-1 days', strtotime($date7)));

$dates = date('D');
$dates2 = date('D', strtotime('-1 days', strtotime($date)));
$dates3 = date('D', strtotime('-1 days', strtotime($date2)));
$dates4 = date('D', strtotime('-1 days', strtotime($date3)));
$dates5 = date('D', strtotime('-1 days', strtotime($date4)));
$dates6 = date('D', strtotime('-1 days', strtotime($date5)));
$dates7 = date('D', strtotime('-1 days', strtotime($date6)));
$dates8 = date('D', strtotime('-1 days', strtotime($date7)));

function hari($date){
	global $con;
	$query = mysqli_query($con, "SELECT COALESCE(SUM(total_bayar),0) AS omset FROM reception WHERE tgl_input LIKE '$date%' AND nama_outlet='$_SESSION[outlet]' AND (cara_bayar<>'Void' OR cara_bayar<>'Reject') ");
	$data = mysqli_fetch_array($query);
	$omset = $data['omset'];
	return $omset;
}

function hari_kiloan($date){
	global $con;
	$query = mysqli_query($con, "SELECT COALESCE(SUM(total_bayar),0) AS omset FROM reception WHERE tgl_input LIKE '$date%' AND nama_outlet='$_SESSION[outlet]' AND (cara_bayar<>'Void' OR cara_bayar<>'Reject')  AND jenis='k'");
	$data = mysqli_fetch_array($query);
	$omset = $data['omset'];
	return $omset;
}

function hari_potongan($date){
	global $con;
	$query = mysqli_query($con, "SELECT COALESCE(SUM(total_bayar),0) AS omset FROM reception WHERE tgl_input LIKE '$date%' AND nama_outlet='$_SESSION[outlet]' AND (cara_bayar<>'Void' OR cara_bayar<>'Reject')  AND jenis='p'");
	$data = mysqli_fetch_array($query);
	$omset = $data['omset'];
	return $omset;
}

?>
       
<div class="row">
	 <div class="col-md-12 text-center">
	    <h4>OMSET Harian <?php echo ucwords($outlet) ?></h4>	
	    <p style="color: green;">Today : <?php echo date('l, d M Y'); ?></p>	    
	 </div>
	 <div class="col-md-4 col-md-offset-4">
        <hr>
    </div>

  <div class="clearfix"></div>
  <div class="col-md-6">
    <div id="chart_div2" class="chart" style="width: 100%; min-height: 250px"></div>
  </div>
  <div class="col-md-6">
    <div id="chart_div1" class="chart" style="width: 100%; min-height: 250px"></div>
  </div>
</div>


</script>


<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart1);
  function drawChart1() {
    var data = google.visualization.arrayToDataTable([
      ['Days', 'Kiloan', 'Potongan'],
      ['<?php echo $dates8 ?>',  <?php echo hari_kiloan($date8) ?>,      <?php echo hari_potongan($date8) ?> ],
      ['<?php echo $dates7 ?>',  <?php echo hari_kiloan($date7) ?>,      <?php echo hari_potongan($date7) ?> ],
      ['<?php echo $dates6 ?>',  <?php echo hari_kiloan($date6) ?>,      <?php echo hari_potongan($date6) ?> ],
      ['<?php echo $dates5 ?>',  <?php echo hari_kiloan($date5) ?>,      <?php echo hari_potongan($date5) ?> ],
      ['<?php echo $dates4 ?>',  <?php echo hari_kiloan($date4) ?>,      <?php echo hari_potongan($date4) ?> ],
      ['<?php echo $dates3 ?>',  <?php echo hari_kiloan($date3) ?>,      <?php echo hari_potongan($date3) ?> ],
      ['<?php echo $dates2 ?>',  <?php echo hari_kiloan($date2) ?>,      <?php echo hari_potongan($date2) ?> ],
      ['<?php echo $dates ?>',  <?php echo hari_kiloan($date) ?>,        <?php echo hari_potongan($date) ?>]
    ]);

    var options = {
      title: 'Omset Persegment',
      hAxis: {title: 'Days', titleTextStyle: {color: 'green'}
    }
   };

  var chart = new google.visualization.ColumnChart(document.getElementById('chart_div1'));
    chart.draw(data, options);
  }

  google.load("visualization", "1", {packages:["line"]});
  google.setOnLoadCallback(drawChart2);
  function drawChart2() {
    var data = google.visualization.arrayToDataTable([
      ['Days', 'Omset Order'],
            ['<?php echo $dates8 ?>',  <?php echo hari($date8) ?>],
            ['<?php echo $dates7 ?>',  <?php echo hari($date7) ?>],
            ['<?php echo $dates6 ?>',  <?php echo hari($date6) ?>],
            ['<?php echo $dates5 ?>',  <?php echo hari($date5) ?>],
            ['<?php echo $dates4 ?>',  <?php echo hari($date4) ?>],
            ['<?php echo $dates3 ?>',  <?php echo hari($date3) ?>],
            ['<?php echo $dates2 ?>',  <?php echo hari($date2) ?>],
            ['<?php echo $dates ?>',  <?php echo hari($date) ?>]
          ]);
    

   var options = {
      title: 'Omset Keseluruhan',
      hAxis: {title: 'Days', titleTextStyle: {color: 'green'}}
   };

    var chart = new google.visualization.AreaChart(document.getElementById('chart_div2'));
    chart.draw(data, options);
  }

  $(window).resize(function(){
    drawChart1();
    drawChart2();
  });

// Reminder: you need to put https://www.google.com/jsapi in the head of your document or as an external resource on codepen //
</script>
  
  
 
