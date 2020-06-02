<script type="text/javascript">
  google.charts.load("current", {packages:["corechart"]});
  google.charts.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Promo', 'Penggunaan'],
      ['Kosong',     1],
    ]);

    var options = {
      title: 'Penggunaan Kode Promo',
      pieHole: 0.4,
    };

    var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
    chart.draw(data, options);
  }
</script>

<div id="donutchart" class="chart" style="width: 100%; min-height: 200px">BELUM TERBIT VOUCHER</div>
<?php echo '<p style="font-size: 10px; font-weight: bold; text-align: right;">Skala : ' .$hari.', '.date('d M Y', strtotime($startDate)).' - '.$hari2.', '.date('d M Y', strtotime($endDate)).'<br>Jumlah Nota : '.semua_data_input($startDate,$endDate).'</p>'; ?>