<?php 


$startDate = date('Y-m-d', strtotime('-9 days', strtotime($date)));
$endDate = date('Y-m-d', strtotime('-3 days', strtotime($date)));




function semua_data_input($startDate,$endDate){
  global $con, $cabang, $outlet;
  $query = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND DATE_FORMAT(a.tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' AND b.Kota='$cabang' AND a.nama_outlet='$outlet'");
  $dataquery = mysqli_fetch_array($query);
  $data = $dataquery['jumlah'];
  return $data;
}

function otp_all($startDate,$endDate){
  global $con, $cabang, $outlet;
  $query = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND DATE_FORMAT(a.tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' AND b.Kota='$cabang' AND datediff(a.tgl_kembali, a.tgl_input)<='2' AND a.nama_outlet='$outlet' ");
  $dataquery = mysqli_fetch_array($query);
  $data = $dataquery['jumlah'];
  return $data;
}

function otp_spk($startDate,$endDate){
  global $con, $cabang, $outlet;
  $query = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND DATE_FORMAT(a.tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' AND b.Kota='$cabang' AND datediff(a.tgl_spk, a.tgl_input)='0' AND a.nama_outlet='$outlet' ");
  $dataquery = mysqli_fetch_array($query);
  $data = $dataquery['jumlah'];
  return $data;
}

function otp_operasional($startDate,$endDate){
  global $con, $cabang, $outlet;
  $query = mysqli_query($con, "SELECT COUNT(*) AS jumlah FROM reception a, outlet b WHERE a.nama_outlet=b.nama_outlet AND DATE_FORMAT(a.tgl_input, '%Y-%m-%d') BETWEEN '$startDate' AND '$endDate' AND b.Kota='$cabang' AND datediff(a.tgl_packing, a.tgl_spk)<='2' AND a.nama_outlet='$outlet'");
  $dataquery = mysqli_fetch_array($query);
  $data = $dataquery['jumlah'];
  return $data;
}


function data_otp($startDate,$endDate){
  $data['otp_all'] = round(otp_all($startDate,$endDate)/semua_data_input($startDate,$endDate)*100,2);
  $data['otp_spk'] = round(otp_spk($startDate,$endDate)/semua_data_input($startDate,$endDate)*100,2);
  $data['otp_operasional'] = round(otp_operasional($startDate,$endDate)/semua_data_input($startDate,$endDate)*100,2); 
  return $data;

}

$data = data_otp($startDate,$endDate);

$day = date('l', strtotime($startDate));
$day2 = date('l', strtotime($endDate));

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
?>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div id="chart_otp" style="width: 100%; min-height: 200px;"></div>
<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart4);
    function drawChart4() {
      var data = google.visualization.arrayToDataTable([
        ['Range OTP', 'Percentage', { role: 'style' } ],
        ['OTP Outlet', <?php echo $data['otp_all'] ?>, 'color: gray'],
        ['OTP SPK', <?php echo $data['otp_spk'] ?>, 'color: #76A7FA'],
        ['OTP Operasional', <?php echo $data['otp_operasional'] ?>, 'opacity: 0.2']
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
        bar: {groupWidth: "100%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("chart_otp"));
      chart.draw(view, options);
  }

    $(window).resize(function(){
      drawChart4();
    });
  
</script>



<?php echo '<p style="font-size: 10px; font-weight: bold; text-align: right;">Skala : ' .$hari.', '.date('d M Y', strtotime($startDate)).' - '.$hari2.', '.date('d M Y', strtotime($endDate)).'<br>Jumlah Nota : '.semua_data_input($startDate,$endDate).'</p>'; ?>
  