<?php 
include 'function/quality_audit.php';


$startDate = $date8;
$endDate = $date2;

?>

<div id="columnchart_values" style="width: 100%; min-height: 400px;"></div>
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
        bar: {groupWidth: "100%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }

    $(window).resize(function(){
      drawChart3();
    });
  
</script>

<footer class="blockquote-footer">Range : 
  <cite title="Source Title"><?= $day8.' - '.$day2 ?></cite>
</footer>