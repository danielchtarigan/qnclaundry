<?php 
include 'fungsi/otp.php';


$workshop = "Toddopuli";
$workshop2 = "Daya";
$workshop3 = "";


$date1 = date('Y-m-d');
$date2 = date('Y-m-d', strtotime('-1 days', strtotime($date1)));
$date3 = date('Y-m-d', strtotime('-3 days', strtotime($date1)));
$date4 = date('Y-m-d', strtotime('-4 days', strtotime($date1)));
$date5 = date('Y-m-d', strtotime('-5 days', strtotime($date1)));
$date6 = date('Y-m-d', strtotime('-6 days', strtotime($date1)));
$date7 = date('Y-m-d', strtotime('-7 days', strtotime($date1)));
$date8 = date('Y-m-d', strtotime('-8 days', strtotime($date1)));
$date9 = date('Y-m-d', strtotime('-9 days', strtotime($date1)));
$date10 = date('Y-m-d', strtotime('-10 days', strtotime($date1)));


$days1 = date('l');
$days2 = date('l', strtotime('-1 days', strtotime($date1)));
$days3 = date('l', strtotime('-3 days', strtotime($date1)));
$days4 = date('l', strtotime('-4 days', strtotime($date1)));
$days5 = date('l', strtotime('-5 days', strtotime($date1)));
$days6 = date('l', strtotime('-6 days', strtotime($date1)));
$days7 = date('l', strtotime('-7 days', strtotime($date1)));
$days8 = date('l', strtotime('-8 days', strtotime($date1)));
$days9 = date('l', strtotime('-9 days', strtotime($date1)));
$days10 = date('l', strtotime('-10 days', strtotime($date1)));

$startDate = $date9;
$endDate = $date3;
$data = kumpulan_otp($startDate,$endDate,$workshop);
$data2 = kumpulan_otp($startDate,$endDate,$workshop2);
$data3 = kumpulan_otp($startDate,$endDate,$workshop3);

?>


<div id="chart_otp" style="width: 100%; min-height: 361px;"></div>
<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(otp);
    function otp() {
      var data = google.visualization.arrayToDataTable([
        ['Range OTP', 'Percentage', { role: 'style' } ],
        ['OP TDP', <?= round($data['otp_operasional']*100,2) ?>, 'color: #00fad7'],
        ['OP ATG', <?= round($data2['otp_operasional']*100,2) ?>, 'color: #00fa69'],
        ['OP Umum', <?= round(($data['otp_operasional']+$data2['otp_operasional']+$data3['otp_operasional'])/4*100,2) ?>, 'color: #66cccc'],
        ['Outlet Umum', <?= round($data['otp_outlet']*100,2) ?>, 'color: #b6f500'],
        ['SPK Umum', <?= round($data['otp_spk']*100,2) ?>, 'color: #c0def4']
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Ontime Performance",
        legend: { position: "none" },
        isStacked: 'percentage',
        vAxis: {
            minValue: 40,
            ticks: [40, 60, 80]
        }
      };
      var chart = new google.visualization.BarChart(document.getElementById("chart_otp"));
      chart.draw(view, options);
  }

    $(window).resize(function(){
      otp();
    });
  
</script>

