<?php 
include 'fungsi/quality_audit.php';

$startDate = $date7;
$endDate = $date2;

?>

<div id="columnchart_values" style="width: 100%; min-height: 180px;"></div>
<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart3);
    function drawChart3() {
      var data = google.visualization.arrayToDataTable([
        ["Kategori", "Rat", { role: "style" } ],
        ["Kebersihan", <?= kebersihan($startDate,$endDate) ?>, "#76ec64"],
        ["Kerapian", <?= kerapian($startDate,$endDate) ?>, "#bdd2ec"],
        ["Keharuman", <?= keharuman($startDate,$endDate) ?>, "#ce7cec"]
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Quality Audit",
        legend: { position: "none" },
        isStacked: true,
        vAxis: {
            viewWindowMode:'explicit',
            viewWindow: {
              max:4.8,
              min:4.2
            }
        }
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }

    $(window).resize(function(){
      drawChart3();
    });
  
</script>

<ul class="list-group">
  <li class="list-group-item">Ketepatan Waktu
    <span class="pull-right"><?= ketepatanWaktu($startDate,$endDate) ?></span>
  </li>
  <li class="list-group-item">Ketepatan Jumlah
    <span class="pull-right"><?= ketepatanJumlah($startDate,$endDate) ?></span>
  </li>
</ul>

<p style="font-size:9px; font-style: oblique; font-weight: bold">Sumber: <?= date('d/m/Y', strtotime($startDate)).' - '.date('d/m/Y', strtotime($endDate)) ?></p>